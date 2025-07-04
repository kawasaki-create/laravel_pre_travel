@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">お問い合わせ内容確認</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('contact.send', ['name' => $name, 'email' => $email, 'message'=> $message]) }}" method="POST">
                        @csrf
                        <span>お名前：</span><br>
                        <span name="sender-name">{{ $name }}</span><br><br>
                        <span>メールアドレス：</span><br>
                        <span name="sender-emailaddress">{{ $email }}</span><br><br>
                        <span>お問い合わせ内容：</span><br>
                        <div name="sender-message" style="border: solid;">{!! nl2br(e($message)) !!}</div><br>
                        <a href="javascript:history.back()" type="button" class="btn btn-secondary">戻って修正する</a>　
                        <button name="contact-submit" class="btn btn-primary">お問い合わせ送信</button>
                    </form>
                </div>
            </div>
            <br><br>
        </div>
    </div>
</div>
@endsection