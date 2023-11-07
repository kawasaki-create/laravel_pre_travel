@extends('layouts.app')
@section('content')
@vite(['resources/js/planEdit.js'])
<script src="{{ asset('resources/js/app.js') }}"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">旅行スケジュール修正</div>

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
                        <input type="text" name="trip-title" value="{{ $travelPlan->trip_title }}"><br><br>
                        <span>日程：</span>
                        <input type="date" name="trip-start" style="width:123px;" value="{{ $formatted_start }}">〜<input type="date" name="trip-end" style="width:123px;" value="{{ $formatted_end }}"><br><br>
                        <span>集合場所：</span>
                        <input type="text" name="meet-place" value="{{ $travelPlan->meet_place }}"><br><br>
                        <span>家を出る時刻：</span>
                        <input type="time" name="departure-time" value="{{ $departure }}"><br><br>
                        <span>予算：</span>
                        <input type="text" name="budget" value="{{$travelPlan->budget}}">&ensp;円&emsp;
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