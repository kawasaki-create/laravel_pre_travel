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
                                <th>金額(小計)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>朝食</td>
                                @if(isset($contents1[$i]) && $displayDays[$i] === $contents1[$i]->date)
                                <td>{{ $contents1->pluck('contents')->implode(', ') }}</td>
                                <td>¥{{ $price1 }}</td>
                                @php
                                    $totalPrice += $price1;
                                @endphp
                                @else
                                <td></td>
                                <td></td>
                                @endif
                            </tr>
                            <tr>
                                <td>昼食</td>
                                @if(isset($contents2[$i]) && $displayDays[$i] === $contents2[$i]->date)
                                <td>{{ $contents2->pluck('contents')->implode(', ') }}</td>
                                <td>¥{{ $price2 }}</td>
                                @php
                                    $totalPrice += $price2;
                                @endphp
                                @else
                                <td></td>
                                <td></td>
                                @endif
                            </tr>
                            <tr>
                                <td>夕食</td>
                                @if(isset($contents3[$i]) && $displayDays[$i] === $contents3[$i]->date)
                                <td>{{ $contents3->pluck('contents')->implode(', ') }}</td>
                                <td>¥{{ $price3 }}</td>
                                @php
                                    $totalPrice += $price3;
                                @endphp
                                @else
                                <td></td>
                                <td></td>
                                @endif
                            </tr>
                            <tr>
                                <td>間食</td>
                                @if(isset($contents4[$i]) && $displayDays[$i] === $contents4[$i]->date)
                                <td>{{ $contents4->pluck('contents')->implode(', ') }}</td>
                                <td>¥{{ $price4 }}</td>
                                @php
                                    $totalPrice += $price4;
                                @endphp
                                @else
                                <td></td>
                                <td></td>
                                @endif
                            </tr>
                            <tr>
                                <td>交通費</td>
                                @if(isset($contents5[$i]) && $displayDays[$i] === $contents5[$i]->date)
                                <td>{{ $contents5->pluck('contents')->implode(', ') }}</td>
                                <td>¥{{ $price5 }}</td>
                                @php
                                    $totalPrice += $price5;
                                @endphp
                                @else
                                <td></td>
                                <td></td>
                                @endif
                            </tr>
                            <tr>
                                <td>宿泊費</td>
                                @if(isset($contents6[$i]) && $displayDays[$i] === $contents6[$i]->date)
                                <td>{{ $contents6->pluck('contents')->implode(', ') }}</td>
                                <td>¥{{ $price6 }}</td>
                                @php
                                    $totalPrice += $price6;
                                @endphp
                                @else
                                <td></td>
                                <td></td>
                                @endif
                            </tr>
                            <tr>
                                <td>お土産</td>
                                @if(isset($contents7[$i]) && $displayDays[$i] === $contents7[$i]->date)
                                <td>{{ $contents7->pluck('contents')->implode(', ') }}</td>
                                <td>¥{{ $price7 }}</td>
                                @php
                                    $totalPrice += $price7;
                                @endphp
                                @else
                                <td></td>
                                <td></td>
                                @endif
                            </tr>
                            <tr>
                                <td>レジャー</td>
                                @if(isset($contents8[$i]) && $displayDays[$i] === $contents8[$i]->date)
                                <td>{{ $contents8->pluck('contents')->implode(', ') }}</td>
                                <td>¥{{ $price8 }}</td>
                                @php
                                    $totalPrice += $price8;
                                @endphp
                                @else
                                <td></td>
                                <td></td>
                                @endif
                            </tr>
                            <tr>
                                <td>その他雑費</td>
                                @if(isset($contents10[$i]) && $displayDays[$i] === $contents10[$i]->date)
                                <td>{{ $contents10->pluck('contents')->implode(', ') }}</td>
                                <td>¥{{ $price10 }}</td>
                                @php
                                    $totalPrice += $price10;
                                @endphp
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
                                            isset($contents10[$i]) && $displayDays[$i] === $contents10[$i]->date ||
                                            isset($contents8[$i]) && $displayDays[$i] === $contents8[$i]->date ||
                                            isset($contents7[$i]) && $displayDays[$i] === $contents7[$i]->date ||
                                            isset($contents6[$i]) && $displayDays[$i] === $contents6[$i]->date ||
                                            isset($contents5[$i]) && $displayDays[$i] === $contents5[$i]->date ||
                                            isset($contents4[$i]) && $displayDays[$i] === $contents4[$i]->date ||
                                            isset($contents3[$i]) && $displayDays[$i] === $contents3[$i]->date ||
                                            isset($contents2[$i]) && $displayDays[$i] === $contents2[$i]->date ||
                                            isset($contents1[$i]) && $displayDays[$i] === $contents1[$i]->date
                                        )
                                        ¥{{ $totalPrice }}
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
                            @php
                                if(isset($travelDate[$i]) && $displayDays[$i] === $travelDate[$i]->date) {
                                    for($j = 0; $j < $timesCnt; $j++) {
                                    echo '<tr>';
                                    echo '<td>';
                                    echo $timeFroms[$j + 1] . '〜' . $timeToes[$j + 1];
                                    echo '</td>';
                                    echo '<td>';
                                    echo $timeContents[$j + 1];
                                    echo '</td>';
                                    echo '</tr>';
                                    }
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