<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Pet;
use Carbon\Carbon;
use Mail;
use App\Mail\PetMatchMail;
use Illuminate\Console\Command;

class TestCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
       
        \Log::info('test cron job running');
     
    }
}
