<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\Service;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('employees','address','service','employee')
        ->orderByDesc('created_at')
        ->paginate(10);
        return response()->json($posts);
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
   
    public function show($id){
        $post = Post::whereId($id)
            ->with('employees','address', 'service', 'options','images','employeeWithUser')
            ->first();
        return response()->json($post);

    }
    public function steps($id)
    {
        $service = Service::with('steps')->find($id);
        return response()->json($service);
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
        $emp = Post::find($id);
        $emp->note = $request->note;
        $emp->status = $request->status;
        $emp->update();
        return response()->json($emp,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $emp = Post::find($id);
        $emp->delete();
        return response()->json($emp,200);
    }
    public function search(Request $request)
    {
        $keywords = $request->keywords;
        $data = Post::where('note', 'like', '%' . $keywords . '%')
            ->orWhere('status', 'like', '%' . $keywords . '%')
            ->paginate(10);
        return response()->json($data);
    }
}
