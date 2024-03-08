<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Controller;
use App\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options = Option::with('step')->orderBy('id','DESC')->paginate(10);
        return response()->json($options);
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
        ]);
        $step = new Option();
        $step->title = $request->title;
        $step->details = $request->details;
        $step->value = null;
        $step->step_id = $request->step_id;
        $step->save();
        return response()->json($step, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $options = Option::where('step_id',$id)->get();
        return response()->json($options);
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
        ]);
        $step = Option::find($id);
        $step->title = $request->title;
        $step->details = $request->details;
        $step->value = null;
        $step->step_id = $request->step_id;
        $step->update();
        return response()->json($step, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $step = Option::find($id);
        $step->delete();
        return response()->json("Deleted successfully!", 200);
    }
    public function search(Request $request)
    {
        $keywords = $request->keywords;
        $data = Option::where('title', 'like', '%' . $keywords . '%')
        ->with('step')
            ->paginate(5);
        return $data;
    }
}
