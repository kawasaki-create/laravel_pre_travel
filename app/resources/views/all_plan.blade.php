@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="/home">←ホーム画面に戻る</a><br><br>
                @foreach($travelPlans as $travelPlan)
                    <div class="card">
                        <form action="/schedule" method="GET">
                            @csrf
                            <input type="hidden" name="travel_plan_id" value="{{ $travelPlan->id }}">
                            <div class="card-header">
                                旅行概要　<button type="submit" class="btn btn-primary" formaction="/schedule">編集</button>　
                                <button type="submit" class="btn btn-secondary">旅行詳細設定</button>
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
                        </form>
                    </div>
                    <br>
                @endforeach
            </div>
        </div>
    </div>
@endsection