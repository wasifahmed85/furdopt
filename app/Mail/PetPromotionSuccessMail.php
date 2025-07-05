<?php

namespace App\Mail;

use App\Models\Pet;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth; // Added to get user name for email

class PetPromotionSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pet;
    public $amount;
    public $user; // Public property to pass user to the view

    /**
     * Create a new message instance.
     */
    public function __construct(Pet $pet, $amount)
    {
        $this->pet = $pet;
        $this->amount = $amount;
        $this->user = Auth::user(); // Get the authenticated user
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Pet Promotion Was Successful!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.pet-promotion-success', // Create this Blade markdown file
            with: [
                'petName' => $this->pet->name,
                'amount' => $this->amount,
                'promotedUntil' => $this->pet->promoted_until ? $this->pet->promoted_until->format('M d, Y') : 'N/A',
                'user' => $this->user, // Pass the user object to the view
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
