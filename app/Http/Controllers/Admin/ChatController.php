<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Events\NewChatMessage;
use App\Helpers\NotificationHelper;
use App\Http\Services\Notification;
use App\Message;
use App\Room;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function rooms(Request $request)
    {
        $user = Auth::user();

        if ($user->roles[0]->name === 'Admin') {
            $rooms = Room::with('user.roles');
        } else {
            $rooms =  Room::with(['user.roles', 'creatorUser.roles'])
                ->where('user_id', '=', $user->id)
                ->where('status', '!=', 'Waiting')
                ->Where('created_at', '>=', Carbon::now()->subWeek());
        }

        return $rooms->orderBy('status', 'DESC')->orderBy('id', 'ASC')->get();
    }

    public function waitingRoom(Request $request)
    {
        $user = Auth::user();
        $rooms =  Room::with(['user.roles', 'creatorUser.roles'])
            ->where('user_id', '=', $user->id)
            ->where('status', '=', 'Waiting')
            ->get();

        return $rooms;
    }

    public function room($id)
    {
        if ($id == 'undefined' || $id == null) {
            $room = Room::with('user.roles')->where('user_id', Auth::id())->first();
            return response()->json($room);
        }
        $room = Room::with('user.roles')->where('user_id', Auth::id())
            ->where('status', 'Active')
            ->first();
        return response()->json($room);
    }
    public function messages(Request $request, $roomId)
    {
        return Message::where('room_id', $roomId)
            ->with('user')
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function newMessage(Request $request, $roomId)
    {
        $newMessage = new Message();
        $newMessage->user_id = Auth::id();
        $newMessage->room_id = $roomId;
        $newMessage->message = $request->message;
        $newMessage->save();
        broadcast(new NewChatMessage($newMessage))->toOthers();
        return response()->json($newMessage);
    }

    public function notify($user, $listener)
    {
        $users = User::where('id', $listener)->get();

        // if ($toUser->roles[0]->name != 'support') {
        //     $users = User::whereHas(
        //         'roles',
        //         function ($q) {
        //             $q->where('name', 'admin')
        //                 ->orWhere('name', 'support');
        //         }
        //     )->get();
        //     $users->push($toUser);
        // } else {
        //     $users = User::whereHas(
        //         'roles',
        //         function ($q) {
        //             $q->where('name', 'admin');
        //         }
        //     )->get();
        //     $users->push($toUser);
        // }

        $data = [
            "title" => "New Message",
            "body" => json_encode(array($user->name, $users[0]->name)), // index 0 is sender, index 1 is receiver.
            "type" => "sms",
            "url" => "",
            "postId" => null,
            "orderId" => null,
            "roomIds" => json_encode(array($user->id, $listener)),
            "earningId" => null,
            "refundId" => null,
        ];
        return new NotificationHelper($user->id, $users, $data);

    }
}
