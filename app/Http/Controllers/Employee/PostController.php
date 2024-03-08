<?php

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\Employer;
use App\Galery;
use App\Helpers\NotificationHelper;
use App\Http\Controllers\Controller;
use App\Jobs\ClosedJob;
use App\Jobs\JobClosed;
use App\Post;
use App\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $post = Post::with('address', 'service')
        ->where('employee_id', $user->employee->id)
        ->orderBy('created_at', 'DESC')
        ->paginate(10);
        return response()->json($post);
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
         $post = Post::whereId($id)
         ->with(['employees' => function($q){
            $q->wherePivot('status', 'Accepted')->with('user','address','reviews');
         }])->with('address', 'service', 'options.suboptions','images')
         ->first();

         return response()->json($post);
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
        
        $post = Post::with('service','employees')->find($id);

        $post->status = 'closed';
        $post->close_reason = $request->reason;
        $post->update();

        dispatch(new JobClosed($post));
        return response()->json("Job closed successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //
    }

    public function steps($id)
    {
        $service = Service::with('steps')->find($id);
        return response()->json($service);
    }

    public function galery($id){
        $galleries = Galery::where('employee_id', $id)
        ->latest() // Orders by the created_at timestamp in descending order
        ->take(6)  // Retrieves the first 6 records
        ->get();
        return response()->json($galleries);
    }

    public function search(Request $request)
    {
        $keywords = $request->keywords;
        $user = Auth::user();
        $post = Post::where('note','like','%'.$keywords.'%')
        ->orWhere('created_at','like','%'.$keywords.'%')
        ->orWhereHas('service',function($q) use ($keywords){
            $q->where('name','like','%'.$keywords.'%');
        })
        ->where('employee_id', $user->employee->id)
        ->with('address', 'service')
        ->paginate(10);
        return response()->json($post);
    }
}
