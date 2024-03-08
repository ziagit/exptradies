<?php

namespace App\Http\Controllers\Admin;

use App\Commission;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $com = Commission::with('service')->get();
        return response()->json($com);
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
        try {
            $request->validate([
                'service_id' => 'required|unique:commissions',
                'service_amount' => 'required',
                'km_amount' => 'required'
            ]);
            $com = new Commission();
            $com->service_id = $request->service_id;
            $com->service_amount = $request->service_amount;
            $com->km_amount = $request->km_amount;
            $com->save();
            return response()->json($com, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $com = Commission::with('service')->where('id', $id)->first();
        return response()->json($com);
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
        try {
            $com = Commission::find($id);
            $com->service_id = $request->service_id;
            $com->service_amount = $request->service_amount;
            $com->km_amount = $request->km_amount;
            $com->update();
            return response()->json($com, 200);
        } catch (Exception $e) {
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
        $com = Commission::find($id);
        $com->delete();
        return response()->json($com);
    }
}
