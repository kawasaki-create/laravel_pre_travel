@extends('layouts.app')
@section('content')
@vite(['resources/js/belongingsEdit.js'])
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (session('danger'))
    <div class="alert alert-danger">
        {{ session('danger') }}
    </div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
        <a href="/home">←ホーム画面に戻る</a>　　　
                <span>旅行名：{{ $travelPlan->trip_title }}</span><br>
                <span>期間：{{ $formatted_start }}〜{{ $formatted_end }}</span>
                <p>{{ $dateCount }}日間</p>
                <br>
            <div class="card">
                <div class="card-header">持っていくものリスト<span style="color: red; font-weight: bold;">削除</span></div>
                <div class="card-body">
                    <form action="{{ route('schedule.belongings_delete') }}" method="POST">
                        @csrf
                        @foreach($belongings as $row)
                        <input type="checkbox" class="checkbox" name="belongings[]" data-id="{{ $row->id }}" value="{{ $row->id }}">
                        <span class="belonging-item" data-id="{{ $row->id }}">{{ $row->contents }}</span><br>
                        @endforeach
                        <br>
                        <button id="belongingsDeleteButton" name="belongings-delete" class="btn btn-outline-danger">削除</button>
                        <input type="hidden" value="{{ $id }}" name="travel_plan_id">
                    </form>
                </div>
            </div>
            <br><br>
            <div class="card">
                <div class="card-header">持っていくもの<span style="color:cornflowerblue; font-weight: bold;">追加</span></div>
                <div class="card-body">
                    <form action="{{ route('schedule.belongings_register') }}" method="POST">
                        @csrf
                        <div name="times">
                            <button type="button" name="add" class="btn btn-outline-success btn-sm">＋</button>
                            <button type="button" name="delete" class="btn btn-outline-danger btn-sm">－</button>

                            <!-- <select name="post-travels" id="post-travels">
                                <option value="0">▼過去の旅行からインポートする</option>
                                @foreach($travelPlans as $row)
                                    <option value="{{ $row->id }}">{{ $row->trip_title }}</option>
                                @endforeach
                            </select> -->
                            <br><br>
                            <div id="belongingsContainer" class="belongings">
                                <span name="num">1：</span>
                                <input type="text" name="belongings-1" style="width: 70%;">
                            </div><br>
                            <button name="belongings-register" class="btn btn-outline-primary">登録</button>
                            <textarea id="belonginsCnt" name="belonginsCnt" hidden>1</textarea>
                            <input type="hidden" value="{{ $id }}" name="travel_plan_id">
                        </div>
                    </form>
                </div>
            </div><br>
        </div>
    </div>
</div>
@endsection