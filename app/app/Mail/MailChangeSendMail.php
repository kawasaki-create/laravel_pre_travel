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
    public function __construct($request, $preUser, $preEmail)
    {
        $this->data = [
            'name' => $request->name,
            'email' => $request->email,
            'preUser' => $preUser,
            'preEmail' => $preEmail,
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
                // ->to(Auth::user()->email, Auth::user()->name)
                ->to([$this->data['email']], [$this->data['name']])
                ->cc([$this->data['preEmail']], [$this->data['preUser']])
                ->from(env('MAIL_USERNAME'),env('APP_NAME'))
                ->subject('名前/メールアドレス変更のお知らせ');
    }
}
