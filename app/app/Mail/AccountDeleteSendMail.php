<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class AccountDeleteSendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request, $urls)
    {
        $this->request = $request;
        $this->urls = $urls;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.accountDelete')
                ->to(Auth::user()->email, Auth::user()->name)
                ->from(env('MAIL_USERNAME'),env('APP_NAME'))
                ->subject('【重要】アカウント削除のご確認')
                ->with([
                    'text' => $this->request->text,
                    'urls' => $this->urls,
                ]);
    }
}
