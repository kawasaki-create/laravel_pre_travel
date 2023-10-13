@extends('layouts.app')
@section('content')
<script src="{{ asset('resources/js/app.js') }}"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">旅行スケジュール登録</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('travel.edit') }}" method="POST">
                        @php
                            $url = $_SERVER['REQUEST_URI'];
                            $editUrl = ltrim(strrchr("$url", "/"), '/');
                        @endphp
                        @csrf
                        <span>旅行名：</span>
                        <input type="text" name="trip-title"><br><br>
                        <span>日程：</span>
                        <input type="date" name="trip-start">〜<input type="date" name="trip-end"><br><br>
                        <span>集合場所：</span>
                        <input type="text" name="meet-place"><br><br>
                        <span>家を出る時刻：</span>
                        <input type="time" name="departure-time"><br><br>
                        <span>予算：</span>
                        <input type="text" name="budget">&ensp;円&emsp;
                        <button type="submit" name="plan-register" class="btn btn-primary">登録</button>
                        <input type="hidden" name="plan-id" value="{{ $editUrl }}">
                    </form>
                </div>
            </div>

            <br><br>
        </div>
    </div>
</div>
@endsection