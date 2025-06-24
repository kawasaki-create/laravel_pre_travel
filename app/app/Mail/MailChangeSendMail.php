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
            'name' => $request->input('name'),
            'email' => $request->input('email'),
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
        $mail = $this->view('email.mailChange')->with($this->data);
        
        // 新しいメールアドレスに送信
        if (!empty($this->data['email'])) {
            $mail->to($this->data['email'], $this->data['name'] ?? '');
        }
        
        // 古いメールアドレスにもCCで送信
        if (!empty($this->data['preEmail']) && $this->data['preEmail'] !== $this->data['email']) {
            $mail->cc($this->data['preEmail'], $this->data['preUser'] ?? '');
        }
        
        return $mail->from(env('MAIL_USERNAME'), env('APP_NAME'))
                   ->subject('名前/メールアドレス変更のお知らせ');
    }
}
