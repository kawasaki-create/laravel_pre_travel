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
                @foreach($travelPlans as $travelPlan)
    <div class="card">
        <div class="card-header">
            旅行概要　
            <a href="{{ route('schedule.edit', ['id' => $travelPlan->id]) }}" class="btn btn-primary">編集</a> 
            <a href="" class="btn btn-secondary">旅行詳細設定</a> 
            <a href="{{ route('schedule.delete', ['id' => $travelPlan->id]) }}" class="btn btn-danger" id="planDeleteButton">削除</a>
        </div>
        <div class="card-body">
            <p>旅行名: {{ $travelPlan->trip_title }}</p>
            <p>期間: {{ $travelPlan->trip_start }} 〜 {{ $travelPlan->trip_end }}</p>
            <p>出発時刻: {{ $travelPlan->departure_time }}</p>
            <p>集合場所: {{ $travelPlan->meet_place }}</p>
            @if($travelPlan->budget)
                <p>予算: {{ $travelPlan->budget }}円</p>
            @endif
        </div>
    </div>
    <br>
@endforeach
            </div>
        </div>
    </div>
@endsection