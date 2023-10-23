@extends('layouts.app')
@section('content')
<script src="{{ asset('resources/js/app.js') }}"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">詳細スケジュール登録</div>

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
                        <span>旅行名：{{ $travelPlan->trip_title }}</span>
                        <span>{{ $travelDate }}</span>
                        <select name="kubun" id="kubun">
                            <option value="">追加項目を選択してください▼</option>
                            <option value="1">朝食</option>
                            <option value="2">昼食</option>
                        </select>
                        <button type="button" class="btn btn-secondary">項目追加</button>
                        <input type="text" name="contents">
                        <!-- <button type="submit" name="plan-register" class="btn btn-primary">登録</button> -->
                        <input type="hidden" name="plan-id" value="{{ $editUrl }}">
                    </form>
                </div>
            </div>

            <br><br>
        </div>
    </div>
</div>
@endsection