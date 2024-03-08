<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $first = Blog::where('tag','first')->first();
        $tops = Blog::where('tag','top')->get();
        $blogs = Blog::paginate(10);
        return view("blog.list",['blogs'=>$blogs, 'first'=>$first, 'tops'=>$tops]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::with('comments')->find($id);
        $tops = Blog::where('tag','top')->get();
        return view("blog.details",["details"=>$blog,"tops"=>$tops]);
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
    public function search(Request $request,$search){
        if(!empty($request->keyword)){
            $first = Blog::where('tag','first')->first();
            $tops = Blog::where('tag','top')->get();
            $blogs = Blog::where("title","like", "%".$request->keyword."%")->paginate(10);
            redirect("/blog");
            return view("blog.list",['blogs'=>$blogs, 'first'=>$first, 'tops'=>$tops]);
        }
      
    }
}
