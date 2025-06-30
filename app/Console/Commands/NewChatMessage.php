<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Chatmessage;
use Carbon\Carbon;
use Mail;
use App\Mail\UnseenMessageNotificationMail;
use Illuminate\Console\Command;

class NewChatMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newchatmail:cron';

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
        $cutoffTime = Carbon::now()->subMinutes(5);

   
    $users = User::whereHas('receivedChats', function ($query) use ($cutoffTime) {
        $query->where('is_seen', 0)
              ->where('created_at', '>=', $cutoffTime);
    })->get();

    foreach ($users as $user) {
        $unseenMessages = $user->receivedChats()
            ->where('is_seen', 0)
            ->where('created_at', '>=', $cutoffTime)
            ->get();

        // Send email
        if ($unseenMessages->count()) {
            Mail::to($user->email)->send(new UnseenMessageNotificationMail($user, $unseenMessages));
        }
    }
\Log::info('New Chat Message sent for unseen messages in the last 5 minutes.');
    
        
        
       
    }
}
