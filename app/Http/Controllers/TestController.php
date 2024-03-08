<?php

namespace App\Http\Controllers;

use App\Commission;
use App\Company;
use App\Employee;
use App\Helpers\DistanceHelper;
use App\Helpers\NotificationHelper;
use App\Jobs\ForgetPassword;
use App\Jobs\VerifyEmail as JobsVerifyEmail;
use App\Mail\BalanceCreated;
use App\Mail\BalanceExpired;
use App\Mail\NotifyEmployee;
use App\Mail\PostAccepted;
use App\Mail\ResetPassword;
use App\Post;
use App\Service;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Cartalyst\Stripe\Laravel\Facades\Stripe;


class TestController extends Controller
{
    public $employees;
    public $post;
    public $response;
    public function index(){
        Mail::to('employee@gmail.com')->send(new ResetPassword('xsia','code455'));

return "sent.";
        $this->post = Post::with('address', 'service', 'options')
        ->find(2);

        $service = $this->post->service['id'];

        $this->employees = Employee::where('user_id','!=',Auth::id())
        ->whereHas('services', function ($q) use ($service) {
            $q->where('services.id', $service);
        })
        ->with('businessAddresses', 'user')
        ->get();
      
        return $this->handle();
    }
    public function handle()
    {
        $users = User::whereHas(
            'roles',
            function ($q) {
                $q->where('name', 'Admin')
                    ->orWhere('name', 'Support');
            }
        )->get();

        foreach ($this->employees as $employee) {
            
            $km = $this->isInRange($employee);
            if($km){
                $emp = Employee::find($employee->id);
                return $commission = $this->addCommission($this->post,$km); 
                $emp->posts()->attach($this->post->id,['commission' => $commission]);
                $user = User::find($employee->user_id);
                $users->push($user);
            }
        }
        return $this->notify($users);
    }


    public function isInRange($employee){
        if(count($employee->businessAddresses)==0){
            return null;
        }
        
        $postAddress = $this->post->address['formatted_address'];
        $empAddresses = $employee->businessAddresses;
        $kms=[];
        foreach($empAddresses as $address){
            $km = DistanceHelper::getInKm($postAddress, $address['address']);
            if($km<=$address['range']){
                array_push($kms,$km==0?1:$km);
            }
        }
        if (count($kms)==0) {
            return null;
        }
        if (count($kms) === 1) {
            return $kms[0];
        }
        return min($kms);
    }

    public function notify($users)
    {
        $data = [
            "title" => "New job",
            "body" =>  json_encode(array($this->post->service->name, $this->post->employee->first_name)),
            "type" => "post",
            "url" => "",
            "postId" => $this->post->id,
            "orderId" => null,
            "roomIds" => null,
            "earningId" => null,
            "refundId" => null,
        ];
         new NotificationHelper(Auth::id(), $users, $data);

         foreach($users as $user){
            if($user->roles[0]->name != 'Admin' && $user->roles[0]->name!='Support'){
                Mail::to($user->email)->queue(new NotifyEmployee($user->name,$this->post->service->name, $this->post->address->city));
            }
         }

        return 'notified';
    }
    public function addCommission($post,$km)
    {
        $commission = Commission::where('service_id', $post->service_id)->first();
        if($commission){
            $km_result =  $commission->km_amount / ($km == 0 ? 1 : $km);
            $result = $commission->service_amount + $km_result;
            return round($result, 2);
        }
        return 20;
    }
}
