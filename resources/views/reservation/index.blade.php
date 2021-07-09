<?php
// require_once "vendor/autoload.php";
use Carbon\Carbon;

//URLからuser_idを取得
$userIdFromUrl = isset($_GET['user_id'])? htmlspecialchars($_GET['user_id'], ENT_QUOTES, 'utf-8') : '';

//月の初日取得

$y = isset($_GET['y'])? htmlspecialchars($_GET['y'], ENT_QUOTES, 'utf-8') : '';
$m = isset($_GET['m'])? htmlspecialchars($_GET['m'], ENT_QUOTES, 'utf-8') : '';
$d = isset($_GET['d'])? htmlspecialchars($_GET['d'], ENT_QUOTES, 'utf-8') : '';
if($m!=''||$y!=''){
  $dt = Carbon::createFromDate($y,$m,01);
}else{
  $dt = Carbon::createFromDate();
}
function renderCalendar($dt){
  $dt->startOfMonth();
  $dt->timezone ='Asia/Tokyo';
}
renderCalendar($dt);
  

$daysInMonth = $dt->daysInMonth;

//前月取得
$sub = Carbon::createFromDate($dt->year,$dt->month,$dt->day);
$subMonth = $sub->subMonth();
$subY = $subMonth->year;
$subM = $subMonth->month;

//次月取得
$add = Carbon::createFromDate($dt->year,$dt->month,$dt->day);
$addMonth = $add->addMonth();
$addY = $addMonth->year;
$addM = $addMonth->month;

// 今月取得
$today = Carbon::createFromDate();
$todayY = $today->year;
$todayM = $today->month;

$link = '<a href="/reservation/index?user_id='.$userIdFromUrl.'" class="btn btn-dark">今月</a>';//今月のリンク
$link .='<div class="link border border-dark"><a href="/reservation/index?user_id='.$userIdFromUrl.'&&y='.$subY.'&&m='.$subM.'&&d=1" class="btn btn-outline-dark subM"><i class="fas fa-arrow-left"></i></a>';//前月のリンク
$link .='<span class="yearMonth">'.$dt->format('Y').'年'; //年を表示
$link .=$dt->format('n').'月</span>';//月を表示
$link .= '<a href="/reservation/index?user_id='.$userIdFromUrl.'&&y='.$addY.'&&m='.$addM.'&&d=1" class="btn btn-outline-dark nextM"><i class="fas fa-arrow-right"></i></a></div>';//次月リンク  

// カレンダー本体
$displayCalendar = '<tbody class="text-center"><tr>';
for($i = 1; $i <= $daysInMonth; $i++){
  if($i == 1){
    if($dt->format('N') != 1 ){
    $displayCalendar .= '<td colspan="'.($dt->format('N')-1).'"></td>';
    }
  }
  if($dt->format('N') == 1){  //月曜なら
    $displayCalendar .= '</tr><tr>';  //改行のtr
  }


  $comp = new Carbon($dt->year."-".$dt->month."-".$dt->day); //YY-MM-DDの形でループの中身を毎回持ってくる
  $comp_now = Carbon::today(); //YY-MM-DDの形で今日を持ってくる

  $day = '';
  if (!empty($d)){
    $day = new Carbon($y."-".$m."-".$d); //YY-MM-DDの形でアドレスバーから日付を持ってくる
  }
  elseif(!empty($m) && empty($d)){
    $day = new Carbon($y."-".$m."-01");
  }

//選択されているかの識別
  $selected = ($comp == $day) ? 'selected' : '' ;
  
//$dtと同じ日付にメニューが登録されていたら、緑丸をつける
  // $loginUserId = Auth::user()->id;
  $menuIds = DB::table('calendars')
          ->where('year', $dt->year)
          ->where('month', $dt->month)
          ->where('day', $dt->day)
          ->where('user_id','=',$userIdFromUrl)
          ->where('is_reserved','=',0)
          ->value('menu_id');
  $issetOrEmpty = (!empty($menuIds)) ? 'bg-success' : '' ;

  if ($comp < ($comp_now)){ //過ぎた日グレー
    $displayCalendar .= '<td class="calendar-date py-0 passed"><div class="day">'.
    $dt->day.
    '</div><div class="menus "></div></td>';

    $dt->addDay();
  }elseif ($comp->eq($comp_now)){ //それらが同じなら下を実行違うならelseで通常を回す
    $displayCalendar .= '<td class="calendar-date py-0 border font-weight-bold '.
    $selected.
    '"><a href="/reservation/index?user_id='.$userIdFromUrl.'&&y='.$dt->year.'&&m='.$dt->month.'&&d='.$dt->day.'" class="calendar-date><div class="day">'.
    $dt->day.
    '</div><div class="menus rounded-circle '.$issetOrEmpty.'"></div></a></td>';

    $dt->addDay();
  }else{
    $displayCalendar .= '<td class="calendar-date p-0 '.
    $selected.
    '"><a href="/reservation/index?user_id='.$userIdFromUrl.'&&y='.$dt->year.'&&m='.$dt->month.'&&d='.$dt->day.'" class="calendar-date><div class="day">'.
    $dt->day.
    '</div><div class="menus rounded-circle '.$issetOrEmpty.'"></div></a></td>';

    $dt->addDay();
  }
}
$displayCalendar .= '</tr></tbody>';


$displayMenus='';
foreach($calendars as $calendar){
  $menuIds = explode(",", $calendar->menu_id);
  
  foreach($menuIds as $menuId){
    $menuName = DB::table('menus')->where('id','=',$menuId)->value('menu_name');
    $menuCharge = DB::table('menus')->where('id','=',$menuId)->value('charge');
    $menuMinutes = DB::table('menus')->where('id','=',$menuId)->value('minutes')*30;
    $menuRequirements = DB::table('menus')->where('id','=',$menuId)->value('requirements');
    
    $displayMenus .='<tr><td class="px-0"><a href="/reservation/create?user_id='.$userIdFromUrl.'&&calendar_id='.$calendar->id.'&&menu_id='.$menuId.'" class="btn btn-outline-success btn-sm">選択</a></td>';
    $displayMenus .='<td class="px-1">'.$calendar->time.'</td>';
    $displayMenus .='<td class="px-1">'.$menuName.'</td>';
    $displayMenus .='<td class="px-1">'.$menuCharge.'円</td>';
    $displayMenus .='<td class="px-1">'.$menuMinutes.'分</td>';
    $displayMenus .='<td class="px-1">'.$menuRequirements.'</td></tr>';
  }
}
?>




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
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%">日時メニュー</div>
            <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%">情報入力</div>
            <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%">予約確認</div>
            <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%">予約完了</div>
          </div>
          <br>
          <p>①日付を選択してください</p>

          {!! $link !!}
          <table class="table m-0 calendar shadow">
            <thead class="text-center">
              <tr class="border-top-0">
                <th scope="col" class="border-top-0">月</th>
                <th scope="col" class="border-top-0">火</th>
                <th scope="col" class="border-top-0">水</th>
                <th scope="col" class="border-top-0">木</th>
                <th scope="col" class="border-top-0">金</th>
                <th scope="col" class="text-primary border-top-0">土</th>
                <th scope="col" class="text-danger border-top-0">日</th>
              </tr>
            </thead>
            <tbody>
              {!! $displayCalendar !!}
            </tbody>
          </table>

          @if(!empty($d))
            <div>
              <br>②メニューを選択してください
            </div>
            <div>
              <?php echo $y."年".$m."月".$d."日"; ?>
            </div>

            <table class="table menuselection">
              <thead>
                <th class="p-0"></th>
                <th class="p-1">予約時間</th>
                <th class="p-1">メニュー</th>
                <th class="p-1">料金</th>
                <th class="p-1">施術時間</th>
                <th class="p-1">条件</th>
              </thead>
              <tbody>
                {!! $displayMenus !!}
              </tbody>
            </table>
          @endif
        </div>
      </div>
    </div>
  </div>

  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</body>
</html>