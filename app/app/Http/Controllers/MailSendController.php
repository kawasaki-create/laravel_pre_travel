<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterSendMail;

use Illuminate\Http\Request;

class MailSendController extends Controller
{
    public function registerSend(){
        Mail::send(new RegisterSendMail());
        return redirect('/home')->with('success', 'アカウントの登録が完了しました');
    }

}
