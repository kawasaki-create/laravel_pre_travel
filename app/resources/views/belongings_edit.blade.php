@extends('layouts.app')
@section('content')
@vite(['resources/js/belongingsEdit.js'])
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
                <div class="card">
                    <div class="card-header">持っていくもの追加 <span style="color:red; font-size:10px;">※旅行中のみ表示</span></div>
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
                                <button name="belongings-register" class="btn btn-primary">登録</button>
                                <textarea id="belonginsCnt" name="belonginsCnt" hidden>1</textarea>
                                <input type="hidden" value="{{ $id }}" name="travel_plan_id">
                            </div>
                        </form>
                    </div>
                </div><br>
                <div class="card">
                    <div class="card-header">持っていくものリスト確認</div>
                    <div class="card-body">
                        @foreach($belongings as $row)
                            <span>・</span>
                            <span>{{ $row->contents }} </span>
                        @endforeach
                    </div>
                </div>
            <br><br>
        </div>
    </div>
</div>
@endsection