<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ReportQuantityUsersCountryMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $usersByCountry;
    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        $this->usersByCountry = User::select('country', DB::raw('count(*) as total'))
            ->groupBy('country')
            ->get();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reporte de cantidad de usuarios por país',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {

        return new Content(
            view: 'quantity_users_country',
            with: [
                'usersByCountry' => $this->usersByCountry,
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
