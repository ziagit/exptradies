<?php

namespace App\Http\Controllers\Admin\Pages;

use App\About;
use App\Blog;
use App\Comment;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Blog::with('comments')->orderBy('id', 'DESC')->paginate(10);
        return response()->json($list);
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
   
        $blog = new Blog();

        $blog->title = $request->title;
        $blog->body = $request->body;

        $blog->save();
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
        $blog = Blog::find($id);
        return response()->json($blog);
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
        try{
            $blog = Blog::find($id);
            $blog->title = $request->title;
            $blog->body = $request->body;
            $blog->image = $request->image;
            $blog->update();
            return response()->json(["message" => "Updated Successfully."], 200);
        }catch(Exception $e){
            return response()->json($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($blog = Blog::find($id)) {
            $file = "public/images/blog/" . $blog->image;
            Storage::delete($file);
            $blog->delete();                                       
            return response()->json(["message" => "Deleted Successfully."]);
        }
        return response()->json(["message" => "Data Not Found!"]);
    }
    public function search(Request $request)
    {
        $keywords = $request->keywords;
        $data = Blog::where('title', 'like', '%' . $keywords . '%')
            ->orderBy('id', 'DESC')
            ->paginate(10);
        return $data;
    }
    public function deleteComment($id){
        $comment=Comment::find($id);
        $comment->delete();
        return response()->json("Comment deleted.");
    }
}
