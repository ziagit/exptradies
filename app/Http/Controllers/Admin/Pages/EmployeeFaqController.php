<?php

namespace App\Http\Controllers\admin\Pages;

use App\EmployeeFaq;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeFaqController extends Controller
{
     //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = EmployeeFaq::orderBy('id','DESC')->paginate(10);
        return response()->json($data);
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
   
        $faq = new EmployeeFaq();

        $faq->title = $request->title;
        $faq->body = $request->body;

        $faq->save();
        return response()->json(["message" => "Saved Successfully."], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shipper = EmployeeFaq::find($id);
        return response()->json($shipper);
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
        $faq = EmployeeFaq::find($id);
        $faq->title = $request->title;
        $faq->body = $request->body;
        $faq->update();
        return response()->json(["message" => "Updated Successfully."], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($faq = EmployeeFaq::find($id)) {
            $faq->delete();
            return response()->json(["message" => "Deleted Successfully."]);
        }
        return response()->json(["message" => "Data Not Found!"]);
    }
    public function search(Request $request)
    {
        $keywords = $request->keywords;
        $data = EmployeeFaq::where('title', 'like', '%' . $keywords . '%')
            ->paginate(5);
        return $data;
    }

}
