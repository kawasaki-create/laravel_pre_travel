@extends('layouts.app')
@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="/home">←ホーム画面に戻る</a><br><br>
                @foreach($tweets as $tweet)
                <div class="card">
        <div class="card-header">
            過去のつぶやき　
            <a href="{{ route('schedule.edit', ['id' => $tweet->id]) }}" class="btn btn-primary">編集</a>
            <a href="" class="btn btn-secondary">旅行詳細設定</a>
            <a href="{{ route('schedule.delete', ['id' => $tweet->id]) }}" class="btn btn-danger" id="planDeleteButton">削除</a>
        </div>
        <div class="card-body">

            <p>旅行名: {{ $tweet->tweet }}</p>
            <p>期間: {{ $tweet->updated_at }}</p>
        </div>
    </div>
    <br>
@endforeach
            </div>
        </div>
    </div>
@endsection