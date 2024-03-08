<?php

namespace App\Jobs;

use App\Commission;
use App\Employee;
use App\Helpers\DistanceHelper;
use App\Helpers\NotificationHelper;
use App\Mail\NotifyEmployee;
use App\Post;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AlertEmployee implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $employees;
    public $post;
    public $response;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($post,$request)
    {
        $this->post = Post::with('address', 'service', 'options')
        ->find($post->id);

        if($request->emp_id){
            $this->employees = Employee::whereId($request->emp_id)->get();
        }else{
            $service = $post->service['id'];

            $this->employees = Employee::where('user_id','!=',Auth::id())
            ->whereHas('services', function ($q) use ($service) {
                $q->where('services.id', $service);
            })
            ->with('businessAddresses', 'user')
            ->get();
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
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
                $commission = $this->addCommission($this->post,$km); 
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
        return 20.00;
    }
}
