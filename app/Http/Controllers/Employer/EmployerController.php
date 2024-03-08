<?php

namespace App\Http\Controllers\Employer;

use App\Address;
use App\Employee;
use App\Employer;
use App\Http\Controllers\Controller;
use App\Service;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::id();
        $employee = Employer::with('user', 'address')
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
        try {
            $validated = $request->validate([
                "name" => "required",
                "country" => "required",
                "state" => "required",
                "city" => "required",
                "zip" => "required",
                "street" => "required",
                "street_number" => "required",
                "formatted_address" => "required",

            ]);
            $address = $this->storeAddress($request);
            $user = $this->getUser();
            $employee = new Employer();
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->licence = $request->licence;
            $employee->service_id = $request->skill;
            $employee->user_id = $user->id;
            $employee->address_id = $address->id;
            $employee->save();
            return response()->json($employee, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
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
    public function getUser()
    {
        $user = Auth::user();
        return $user;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employer = Employer::with('address')->find($id);
        return response()->json($employer);
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
        $request->validate([
            "name" => "required",
            "country" => "required",
            "state" => "required",
            "city" => "required",
            "zip" => "required",
            "street" => "required",
            "street_number" => "required",
            "formatted_address" => "required",

        ]);
        $emp = Employer::with('address','user')->find($id);
        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->update();
        $this->updateAddress($request, $emp->address_id);
        $emp->name = $request->name;
        $emp->update();
        return response()->json("Updated successfully.", 200);
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
  
}
