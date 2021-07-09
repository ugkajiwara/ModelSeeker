<!-- 予約時に＜＜美容師側＞＞に送られるメール内容 -->

新規の予約があります。内容をご確認ください。<br>
<br>
以下、予約内容です。<br>
____________________________________<br>
予約者情報<br>
名前：{{ $reservation->name }}様<br>

性別：
@if( $reservation->gender == 0 )
男
@elseif( $reservation->gender == 1 )
女
@elseif( $reservation->gender == 2 )
その他
@endif
<br>

メールアドレス：{{ $reservation->email }}<br>
電話番号：{{ $reservation->tel }}<br>
____________________________________<br>
予約内容<br>
日時：{{ $calendar->year }}年{{ $calendar->month }}月{{ $calendar->day }}日{{ $calendar->time }}<br>
メニュー：{{ $menu->menu_name }}<br>
____________________________________<br>
詳しい内容等は、ModelSeeker内マイページにてご確認ください。<br>
<!-- ここにURLをはる --><br>

