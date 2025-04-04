<?php

namespace App\Console\Commands;

use App\Jobs\TakeBackup;
use Illuminate\Console\Command;

class DatabaseBackUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'take:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Taking backup every week.';

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
        dispatch(new TakeBackup());
    }
}
