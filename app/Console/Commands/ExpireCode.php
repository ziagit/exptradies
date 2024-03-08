<?php

namespace App\Console\Commands;

use App\Jobs\ExpireVerificationCode;
use Illuminate\Console\Command;

class ExpireCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire:code';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expire every code generated after 10 minuts.';

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
      dispatch(new ExpireVerificationCode());
    }
}
