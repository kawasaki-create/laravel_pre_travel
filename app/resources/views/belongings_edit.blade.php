@extends('layouts.app')
@section('content')
@vite(['resources/js/planEdit.js'])
<script src="{{ asset('resources/js/app.js') }}"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
                <div class="card">
                    <div class="card-header">持っていくものリスト <span style="color:red; font-size:10px;">※旅行中のみ表示</span></div>
                    <div class="card-body">
                        <form action="{{ route('schedule.detailNR') }}" method="POST">
                            @csrf
                            <div name="times">
                                <button type="button" name="add" class="btn btn-outline-success btn-sm">＋</button>
                                <button type="button" name="delete" class="btn btn-outline-danger btn-sm">－</button><br><br>
                                    <div id="belongingsContainer" class="belongings">
                                        <span name="num">1：</span>
                                        <input type="checkbox" name="belongingsCheck">
                                        <input type="text" name="belongings-1" style="width: 70%;">
                                    </div>
                                <button name="belongings-register" class="btn btn-primary">登録</button>
                                <textarea id="belonginsCnt" name="belonginsCnt" hidden>1</textarea>
                            </div>
                        </form>
                    </div>
                </div><br>

            <br><br>
        </div>
    </div>
</div>
@endsection