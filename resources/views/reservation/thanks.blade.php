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

          <div class="text-success mt-3">
            <h5>予約を受け付けました。</h5>
            <h5>確認メールを送信しました。</h5>
            <h5>※この画面をスクリーンショットなどで保存されることをお勧めします※</h5>
          </div>
          
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
            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%">情報入力</div>
            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%">予約確認</div>
            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%">予約完了</div>
          </div>

          <div class="card shadow-sm bg-white border-0 my-3" style="width: 100%;">
            <div class="card-header border-0">
              予約日時:
              {{ $selectedCalendar->year }}年
              {{ $selectedCalendar->month }}月
              {{ $selectedCalendar->day }}日
              {{ $selectedCalendar->time }}
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

          <div class="card shadow-sm bg-white border-0 my-3" style="width: 100%;">
            <div class="card-body py-3">
              <h5 class="card-title">お客様情報</h5>
              <div class="card-body-detail">
                <p class="card-text m-0">【名前】{{ $reservation->name }}</p>
                <p class="card-text m-0">【性別】
                @if($reservation->gender == 0)
                男
                @elseif($reservation->gender == 1)
                女
                @elseif($reservation->gender == 2)
                その他
                @endif
                </p>
                <p class="card-text m-0">【メール】{{ $reservation->email }}</p>
                <p class="card-text">【電話番号】{{ $reservation->tel }}</p>
              </div>
            </div>
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

</body>
