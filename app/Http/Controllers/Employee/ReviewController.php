<?php

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
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
        $review = new Review();
        $review->stars = $request->stars;
        $review->message = $request->message;
        $review->employee_id = $request->employee;
        $review->review_by = Auth::user()->name;
        $review->save();

        $this->updateEmployee($request);

        return response()->json("Thank you for giving time to rate and review this business performance.");
    }

    public function updateEmployee($request){
        $emp= Employee::find($request->employee);
        $reviewed = Review::where('employee_id',$request->employee)->get();
        $stars = $reviewed->sum(function ($review) {
            return $review->stars;
        });
        $reviewCount = $reviewed->count()+1;
        $total = $stars + 5;
        $result = $total/$reviewCount;

        $emp->stars = $result;
        $emp->update();
        return $stars;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
}
