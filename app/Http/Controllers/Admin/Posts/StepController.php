<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Controller;
use App\Step;
use Illuminate\Http\Request;

class StepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $steps = Step::with('service')->orderBy('id', 'DESC')->paginate(10);
        return response()->json($steps);
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
        $request->validate([
            "title" => "required",
            "service_id" => "required",
        ]);
        $step = new Step();
        $step->title = $request->title;
        $step->details = $request->details;
        
        $step->service_id = $request->service_id;
        $step->save();
        return response()->json($step,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $steps = Step::where("service_id",$id)->get();
        return response()->json($steps);
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
            "title" => "required",
            "service_id" => "required"
        ]);
        $step = Step::find($id);
        $step->title = $request->title;
        $step->details = $request->details;
        $step->service_id = $request->service_id;
        $step->update();
        return response()->json($step,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $step = Step::find($id);
        $step->delete();
        return response()->json("Deleted successfully!",200);   
    }
    public function search(Request $request)
    {
        $keywords = $request->keywords;
        $data = Step::where('title', 'like', '%' . $keywords . '%')
        ->with("service")
            ->paginate(5);
        return $data;
    }
}
