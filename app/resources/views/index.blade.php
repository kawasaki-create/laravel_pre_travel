@extends('layouts.app')
@section('content')
@vite(['resources/js/planEdit.js'])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">旅行スケジュール登録</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('travel.click') }}" method="POST">
                        @csrf
                        <span>旅行名：</span>
                        <input type="text" name="trip-title"><br><br>
                        <span>日程：</span>
                        <input type="date" name="trip-start" style="width:123px;">〜<input type="date" name="trip-end" style="width:123px;"><br><br>
                        <span>集合場所：</span>
                        <input type="text" name="meet-place"><br><br>
                        <span>家を出る時刻：</span>
                        <input type="time" name="departure-time"><br><br>
                        <span>予算：</span>
                        <input type="text" name="budget">&ensp;円&emsp;
                        <button type="submit" name="plan-register" class="btn btn-primary">登録</button>
                    </form>
                </div>
            </div>
            <br><br>
        </div>
    </div>
</div>
@endsection