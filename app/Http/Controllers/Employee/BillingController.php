<?php

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\Helpers\PaymentHelper;
use App\Http\Controllers\Controller;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emp = Employee::where('user_id', Auth::id())
            ->whereNotNull('stripe_customer_id')
            ->first();

        if ($emp) {
            $customer = PaymentHelper::getCustomer($emp->stripe_customer_id);
            //$card = Stripe::cards()->all();
            return response()->json($customer, 200);
        }
        return response()->json("No payment method added yet!", 404);
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
            $request->validate([
                "name_oncard" => "required",
                "email" => "required|email",
                "paymentMethod" => "required"
            ]);
            $customer = PaymentHelper::createCustomer($request);
            $this->updateEmployee($customer);
            return response()->json("Your payment method added successfuly.",200);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function updateEmployee($customer)
    {
        $emp = Employee::where('user_id', Auth::id())->first();
        $emp->stripe_customer_id = $customer['id'];
        $emp->update();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::with('user', 'address')->where("user_id", $id)->first();
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
        try {
            $request->validate([
                "name_oncard" => "required",
                "paymentMethod" => "required"
            ]);
            $emp = Employee::where('user_id', Auth::id())->first();
            return PaymentHelper::updateCustomer($request,$emp->stripe_customer_id);
            return response()->json("Your card updated successfuly.",200);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
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
