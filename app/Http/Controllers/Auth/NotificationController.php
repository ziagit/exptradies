<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notif;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        //$nots = $user->notifs()->orderBy('id', 'DESC')->limit(10)->get();
        $nots = $user->notifs()->orderBy('id', 'DESC')->get();

        return response()->json($nots);
    }

    public function show($id)
    {
        $now = new Carbon();
        $user = Auth::user();
        $notif = Notif::find($id);
        $notif->users()->updateExistingPivot($user->id, array('read_at' => $now));
        return response()->json("Updated successfuly!");
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
    public function unread()
    {
        $user = User::find(Auth::id());
        $nots = $user->notifs()->wherePivot('read_at', null)->get();
        return response()->json($nots);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
