<?php

namespace App\Mail;
use App\Models\Abonnement;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ActivationAccount extends Mailable
{
    use Queueable, SerializesModels;



    /**
     * Create a new message instance.
     */
    public function __construct(public $user,public $abonnement)
    {

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
       return new Envelope(
            subject: 'Confirmation de votre abonnement ' . $this->abonnement->getTypeDisplayName(),
        );
    }

    public function content(): Content
    {
           return new Content(
            view: 'emails.subscription-confirmation',
            with: [
                'user' => $this->user,
                'subscription' => $this->abonnement,
                'features' => $this->abonnement->getFeatures(),
            ],
        );
    }


    public function build()
    {
        return $this->subject('location validé')->view("views.mail.inscriptionValide")
        ->with([
            'name' => $this->user->name
        ]);
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
