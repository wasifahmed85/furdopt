<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\UserDetail;
use App\Models\Pet;
use Carbon\Carbon;
use Mail;
use App\Mail\PetMatchMail;
use Illuminate\Console\Command;

class PetMatchCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'petmatch:cron';

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
        $users = UserDetail::get(['id','user_id', 'looking_for', 'looking_for_state', 'gender', 'pet_age', 'size', 'looking_for_location', 'pet_sports', 'pet_personality']);
        $lastHour = Carbon::now()->subHour();
        \Log::info('cron job running');
        foreach ($users as $user) {
            $pets = Pet::where('created_at', '>=', $lastHour)
                ->where(function ($query) use ($user) {
                    $query->where('category_id', $user->looking_for)
                        //   ->orWhere('sub_category_id', $user->breed_id)
                        ->orWhere('uk_state_id', $user->looking_for_state)
                        ->orWhere('gender', $user->gender)
                        ->orWhere('age', $user->pet_age)
                        ->orWhere('size', $user->size)
                        ->orWhere('location', $user->looking_for_location)
                        ->orWhere('sports', $user->pet_sports)
                        ->orWhere('personality', $user->pet_personality);
                })
                ->limit(5)
                ->get();

            if ($pets->isNotEmpty()) {

                Mail::to($user->user->email)->send(new PetMatchMail($user, $pets));
            }
        }
    }
}
