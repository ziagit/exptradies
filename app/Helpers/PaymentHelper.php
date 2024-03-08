<?php

namespace App\Helpers;

use App\Balance;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Exception;

class PaymentHelper{
    static function getCustomer($customerId){
        $methods = Stripe::paymentMethods()->all([
            'type' => 'card',
            'customer' => $customerId,
        ]);
        return $methods;
    }
    static function createCustomer($request){
        $customer = Stripe::customers()->create([
            'name' => $request->name,
            'email' => $request->email,
            'payment_method' => $request->paymentMethod,
            'description' => 'Exptradies customer',
        ]);
        return $customer;
    }
    static function updateCustomer($request, $customerId){
        $customer = Stripe::customers()->update(
            $customerId,
            [
            'name' => $request->name,
            'email' => $request->email,
            'description' => 'Exptradies customer',
        ]);
        $methods = PaymentHelper::getPaymentMethods($customerId);
        
        Stripe::paymentMethods()->detach($methods[0]['id']);
        Stripe::paymentMethods()->attach($request->paymentMethod, $customerId);

        return $customer;
    }
    static function createPaymentIntent($amount, $customerId){
        $paymentIntent = Stripe::paymentIntents()->create([
            'customer'=>$customerId,
            'amount' => $amount,
            'currency' => 'AUD',
            'payment_method_types' => ['card'],
            'payment_method'=> PaymentHelper::getPaymentMethods($customerId)[0]['id'],
            'confirm' => true
            //'capture_method' => 'manual',
        ]);
        return $paymentIntent;
    }
    static function getPaymentMethods($customerId){
        $methods = Stripe::paymentMethods()->all([
            'type' => 'card',
            'customer' => $customerId,
        ]);
        return $methods['data'];
    }

    static function payByBalance($amount,$employee){

        $balance = Balance::find(1);
        $payable = $amount - ($amount * $balance->discount/100);
        $employee->balance = $employee->balance-$payable;
        $employee->update();
        return $balance->charge_id;
    }

    static function createRefund($chargeId, $amount){
        try{
            $refund = Stripe::refunds()->create($chargeId, $amount);
            return $refund;
        }catch(Exception $e){
            return $e->getMessage();
        }

     }
}