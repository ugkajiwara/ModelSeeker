@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">新規登録/必要事項を記入してください</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" onSubmit="return checkDouble();">
                        @csrf

                        <!-- 名前 -->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">名前</label>

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
                        <div class="form-group row mb-0">
                            <label for="email" class="col-md-4 col-form-label text-md-right">性別</label>
                            <div class="col-md-6">
                                <input id="gender" class="" type="radio" name="gender" value="0">男性</input>
                                <input id="gender" class="" type="radio" name="gender" value="1">女性</input>
                                <input id="gender" class="" type="radio" name="gender" value="2">その他</input><br>
                                @error('gender')
                                    <span class="text-danger" role="alert" style="font-size:11px;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- メアド -->
                        <div class="form-group row mt-2">
                            <label for="email" class="col-md-4 col-form-label text-md-right">メールアドレス</label>

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
                            <label for="password" class="col-md-4 col-form-label text-md-right">パスワード</label>

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
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">パスワード確認</label>

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

                        <!-- 利用規約＆プライバシーポリシー同意 -->
                        <div class="my-3 text-center">
                            <input type="checkbox" required>
                            <a href="/setting/terms/" target="_blank" rel="noopener noreferrer">利用規約</a> と
                            <a href="/setting/privacy_policy/" target="_blank" rel="noopener noreferrer">プラーバシーポリシー</a>
                            に同意します。
                            </input>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-block" id="btnSubmit">
                                    登録
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
  var set=0;
  function double() {
  if(set==0){ set=1; } else {
  alert("只今処理中です。\nそのままお待ちください。");
  return false; }}
  </script>
@endsection
