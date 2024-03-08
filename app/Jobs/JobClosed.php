<?php

namespace App\Jobs;

use App\Helpers\NotificationHelper;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class JobClosed implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $post;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($post)
    {
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::whereHas(
            'roles',
            function ($q) {
                $q->where('name', 'Admin')
                    ->orWhere('name', 'Support');
            }
        )->get();

        $data = [
            "title" => "Job closed",
            "body" => json_encode(array($this->post->service->name, $this->post->employee->first_name)), 
            "type" =>"post",
            "url" => "",
            "postId" => $this->post->id,
            "orderId" => null,
            "roomIds" => null,
            "earningId" => null,
            "refundId" => null,
        ];
        
         new NotificationHelper(Auth::id(), $users, $data);

        return "notified";
    }
}
