<?php

namespace App\Http\Controllers\Auth;

use App\BackupUser;
use App\Http\Controllers\Controller;
use App\User;
use Exception;
use Illuminate\Http\Request;

class MeController extends Controller
{
    public function __invoke(Request $request)
    {
        try {
            $user = $request->user();
            $roles = $user->roles;
            return response()->json([
                'id' => $user->id,
                'name' => $user->name,
                'avatar' => $user->avatar,
                'phone' => $user->phone,
                'email' => $user->email,
                'role' => $roles[0]
            ]);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function changeAvatar(Request $request, $id)
    {
        $this->validate($request, [
            'avatar' => 'required',
        ]);
        $user = User::find($id);
        if ($request->hasFile('avatar')) {
            $old_image_path = public_path('images/uploads/profile/'. $user->avatar);
            if (file_exists($old_image_path)) {
                @unlink($old_image_path);
            }
            $file = $request->file('avatar');
            $avatar_name = time() . '.' . $file->getClientOriginalName();
            $file->move(public_path('images/uploads/profile'), $avatar_name);
        } else {
            $avatar_name = $user->avatar;
        }
        $user->avatar = $avatar_name;
        $user->update();
        return response()->json(['message' => 'Updated successfully!','name'=>$avatar_name], 200);
    }
    public function removeMe($id)
    {
        $user = User::with('roles')->where('id', $id)->first();
        if($user){
            $random = rand(1000000000, 9999999999);
            $user->phone = $random;
            $user->email = $random . '@exptradies.com';
            $user->status = 'Deleted';
            $user->verification_code=null;
            
            $user->update();
            return response()->json("Your account with Exptradies deleted successfuly.");
        }
        return response()->json("User not found.");
        
    }
}
