@extends('layouts.app')
@section('content')
@vite(['resources/js/scheduleDelete.js'])
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
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
                            <a href="{{ route('schedule.detail', ['id' => $travelPlan->id]) }}" class="btn btn-secondary">旅行詳細設定</a>
                            <form action="{{ route('schedule.delete', ['id' => $travelPlan->id]) }}" method="GET" style="display:inline;" onsubmit="return confirm('旅行を削除しますか？(この動作は取り消せません)');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" id="planDeleteButton">削除</button>
                            </form>
                        </div>
                        <div class="card-body">
                            @php
                                $time = substr($travelPlan->departure_time, 11, 8);
                                $ftime = substr($time, 0, 5);
                            @endphp
                            <p>旅行名： {{ $travelPlan->trip_title }}</p>
                            <p>期間： {{ $travelPlan->trip_start }} 〜 {{ $travelPlan->trip_end }}</p>
                            @if($time != '00:00:00')
                            <p>出発時刻： {{ $travelPlan->trip_start . ' ' . $ftime }}</p>
                            @endif
                            @if($travelPlan->meet_place)
                                <p>集合場所： {{ $travelPlan->meet_place }}</p>
                            @endif
                            @if($travelPlan->budget)
                                <p>予算： {{ $travelPlan->budget }}円</p>
                            @endif
                            <div>
                                <a href="{{ route('schedule.belongings') }}">旅行の持ち物の確認・編集</a>
                            </div>
                        </div>
                    </div>
                    <br>
                @endforeach
            </div>
        </div>
    </div>
@endsection