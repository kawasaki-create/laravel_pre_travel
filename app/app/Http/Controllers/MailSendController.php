<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterSendMail;
use App\Mail\AccountDeleteSendMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

class MailSendController extends Controller
{
    public function registerSend(){
        Mail::send(new RegisterSendMail());
        return redirect('/home')->with('success', 'アカウントの登録が完了しました。アプリ版はそちらを開いてログインしてください。');
    }

    public function AccountDeleteSend(Request $request)
    {
        $id = auth()->user()->id;
        $urls = [
            'hi' => URL::temporarySignedRoute(
                'deleted',
                now()->addMinutes(5),  // 5分間だけ有効
                ['id' => $id]
            ),
        ];
        Mail::send(new AccountDeleteSendMail($request, $urls));
        return redirect('/')->with('success', 'アカウント削除の確認用メールを送信しました。(5分以内にURLをクリックしてください。)');
    }
}
