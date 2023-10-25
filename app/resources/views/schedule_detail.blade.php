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
                        <form action="{{ route('schedule.detailNew', ['travel_plan_id' => $travelPlan->id, 'date' => $displayDays[$i]]) }}" method="POST">
                            @csrf
                            <div class="d-grid gap-2 d-md-block">
                                <button class="btn btn-outline-primary" name="newDetail" style="display: {{ $displayFlags[$displayDays[$i]] ? 'inline' : 'none' }};">予定追加</button>　
                            </div>
                            <textarea type="text" name="travel_plan_id" hidden>{{ $travelPlan->id }}</textarea>
                            <textarea type="text" name="travelDate" hidden>{{ $displayDays[$i] }}</textarea>
                        </form>
                        <form action="{{ route('schedule.detailEdit', ['travel_plan_id' => $travelPlan->id, 'date' => $displayDays[$i]]) }}" method="POST">
                            @csrf
                            <div class="d-grid gap-2 d-md-block">
                                <button class="btn btn-outline-secondary" name="editDetail" style="display: {{ $displayFlags[$displayDays[$i]] ? 'inline' : 'none' }};">予定編集</button>
                            </div>
                            <textarea type="text" name="travel_plan_id" hidden>{{ $travelPlan->id }}</textarea>
                            <textarea type="text" name="travelDate" hidden>{{ $displayDays[$i] }}</textarea>
                        </form>
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
                                <td>{{ $contents1->implode(', ') }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>昼食</td>
                                <td>{{ $contents2->implode(', ') }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>夕食</td>
                                <td>{{ $contents3->implode(', ') }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>間食</td>
                                <td>{{ $contents4->implode(', ') }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>交通費</td>
                                <td>{{ $contents5->implode(', ') }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>宿泊費</td>
                                <td>{{ $contents6->implode(', ') }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>お土産</td>
                                <td>{{ $contents7->implode(', ') }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>レジャー</td>
                                <td>{{ $contents8->implode(', ') }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>その他雑費</td>
                                <td>{{ $contents10->implode(', ') }}</td>
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
                            @php
                                for($j = 0; $j < $timesCnt; $j++) {
                                echo '<tr>';
                                echo '<td>';
                                echo '10:00~12:00';
                                echo '</td>';
                                echo '<td>';
                                echo '家を出てしばらくするとそこには有名なコンビニエンスストアがありました';
                                echo '</td>';
                                echo '</tr>';
                                }
                            @endphp
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