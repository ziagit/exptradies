<?php

namespace App\Jobs;

use App\Mail\VerifyEmail as MailVerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class VerifyEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    public $code;
    public $name;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($name, $email, $code)
    {
        $this->name = $name;
        $this->email = $email;
        $this->code = $code;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->queue(new MailVerifyEmail($this->name, $this->code));
    }
}
