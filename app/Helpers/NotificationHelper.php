<?php

namespace App\Helpers;

use App\Events\NewNotification;
use App\Notif;
use Exception;

class NotificationHelper
{
    public function __construct($fromUser, $users, $data)
    {
        $this->deleteDuplicate($data);
        try {
            $notif = new Notif();
            $notif->title = $data['title'];
            $notif->body = $data['body'];
            $notif->type = $data['type'];
            $notif->url = $data['url'];
            $notif->post_id = $data['postId'];
            $notif->order_id = $data['orderId'];
            $notif->room_ids = $data['roomIds'];
            $notif->earning_id = $data['earningId'];
            $notif->refund_id = $data['refundId'];
            $notif->save();
            $notif->users()->attach($users);
            foreach ($users as $user) {
                broadcast(new NewNotification($fromUser, $user->id, $notif->id, $notif->type,$notif->title))->toOthers();
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function deleteDuplicate($data)
    {
        if ($data['type'] != 'sms') {
            return;
        }
        Notif::where('room_ids', $data['roomIds'])->delete();
        return;
    }
}
