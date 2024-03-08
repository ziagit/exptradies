<?php

namespace App\Jobs;

use App\Balance;
use App\Employee;
use App\Mail\BalanceCreated as MailBalanceCreated;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class BalanceCreated implements ShouldQueue
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
        $emp = Employee::where('balance',null)->where('is_balance_auto_renew',true)->get();
        if(count($emp)>0){
            $balance = Balance::find(1);
            foreach($emp as $e){
                $e = Employee::find($e->id);
                $e->balance = $balance->min_balance;
                $e->balance_updated_at = Carbon::now();
                $e->update();
                Mail::to($e->user->email)->queue(new MailBalanceCreated($e->first_name, $e->balance));
            }
        }

    }
}
