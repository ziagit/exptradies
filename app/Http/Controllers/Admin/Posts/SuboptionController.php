<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Controller;
use App\Suboption;
use Illuminate\Http\Request;

class SuboptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options = Suboption::with('step')->orderBy('id','DESC')->paginate(10);
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
            "title" => "required_without:custom",
            "custom" => "required_without:title",
        ]);
        $option = new Suboption();
        $option->title = $request->title;
        $option->custom = $request->custom;
        $option->details = $request->details;
        $option->value = null;
        $option->option_id = $request->option_id;
        $option->save();
        return response()->json($option, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $options = Suboption::where('option_id',$id)->get();
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
            "title" => "required_without:custom",
            "custom" => "required_without:title",
        ]);
        $step = Suboption::find($id);
        $step->title = $request->title;
        $step->custom = $request->custom;
        $step->details = $request->details;
        $step->value = null;
        $step->option_id = $request->option_id;
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
        $step = Suboption::find($id);
        $step->delete();
        return response()->json("Deleted successfully!", 200);
    }
    public function search(Request $request)
    {
        $keywords = $request->keywords;
        $data = Suboption::where('title', 'like', '%' . $keywords . '%')
        ->with('option')
            ->paginate(5);
        return $data;
    }
}
