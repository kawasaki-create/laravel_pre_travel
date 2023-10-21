@extends('layouts.app')
@section('content')
@vite(['resources/js/scheduleDetail.js'])
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="/home">←ホーム画面に戻る</a>　　　
                <span>旅行名：{{ $travelPlan->trip_title }}</span><br>
                <span>期間：{{ $formatted_start }}〜{{ $formatted_end }}</span>
                <p>{{ $dateCount }}日間</p>
                <br><br>
                @for($i = 0; $i < $dateCount; $i ++)
                    <a href="" class="date" id="date{{$i}}">{{ $displayDays[$i] }}<span style="font-size: 10px; color: gray;" id="dateText{{$i}}">{{ $displayFlags[$displayDays[$i]] ? '(クリックで閉じる)' : '(クリックで表示)' }}</span></a>
                    <span name="clickInline" style="display: {{ $displayFlags[$displayDays[$i]] ? '' : 'none' }};"><br><br></span>
                    <div class="d-grid text-right">
                        <button class="btn btn-outline-primary" type="button" name="newEdit" style="display: {{ $displayFlags[$displayDays[$i]] ? '' : 'none' }};">予定追加・編集</button>
                    </div>
                    <span>　</span>
                    <table name="expense" class="table table-bordered table-striped table-responsive" style="display: {{ $displayFlags[$displayDays[$i]] ? 'table' : 'none' }};">
                        <thead>
                            <tr class="table-primary">
                                <th>種目</th>
                                <th>内容</th>
                                <th>金額</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>朝食</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>昼食</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <table name="todo" class="table table-bordered table-striped table-responsive" style="display: {{ $displayFlags[$displayDays[$i]] ? 'table' : 'none' }};">
                    <thead>
                            <tr class="table-success">
                                <th>時間</th>
                                <th>内容</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>10:00~12:00</td>
                                <td>家を出てしばらくするとそこには有名なコンビニエンスストアがありました</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                @endfor
            </div>
            <div class="display">
            </div>
        </div>
    </div>
@endsection