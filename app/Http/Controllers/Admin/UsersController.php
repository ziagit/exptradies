<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emps = User::whereHas('roles',function($q){
            $q->where('name','Admin')->orWhere('name','Support');
        })->orderBy('id','DESC')->with('roles')->paginate(10);
        return response()->json($emps);
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
                "name" => "required",
                "email" => "required|email",
                "phone" => "required|unique:users",
                "password"=>"required|same:password_confirmation|min:6",
                "password_confirmation"=>"required"
            ]);
            
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->save();
            $role = Role::where('name',$request->role)->first();
            $user->roles()->attach($role);
            return response()->json("Saved successfully!");
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
        $emp = User::find($id);
        return response()->json($emp);
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
            $request->validate([
                "name" => "required",
                "email" => "required|email",
                "phone" => "required",
            ]);
            $emp = User::find($id);
            $emp->name = $request->name;
            $emp->email = $request->email;
            $emp->phone = $request->phone;
            $emp->password = Hash::make($request->password);
            $emp->update();
            return response()->json($emp, 200);
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
        $emp = User::find($id);
        $emp->delete();
        return response()->json("Deleted successfully!");
    }
    public function search(Request $request)
    {
        $keywords = $request->keywords;
        $data = User::where('name', 'like', '%' . $keywords . '%')
            ->paginate(5);
        return $data;
    }
}
