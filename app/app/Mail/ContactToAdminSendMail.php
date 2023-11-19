<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class ContactToAdminSendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $message)
    {
        $this->data = [
            'name' => $name,
            'email' => $email,
            'contents' => $message
        ];

        // dd($this->data);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.contactToAdmin')
                ->with($this->data)
                ->to(env('MAIL_KAWASAKI_ADDRESS'))
                ->from(env('MAIL_USERNAME'),env('APP_NAME'))
                ->subject('【要確認】PreTravel利用者からのお問い合わせ');
    }
}
