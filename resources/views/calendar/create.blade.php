<?php
// require_once "vendor/autoload.php";
use Carbon\Carbon;

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

//今月取得
// $today = Carbon::createFromDate();
// $todayY = $today->year;
// $todayM = $today->month;


$link = '<a href="/calendar/index" class="btn btn-dark">今月</a>';//今月のリンク
$link .='<div class="link border border-dark"><a href="/calendar/index?y='.$subY.'&&m='.$subM.'&&d=1" class="btn btn-outline-dark subM"><i class="fas fa-arrow-left"></i></a>';//前月のリンク
$link .='<span class="yearMonth">'.$dt->format('Y').'年'; //年を表示
$link .=$dt->format('n').'月</span>';//月を表示
$link .= '<a href="/calendar/index?y='.$addY.'&&m='.$addM.'&&d=1" class="btn btn-outline-dark nextM"><i class="fas fa-arrow-right"></i></a></div>';//次月リンク  

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
  $loginUserId = Auth::user()->id;

  $canReserve = DB::table('calendars')
              ->where('year', $dt->year)
              ->where('month', $dt->month)
              ->where('day', $dt->day)
              ->where('user_id','=',$loginUserId)
              ->where('is_reserved','=','0')
              ->exists();

  $isReserved = DB::table('calendars')
              ->where('year', $dt->year)
              ->where('month', $dt->month)
              ->where('day', $dt->day)
              ->where('user_id','=',$loginUserId)
              ->where('is_reserved','=','1')
              ->exists();
              $reservedOrNot = '';
              if($canReserve){
                $reservedOrNot = 'bg-success';
              }
              if($canReserve == false && $isReserved){
                $reservedOrNot = 'bg-secondary';
              }

  if($comp < ($comp_now)){ //過ぎた日グレー
    $displayCalendar .= '<td class="calendar-date py-0 passed '.
    $selected.
    '"><a href="/calendar/index?y='.$dt->year.'&&m='.$dt->month.'&&d='.$dt->day.'" class="calendar-date"><div class="day">'.
    $dt->day.
    '</div><div class="menus rounded-circle '.$reservedOrNot.'"></div></a></td>';
  
    $dt->addDay();
  }elseif ($comp->eq($comp_now)){ //それらが同じなら下を実行違うならelseで通常を回す
  $displayCalendar .= '<td class="calendar-date py-0 border font-weight-bold '.
  $selected.
  '"><a href="/calendar/index?y='.$dt->year.'&&m='.$dt->month.'&&d='.$dt->day.'" class="calendar-date><div class="day">'.
  $dt->day.
  '</div><div class="menus rounded-circle '.$reservedOrNot.'"></div></a></td>';

  $dt->addDay();
  }else{
  $displayCalendar .= '<td class="calendar-date p-0 '.
  $selected.
  '"><a href="/calendar/index?y='.$dt->year.'&&m='.$dt->month.'&&d='.$dt->day.'" class="calendar-date><div class="day">'.
  $dt->day.
  '</div><div class="menus rounded-circle '.$reservedOrNot.'"></div></a></td>';

  $dt->addDay();
  }
}
$displayCalendar .= '</tr></tbody>';
?>




@extends('layouts.app')

@section('content')
<div class="container mb-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <?php echo $link;?>
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
              <?php echo $displayCalendar;?>
            </tbody>
          </table>

          @if(!empty($d))
            <div>
            <?php echo $y."年".$m."月".$d."日"; ?>
            </div>
            <br>


            @if($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>・{{ $error }}</li>
                @endforeach
              </ul>
            </div>
            @endif

            <form method="POST" action="<?php echo '/calendar/store?y='.$y.'&&m='.$m.'&&d='.$d; ?>">
            @csrf
              <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
              <input type="hidden" name="year" value="<?php echo $y; ?>" readonly>
              <input type="hidden" name="month" value="<?php echo $m; ?>" readonly>
              <input type="hidden" name="day" value="<?php echo $d ?>" readonly>
              <div class="form-group">
                ・施術開始時間を設定してください<span class="text-danger">※<span><br>
                <input type="time" name="time" class="form-controll" required>
              </div>

              ・募集するメニューを選択してください<span class="text-danger">※<span><br>
              <table class="table menuselection">
                <thead>
                    <tr>
                    <th scope="col" class="p-1"></th>
                    <th scope="col" class="p-1">メニュー</th>
                    <th scope="col" class="p-1">施術時間</th>
                    <th scope="col" class="p-1">料金</th>
                    <th scope="col" class="p-1">条件</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($menus as $menu)
                    @if($menu->is_deleted == 0)
                    <tr>
                      <td class="td_class px-1"><input type="checkbox" name="menu_id[]" value="{{ $menu->id }}"></td>
                      <td class="px-1">{{ $menu->menu_name}}</td>
                      <td class="px-1">{{ $menu->minutes*30 }}分</td>
                      <td class="px-1">{{ $menu->charge}}円</td>
                      <td class="px-1">{{ $menu->requirements}}</td>
                    </tr>
                    @endif
                  @endforeach
                </tbody>
              </table>
              <span class="text-danger">※は必須項目<span>
              <input type="submit" value="登録する" id="submit" class="btn btn-success btn-block">
            </form>
            @endif

        </div>
    </div>
</div>
<footer class="fixed-bottom bg-white shadow footer-bar">
    <div class="row text-center">
        <div class="col mt-2">
            <a href="/calendar/index/" class="text-success">
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
            <a href="/setting/index/" class="text-secondary">
                <i class="fas fa-cog"></i>
                <p>設定</p>
            </a>
        </div>
    </div>
</footer>

@endsection
