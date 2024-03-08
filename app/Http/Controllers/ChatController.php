<?php

namespace App\Http\Controllers;

use App\Room;
use App\Message;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Events\NewChatMessage;
use App\Helpers\NotificationHelper;
use App\Notif;
use App\User;
use Exception;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function newRoom(Request $request)
    {
        try {
            $user = Auth::user();
            $toUserId = null;
            if ($request->listener === null) {

                $supportRoom = Room::whereHas('user', function ($user) {
                    $user->whereHas('roles', function ($roles) {
                        return $roles->where('name', 'support');
                    });
                })
                    ->where('status', 'Active')
                    ->where('creator', $user->id)
                    ->orderBy('id', 'DESC')
                    ->first();

                if ($supportRoom === null) {
                    $support = $this->getAvailableSupport();
                    $newRoom = $this->createRoom($user, $support['user'], $support['status']);
                    $supportRoom = Room::with('user')->find($newRoom->id);

                    $defaultMessages = [
                        [
                            'room_id' => $newRoom->id,
                            'user_id' => $support['user']->id,
                            'message' => 'Hi, welcome to Exptradies live support.',
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ],
                    ];
                    if ($support['status'] == 'Waiting' || $support['user']->is_logged_in == 0) {
                        array_push($defaultMessages, [
                            'room_id' => $newRoom->id,
                            'user_id' => $support['user']->id,
                            'message' => 'Our supports are busy at the moment, we will get back to you as soon as possible.',
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ]);
                    }
                    Message::insert($defaultMessages);

                    $this->notify($user, $support['user']->id);
                }

                if ((Carbon::parse($supportRoom->updated_at)->addHours(1)) < Carbon::now()) {
                    $support = $this->getAvailableSupport();
                    $supportRoom->user_id = $support['user']->id;
                    $supportRoom->update();
                }
            } else {
                $room = Room::with('user')
                    ->where('status', 'Active')
                    ->where('creator', $user->id)
                    ->where('user_id', $request->listener)
                    ->orWhere('user_id', $user->id)
                    ->where('creator', $request->listener)
                    ->where('status', 'Active')
                    ->orderBy('id', 'DESC')
                    ->first();

                if ($room === null) {
                    $listener = User::find($request->listener);
                    $newRoom = $this->createRoom($user, $listener);
                    $room = Room::with('user')->find($newRoom->id);
                    $toUserId = $listener->id;
                }
                if (Auth::id() == $room->creator) {
                    $toUserId = $room->user_id;
                } else {
                    $toUserId = $room->creator;
                }

                $this->notify($user, $toUserId);

                $room->user = $room->user;

                return response()->json($room, 200);
            }
            $supportRoom->user = $supportRoom->user;
            return response()->json($supportRoom, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    private function createRoom($user, $listener, $status = 'Active')
    {
        $room = new Room();
        $room->name = $user->name;
        $room->creator = $user->id;
        $room->user_id = $listener->id;
        $room->status = $status;
        $room->user_phone = $listener->phone;
        $room->save();
        return $room;
    }

    private function getAvailableSupport()
    {
        $supportUsers = User::whereHas('roles', function ($q) {
            $q->where('name', 'support');
        })->get();

        $listener = null;
        $lastDateTime = Carbon::now();
        foreach ($supportUsers as $supportUser) {
            $supportLastRoom  = Room::where(
                ['status' => 'Active', 'user_id' => $supportUser->id]
            )->orderBy('id', 'DESC')->first();

            if ($supportLastRoom == null) {
                return ['status' => 'Active', 'user' => $supportUser];
            }

            if ($supportLastRoom->created_at < $lastDateTime) {
                $listener = $supportUser;
                $lastDateTime = $supportLastRoom->created_at;
            }
        }
        return  ['status' => 'Waiting', 'user' => $listener];;
    }

    public function rooms(Request $request)
    {
        $user = Auth::user();
        $this->readNotification($user, $request->listener);

        if ($request->listener !== null) {
            $rooms = Room::with('user.roles')
                ->where(['creator' => $user->id])
                //->where(['user_id' => $request->listener])
                ->orWhere('user_id', $user->id)
                ->where('status', 'Active')
                //->where(['creator' => $request->listener])
                //->where('status', 'Active')
                ->orderBy('id', 'DESC')
                ->get();
        } else {
            $rooms = Room::with('user.roles')
                ->whereHas('user.roles', function ($q) {
                    $q->where('name', 'support');
                })
                ->where(($request->isSupport ? ['user_id' => $user->id] : ['creator' => $user->id]))
                ->orderBy('id', 'DESC')
                ->get();
        }
        return $rooms;
    }
    public function readNotification($user, $listener)
    {
        $meAsCreator = json_encode(array($user->id, json_decode($listener))); // index 0 is creator, index 1 is listener
        $meAsListener = json_encode(array(json_decode($listener), $user->id)); // index 0 is creator, index 1 is listener
        $notifs = Notif::where('type', 'sms')
            ->where('room_ids', $meAsListener)
            ->orWhere('room_ids', $meAsCreator)
            ->get();
        $now = new Carbon();
        foreach ($notifs as $notif) {
            $notif->users()->updateExistingPivot($user->id, array('read_at' => $now));
        }
        return;
    }
    public function messages(Request $request, $roomId)
    {
        $user = Auth::user();
        $room = Room::find($roomId);
        $messages =  Message::where('room_id', $roomId);
        if ($user->roles[0]->name === 'guest') {
            $messages->where('created_at', '>=', Carbon::now()->subHours(1));
        }
        $messages = $messages->with('user')->orderBy('id', 'DESC')
            ->get();

        if (count($messages) === 0 && $user->roles[0]->name === 'guest') {
            $defaultMessages = [
                [
                    'room_id' => $room->id,
                    'user_id' => $room->user_id,
                    'message' => 'What can we help you with?',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'room_id' => $room->id,
                    'user_id' => $room->user_id,
                    'message' => 'Hi, welcome to Exptradies live support.',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
            ];
            Message::insert($defaultMessages);
            $messages = Message::where('room_id', $roomId)->with('user')->orderBy('id', 'DESC')->get();
        }
        return $messages;
    }

    public function newMessage(Request $request, $roomId)
    {
        try {
            $newMessage = new Message();
            $newMessage->user_id = Auth::id();
            $newMessage->room_id = $roomId;
            $newMessage->message = $request->message;
            $newMessage->save();
            broadcast(new NewChatMessage($newMessage))->toOthers();
            return response()->json($newMessage);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
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


    public function inActive($roomId)
    {
        $room = Room::find($roomId);
        $user = Auth::user();
        $nextRoom = Room::where(
            ['status' => 'Waiting', 'user_id' => $room->user_id]
        )->orderBy('id', 'ASC')->first();

        $room->status = 'Inactive';
        $room->update();
        if ($nextRoom) {
            $nextRoom->status = 'Active';
            $nextRoom->update();

            if ($user->id === $room->user_id) {
                $this->notify($user, $nextRoom->creator);
            } else {
                $this->notify(User::find($nextRoom->creator), $room->user_id);
            }
        }

        if ($user->id === $room->user_id) {
            $this->notify($user, $room->creator);
        } else {
            $this->notify(User::find($room->creator), $room->user_id);
        }

        return response()->json([], 204);
    }
}