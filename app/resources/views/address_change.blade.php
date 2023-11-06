@extends('layouts.app')
@section('content')
<script src="{{ asset('resources/js/app.js') }}"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">メールアドレス変更</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('mail.change') }}" method="POST">
                        @php
                            $url = $_SERVER['REQUEST_URI'];
                            $editUrl = ltrim(strrchr("$url", "/"), '/');
                        @endphp
                        @csrf
                        <span>名前：</span><br>
                        <input type="text" name="name" value="{{ Auth::user()->name; }}"><br><br>
                        <span>メールアドレス：</span><br>
                        <input type="email" name="email" value="{{ Auth::user()->email; }}" size="30"><br><br>
                        <button type="submit" name="mail-register" class="btn btn-primary">登録</button>
                    </form>
                </div>
            </div>

            <br><br>
        </div>
    </div>
</div>
@endsection