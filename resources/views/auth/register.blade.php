@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- 名前 -->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- 性別 -->
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">性別</label>
                            <div class="col-md-6">
                                <input id="gender" type="radio" name="gender" value="0">男性</input>
                                <input id="gender" type="radio" name="gender" value="1">女性</input>
                                <input id="gender" type="radio" name="gender" value="2">その他</input>

                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- メアド -->
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- パスワード -->
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- パスワード確認 -->
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <!-- サロン名 -->
                        <div class="form-group row">
                            <label for="salon_name" class="col-md-4 col-form-label text-md-right">所属サロン名</label>

                            <div class="col-md-6">
                                <input id="salon_name" type="salon_name" class="form-control @error('salon_name') is-invalid @enderror" name="salon_name" value="{{ old('salon_name') }}" required autocomplete="salon_name">

                                @error('salon_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- サロン住所 -->
                        <div class="form-group row">
                            <label for="salon_address" class="col-md-4 col-form-label text-md-right">所属サロン住所</label>

                            <div class="col-md-6">
                                <input id="salon_address" type="salon_address" class="form-control @error('salon_address') is-invalid @enderror" name="salon_address" value="{{ old('salon_address') }}" required autocomplete="salon_address">

                                @error('salon_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- サロン電話番号 -->
                        <div class="form-group row">
                            <label for="salon_tel" class="col-md-4 col-form-label text-md-right">所属サロン電話番号</label>

                            <div class="col-md-6">
                                <input id="salon_tel" type="salon_tel" class="form-control @error('salon_tel') is-invalid @enderror" name="salon_tel" value="{{ old('salon_tel') }}" required autocomplete="salon_tel">

                                @error('salon_tel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
