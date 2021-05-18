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

$link = '<caption><a href="/reservation/index?user_id='.$userIdFromUrl.'" class="btn btn-primary">今月</a> ';//今月のリンク
$link .= '<a href="/reservation/index?user_id='.$userIdFromUrl.'&&y='.$subY.'&&m='.$subM.'&&d=1" class="btn btn-primary"><<</a>';//前月のリンク
$link .='<span>'.$dt->format('Y').'年</span>'; //年を表示
$link .='<span>'.$dt->format('n').'月</span>';//月を表示
$link .= '<a href="/reservation/index?user_id='.$userIdFromUrl.'&&y='.$addY.'&&m='.$addM.'&&d=1" class="btn btn-primary">>></a></caption>';//次月リンク  

// カレンダー本体
$calendar = '<tbody class="text-center"><tr>';
for($i = 1; $i <= $daysInMonth; $i++){
  if($i == 1){
    if($dt->format('N') != 1 ){
    $calendar .= '<td colspan="'.($dt->format('N')-1).'"></td>';
    }
  }
  if($dt->format('N') == 1){  //月曜なら
    $calendar .= '</tr><tr>';  //改行のtr
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
    $calendar .= '<td class="calendar-date py-0 passed '.
    $selected.
    '"><a href="/reservation/index?user_id='.$userIdFromUrl.'&&y='.$dt->year.'&&m='.$dt->month.'&&d='.$dt->day.'" class="calendar-date><div class="day">'.
    $dt->day.
    '</div><div class="menus rounded-circle '.$issetOrEmpty.'"></div></a></td>';
  
    $dt->addDay();
  }elseif ($comp->eq($comp_now)){ //それらが同じなら下を実行違うならelseで通常を回す
  $calendar .= '<td class="calendar-date py-0 border border-secondary '.
  $selected.
  '"><a href="/reservation/index?user_id='.$userIdFromUrl.'&&y='.$dt->year.'&&m='.$dt->month.'&&d='.$dt->day.'" class="calendar-date><div class="day">'.
  $dt->day.
  '</div><div class="menus rounded-circle '.$issetOrEmpty.'"></div></a></td>';

  $dt->addDay();
  }else{
  $calendar .= '<td class="calendar-date p-0 '.
  $selected.
  '"><a href="/reservation/index?user_id='.$userIdFromUrl.'&&y='.$dt->year.'&&m='.$dt->month.'&&d='.$dt->day.'" class="calendar-date><div class="day">'.
  $dt->day.
  '</div><div class="menus rounded-circle '.$issetOrEmpty.'"></div></a></td>';

  $dt->addDay();
  }
}
$calendar .= '</tr></tbody>';
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
</head>
<body class="reservation">

<!-- <div class="container"> -->
    <div class="justify-content-center">
        
        reservation/index です。<br>
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
                  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%">日時メニュー選択</div>
                  <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%">情報入力</div>
                  <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%">予約確認</div>
                  <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%">予約完了</div>
                </div>
                <br>
                
                <p>①日付を選択してください</p>
                <?php echo $link;?>
                <div class="border">
                  <table class="table m-0">
                    <thead class="text-center">
                      <tr>
                        <th scope="col">月</th>
                        <th scope="col">火</th>
                        <th scope="col">水</th>
                        <th scope="col">木</th>
                        <th scope="col">金</th>
                <th scope="col" class="text-primary">土</th>
                <th scope="col" class="text-danger">日</th>
              </tr>
            </thead>
            <tbody>
              <?php echo $calendar;?>
            </tbody>
          </table>
        </div>

          @if(!empty($d))
          <div>
          <br>
          ②メニューを選択してください
        </div>
        <div>
          <?php echo $y."年".$m."月".$d."日"; ?>
        </div>
        @endif

        <!-- <form  method="GET" action="/reservation/create?user_id='.$userIdFromUrl.'&&y='.$y.'&&m='.$m.'&&d='.$d.'&&menu_id='.$d."> -->
        <!-- <form  method="GET" action="{{ route('reservation.create') }}" > -->
          <!-- <input type="hidden" name="user_id" value="{{$userIdFromUrl}}"> -->

          <table class="table menuselection">
            <thead>
              <th></th>
              <th>予約時間</th>
              <th>メニュー</th>
              <th>料金</th>
              <th>施術時間</th>
              <th>条件</th>
            </thead>
            <tbody>
              
              @php
              $displayMenus='';
              foreach($calendars as $calendar){
                $menuIds = explode(",", $calendar->menu_id);
                
                foreach($menuIds as $menuId){
                  $menuName = DB::table('menus')->where('id','=',$menuId)->value('menu_name');
                  $menuCharge = DB::table('menus')->where('id','=',$menuId)->value('charge');
                  $menuMinutes = DB::table('menus')->where('id','=',$menuId)->value('minutes');
                  $menuRequirements = DB::table('menus')->where('id','=',$menuId)->value('requirements');
                  
                  $displayMenus .='<tr><td><a href="/reservation/create?user_id='.$userIdFromUrl.'&&calendar_id='.$calendar->id.'&&menu_id='.$menuId.'" class="btn btn-outline-primary btn-sm">選択</a></td>';
                  $displayMenus .='<td>'.$calendar->time.'</td>';
                  $displayMenus .='<td>'.$menuName.'</td>';
                  $displayMenus .='<td>'.$menuCharge.'円</td>';
                  $displayMenus .='<td>'.$menuMinutes.'分</td>';
                  $displayMenus .='<td>'.$menuRequirements.'</td></tr>';
                }
              }
              echo $displayMenus;
              @endphp
            </tbody>
          </table>
          <!-- <input type="submit" value="この内容で次へ" class="btn btn-outline-primary"> -->
        <!-- </form> -->
        </div>
        <!-- </div> -->
        <br>
        <br>
        <br>
        <br>
        <br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
</body>
</html>