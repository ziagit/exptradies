<?php

namespace App\Jobs;

use App\Employee;
use App\Mail\BalanceExpired as MailBalanceExpired;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class BalanceExpired implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
  
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $employees = Employee::where('balance_updated_at', '<=', now()->subDays(3))->get();
        
        foreach ($employees as $employee) {
            $employee->update(['balance_updated_at' => null]);
            Mail::to($employee->user->email)->queue(new MailBalanceExpired($employee->last_name));
        }
    }
}
