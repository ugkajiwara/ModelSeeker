<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    <link href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" rel="stylesheet">

</head>
<body>

  <header>
    <nav class="navbar navbar-expand-md navbar-light bg-white">
      <div class="container">
        
        <div class="navbar-brand">
          {{ config('app.name', 'Laravel') }}
        </div>

      </div>
    </nav>
  </header>

  <div class="reservation">

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          
          <div class="card shadow-sm bg-white border-0 my-3" style="width: 100%;">
            <div class="card-body py-3">
              <h5 class="card-title">{{ $user->salon_name }}</h5>
              <div class="card-body-detail">
                <p class="card-text m-0">【住所】{{ $user->salon_address }}</p>
                <p class="card-text m-0">【電話】{{ $user->salon_tel }}</p>
                <p class="card-text">【担当】{{ $user->name }}</p>
              </div>
            </div>
          </div>

          <div class="progress" style="height: 40px; font-size: 10px;">
            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%">日時メニュー</div>
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%">情報入力</div>
            <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%">予約確認</div>
            <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%">予約完了</div>
          </div>

          <div class="card shadow-sm bg-white border-0 my-3" style="width: 100%;">
            <div class="card-header border-0">
              予約日時:
              {{ $calendar->year }}年
              {{ $calendar->month }}月
              {{ $calendar->day }}日
              {{ $calendar->time }}
            </div>
            <div class="card-body py-3">
              <h5 class="card-title">メニュー:　{{ $menu->menu_name }}</h5>
              <div class="card-body-detail">
                <p class="card-text m-0">所要時間:　{{ $menu->minutes*30 }}分</p>
                <p class="card-text m-0">料金:　{{ $menu->charge }}円</p>
                <p class="card-text">条件:　{{ $menu->requirements }}</p>
              </div>
            </div>
          </div>
          
          <div class="my-5 form">
            <h5>☑︎必要事項を入力してください</h5>

            @if($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>・{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('reservation.confirm') }}" onsubmit="return checkDouble();">
              @csrf
              <div class="form-group row">
                <label for="name" class="col-3 col-form-label">名前<span class="text-danger">※<span></label>
                <div class="col-9">
                  <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name" placeholder="" required>
                </div>
              </div>

              <fieldset class="form-group">
                <div class="row">
                  <legend class="col-form-label col-3 pt-0">性別<span class="text-danger">※<span></legend>
                  <div class="col-9">
                    <div class="form-check form-check-inline">
                      <input type="radio" name="gender" value="0" id="inlineRadio0" class="form-check-input">
                      <label class="form-check-label" for="inlineRadio0">男性</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input type="radio" name="gender" value="1" id="inlineRadio1" class="form-check-input">
                      <label class="form-check-label" for="inlineRadio1">女性</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input type="radio" name="gender" value="2" id="inlineRadio2" class="form-check-input">
                      <label class="form-check-label" for="inlineRadio2">その他</label>
                    </div>
                  </div>
                </div>
              </fieldset>
              
              
              <div class="form-group row">
                <label for="email" class="col-3 col-form-label">メール<span class="text-danger">※<span></label>
                <div class="col-9">
                  <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email" placeholder="" required>
                </div>
              </div>

              <div class="form-group row">
                <label for="tel" class="col-3 col-form-label">電話番号<span class="text-danger">※<span></label>
                <div class="col-9">
                  <input type="tel" name="tel" value="{{ old('tel') }}" class="form-control" id="tel" placeholder="" required>
                </div>
              </div>
              
              <input type="hidden" name="user_id" value="{{ $user->id }}">
              <input type="hidden" name="menu_id" value="{{ $menu->id }}">
              <input type="hidden" name="calendar_id" value="{{ $calendar->id }}">

              @if( isset($menu->requirements) )
                <div class="my-3">
                  <div style="font-size: 12px;">
                    下記モデル募集条件に同意してチェックをしてください
                    <span class="text-danger">※<span>
                  </div>
                  <input type="checkbox" required>　{{ $menu->requirements }}</input>
                </div>
              @endif

              <span class="text-danger">※は必須項目<span>
              <input type="submit" value="確認する" class="btn btn-block btn-success" id="btnSubmit">
            </form>
            
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer>
    <div class="text-center">
    <a href="/setting/terms/" target="_blank" rel="noopener noreferrer">利用規約</a>
    <a href="/setting/privacy_policy/" target="_blank" rel="noopener noreferrer">プライバシーポリシー</a>
    <p>created by Yuji Kajiwara<a href="https://www.instagram.com/ug_ka/" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram text-dark"></i></a></p>
    </div>
  </footer>

<script>
function checkDouble(){
  var obj = document.getElementById("btnSubmit");
  if(obj.disabled){
    return false;
  }else{
    obj.disabled = true;
    return true;
  }
}
</script>

</body>