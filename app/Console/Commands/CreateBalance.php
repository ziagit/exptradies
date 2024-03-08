<?php

namespace App\Console\Commands;

use App\Balance;
use App\Employee;
use App\Jobs\BalanceCreated;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CreateBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:balance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Balance created';

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
        dispatch(new BalanceCreated());
    }
}
