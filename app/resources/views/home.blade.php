@extends('layouts.app')

@section('content')
@vite(['resources/js/app.js'])
@vite(['resources/js/accountDelete.js'])
@vite(['resources/js/belongingsHome.js'])
@vite(['resources/css/homeNav.css'])
<!-- ナビゲーションバー -->
<nav class="navbar navbar-light bg-light hamnav">
    <!-- ハンバーガーメニュー -->
    <button class="navbar-toggler topm" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <!-- ナビゲーションメニュー -->
    <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
        <li class="nav-item active">
        <a class="nav-link" href="/schedule/all_plan/">全ての旅行</a>
        <li class="nav-item">
        <a class="nav-link" href="/home/all_tweet">全てのつぶやきを表示</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="/home/change_mail">メールアドレス変更</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="/home/contact">お問い合わせ/質問・要望</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="/home/account_delete" type="button" id="accountDelete">アカウント削除</a>
        </li>
    </ul>
    </div>
</nav>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
@endif
@if (session('danger'))
    <div class="alert alert-danger">
        {{ session('danger') }}
    </div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <ul class="navbar-nav">
                <li class="nav-item active">
                <a class="nav-link" href="/schedule/all_plan/">全ての旅行</a>
                <li class="nav-item">
                <a class="nav-link" href="/home/all_tweet">全てのつぶやきを表示</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/home/change_mail">メールアドレス変更</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/home/contact">お問い合わせ/質問・要望</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/home/account_delete" type="button" id="accountDeleteSideBar">アカウント削除</a>
                </li>
            </ul>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>ようこそ、{{Auth::user()->name;}}さん！</p>
                    <!-- <input type="button" class="btn btn-secondary" onclick="location.href='/schedule'" value="スケジュール作成"> -->
                    @if(Auth::check())
                        @php
                            $user = Auth::user();
                            $userTravelPlansCount = $user->travelPlan()->count();
                        @endphp
                        <a href="/schedule" class="btn btn-secondary">スケジュール作成</a>
                    @endif
                </div>
            </div>
            <br><br>
            @php
                $displayCard = false;
                $currentTravelPlanId = null;
                $tweetCount = 0;
            @endphp
            @foreach ($travelPlans as $travelPlan)
                @if($travelPlan->trip_start <= date('Y-m-d H:i:s', strtotime('+1 day')) && date('Y-m-d H:i:s', strtotime('-1 day')) <= $travelPlan->trip_end)
                    @php
                        $displayCard = true;
                        $currentTravelPlanId = $travelPlan->id;
                        $tweetCount = $travelPlan->tweet()->count();
                    @endphp
                    @break
                @endif
            @endforeach
            @if($displayCard)
            <div class="card">
                <div class="card-header">つぶやき <span style="color:red; font-size:10px;">※旅行中のみ表示</span></div>
                <div class="card-body">
                    <form action="{{ route('button.click') }}" method="POST">
                        @csrf
                        <input type="hidden" name="travel_plan_id" value="{{ $currentTravelPlanId }}" id="selectedTravelPlanId">
                        <textarea id="myTextarea" name="tweet" placeholder="つぶやき" minlength="1" maxlength="140"></textarea><br>
                        <div id="charCount"></div>
                        <button type="submit" class="btn btn-primary" id="tweetButton" onclick="return checkTweetCount({{ auth()->user()->canTweetUnlimited() ? 1 : 0 }});">投稿</button>　
                        <select name="duplicatedTravel" id="duplicatedTravel" {{ $tripCnt >= 2 ? '' : 'hidden' }} onchange="updateTweetCount()">
                        @for($i = 0; $i < $tripCnt; $i++)
                            <option value="{{ $duplicatedIdList[$i] }}" data-tweet-count="{{ $travelPlans->find($duplicatedIdList[$i])->tweet()->count() }}">{{ $duplicatedTitleList[$i] }}</option>
                        @endfor
                        </select>
                    </form>
                </div>
            </div>
            <script>
                // console.log("vipFlg: {{ auth()->user()->vip_flg }}");
                // console.log("tweetCount: {{ $tweetCount }}");

                function updateTweetCount() {
                    var selectedOption = document.getElementById("duplicatedTravel").selectedOptions[0];
                    var tweetCount = selectedOption.getAttribute("data-tweet-count");
                    document.getElementById("selectedTravelPlanId").value = selectedOption.value;
                    // console.log("Updated tweetCount: " + tweetCount);
                    return tweetCount;
                }
    
                function checkTweetCount(isPremium) {
                    var tweetCount = updateTweetCount();
                    if (isPremium == 0 && tweetCount >= 10) {
                        // プレミアムモーダルを表示
                        var premiumModalElement = document.getElementById('premiumModal');
                        if (premiumModalElement) {
                            if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                                var premiumModal = new bootstrap.Modal(premiumModalElement);
                                premiumModal.show();
                            } else {
                                alert('つぶやきの上限に達しました。\\n\\n無料会員は10個までのつぶやきを投稿できます。\\n有料会員登録で無制限にご利用いただけます。');
                            }
                        }
                        return false;
                    }
                    return true;
                }
            </script>
            
            <script>
                // Character counter for main textarea
                document.addEventListener('DOMContentLoaded', function() {
                    const textarea = document.getElementById('myTextarea');
                    const charCount = document.getElementById('charCount');
                    
                    if (textarea && charCount) {
                        textarea.addEventListener('input', function() {
                            const remaining = 140 - this.value.length;
                            charCount.textContent = `残り${remaining}文字`;
                            charCount.style.color = remaining < 20 ? 'red' : 'gray';
                        });
                    }
                    
                    // Edit button functionality
                    const editButtons = document.querySelectorAll('.editButton');
                    editButtons.forEach(function(button) {
                        button.addEventListener('click', function() {
                            const tweetId = this.getAttribute('data-tweet-id');
                            const tweetElement = this.previousElementSibling.previousElementSibling;
                            const tweetText = tweetElement.textContent.replace('(編集済み)', '').trim();
                            
                            // Find the modal and textarea
                            const modal = document.getElementById('easyModal');
                            const modalTextarea = document.getElementById('myTweetEdit');
                            const modalCharCount = document.getElementById('modalCharCount');
                            
                            if (modal && modalTextarea) {
                                modalTextarea.value = tweetText;
                                const remaining = 140 - tweetText.length;
                                modalCharCount.textContent = `残り${remaining}文字`;
                                modalCharCount.style.color = remaining < 20 ? 'red' : 'gray';
                                
                                modal.style.display = 'block';
                                modal.setAttribute('data-tweet-id', tweetId);
                            }
                        });
                    });
                    
                    // Modal close functionality
                    const modalCloses = document.querySelectorAll('.modalClose');
                    modalCloses.forEach(function(closeBtn) {
                        closeBtn.addEventListener('click', function() {
                            const modal = document.getElementById('easyModal');
                            if (modal) {
                                modal.style.display = 'none';
                            }
                        });
                    });
                    
                    // Save functionality
                    const saveButtons = document.querySelectorAll('.editSaveBtn');
                    saveButtons.forEach(function(saveBtn) {
                        saveBtn.addEventListener('click', function(e) {
                            e.preventDefault();
                            const modal = document.getElementById('easyModal');
                            const modalTextarea = document.getElementById('myTweetEdit');
                            const tweetId = modal.getAttribute('data-tweet-id');
                            
                            if (tweetId && modalTextarea.value.trim()) {
                                // Send update request
                                const formData = new FormData();
                                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                                formData.append('tweet_id', tweetId);
                                formData.append('tweet_content', modalTextarea.value.trim());
                                
                                fetch('/tweet/update', {
                                    method: 'POST',
                                    body: formData
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        modal.style.display = 'none';
                                        location.reload();
                                    } else {
                                        alert('更新に失敗しました');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    alert('通信エラーが発生しました');
                                });
                            }
                        });
                    });
                    
                    // Modal textarea character counter
                    const modalTextarea = document.getElementById('myTweetEdit');
                    const modalCharCount = document.getElementById('modalCharCount');
                    if (modalTextarea && modalCharCount) {
                        modalTextarea.addEventListener('input', function() {
                            const remaining = 140 - this.value.length;
                            modalCharCount.textContent = `残り${remaining}文字`;
                            modalCharCount.style.color = remaining < 20 ? 'red' : 'gray';
                        });
                    }
                });
            </script>
                <br><br>
                <div class="card">
                    <div class="card-header">旅行概要 <span style="color:red; font-size:10px;">※旅行中のみ表示</span></div>
                    <div class="card-body">
                        @foreach ($travelPlans as $travelPlan)
                            @if($travelPlan->trip_start <= date('Y-m-d H:i:s') && date('Y-m-d H:i:s', strtotime('-1 day')) <= $travelPlan->trip_end)
                                @if($loop->iteration > 1)
                                    <span name="clickInline" style="display: {{ $tripCnt >= 2 ? '' : 'none' }};"><br></span>
                                @endif
                                @php
                                    $time = substr($travelPlan->departure_time, 11, 8);
                                    $ftime = substr($time, 0, 5);
                                @endphp
                                <p>旅行名： {{ $travelPlan->trip_title }}</p>
                                <p>期間： {{ $travelPlan->trip_start }} 〜 {{ $travelPlan->trip_end }}</p>
                                @if($time != '00:00:00')
                                <p>出発時刻： {{ $travelPlan->trip_start . ' ' . $ftime }}</p>
                                @endif
                                @if($travelPlan->meet_place)
                                    <p>集合場所： {{ $travelPlan->meet_place }}</p>
                                @endif
                                @if($travelPlan->budget)
                                    <p>予算： {{ $travelPlan->budget }}円</p>
                                @endif
                                <div>
                                    <input type="hidden" value="{{ $travelPlan->id }}">
                                    <a href="{{ route('schedule.edit', ['id' => $travelPlan->id]) }}" class="btn btn-outline-primary">旅行編集</a>　
                                    <input type="hidden" value="{{ $travelPlan->id }}">
                                    <a href="{{ route('schedule.detail', ['id' => $travelPlan->id]) }}" class="btn btn-outline-success">旅行詳細設定</a>
                                </div>
                                @if($loop->iteration >= 7)
                                <br><br>
                                    <!-- <span name="clickInline" style="display: {{ $tripCnt >= 2 ? '' : 'none' }};"><br></span> -->
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
            <br><br>
            @php
                $displayCard = false;
            @endphp
            @foreach ($travelPlans as $travelPlan)
                @foreach ($tweets as $tweet)
                    @php
                        $nextDay = date('Y-m-d H:i:s', strtotime($travelPlan->trip_end . ' +1 day'));
                    @endphp
                    @if($travelPlan->trip_start <= date('Y-m-d H:i:s') && date('Y-m-d H:i:s', strtotime('-1 day')) <= $travelPlan->trip_end && $travelPlan->id == $tweet->travel_plan_id)
                        @php
                            $displayCard = true;
                        @endphp
                    @endif
                @endforeach
            @endforeach
            @if($displayCard)
                <div class="card">
                    <form action="{{ route('tweets.delete') }}" method="POST">
                        @csrf
                        <div class="card-header">つぶやき表示 <span style="color:red; font-size:10px;">※旅行中限定</span></div>
                        <div class="card-body">
                        @foreach ($travelPlans as $travelPlan)
                            @foreach ($tweets as $tweet)
                                @php
                                    $displayCard = false;
                                    $nextDay = date('Y-m-d H:i:s', strtotime($travelPlan->trip_end . ' +1 day'));
                                @endphp
                                @if($travelPlan->trip_start <= date('Y-m-d H:i:s') && date('Y-m-d H:i:s', strtotime('-1 day')) <= $travelPlan->trip_end && $travelPlan->id == $tweet->travel_plan_id)
                                    @php
                                        $displayCard = true;
                                    @endphp
                                    <input type="checkbox" name="tweets[]" value="{{ $tweet->id }}">
                                    <span name="{{ $tweet->id }}">{!! nl2br(e($tweet->tweet)) !!}
                                        @if($tweet->editFlg == 1)
                                            <span name="edited" style="color:gray; font-size: 10px;">(編集済み)</span>
                                        @endif
                                    </span><br>
                                    <span style="font-size :10px; color: gray;">{{ $tweet->updated_at }}</span>
                                    <button type="button" class="editButton" id="modalOpen" data-tweet-id="{{ $tweet->id }}">編集</button>
                                    <div id="easyModal" class="modal">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1>つぶやき編集🐦</h1>
                                                <span class="modalClose">×</span>
                                            </div>
                                            <div class="modal-body">
                                                <textarea id="myTweetEdit" name="tweet" placeholder="つぶやき" minlength="1" maxlength="140"></textarea><br>
                                                <span id="modalCharCount"></span>　
                                                <a href="#" class="btn editSaveBtn">保存</a>
                                            </div>
                                        </div>
                                    </div>
                                    <br><br>
                                @endif
                            @endforeach
                        @endforeach
                            <button type="submit" class="btn btn-warning" id="tweetDeleteButton">削除</button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- @include('components.premium-modal') --}}
@endsection
