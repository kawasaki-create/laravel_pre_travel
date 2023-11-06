<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class MailChangeSendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->data = [
            'name' => $request->name,
            'email' => $request->email,
        ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.mailChange')
                ->with($this->data)
                ->to(Auth::user()->email, Auth::user()->name)
                ->from(env('MAIL_USERNAME'),env('APP_NAME'))
                ->subject('名前/メールアドレス変更のお知らせ');
    }
}
