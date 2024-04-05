<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class VipRegisterNoticeToAdminSendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email)
    {
        $this->data = [
            'name' => $name,
            'email' => $email
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
        return $this->view('email.vipRegisterNoticeToAdmin')
                ->with($this->data)
                ->to(env('MAIL_KAWASAKI_ADDRESS'))
                ->from(env('MAIL_USERNAME'),env('APP_NAME'))
                ->subject('【お知らせ】ユーザーが有料会員登録しました🥳');
    }
}
