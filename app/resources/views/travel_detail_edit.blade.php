@extends('layouts.app')
@section('content')
@vite(['resources/js/todoAddSelect.js'])
@vite(['resources/css/newSchedule.css'])
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">詳細スケジュール<span style="color: red; font-weight: bold;">削除</span></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('schedule.detailDelete') }}" method="POST">
                        @php
                            $url = $_SERVER['REQUEST_URI'];
                            $editUrl = ltrim(strrchr("$url", "/"), '/');
                        @endphp
                        @csrf
                        <span>旅行名：{{ $travelPlan->trip_title }} </span>
                        <span>{{ $travelDate }}</span><br><br>

                        @php
                        $matchingContents = $contents1->where('date', $travelDate);
                            // ここにもし項目(旅費)がセットされてれば表示されるようにする
                            if ($matchingContents->isNotEmpty()) {
                                $contentsCount = 0;
                                foreach($matchingContents as $content) {
                                    echo '<input type="checkbox" name="deletes[]" value="' . $content->id . '"> ';
                                    echo '<span>' . '朝食：'. $content->contents . '</span>　';
                                    echo '<span>' . '¥' . $content->price . '</span><br>';
                                    $contentsCount++;
                                }
                                $deleteFlg = true;
                            }
                        @endphp
                        @php
                        $matchingContents = $contents2->where('date', $travelDate);
                            // ここにもし項目(旅費)がセットされてれば表示されるようにする
                            if ($matchingContents->isNotEmpty()) {
                                $contentsCount = 0;
                                foreach($matchingContents as $content) {
                                    echo '<input type="checkbox" name="deletes[]" value="' . $content->id . '"> ';
                                    echo '<span>' . '昼食：'. $content->contents . '</span>　';
                                    echo '<span>' . '¥' . $content->price . '</span><br>';
                                    $contentsCount++;
                                }
                                $deleteFlg = true;
                            }
                        @endphp
                        @php
                        $matchingContents = $contents3->where('date', $travelDate);
                            // ここにもし項目(旅費)がセットされてれば表示されるようにする
                            if ($matchingContents->isNotEmpty()) {
                                $contentsCount = 0;
                                foreach($matchingContents as $content) {
                                    echo '<input type="checkbox" name="deletes[]" value="' . $content->id . '"> ';
                                    echo '<span>' . '夕食：'. $content->contents . '</span>　';
                                    echo '<span>' . '¥' . $content->price . '</span><br>';
                                    $contentsCount++;
                                }
                                $deleteFlg = true;
                            }
                        @endphp
                        @php
                        $matchingContents = $contents4->where('date', $travelDate);
                            // ここにもし項目(旅費)がセットされてれば表示されるようにする
                            if ($matchingContents->isNotEmpty()) {
                                $contentsCount = 0;
                                foreach($matchingContents as $content) {
                                    echo '<input type="checkbox" name="deletes[]" value="' . $content->id . '"> ';
                                    echo '<span>' . '間食：'. $content->contents . '</span>　';
                                    echo '<span>' . '¥' . $content->price . '</span><br>';
                                    $contentsCount++;
                                }
                                $deleteFlg = true;
                            }
                        @endphp
                        @php
                        $matchingContents = $contents5->where('date', $travelDate);
                            // ここにもし項目(旅費)がセットされてれば表示されるようにする
                            if ($matchingContents->isNotEmpty()) {
                                $contentsCount = 0;
                                foreach($matchingContents as $content) {
                                    echo '<input type="checkbox" name="deletes[]" value="' . $content->id . '"> ';
                                    echo '<span>' . '交通費：'. $content->contents . '</span>　';
                                    echo '<span>' . '¥' . $content->price . '</span><br>';
                                    $contentsCount++;
                                }
                                $deleteFlg = true;
                            }
                        @endphp
                        @php
                        $matchingContents = $contents6->where('date', $travelDate);
                            // ここにもし項目(旅費)がセットされてれば表示されるようにする
                            if ($matchingContents->isNotEmpty()) {
                                $contentsCount = 0;
                                foreach($matchingContents as $content) {
                                    echo '<input type="checkbox" name="deletes[]" value="' . $content->id . '"> ';
                                    echo '<span>' . '宿泊費：'. $content->contents . '</span>　';
                                    echo '<span>' . '¥' . $content->price . '</span><br>';
                                    $contentsCount++;
                                }
                                $deleteFlg = true;
                            }
                        @endphp
                        @php
                        $matchingContents = $contents7->where('date', $travelDate);
                            // ここにもし項目(旅費)がセットされてれば表示されるようにする
                            if ($matchingContents->isNotEmpty()) {
                                $contentsCount = 0;
                                foreach($matchingContents as $content) {
                                    echo '<input type="checkbox" name="deletes[]" value="' . $content->id . '"> ';
                                    echo '<span>' . 'お土産：'. $content->contents . '</span>　';
                                    echo '<span>' . '¥' . $content->price . '</span><br>';
                                    $contentsCount++;
                                }
                                $deleteFlg = true;
                            }
                        @endphp
                        @php
                        $matchingContents = $contents8->where('date', $travelDate);
                            // ここにもし項目(旅費)がセットされてれば表示されるようにする
                            if ($matchingContents->isNotEmpty()) {
                                $contentsCount = 0;
                                foreach($matchingContents as $content) {
                                    echo '<input type="checkbox" name="deletes[]" value="' . $content->id . '"> ';
                                    echo '<span>' . 'レジャー：'. $content->contents . '</span>　';
                                    echo '<span>' . '¥' . $content->price . '</span><br>';
                                    $contentsCount++;
                                }
                                $deleteFlg = true;
                            }
                        @endphp
                        @php
                        $matchingContents = $contents10->where('date', $travelDate);
                            // ここにもし項目(旅費)がセットされてれば表示されるようにする
                            if ($matchingContents->isNotEmpty()) {
                                $contentsCount = 0;
                                foreach($matchingContents as $content) {
                                    echo '<input type="checkbox" name="deletes[]" value="' . $content->id . '"> ';
                                    echo '<span>' . 'その他雑費：'. $content->contents . '</span>　';
                                    echo '<span>' . '¥' . $content->price . '</span><br>';
                                    $contentsCount++;
                                }
                                $deleteFlg = true;
                            }
                        @endphp
                        @php
                        $matchingContents = $contents9->where('date', $travelDate)->sortBy('time_from');
                            // ここにもし項目(予定)がセットされてれば表示されるようにする
                            if($matchingContents->isNotEmpty()) {
                                echo '<br>';
                                $contentsCount = 0;
                                foreach($matchingContents as $content) {
                                    echo '<input type="checkbox" name="deletes[]" value="' . $content->id . '"> ';
                                    echo '<span>' . substr($content->time_from, 11, 5) . '～' . substr($content->time_to, 11, 5) . '　' . $content->contents . '</span></br>';
                                    $contentsCount++;
                                }
                                $deleteFlg = true;
                            }
                        @endphp
                        @if($deleteFlg)
                            <br><button type="submit" class="btn btn-danger" id="detail-delete">削除</button><br>
                        @endif
                        <!-- <button type="submit" name="plan-register" class="btn btn-primary">登録</button> -->
                        <input type="hidden" name="plan-id" value="{{ $editUrl }}">
                    </form>
                </div>
            </div>
            <br><br>
            <div class="card">
                <div class="card-header">詳細スケジュール<span style="color:cornflowerblue; font-weight: bold;">追加</span></div>
                <div class="card-body">
                    <form action="{{ route('schedule.detailNR') }}" method="POST">
                        @php
                            $url = $_SERVER['REQUEST_URI'];
                            $editUrl = ltrim(strrchr("$url", "/"), '/');
                        @endphp
                        @csrf
                        <span>旅行名：{{ $travelPlan->trip_title }} </span>
                        <span>{{ $travelDate }}</span><br><br>
                        @if(
                            $contents1->pluck('contents') && in_array($travelDate, $contents1->pluck('date')->toArray()) ||
                            $contents2->pluck('contents') && in_array($travelDate, $contents2->pluck('date')->toArray()) ||
                            $contents3->pluck('contents') && in_array($travelDate, $contents3->pluck('date')->toArray()) ||
                            $contents4->pluck('contents') && in_array($travelDate, $contents4->pluck('date')->toArray()) ||
                            $contents5->pluck('contents') && in_array($travelDate, $contents5->pluck('date')->toArray()) ||
                            $contents6->pluck('contents') && in_array($travelDate, $contents6->pluck('date')->toArray()) ||
                            $contents7->pluck('contents') && in_array($travelDate, $contents7->pluck('date')->toArray()) ||
                            $contents8->pluck('contents') && in_array($travelDate, $contents8->pluck('date')->toArray()) ||
                            $contents9->pluck('contents') && in_array($travelDate, $contents9->pluck('date')->toArray()) ||
                            $contents10->pluck('contents') && in_array($travelDate, $contents10->pluck('date')->toArray())
                        )
                            <select name="kubun"  id="selectBox">
                                <option value="0">追加項目選択</option>
                                <option value="1">朝食</option>
                                <option value="2">昼食</option>
                                <option value="3">夕食</option>
                                <option value="4">間食</option>
                                <option value="5">交通費</option>
                                <option value="6">宿泊費</option>
                                <option value="7">お土産</option>
                                <option value="8">レジャー</option>
                                <option value="9">行きたいところ</option>
                                <option value="10">その他雑費</option>
                            </select>
                            <textarea id="timeCnt" name="timeCnt" hidden>1</textarea>
                            <textarea type="text" name="travel_plan_id" hidden>{{ $travelPlanId }}</textarea>
                            <textarea type="text" name="travelDate" hidden>{{ $travelDate }}</textarea>
                            <button type="submit" id="detail-add" class="btn btn-primary" name="todo-register">登録</button>
                            <span id="inputContainer"></span>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection