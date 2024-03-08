<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\VerifyEmail as JobsVerifyEmail;
use Illuminate\Http\Request;
use App\Role;
use App\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class VerifyEmailController extends Controller
{
    public function __invoke(Request $data)
    {
        if (filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
            return $this->byEmail($data);
        } else {
            return $this->byPhone($data);
            $parts = sscanf($data->email, '%2c%3c%3c%4c');
            return "$parts[1]-$parts[2]-$parts[3]";
        }
        return response()->json("Invalid data provided!", 404);
    }
    public function byPhone($data)
    {
        $user = User::where('phone', $data->email)->first();
        if ($user) {
            return response()->json("This phone number is already been taken!", 409);
        }
        try {
            if ($this->validate_phone_number($data->email) == true) {
                $vcode = rand(1000, 9999);
                $user = User::create(array(
                    'name' => $data->name,
                    'phone' => $data->email,
                    'password' => Hash::make($data->password),
                    'verification_code' => $vcode
                ));
                $role = Role::where('name', '=', $data->type)->first();
                $user->roles()->attach($role);
                $this->sms($user, $vcode);
                return response()->json($user->id);
            }
            return response()->json("Please provide valid data!", 203);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function byEmail($data)
    {
        $validator = Validator::make($data->all(), [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users',
            'phone' => 'unique:users',
            'password' => 'required|min:3',
            'password_confirmation' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 409);
        }
        if ($data->type === "Employee") {
            
            try {
                $vcode = rand(1000, 9999);
                $user = new User();
                $user->name = $data->name;
                $user->email = $data->email;
                $user->phone = $data->phone?$data->phone:null;
                $user->password = Hash::make($data->password);
                $user->verification_code = $vcode;
                $user->save();
                $role = Role::where('name', $data->type)->first();
                $user->roles()->attach($role);
                
                dispatch(new JobsVerifyEmail($user->name,$user->email, $vcode));
                return response()->json($user->id);
            } catch (Exception $e) {
                return response()->json($e->getMessage(), 409);
            }
        }
        return response()->json(["message" => "Don't fuck with me 🖕"], 400);
    }
    /*   public function sms($user, $vcode)
    {
        try {
            $sms = new Sms();
            return $sms->verifyPhone($user->phone, $vcode);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    } */
    function validate_phone_number($phone)
    {
        // Allow +, - and . in phone number
        $filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
        // Remove "-" from number
        $phone_to_check = str_replace("-", "", $filtered_phone_number);

        // Check the lenght of number
        // This can be customized if you want phone number from a specific country
        if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 14) {
            return false;
        } else {
            return true;
        }
    }
}
