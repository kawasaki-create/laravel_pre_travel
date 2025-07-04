@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">お問い合わせ/質問・要望　<span style="color: red; font-size: 10px;">※全て入力必須です</span></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('contact.comfirm') }}" method="POST">
                        @csrf
                        <span>お名前：</span><br>
                        <input type="text" name="sender-name" required><br><br>
                        <span>メールアドレス：</span><br>
                        <input type="email" name="sender-emailaddress" value="{{ Auth::user()->email }}" required><br><br>
                        <span>お問い合わせ内容：</span><br>
                        <textarea name="sender-message" maxlength="500" placeholder="最大500字まで" required></textarea><br><br>
                        <button name="contact-submit" class="btn btn-secondary">内容の確認</button>
                    </form>
                </div>
            </div>
            <br><br>
        </div>
    </div>
</div>
@endsection