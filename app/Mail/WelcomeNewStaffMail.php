<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeNewStaffMail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $user;
    /**
     * Create a new message instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->view('emails.welcome_new_staff_mail')
        ->subject('Welcome to ' . config('app.name'))
        ->with([
            'name' => $this->user->name,
            'role' => $this->user->role->name,
            'resetPasswordUrl' => route('password.reset'),
        ]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome New Staff',
        );
    }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

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
