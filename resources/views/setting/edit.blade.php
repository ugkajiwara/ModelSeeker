@extends('layouts.app')

@section('content')
<div class="container pb-3">
    <div class="row justify-content-center">
        <div class="col-md-8">


   



            <div class="card-body">
                <form method="POST" action="{{ route('setting.update') }}">
                    @csrf

                    <!-- 名前 -->
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">名前</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$user->name) }}" required autocomplete="name" autofocus>

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
                            <input id="gender" class="" type="radio" name="gender" value="0" @if( $user->gender == 0 ) checked @endif >男性</input>
                            <input id="gender" class="" type="radio" name="gender" value="1" @if( $user->gender == 1 ) checked @endif >女性</input>
                            <input id="gender" class="" type="radio" name="gender" value="2" @if( $user->gender == 2 ) checked @endif >その他</input><br>
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
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email',$user->email) }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>



                    <!-- サロン名 -->
                    <div class="form-group row">
                        <label for="salon_name" class="col-md-4 col-form-label text-md-right">所属サロン名</label>

                        <div class="col-md-6">
                            <input id="salon_name" type="salon_name" class="form-control @error('salon_name') is-invalid @enderror" name="salon_name" value="{{ old('salon_name',$user->salon_name) }}" required autocomplete="salon_name">

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
                            <input id="salon_address" type="salon_address" class="form-control @error('salon_address') is-invalid @enderror" name="salon_address" value="{{ old('salon_address',$user->salon_address) }}" required autocomplete="salon_address">

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
                            <input id="salon_tel" type="salon_tel" class="form-control @error('salon_tel') is-invalid @enderror" name="salon_tel" value="{{ old('salon_tel',$user->salon_tel) }}" required autocomplete="salon_tel">

                            @error('salon_tel')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>



                        <div class="form-group row mb-5">
                            <div class="col-md-6 offset-md-4">

                                <button type="submit" class="btn btn-primary">
                                    変更する
                                </button>

                                <a href="{{ route('setting.index') }}">
                                    <button type="button" class="btn btn-outline-dark">
                                        戻る
                                    </button>
                                </a>
                                
                            </div>
                        </div>
                    </form>
                </div>


        </div>
    </div>
</div>

<footer class="fixed-bottom bg-white shadow footer-bar">
    <div class="row text-center">
        <div class="col mt-2">
            <a href="/calendar/index/" class="text-secondary">
                <i class="far fa-calendar-alt"></i>
                <p>カレンダー</p>
            </a>
        </div>

        <div class="col mt-2">
            <a href="/menu/index/" class="text-secondary">
                <i class="fas fa-cut"></i>
                <p>メニュー</p>
            </a>
        </div>

        <div class="col mt-2">
            <a href="/notification/index/" class="text-secondary">
                <i class="far fa-bell"></i>
                <p>通知</p>
            </a>
        </div>

        <div class="col mt-2">
            <a href="/setting/index/" class="text-success">
                <i class="fas fa-cog"></i>
                <p>設定</p>
            </a>
        </div>
    </div>
</footer>

@endsection




