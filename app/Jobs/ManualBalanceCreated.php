<?php

namespace App\Jobs;

use App\Mail\BalanceCreated;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ManualBalanceCreated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $name;
    protected $email;
    protected $amount;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($name, $email,$amount)
    {
        $this->name=$name;
        $this->email=$email;
        $this->amount=$amount;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->queue(new BalanceCreated($this->name, $this->amount));
    }
}
