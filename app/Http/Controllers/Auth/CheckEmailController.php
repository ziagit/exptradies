<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\VerifyEmail as JobsVerifyEmail;
use App\User;
use Exception;
use Illuminate\Http\Request;

class CheckEmailController extends Controller
{
    public function __invoke(Request $data)
    {
        try {
            if (filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
                $user = User::with('roles')->where('email', $data->email)->first();
                
                if ($user) {
                    if($user->email_verified_at){
                        return response()->json(['status' => 'email', 'id' => $user->id, 'role' => $user->roles[0]['name']], 200);
                    }
                   return response()->json(['status'=>'unverified','id'=>$this->verifyEmail($user)]);
                }
                return response()->json("This email not exist!", 404);
            } 
            $user = User::with('roles')->where('phone', $data->email)->first();

            if ($user) {
                $vcode = rand(1000, 9999);
                $user->verification_code = $vcode;
                $user->update();
                $this->sms($data->email, $vcode);
                return response()->json(['status' => 'phone', 'id' => $user->id, 'role' => $user->roles[0]['name']]);
            }
            return response()->json("This phone number not exist!", 404);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function verifyEmail($user){
        $vcode = rand(1000, 9999);
        $user->verification_code = $vcode;
        $user->update();
        dispatch(new JobsVerifyEmail($user->name, $user->email, $vcode));
        return $user->id;
    }

    public function resendCode(Request $data)
    {
        try {
            if (filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
                $user = User::with('roles')->where('email', $data->email)->first();
                if ($user) {
                    $vcode = rand(1000, 9999);
                    $user->verification_code = $vcode;
                    $user->update();
                    dispatch(new JobsVerifyEmail($user->name , $data->email, $vcode));

                    return response()->json(['status' => 'email', 'id' => $user->id, 'role' => $user->roles[0]['name']], 200);
                }
                return response()->json("This email not found!", 404);
            } 
            $user = User::with('roles')->where('phone', $data->email)->first();
            if ($user) {
                $vcode = rand(1000, 9999);
                $user->verification_code = $vcode;
                $user->update();
                $this->sms($data->email, $vcode);
                return response()->json(['status' => 'phone', 'id' => $user->id, 'role' => $user->roles[0]['name']]);
            }
            return response()->json("Invalide phone number!", 404);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function sms($phone, $vcode)
    {
     /*    try {
            $sms = new Sms();
            $sms->verify($phone, $vcode);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        } */
    }
}
