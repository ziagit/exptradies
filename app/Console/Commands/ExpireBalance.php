<?php

namespace App\Console\Commands;

use App\Employee;
use App\Jobs\BalanceExpired;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class ExpireBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire:balance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Balance Expired';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        dispatch(new BalanceExpired());
    }
}
