<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\SubscriptionPlan;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class SpotlightPurchaseInvoice extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $SubscriptionPlan;
    public $payment;
    /**
     * Create a new message instance.
     */
    public function __construct(User $user, SubscriptionPlan $subscriptionPlan, Payment $payment)
    {
        $this->user = $user;
        $this->SubscriptionPlan = $subscriptionPlan;
        $this->payment = $payment;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Spotlight Purchase Invoice',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.spotlight-invoice',
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
