<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SignInController extends Controller
{
    public function __invoke(Request $data)
    {
        if ($data->password && $data->me) {
            return $this->signin($data);
        }
        try {
            $user = User::where('id', $data->me)
            ->where('status','Active')
            ->where('verification_code', $data->code)
            ->first();
            if ($user) {
                $user->email_verified_at = date('Y-m-d h:i:s');
                $user->update();
                $token = Auth::login($user);
                return response()->json($token);
            }
            return response()->json("Invalid code entered/your account is blocked by admin!", 401);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    
    public function signin($data)
    {
        $user=User::find($data->me);
        if(!$user->whereNotNull('email_verified_at')){
            return response()->json(['message'=>'Your email is not verified'],401);
        }
     
        if(!$token = Auth::attempt(['email'=>$user->email,'password'=>$data->password,'status'=>'Active'])){
            return response()->json(['message'=>'Incorrect credentials or your account is been blocked!'],401);
        }
        return response()->json($token);
    }

    public function newUser(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            return response()->json($user);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->email_verified_at = date('d-m-y h:i:s');
        $user->save();
        $role = Role::where('name', 'guest')->first();
        $user->roles()->attach($role);
        return response()->json($user);
    }
}
