@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h2 class="h4 fw-bold">新規アカウント作成</h2>
                    <p class="text-muted mt-2">
                        すでにアカウントをお持ちの方は
                        <a href="{{ route('login') }}" class="text-primary">ログイン</a>
                    </p>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('ニックネーム(表示名)') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('メールアドレス') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('パスワード') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('パスワード(確認)') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('アカウントを作成') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Mobile App Promotion -->
            <div class="text-center mt-4">
                <p class="text-muted">モバイルアプリ版もご利用いただけます</p>
                <div class="d-flex justify-content-center flex-wrap mt-3" style="gap: 1rem;">
                    <a href="https://apps.apple.com/jp/app/pretravel-旅行計画作成アプリ/id6478861524" class="d-inline-block">
                        <img src="https://tools.applemediaservices.com/api/badges/download-on-the-app-store/white/ja-jp?size=250x83" 
                             alt="Download on the App Store" 
                             style="height: 2.5rem;">
                    </a>
                    <a href="https://play.google.com/store/apps/details?id=com.pretravel.kawasaki_create.pre_travel_mobile" class="d-inline-block">
                        <img src="https://play.google.com/intl/ja/badges/static/images/badges/ja_badge_web_generic.png" 
                             alt="Google Play で手に入れよう" 
                             style="height: 2.5rem;">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
