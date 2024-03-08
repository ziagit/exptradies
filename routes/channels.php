<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
// Broadcast::channel('home', function () {
//     return true;
// });

Broadcast::channel('chat.{roomId}', function ($user, $roomId) {
    if (Auth::check()) {
        return ['id' => $user->id, 'name' => $user->name];
    }
});
Broadcast::channel('room.{userId}', function ($user, $roomId) {
    if (Auth::check()) {
        return ['id' => $user->id, 'name' => $user->name];
    }
});
Broadcast::channel('notification.{userId}', function ($user, $notification) {
    if (Auth::check()) {
        return ['user' => $user->id, 'notification' => $notification];
    }
});
Broadcast::channel('flutter-channel', function ($user, $roomId) {
    return $user;
});
