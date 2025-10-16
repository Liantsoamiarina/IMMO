<?php

namespace App\Mail;

use App\Models\Lead;
use App\Models\Property;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactAgenceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $lead;
    public $property;

    public function __construct(Lead $lead, Property $property)
    {
        $this->lead = $lead;
        $this->property = $property;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🏠 Nouveau lead pour : ' . $this->property->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.contactAgence',
            with: [
                'agencyName' => $this->property->user->name,
                'clientName' => $this->lead->client_name,
                'clientEmail' => $this->lead->client_email,
                'clientPhone' => $this->lead->client_phone,
                'propertyTitle' => $this->property->title,
                'propertyRef' => '#' . $this->property->id,
                'propertyAddress' => $this->property->address . ', ' . $this->property->city,
                'propertyPrice' => $this->property->formatted_price,
                'propertyType' => $this->property->transaction_type == 'vente' ? 'Vente' : 'Location',
                'clientMessage' => $this->lead->message,
                'propertyUrl' => route('properties.show', $this->property->id),
                'requestDate' => $this->lead->created_at->format('d/m/Y à H:i'),
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
