@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">お問い合わせ/質問・要望</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('contact.send') }}" method="POST">
                        @csrf
                        <span>お名前：</span><br>
                        <input type="text" name="sender-name" readonly value="{{ $name }}"><br><br>
                        <span>メールアドレス：</span><br>
                        <input type="text" name="sender-emailaddress" readonly value="{{ $email }}"><br><br>
                        <span>お問い合わせ内容：</span><br>
                        <textarea name="sender-message" readonly value="{{ $message }}"></textarea><br><br>
                        <button name="contact-submit" class="btn btn-primary">お問い合わせ送信</button>
                    </form>
                </div>
            </div>
            <br><br>
        </div>
    </div>
</div>
@endsection