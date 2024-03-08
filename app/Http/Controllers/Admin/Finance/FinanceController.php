<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Earning;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emps = Earning::with('employee','employerPost')->orderBy('id','DESC')->paginate(10);
        return response()->json($emps);
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
    public function search(Request $request){
        $keywords = $request->keywords;
        $er = Earning::where('created_at', 'like', '%' . $keywords . '%')
        ->orWhere('amount','like','%'. $keywords.'%')
        ->orWhereHas('employee', function($q) use ($keywords){
            $q->where('first_name', 'like', '%'. $keywords .'%');
        })->with('employee','employerPost')
        ->orderBy('id','DESC')
        ->paginate(10);
        return $er;
    }
}
