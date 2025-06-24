@extends('layouts.app')

@section('content')
@vite(['resources/js/app.js'])
@vite(['resources/js/accountDelete.js'])
@vite(['resources/js/belongingsHome.js'])

<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <!-- Mobile Navigation -->
    <div class="lg:hidden">
        <div x-data="{ open: false }" class="bg-white dark:bg-gray-800 shadow">
            <div class="px-4 py-2">
                <button @click="open = !open" class="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
            <div x-show="open" @click.away="open = false" class="px-2 pt-2 pb-3 space-y-1">
                <a href="/schedule/all_plan/" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">全ての旅行</a>
                <a href="/home/all_tweet" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">全てのつぶやきを表示</a>
                <a href="/home/change_mail" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">メールアドレス変更</a>
                <a href="/home/contact" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">お問い合わせ/質問・要望</a>
                <a href="/home/account_delete" class="block px-3 py-2 rounded-md text-base font-medium text-red-600 hover:text-red-700 hover:bg-red-50" id="accountDelete">アカウント削除</a>
            </div>
        </div>
    </div>

    <!-- Alerts -->
    @if (session('success'))
        <div class="alert alert-success mx-4 mt-4">
            {{ session('success') }}
        </div>
    @endif
    @if (session('warning'))
        <div class="alert alert-warning mx-4 mt-4">
            {{ session('warning') }}
        </div>
    @endif
    @if (session('danger'))
        <div class="alert alert-danger mx-4 mt-4">
            {{ session('danger') }}
        </div>
    @endif

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="lg:grid lg:grid-cols-4 lg:gap-8">
            <!-- Sidebar Navigation -->
            <div class="hidden lg:block">
                <nav class="space-y-1 bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                    <a href="/schedule/all_plan/" class="nav-link block">全ての旅行</a>
                    <a href="/home/all_tweet" class="nav-link block">全てのつぶやきを表示</a>
                    <a href="/home/change_mail" class="nav-link block">メールアドレス変更</a>
                    <a href="/home/contact" class="nav-link block">お問い合わせ/質問・要望</a>
                    <a href="/home/account_delete" class="nav-link block text-red-600 hover:text-red-700" id="accountDeleteSideBar">アカウント削除</a>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3 space-y-6">
                <!-- Welcome Card -->
                <div class="card">
                    <div class="card-header">ダッシュボード</div>
                    <div class="card-body">
                        <p class="text-lg text-gray-700 dark:text-gray-300 mb-4">
                            ようこそ、{{Auth::user()->name}}さん！
                        </p>
                        @if(Auth::check())
                            @php
                                $user = Auth::user();
                                $userTravelPlansCount = $user->travelPlan()->count();
                            @endphp
                            <a href="/schedule" class="btn btn-primary">
                                スケジュール作成
                            </a>
                        @endif
                    </div>
                </div>

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
                    <!-- Tweet Card -->
                    <div class="card">
                        <div class="card-header flex items-center">
                            つぶやき
                            <span class="ml-2 text-xs text-red-500">※旅行中のみ表示</span>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('button.click') }}" method="POST">
                                @csrf
                                <input type="hidden" name="travel_plan_id" value="{{ $currentTravelPlanId }}" id="selectedTravelPlanId">
                                <div class="space-y-4">
                                    <div>
                                        <textarea id="myTextarea" name="tweet" placeholder="つぶやき" minlength="1" maxlength="140"
                                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary-500 focus:border-primary-500"></textarea>
                                        <div id="charCount" class="text-sm text-gray-500 mt-1"></div>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <button type="submit" class="btn btn-primary" id="tweetButton" onclick="return checkTweetCount({{ auth()->user()->canTweetUnlimited() ? 1 : 0 }});">
                                            投稿
                                        </button>
                                        @if($tripCnt >= 2)
                                            <select name="duplicatedTravel" id="duplicatedTravel" onchange="updateTweetCount()"
                                                    class="form-select px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                                                @for($i = 0; $i < $tripCnt; $i++)
                                                    <option value="{{ $duplicatedIdList[$i] }}" data-tweet-count="{{ $travelPlans->find($duplicatedIdList[$i])->tweet()->count() }}">
                                                        {{ $duplicatedTitleList[$i] }}
                                                    </option>
                                                @endfor
                                            </select>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <script>
                        function updateTweetCount() {
                            var selectedOption = document.getElementById("duplicatedTravel").selectedOptions[0];
                            var tweetCount = selectedOption.getAttribute("data-tweet-count");
                            document.getElementById("selectedTravelPlanId").value = selectedOption.value;
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
                                        alert('つぶやきの上限に達しました。\n\n無料会員は10個までのつぶやきを投稿できます。\n有料会員登録で無制限にご利用いただけます。');
                                    }
                                }
                                return false;
                            }
                            return true;
                        }
                    </script>

                    <!-- Trip Summary Card -->
                    <div class="card">
                        <div class="card-header flex items-center">
                            旅行概要
                            <span class="ml-2 text-xs text-red-500">※旅行中のみ表示</span>
                        </div>
                        <div class="card-body space-y-6">
                            @foreach ($travelPlans as $travelPlan)
                                @if($travelPlan->trip_start <= date('Y-m-d H:i:s') && date('Y-m-d H:i:s', strtotime('-1 day')) <= $travelPlan->trip_end)
                                    <div class="border-b border-gray-200 pb-4 last:border-0">
                                        @php
                                            $time = substr($travelPlan->departure_time, 11, 8);
                                            $ftime = substr($time, 0, 5);
                                        @endphp
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ $travelPlan->trip_title }}</h3>
                                        <div class="space-y-1 text-sm text-gray-600 dark:text-gray-400">
                                            <p>期間： {{ $travelPlan->trip_start }} 〜 {{ $travelPlan->trip_end }}</p>
                                            @if($time != '00:00:00')
                                                <p>出発時刻： {{ $travelPlan->trip_start . ' ' . $ftime }}</p>
                                            @endif
                                            @if($travelPlan->meet_place)
                                                <p>集合場所： {{ $travelPlan->meet_place }}</p>
                                            @endif
                                            @if($travelPlan->budget)
                                                <p>予算： {{ number_format($travelPlan->budget) }}円</p>
                                            @endif
                                        </div>
                                        <div class="mt-4 flex space-x-3">
                                            <a href="{{ route('schedule.edit', ['id' => $travelPlan->id]) }}" class="btn btn-outline-primary">
                                                旅行編集
                                            </a>
                                            <a href="{{ route('schedule.detail', ['id' => $travelPlan->id]) }}" class="btn btn-outline-success">
                                                旅行詳細設定
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

                @php
                    $displayCard = false;
                @endphp
                @foreach ($travelPlans as $travelPlan)
                    @foreach ($tweets as $tweet)
                        @if($travelPlan->trip_start <= date('Y-m-d H:i:s') && date('Y-m-d H:i:s', strtotime('-1 day')) <= $travelPlan->trip_end && $travelPlan->id == $tweet->travel_plan_id)
                            @php
                                $displayCard = true;
                            @endphp
                        @endif
                    @endforeach
                @endforeach

                @if($displayCard)
                    <!-- Tweets Display Card -->
                    <div class="card">
                        <form action="{{ route('tweets.delete') }}" method="POST">
                            @csrf
                            <div class="card-header flex items-center justify-between">
                                <div class="flex items-center">
                                    つぶやき表示
                                    <span class="ml-2 text-xs text-red-500">※旅行中限定</span>
                                </div>
                            </div>
                            <div class="card-body space-y-4">
                                @foreach ($travelPlans as $travelPlan)
                                    @foreach ($tweets as $tweet)
                                        @if($travelPlan->trip_start <= date('Y-m-d H:i:s') && date('Y-m-d H:i:s', strtotime('-1 day')) <= $travelPlan->trip_end && $travelPlan->id == $tweet->travel_plan_id)
                                            <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
                                                <div class="flex items-start">
                                                    <input type="checkbox" name="tweets[]" value="{{ $tweet->id }}" class="mt-1 mr-3">
                                                    <div class="flex-1">
                                                        <p class="text-gray-800 dark:text-gray-200 whitespace-pre-wrap">{!! nl2br(e($tweet->tweet)) !!}
                                                            @if($tweet->editFlg == 1)
                                                                <span class="text-xs text-gray-500">(編集済み)</span>
                                                            @endif
                                                        </p>
                                                        <div class="mt-2 flex items-center justify-between">
                                                            <span class="text-xs text-gray-500">{{ $tweet->updated_at }}</span>
                                                            <button type="button" class="editButton text-sm text-primary-600 hover:text-primary-700" data-tweet-id="{{ $tweet->id }}">
                                                                編集
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endforeach
                                <button type="submit" class="btn btn-warning" id="tweetDeleteButton">
                                    選択したつぶやきを削除
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="easyModal" class="modal fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900">つぶやき編集🐦</h3>
                <button class="modalClose text-gray-400 hover:text-gray-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="mt-2">
                <textarea id="myTweetEdit" name="tweet" placeholder="つぶやき" minlength="1" maxlength="140"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary-500 focus:border-primary-500"></textarea>
                <div class="mt-2 flex justify-between items-center">
                    <span id="modalCharCount" class="text-sm text-gray-500"></span>
                    <button class="btn btn-primary editSaveBtn">保存</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Character counter
    const textarea = document.getElementById('myTextarea');
    const charCount = document.getElementById('charCount');
    
    if (textarea) {
        textarea.addEventListener('input', function() {
            const remaining = 140 - this.value.length;
            charCount.textContent = `残り${remaining}文字`;
            charCount.className = remaining < 20 ? 'text-sm text-red-500 mt-1' : 'text-sm text-gray-500 mt-1';
        });
    }
    
    // Modal character counter
    const modalTextarea = document.getElementById('myTweetEdit');
    const modalCharCount = document.getElementById('modalCharCount');
    
    if (modalTextarea) {
        modalTextarea.addEventListener('input', function() {
            const remaining = 140 - this.value.length;
            modalCharCount.textContent = `残り${remaining}文字`;
            modalCharCount.className = remaining < 20 ? 'text-sm text-red-500' : 'text-sm text-gray-500';
        });
    }
    
    // Edit modal functionality
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.editButton');
        const modal = document.getElementById('easyModal');
        const modalTextarea = document.getElementById('myTweetEdit');
        const modalCharCount = document.getElementById('modalCharCount');
        const closeButtons = document.querySelectorAll('.modalClose');
        const saveButton = document.querySelector('.editSaveBtn');
        let currentTweetId = null;
        
        // Edit button click handlers
        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                currentTweetId = this.getAttribute('data-tweet-id');
                
                // Find the tweet content for this ID
                const tweetElement = this.closest('.bg-gray-50').querySelector('p');
                const tweetText = tweetElement.textContent.replace('(編集済み)', '').trim();
                
                // Set modal content
                modalTextarea.value = tweetText;
                
                // Update character count
                const remaining = 140 - tweetText.length;
                modalCharCount.textContent = `残り${remaining}文字`;
                modalCharCount.className = remaining < 20 ? 'text-sm text-red-500' : 'text-sm text-gray-500';
                
                // Show modal
                modal.classList.remove('hidden');
                modal.style.display = 'block';
                modalTextarea.focus();
            });
        });
        
        // Close modal handlers
        closeButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                modal.classList.add('hidden');
                modal.style.display = 'none';
                currentTweetId = null;
            });
        });
        
        // Click outside modal to close
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.add('hidden');
                modal.style.display = 'none';
                currentTweetId = null;
            }
        });
        
        // Save button handler
        if (saveButton) {
            saveButton.addEventListener('click', function() {
                if (!currentTweetId || !modalTextarea.value.trim()) {
                    alert('つぶやき内容を入力してください');
                    return;
                }
                
                // Send update request
                const formData = new FormData();
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                formData.append('tweet_id', currentTweetId);
                formData.append('tweet_content', modalTextarea.value.trim());
                
                fetch('/tweet/update', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Close modal and reload page
                        modal.classList.add('hidden');
                        modal.style.display = 'none';
                        location.reload();
                    } else {
                        alert('更新に失敗しました: ' + (data.message || 'エラーが発生しました'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('通信エラーが発生しました');
                });
            });
        }
    });
</script>

<!-- プレミアムモーダルを含める -->
@include('components.premium-modal')

@endsection