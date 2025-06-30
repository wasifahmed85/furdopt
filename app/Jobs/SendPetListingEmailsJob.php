<?php

namespace App\Jobs;

use App\Models\User;
use App\Mail\NewPetListingEmail;
use App\Mail\PetListingPublishedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPetListingEmailsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $petId;
    protected $petName;
    protected $user;

    public function __construct($petId, $petName, $user)
    {
        $this->petId = $petId;
        $this->petName = $petName;
        $this->user = $user;
    }

    public function handle()
    {
        try {
            // Send emails to users with role_id 4
            $users = User::where('role_id', 4)->get(['id', 'email']);

            foreach ($users as $user) {
                Mail::to($user->email)->send(new NewPetListingEmail($this->petName));
            }

            // Send confirmation email to the pet owner
            Mail::to($this->user->email)->send(new PetListingPublishedMail($this->user->name));

        } catch (\Exception $e) {
            \Log::error('Failed to send pet listing emails: ' . $e->getMessage());
            // You might want to retry or handle this differently
        }
    }

    public function failed(\Throwable $exception)
    {
        \Log::error('SendPetListingEmailsJob failed: ' . $exception->getMessage());
    }
}
