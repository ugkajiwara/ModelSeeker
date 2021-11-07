<!-- 予約時に＜＜予約者側＞＞に送られるメール内容 -->

ModelSeekerをご利用いただきありがとうございます。<br>
以下、予約内容です。<br>
____________________________________  <br>
予約内容<br>
日時：
{{ $calendar->year }}年
{{ $calendar->month }}月
{{ $calendar->day }}日
{{ $calendar->time }} <br>
<br>
メニュー名：{{ $menu->menu_name }} <br>
所要時間：{{ $menu->minutes*30 }}分 <br>
料金：{{ $menu->charge }}円 <br>
条件：{{ $menu->requirements }} <br>
____________________________________ <br>
美容師情報<br>
名前：{{ $user->name }} <br>
サロン名：{{ $user->salon_name }} <br>
サロン住所：{{ $user->salon_address }} <br>
サロン電話番号：{{ $user->salon_tel }} <br>
____________________________________ <br>
予約者情報<br>
氏名：{{ $reservation->name }} <br>

性別：
@if( $reservation->gender == 0 )
男
@elseif( $reservation->gender == 1 )
女
@elseif( $reservation->gender == 2 )
その他
@endif
<br>
メールアドレス：{{ $reservation->email }} <br>
電話番号：{{ $reservation->tel }} <br>
____________________________________  <br>
予約をキャンセルされる際、ご予約に関してわからないことがある場合は、直接、または店舗の方へご連絡ください。

