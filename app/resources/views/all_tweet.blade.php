@extends('layouts.app')
@section('content')
<script src="{{ asset('resources/js/app.js') }}"></script>
<link rel="stylesheet" src="{{ asset('resources/css/app.css') }}">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="/home">←ホーム画面に戻る</a><br><br>
                <div class="card">
                    <form action="{{ route('allTweets.delete') }}" method="POST">
                        @csrf
                        <div class="card-header">過去のつぶやき一覧</div>
                        <div class="card-body">
                            @foreach ($tweets as $tweet)
                                    <input type="checkbox" name="tweets[]" value="{{ $tweet->id }}">
                                    <span>{{ $tweet->tweet }}</span><br>
                                    <span style="font-size :10px; color: gray;">{{ $tweet->created_at }}</span><br>
                                    <br>
                            @endforeach
                            <button type="submit" class="btn btn-warning" id="tweetDeleteButton">削除</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection