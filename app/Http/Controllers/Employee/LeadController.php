<?php

namespace App\Http\Controllers\Employee;

use App\Address;
use App\Balance;
use App\Commission;
use App\Company;
use App\Earning;
use App\Employee;
use App\Employer;
use App\Helpers\DistanceHelper;
use App\Helpers\NotificationHelper;
use App\Helpers\PaymentHelper;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\Jobs\EmployerPostAccepted;
use App\Jobs\PostAccepted as JobsPostAccepted;
use App\Post;
use App\Service;
use App\User;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::query()
        ->whereHas('employees', function ($rel) {
            $rel->where('user_id', Auth::id())
            ->whereNull('employee_post.status');
        })
        ->with([
            'address',
            'service',
            'employee',
            'employees' => function ($rel) {
                $rel->where('user_id', Auth::id())
                ->whereNull('employee_post.status');
            }
        ])
        ->orderByDesc('created_at')
        ->paginate(10);

        return response()->json($posts);
    }

    public function accepted()
    {
        $posts = Post::query()
        ->whereHas('employees', function ($rel) {
            $rel->where('employee_post.status', 'Accepted')
            ->where('user_id', Auth::id());
        })
        ->with([
            'address',
            'service',
            'employee',
            'employees' => function ($rel) {
                $rel->wherePivot('status', 'Accepted')
                ->where('user_id', Auth::id());
            }
        ])
        ->orderByDesc('created_at')
        ->paginate(10);

        return response()->json($posts);
    }

    public function show($id){
            $post = Post::whereId($id)
                ->with(['employees' => function($q){
                    $q->where('user_id',Auth::id());
                }])->with('address', 'service', 'options','images','employeeWithUser')
                ->first();
            return response()->json($post);
    }

    public function steps($id)
    {
        $service = Service::with('steps')->find($id);
        return response()->json($service);
    }

    public function accept($id)
    {
        $employee = Employee::where('user_id', Auth::id())
            ->whereNotNull('stripe_customer_id')
            ->first();

        if (!$employee) 
        return response()->json("Before accepting a job please add a payment method!", 404);

        $post = Post::with('employeeWithUser','employees')->find($id);
        $company = Company::select('acceptable_by')->first();

        if($post->number_of_accepted<$company->acceptable_by){

            $charge = $this->chargeEmployee($post, $employee);
        
            if($charge==400)
            return response()->json("A problem ocrurred, please make sure your card is valid and has enough funds.",400);
    
            $this->createEarning($charge, $post,$employee);
            $this->createInvoice($charge, $post,$employee);

            $post->is_acceptable=$post->number_of_accepted+1==$company->acceptable_by?false:true;
            $post->number_of_accepted = $post->number_of_accepted+1;
            $post->update();

            $employee->posts()->updateExistingPivot($post->id, ['status' => 'Accepted']);
            $this->notify($post,$employee);

            return response()->json("Accepted successfully.");
        }
        return response()->json("Unfortunately, another individual has accepted this job. To avoid missing out on future opportunities, please accept jobs as soon as you receive notification.",400);

    }
    
    public function chargeEmployee($post, $employee)
    {
        $commission = $post->employees[0]->pivot->commission;
        try {
            if($employee->balance && $employee->balance >= $commission ){
                 $chargeId = PaymentHelper::payByBalance($commission, $employee);
                return ["id"=>$chargeId,"amount"=>$commission];
            }
            $charge=PaymentHelper::createPaymentIntent($commission,$employee->stripe_customer_id);
            return ["id"=>$charge['id'],"amount"=>($charge['amount']/100)];
        } catch (Exception $e) {
            return 400;
        }
    }
    public function createEarning($charge, $post,$employee)
    {
        $company = Company::first();
        $gst = ($charge['amount'] * $company->gst) /100;
        $earning = new Earning();
        $earning->amount = $charge['amount'];
        $earning->gst = $gst;
        $earning->stripe_charge_id = $charge['id'];
        $earning->post_id = $post->id;
        $earning->employee_id = $employee->id;
        $earning->save();
        return $earning;
    }
    public function createInvoice($charge, $post, $employee)
    {
        $invoice = new Invoice();
        $invoice->amount = $charge['amount'];
        $invoice->stripe_charge_id = $charge['id'];
        $invoice->post_id = $post->id;
        $invoice->employee_id = $employee->id;
        $invoice->gst=0;
        $invoice->save();
        return $invoice;
    }
   
    public function notify($post,$employee)
    {
        $user = User::find($post->employeeWithUser->user_id);

        $this->createNotification($user,$post, $employee);
        dispatch(new JobsPostAccepted($user, $post));
        return "notified";
    }

    public function createNotification($user, $post, $employee)
    {
        $users = User::whereHas(
            'roles',
            function ($q) {
                $q->where('name', 'Admin')
                    ->orWhere('name', 'Support');
            }
        )->get();
        $users->push($user);

        $data = [
            "title" => "Job accepted",
            "body" =>json_encode($employee->business_name), 
            "type" => "post",
            "url" => "",
            "postId" => $post->id,
            "orderId" => null,
            "roomIds" => null,
            "earningId" => null,
            "refundId" => null,
        ];
         new NotificationHelper(Auth::id(), $users, $data);
        return "sent.";
    }

    public function search(Request $request)
    {
        $keywords = $request->keywords;
        if($request=='accepted'){
            $posts = Post::query()
            ->where('created_at','like','%'.$keywords.'%')
            ->orWhere('note','like','%'.$keywords.'%')
            ->orWhereHas('service',function($q) use($keywords){
                $q->where('name','like','%'.$keywords.'%');
            })
            ->whereHas('employees', function ($rel) {
                $rel->where('employee_post.status', 'Accepted')
                ->where('user_id', Auth::id());
            })
            ->with([
                'address',
                'service',
                'employees' => function ($rel) {
                    $rel->wherePivot('status', 'Accepted')
                    ->where('user_id', Auth::id());
                }
            ])
            ->paginate(10);
            return response()->json($posts);
        }
        $posts = Post::query()
       
        ->whereHas('employees', function ($rel) {
            $rel->where('user_id', Auth::id());
        })
        ->with([
            'address',
            'service',
            'employees' => function ($rel) {
                $rel->where('user_id', Auth::id());
            }
        ])
        ->where('created_at','like','%'.$keywords.'%')
        ->orWhere('note','like','%'.$keywords.'%')
        ->orWhereHas('service',function($q) use($keywords){
            $q->where('name','like','%'.$keywords.'%');
        })
        ->paginate(10);
        return response()->json($posts);
    }
}
