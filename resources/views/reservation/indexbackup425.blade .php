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

$link = '<caption><a href="/reservation/index?user_id='.$userIdFromUrl.'&&y='.$todayY.'&&m='.$todayM.'&&d=1" class="btn btn-primary">今月</a> ';//今月のリンク
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
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        
        reservation/index です。<br>
        名前
        {{ $user->name }}
        <br>
        性別
        {{ $user->gender }}
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

          
          <!-- メニューここから（rawのやつ） -->
            <!-- <div class="row">
              @foreach( $calendars as $calendar )
              @if($calendar->year."-".$calendar->month."-".$calendar->day == $y."-".$m."-".$d)
              <div class="col-2">
              {{ $calendar->time }}
              </div>
              <div class="col-9 menuselection">
                @php  
                $menu_ids_array = explode(",",$calendar->menu_id); //配列に戻す
                foreach($menu_ids_array as $menu_id_from_array){  
                  $menu_from_array = DB::table('menus')
                  ->where('id','=',$menu_id_from_array)
                  ->select('id','menu_name','minutes','charge','requirements','is_deleted')
                  ->get();
                  foreach($menu_from_array as $menu_list){
                    echo 
                            '<div class="border">
                              <div class="row">
                                <div class="col-5">'.
                                $menu_list->menu_name.
                              '</div>
                                <div class="col-3">'.
                                $menu_list->minutes.
                              '</div>
                                <div class="col-4">'.
                                $menu_list->charge.
                              '</div>
                              </div>
                              <div class="row">
                                <input type="radio" method="" action="" value="" class="col-1" name="menu">
                                <div class="col-11">'.
                                $menu_list->requirements.
                               '</div>
                              </div>
                            </div>';
                        }
                      }
                      @endphp
                    </div>
                    @endif
                    @endforeach
                  </div> -->
          <!-- メニューここまで（rawのやつ） -->

          <table>
            @foreach($calendars as $calendar)
            {{$calendar->time}}

            @endforeach
          </table>



<!-- 
          <table class="table">
            <tbody>
            @foreach( $calendars as $calendar )
              @if($calendar->year."-".$calendar->month."-".$calendar->day == $y."-".$m."-".$d)
                <tr>
                  <td>{{ $calendar->time }}</td>


                  <td>

予約済みかどうかで、メニューのテーブルかモデル（リザベーション）のテーブル
どっちからデータを取ってくるか決める。＠if（$calendar->is_reserved == 0 or 1 ）を使う
                  @php  
                  $menu_ids_array = explode(",",$calendar->menu_id); //配列に戻す
                  foreach($menu_ids_array as $menu_id_from_array){  
                    $menu_name_from_array = DB::table('menus')->where('id', $menu_id_from_array)->value('menu_name');
                    echo "・".$menu_name_from_array."<br>";
                  }
                  @endphp
予約済みならここにお客さんの名前持ってきたい
                  </td>


                  @if( $calendar->is_reserved == 0 )
                  <td class="text-success">受付中</td>
                  @endif
                  @if( $calendar->is_reserved == 1 )
                  <td class="text-secondary">予約済み☑︎</td>
                  @endif
                  <td><a href="{{ route('calendar.show',['id' => $calendar->id ]) }}">詳細</a></td>
                </tr>
              @endif
            @endforeach
            </tbody>
          </table> -->
        </div>
    </div>
</div>
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