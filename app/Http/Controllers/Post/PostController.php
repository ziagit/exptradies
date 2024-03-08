<?php

namespace App\Http\Controllers\Post;

use App\Address;
use App\BusinessAddress;
use App\Employee;
use App\Employer;
use App\Helpers\DistanceHelper;
use App\Helpers\NotificationHelper;
use App\Http\Controllers\Controller;
use App\Http\Services\Notification;
use App\Image;
use App\Jobs\AlertEmployee;
use App\Jobs\SendEmail;
use App\Post;
use App\Role;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PostController extends Controller
{
    public $employees;
    public $post;
    public $token;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $defaultText="I will provide further work details either during our conversations or through direct contact. I look for expert who can deliver exceptionally high-quality services, free from any flaws or shortcomings.";
        try{
            $address = $this->storeAddress($request);
            $user = $this->storeUser($request);
            if(!$user)
            return response()->json("This email is already taken.",409);

            $employer = $this->storeEmployer($request, $address,$user);
    
            $post = new Post();
            $post->note = $request->contact['message']?$request->contact['message']:$defaultText;
            $post->service_id = $request->service['id'];
            $post->employee_id = $employer[1];
            $post->address_id = $address->id;
            $post->save();

            $post->options()->attach($request->options);
            $post->suboptions()->attach($request->suboptions);

            $imageIds = $this->attachImages($request->images);
    
           if($imageIds)
           $post->images()->attach($imageIds);
    
           dispatch(new AlertEmployee($post,$request));

           return response()->json(['me'=>$employer[0], 'message'=>'Posted successfuly.'],200);
        }catch(Exception $e){
            return response()->json($e->getMessage(),400);
        }
    }
    
    public function attachImages($images){
        if($images){
            $ids = array();
            foreach($images as $img){
                $image = new Image();
                $image->name = $img['name'];
                $image->save();
                array_push($ids, $image->id);
            }
            return $ids;
        }
        return null;
    }
  
    public function storeEmployer($request, $address,$user)
    {
        try{
            $arr=array();
            $arr[0]=$user->id;
    
            $employer = Employee::where('user_id', $user->id)->first();
            
            if ($employer) {
                $arr[1]=$employer->id;
                return $arr;
            }

            $emp = new Employee();
            $emp->first_name = $request->contact['name'];
            $emp->last_name = $request->contact['name'];

            $emp->user_id = $user->id;
            $emp->address_id = $address->id;
            $emp->save();

            $arr[1]=$emp->id;
            return $arr;
        }catch(Exception $e){
            return $e->getMessage();
        }
       
    }
 
    public function storeUser($request)
    {
        $user= User::where("email",$request->contact['email'])->first();
        $user->phone = $request->contact['phone'];
        $user->verification_code = rand(1000, 9999);
        $user->update();
        return $user;
    }
    public function storeAddress($request)
    {
        $address = new Address();
        $address->country = $request->address['country'];
        $address->state = $request->address['state'];
        $address->city = $request->address['city'];
        $address->zip = $request->address['zip'];
        $address->street = $request->address['street'];
        $address->street_number = $request->address['street_number'];
        $address->formatted_address = $request->address['formatted_address'];
        $address->save();
        return $address;
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with('service', 'address', 'employer', 'options')->find($id);
        return response()->json($post);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }








    // public function findEmployees($post)
    // {
    //     $this->post = Post::with('address', 'service', 'options')
    //     ->find($post->id);

    //     $service = $post->service['id'];

    //     $this->employees = Employee::whereHas('services', function ($q) use ($service) {
    //         $q->where('services.id', $service);
    //     })
       
    //     ->with('businessAddresses', 'user')
    //     ->get();
    //     return $this->employees;
    // }

    // /**
    //  * Execute the job.
    //  *
    //  * @return void
    //  */
    // public function handle()
    // {
    //     $users = User::whereHas(
    //         'roles',
    //         function ($q) {
    //             $q->where('name', 'Admin')
    //                 ->orWhere('name', 'Support');
    //         }
    //     )->get();

    //     foreach ($this->employees as $employee) {
    //         if($this->isInRange($employee) && ($employee->user_id != Auth::id())){
    //             $emp = Employee::find($employee->id);
    //             $emp->posts()->attach($this->post->id);
    //             $user = User::find($employee->user_id);
                
    //             $users->push($user);
                
    //             //Mail::to($users[0]->email)->queue(new MailAlertEmployee("New job"));
    //         }
    //     }

    //     $this->notify($users);
    //     return $emp;
    // }

    // public function isInRange($employee){
    //     $postAddress = $this->post->address['formatted_address'];
    //     $empAddresses = $employee->businessAddresses;
    //     $isFound=false;
    //     foreach($empAddresses as $address){
    //         $km = DistanceHelper::getInKm($postAddress, $address['address']);
    //         if($km<=$address['range']){
    //             $isFound=true;
    //             break;
    //         }
    //     }
    //     return $isFound;
    // }
    // public function notify($users)
    // {
    //     $data = [
    //         "title" => "New job",
    //         "body" => "", 
    //         "type" => "post",
    //         "url" => "",
    //         "postId" => $this->post->id,
    //         "orderId" => null,
    //         "roomIds" => null,
    //         "earningId" => null,
    //         "refundId" => null,
    //     ];
    //      new NotificationHelper(Auth::id(), $users, $data);
    //     return;
    // }
}
