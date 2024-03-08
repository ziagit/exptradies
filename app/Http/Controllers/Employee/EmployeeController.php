<?php

namespace App\Http\Controllers\Employee;

use App\Address;
use App\BusinessAddress;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Service;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::id();
        $employee = Employee::with('user', 'address','businessAddresses', 'services')
            ->where('user_id', $user)
            ->first();
        return response()->json($employee);
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
            $validator=Validator::make($request->all(),[
                "first_name" => "required",
                "last_name" => "required",
                "phone" => "required|unique:users",
                "country" => "required",
                "state" => "required",
                "city" => "required",
                "zip" => "required",
                "formatted_address" => "required",
                "business_abn" => "required|digits:11",
                "services"=>"required",
                "service_area"=>"required"

            ]);
            if($validator->fails()){
                return response()->json($validator->errors(),400);
            }
            try {
                $address = $this->storeAddress($request);
                $this->updateUser($request);
                
                $employee = new Employee();
                $employee->first_name = $request->first_name;
                $employee->last_name = $request->last_name;
                $employee->business_abn = $request->business_abn;
                $employee->business_name = $request->business_name;
                $employee->business_details = 
                $employee->user_id = Auth::id();
                $employee->address_id = $address->id;
                $employee->save();

                foreach ($request->services as $service) {
                    $employee->services()->attach($service['id']);
                }
                $this->storeBusinessAddresses($employee, $request);
                return response()->json($employee);

            } catch (Exception $e) {
                return response()->json($e->getMessage());
            }
    }
    public function storeBusinessAddresses($employee, $request){
        BusinessAddress::where('employee_id',$employee->id)->delete();;
        foreach($request->service_area as $area){
            $business = new BusinessAddress();
            $business->address = $area['address'];
            $business->range = $area['range'];
            $business->employee_id = $employee->id;
            $business->save();
        }
        return;
    }
    public function storeAddress($request)
    {
        $address = new Address();
        $address->country = $request->country;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->zip = $request->zip;
        $address->street = $request->street;
        $address->street_number = $request->street_number;
        $address->formatted_address = $request->formatted_address;
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
        $employee = Employee::with('address')->find($id);
        return response()->json($employee);
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
        // $validator = Validator::make($request->all(),[
        //     "first_name" => "required",
        //     "last_name" => "required",
        //     "country" => "required",
        //     "state" => "required",
        //     "city" => "required",
        //     "zip" => "required",
        //     "formatted_address" => "required",
        //     "business_abn" => "required|string|size:11",
        //     "services"=>"required",
        //     "service_area"=>"required"
        // ]);
        // if($validator->fails()){
        //     return response()->json($validator->errors(),400);
        // }
        $employee = Employee::with('address')->find($id);

        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->business_abn = $request->business_abn;
        $employee->business_name = $request->business_name;
        $employee->business_details = $request->business_details;
        $employee->license_number = $request->license_number;

        $this->updateAddress($request, $employee->address_id);

        $this->updateUser($request);

        $employee->update();

        $employee->services()->detach();
        foreach ($request->services as $service) {
            $employee->services()->attach($service['id']);
        }
        $this->storeBusinessAddresses($employee, $request);

        return response()->json($employee, 200);
    }
    public function updateAddress($request, $address)
    {
        $address = Address::find($address);
        $address->country = $request->country;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->zip = $request->zip;
        $address->street = $request->street;
        $address->street_number = $request->street_number;
        $address->formatted_address = $request->formatted_address;
        $address->update();
        return $address;
    }
    public function updateUser($request){
        $user = User::find(Auth::id());
        $user->name = $request->first_name;
        if($request->phone)
        $user->phone=$request->phone;
        if($request->email)
        $user->email = $request->email;
        $user->update();
        return;
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
    public function services()
    {
        $services = Service::all();
        return response()->json($services);
    }

    //get address to calculate rate while accepting job
    public function address()
    {
        $employee = Employee::with('address')->where('user_id', Auth::id())->first();
        return response()->json($employee->address);
    }

  
}
