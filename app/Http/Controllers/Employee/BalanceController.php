<?php

namespace App\Http\Controllers\Employee;

use App\Balance;
use App\Employee;
use App\Helpers\NotificationHelper;
use App\Helpers\PaymentHelper;
use App\Http\Controllers\Controller;
use App\Jobs\BalanceCreated as JobsBalanceCreated;
use App\Jobs\ManualBalanceCreated;
use App\Mail\BalanceCreated;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Mail;

class BalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Employee::where('user_id', Auth::id())->first();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $balance = Balance::find(1);
        if($request->amount==null || floatval($request->amount) < $balance->min_balance){
            return response()->json("Please provide amount above or equal to $".$balance->min_balance,400);
        }
        $request->validate([
            "amount" => "required",
        ]);
        $employee = Employee::where('user_id', Auth::id())
        ->whereNotNull('stripe_customer_id')
        ->first();

        if($employee){

            $balance = Balance::find(1);
            $paymentIntent = PaymentHelper::createPaymentIntent($request->amount,$employee->stripe_customer_id);

            if(count($paymentIntent['charges']['data'])>0){
                $balance->charge_id = $paymentIntent['charges']['data'][0]['id'];
                $balance->update();
            }
            $amount = $request->amount + ($request->amount * $balance->percentage)/100;
            
            if($employee->balance)
            $amount = $amount + $employee->balance;

            $employee->balance = $amount;
            $employee->balance_updated_at = Carbon::now();
            $employee->update();

            $this->notify($employee, $amount);

            return response()->json("Thank you, your balance added.", 200);
        }
        return response()->json("Before adding your balance please add a payment method.",404);

    }

    public function notify($employee, $amount)
    {
        $user = User::find($employee->user_id);
        dispatch(new ManualBalanceCreated($employee->last_name, $user->email, $amount));
        $this->createNotification($user, $employee);
        return;
    }

      public function createNotification($user,$employee)
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
            "title" => "Balance created",
            "body" =>json_encode($employee->business_name), 
            "type" => "balance",
            "url" => "",
            "postId" => null,
            "orderId" => null,
            "roomIds" => null,
            "earningId" => null,
            "refundId" => null,
        ];
         new NotificationHelper(Auth::id(), $users, $data);
        return "sent.";
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $employee = Employee::find($id);
      $employee->is_balance_auto_renew = $request->status;
      $employee->update();
      return response()->json("Auto renewal updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 
}
