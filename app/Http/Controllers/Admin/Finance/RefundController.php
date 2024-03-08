<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Employee;
use App\Helpers\PaymentHelper;
use App\Http\Controllers\Controller;
use App\Post;
use App\Refund;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Exception;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $refunds = Refund::with('employee')->paginate(10);
        return response()->json($refunds);
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
        $post = Post::find($request->post_id);
        $stripeRef=PaymentHelper::createRefund($post->earning->stripe_charge_id,$request->amount);
        if($stripeRef){
            $refund = new Refund();
            $refund->employee_id = $request->employee_id;
            $refund->stripe_refund_id = $stripeRef['id'];
            $refund->amount = $stripeRef['amount']/100;
            $refund->reason = $request->reason;
            $refund->save();
            return response()->json("Refunded successfully.");
        }
        return response()->json("Refund failed.",400);

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
    public function search($request){
        
    }
    public function employees(){
      
        $employees = Employee::whereNotNull('business_name')
        ->whereNotNull('business_abn')
        ->whereHas('posts', function ($query) {
            $query->where('employee_post.status', 'Accepted');
        })
        ->with(['posts' => function ($query) {
            $query->where('employee_post.status', 'Accepted')
                  ->latest()
                  ->limit(1);
        }])
        ->get();
        return response()->json($employees);
    }
}
