@extends('layouts.app')
@section('content')
@vite(['resources/js/todoAddSelect.js'])
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
                    <form action="{{ route('travel.edit') }}" method="POST">
                        @php
                            $url = $_SERVER['REQUEST_URI'];
                            $editUrl = ltrim(strrchr("$url", "/"), '/');
                        @endphp
                        @csrf
                        <span>旅行名：{{ $travelPlan->trip_title }} </span>
                        <span>{{ $travelDate }}</span><br><br>

                        @php
                            // ここにもし項目(旅費)がセットされてれば表示されるようにする
                            if($contents1->pluck('contents') && in_array($travelDate, $contents1->pluck('date')->toArray())) {
                                $contentsCount = 0;
                                foreach($contents1->pluck('contents') as $content) {
                                    echo '<input type="checkbox" name="' . $contents1->pluck('id')[$contentsCount] . '" value="' . $contents1->pluck('id')[$contentsCount] . '"> ';
                                    echo '<span>' . '朝食：'. $content . '</span></br>';
                                    $contentsCount++;
                                }
                            }
                        @endphp
                        @php
                            // ここにもし項目(旅費)がセットされてれば表示されるようにする
                            if($contents2->pluck('contents') && in_array($travelDate, $contents2->pluck('date')->toArray())) {
                                $contentsCount = 0;
                                foreach($contents2->pluck('contents') as $content) {
                                    echo '<input type="checkbox" name="' . $contents2->pluck('id')[$contentsCount] . '" value="' . $contents2->pluck('id')[$contentsCount] . '"> ';
                                    echo '<span>' . '昼食：'. $content . '</span></br>';
                                    $contentsCount++;
                                }
                            }
                        @endphp
                        @php
                            // ここにもし項目(旅費)がセットされてれば表示されるようにする
                            if($contents3->pluck('contents') && in_array($travelDate, $contents3->pluck('date')->toArray())) {
                                $contentsCount = 0;
                                foreach($contents3->pluck('contents') as $content) {
                                    echo '<input type="checkbox" name="' . $contents3->pluck('id')[$contentsCount] . '" value="' . $contents3->pluck('id')[$contentsCount] . '"> ';
                                    echo '<span>' . '夕食：'. $content . '</span></br>';
                                    $contentsCount++;
                                }
                            }
                        @endphp
                        @php
                            // ここにもし項目(旅費)がセットされてれば表示されるようにする
                            if($contents4->pluck('contents') && in_array($travelDate, $contents4->pluck('date')->toArray())) {
                                $contentsCount = 0;
                                foreach($contents4->pluck('contents') as $content) {
                                    echo '<input type="checkbox" name="' . $contents4->pluck('id')[$contentsCount] . '" value="' . $contents4->pluck('id')[$contentsCount] . '"> ';
                                    echo '<span>' . '間食：'. $content . '</span></br>';
                                    $contentsCount++;
                                }
                            }
                        @endphp
                        @php
                            // ここにもし項目(旅費)がセットされてれば表示されるようにする
                            if($contents5->pluck('contents') && in_array($travelDate, $contents5->pluck('date')->toArray())) {
                                $contentsCount = 0;
                                foreach($contents5->pluck('contents') as $content) {
                                    echo '<input type="checkbox" name="' . $contents5->pluck('id')[$contentsCount] . '" value="' . $contents5->pluck('id')[$contentsCount] . '"> ';
                                    echo '<span>' . '交通費：'. $content . '</span></br>';
                                    $contentsCount++;
                                }
                            }
                        @endphp
                        @php
                            // ここにもし項目(旅費)がセットされてれば表示されるようにする
                            if($contents6->pluck('contents') && in_array($travelDate, $contents6->pluck('date')->toArray())) {
                                $contentsCount = 0;
                                foreach($contents6->pluck('contents') as $content) {
                                    echo '<input type="checkbox" name="' . $contents6->pluck('id')[$contentsCount] . '" value="' . $contents6->pluck('id')[$contentsCount] . '"> ';
                                    echo '<span>' . '宿泊費：'. $content . '</span></br>';
                                    $contentsCount++;
                                }
                            }
                        @endphp
                        @php
                            // ここにもし項目(旅費)がセットされてれば表示されるようにする
                            if($contents7->pluck('contents') && in_array($travelDate, $contents7->pluck('date')->toArray())) {
                                $contentsCount = 0;
                                foreach($contents7->pluck('contents') as $content) {
                                    echo '<input type="checkbox" name="' . $contents7->pluck('id')[$contentsCount] . '" value="' . $contents7->pluck('id')[$contentsCount] . '"> ';
                                    echo '<span>' . 'お土産：'. $content . '</span></br>';
                                    $contentsCount++;
                                }
                            }
                        @endphp
                        @php
                            // ここにもし項目(旅費)がセットされてれば表示されるようにする
                            if($contents8->pluck('contents') && in_array($travelDate, $contents8->pluck('date')->toArray())) {
                                $contentsCount = 0;
                                foreach($contents8->pluck('contents') as $content) {
                                    echo '<input type="checkbox" name="' . $contents8->pluck('id')[$contentsCount] . '" value="' . $contents8->pluck('id')[$contentsCount] . '"> ';
                                    echo '<span>' . 'レジャー：'. $content . '</span></br>';
                                    $contentsCount++;
                                }
                            }
                        @endphp
                        @php
                            // ここにもし項目(旅費)がセットされてれば表示されるようにする
                            if($contents10->pluck('contents') && in_array($travelDate, $contents10->pluck('date')->toArray())) {
                                $contentsCount = 0;
                                foreach($contents10->pluck('contents') as $content) {
                                    echo '<input type="checkbox" name="' . $contents10->pluck('id')[$contentsCount] . '" value="' . $contents10->pluck('id')[$contentsCount] . '"> ';
                                    echo '<span>' . 'その他雑費：'. $content . '</span></br>';
                                    $contentsCount++;
                                }
                            }
                        @endphp
                        @php
                            // ここにもし項目(予定)がセットされてれば表示されるようにする
                            if($contents9->pluck('contents') && in_array($travelDate, $contents9->pluck('date')->toArray())) {
                                echo '<br>';
                                $contentsCount = 0;
                                foreach($contents9->pluck('contents') as $content) {
                                    echo '<input type="checkbox" name="' . $contents9->pluck('id')[$contentsCount] . '" value="' . $contents9->pluck('id')[$contentsCount] . '"> ';
                                    echo '<span>' . $timeFroms[$contentsCount] . '～' . $timeToes[$contentsCount] . '　' . $timeContents[$contentsCount] . '</span></br>';
                                    $contentsCount++;
                                }
                            }
                        @endphp
                        <br>
                        <button type="button" class="btn btn-danger">削除</button><br>
                        <!-- <button type="submit" name="plan-register" class="btn btn-primary">登録</button> -->
                        <input type="hidden" name="plan-id" value="{{ $editUrl }}">
                    </form>
                </div>
            </div>
            <br><br>
            <div class="card">
                <div class="card-header">詳細スケジュール<span style="color:cornflowerblue; font-weight: bold;">追加</span></div>
                <div class="card-body">
                <form action="{{ route('travel.edit') }}" method="POST">
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
                            <select name="add"  id="selectBox">
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
                            <span id="inputContainer"></span>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection