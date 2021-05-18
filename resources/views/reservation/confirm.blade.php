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
</head>
<body class="reservation">

<!-- <div class="container"> -->
  <div class="justify-content-center">
        
  reservation/createです。<br>
      名前
      {{ $user->name }}
      <br>
      サロン名
      {{ $user->salon_name }}
      <br>
      サロン住所
      {{ $user->salon_address }}
      <br>
      サロン電話番号
      {{ $user->salon_tel }}
      <br>
      <br>
      <div class="progress" style="height: 40px;">
        <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%">日時メニュー選択</div>
        <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%">情報入力</div>
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%">予約確認</div>
        <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%">予約完了</div>
      </div>
      <br>
  </div>
  <div>
    予約日時
    {{ $calendar->year }}年
    {{ $calendar->month }}月
    {{ $calendar->day }}日
    {{ $calendar->time }}
  </div>

  <div>
    選択メニュー
    {{ $menu->menu_name }}
    {{ $menu->minutes }}分
    {{ $menu->charge }}円
    {{ $menu->requirements }}
  </div>

  <div>
    {{ $inputs['name'] }}
    {{ $inputs['gender'] }}
    {{ $inputs['email'] }}
    {{ $inputs['tel'] }}
  </div>
  <form method="POST" action="{{ route('reservation.store') }}">
    @csrf
    <input type="hidden" name="user_id" value="{{ $user->id }}">
    <input type="hidden" name="menu_id" value="{{ $menu->id }}">
    <input type="hidden" name="calendar_id" value="{{ $calendar->id }}">
    <input type="hidden" name="name" value="{{ $inputs['name'] }}">
    <input type="hidden" name="gender" value="{{ $inputs['gender'] }}">
    <input type="hidden" name="email" value="{{ $inputs['email'] }}">
    <input type="hidden" name="tel" value="{{ $inputs['tel'] }}">
    <input type="submit" value="予約を確定する">
  </form>
</body>