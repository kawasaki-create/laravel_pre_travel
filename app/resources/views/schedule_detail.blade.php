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
                    <div class="d-flex">
                        <form action="{{ route('schedule.detailNew', ['travel_plan_id' => $travelPlan->id, 'date' => $displayDays[$i]]) }}" method="POST" style="display: inline;" class="me-2">
                            @csrf
                            <div class="d-grid gap-2 d-md-block">
                                <button class="btn btn-outline-primary" name="newDetail" style="display: {{ $displayFlags[$displayDays[$i]] ? 'inline' : 'none' }};">予定追加</button>
                            </div>
                            <textarea type="text" name="travel_plan_id" hidden>{{ $travelPlan->id }}</textarea>
                            <textarea type="text" name="travelDate" hidden>{{ $displayDays[$i] }}</textarea>
                        </form>
                        <form action="{{ route('schedule.detailEdit', ['travel_plan_id' => $travelPlan->id, 'date' => $displayDays[$i]]) }}" method="POST" style="display: inline;">
                            @csrf
                            <div class="d-grid gap-2 d-md-block">
                                <button class="btn btn-outline-secondary" name="editDetail" style="display: {{ $displayFlags[$displayDays[$i]] ? 'inline' : 'none' }};">予定編集</button>
                            </div>
                            <textarea type="text" name="travel_plan_id" hidden>{{ $travelPlan->id }}</textarea>
                            <textarea type="text" name="travelDate" hidden>{{ $displayDays[$i] }}</textarea>
                        </form>
                    </div>
                    <span>　</span>
                    <table name="expense" class="table table-bordered table-striped table-responsive" style="display: {{ $displayFlags[$displayDays[$i]] ? 'table' : 'none' }};">
                        <thead>
                            <tr class="table-primary">
                                <th>種目</th>
                                <th>内容</th>
                                <th>金額(小計)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>朝食</td>
                                @if($contents1Data[$i]?? null )
                                    <td>{{ $contents1Data[$i]->implode(', '); }}</td>
                                    <td>¥{{ $price1Data[$i]->sum() }}</td>
                                @else
                                    <td></td>
                                    <td></td>
                                @endif
                            </tr>
                            <tr>
                                <td>昼食</td>
                                @if($contents2Data[$i]?? null )
                                    <td>{{ $contents2Data[$i]->implode(', '); }}</td>
                                    <td>¥{{ $price2Data[$i]->sum(); }}</td>
                                @else
                                    <td></td>
                                    <td></td>
                                @endif
                            </tr>
                            <tr>
                                <td>夕食</td>
                                @if($contents3Data[$i]?? null )
                                    <td>{{ $contents3Data[$i]->implode(', '); }}</td>
                                    <td>¥{{ $price3Data[$i]->sum(); }}</td>
                                @else
                                    <td></td>
                                    <td></td>
                                @endif
                            </tr>
                            <tr>
                                <td>間食</td>
                                @if($contents4Data[$i]?? null )
                                    <td>{{ $contents4Data[$i]->implode(', '); }}</td>
                                    <td>¥{{ $price4Data[$i]->sum(); }}</td>
                                @else
                                    <td></td>
                                    <td></td>
                                @endif
                            </tr>
                            <tr>
                                <td>交通費</td>
                                @if($contents5Data[$i]?? null )
                                    <td>{{ $contents5Data[$i]->implode(', '); }}</td>
                                    <td>¥{{ $price5Data[$i]->sum(); }}</td>
                                @else
                                    <td></td>
                                    <td></td>
                                @endif
                            </tr>
                            <tr>
                                <td>宿泊費</td>
                                @if($contents6Data[$i]?? null )
                                    <td>{{ $contents6Data[$i]->implode(', '); }}</td>
                                    <td>¥{{ $price6Data[$i]->sum(); }}</td>
                                @else
                                    <td></td>
                                    <td></td>
                                @endif
                            </tr>
                            <tr>
                                <td>お土産</td>
                                @if($contents7Data[$i]?? null )
                                    <td>{{ $contents7Data[$i]->implode(', '); }}</td>
                                    <td>¥{{ $price7Data[$i]->sum(); }}</td>
                                @else
                                    <td></td>
                                    <td></td>
                                @endif
                            </tr>
                            <tr>
                                <td>レジャー</td>
                                @if($contents8Data[$i]?? null )
                                    <td>{{ $contents8Data[$i]->implode(', '); }}</td>
                                    <td>¥{{ $price8Data[$i]->sum(); }}</td>
                                @else
                                    <td></td>
                                    <td></td>
                                @endif
                            </tr>
                            <tr>
                                <td>その他雑費</td>
                                @if($contents10Data[$i]?? null )
                                    <td>{{ $contents10Data[$i]->implode(', '); }}</td>
                                    <td>¥{{ $price10Data[$i]->sum(); }}</td>
                                @else
                                    <td></td>
                                    <td></td>
                                @endif
                            </tr>
                            <tfoot class="table-danger">
                                <tr>
                                    <td>合計金額</td>
                                    <td></td>
                                    <td>
                                        @if(
                                            $price2Data[$i] ?? null ||
                                            $price3Data[$i] ?? null ||
                                            $price4Data[$i] ?? null ||
                                            $price5Data[$i] ?? null ||
                                            $price6Data[$i] ?? null ||
                                            $price7Data[$i] ?? null ||
                                            $price8Data[$i] ?? null ||
                                            $price1Data[$i] ?? null ||
                                            $price10Data[$i] ?? null
                                        )
                                        ¥{{ $totalPrice[$i]}}
                                        @endif
                                    </td>
                                </tr>
                            </tfoot>
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
                            @foreach ($contents9 as $row)
                                @if(substr($row->time_from, 0, 10) == $displayDays[$i])
                                    <tr>
                                        <td>{{ substr($row->time_from, 11, 5) }}～{{ substr($row->time_to, 11, 5) }}</td>
                                        <td>{{ $row->contents }}</td>
                                    </tr>
                                @endif
                            @endforeach
                    </table>
                    <br>
                @endfor
            </div>
            <div class="display">
            </div>
        </div>
    </div>
@endsection