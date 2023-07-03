@extends('layouts.app')

@section('content')
<script src="{{ asset('resources/js/app.js') }}"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>ようこそ、{{Auth::user()->email;}}さん！</p>
                    <form action="/schedule" method="POST">
                        <button type="submit" class="btn btn-secondary">スケジュール作成</button>
                    </form>
                </div>
            </div>
            <br><br>
            <div class="card">
                <div class="card-header">つぶやき <span style="color:red; font-size:4px;">※旅行中のみ表示</span></div>
                <div class="card-body">
                    <form action="{{ route('button.click') }}" method="POST">
                        @csrf
                        <textarea id="myTextarea" name="tweet" placeholder="つぶやき" maxlength="140"></textarea><br>
                        <div id="charCount"></div>
                        <button type="submit" class="btn btn-primary">投稿</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
