@extends('layouts.app')

@section('content')
<div class="container mb-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <h5>
                【予約時間】
                {{ $calendar->year }}年
                {{ $calendar->month }}月
                {{ $calendar->day }}日
                {{ $calendar->time }} 
                </h5>
                <br>
                <br>
                
                <!-- 時間に入ってるメニューをexplodeして表示しつつ、
                予約済みのメニューに関しては、お客さんのデータを持ってくる。 -->
                
                @if($calendar->is_reserved == 0 )
                <div class="container">

                    <h4>メニュー詳細</h4>
                    @foreach($menuList as $menu)
                    
                    <div class="row">
                        <div class="col-4 bg-success text-light mb-1">
                        メニュー名
                        </div>
                        <div class="col-8">
                        {{ $menu->menu_name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 bg-success text-light mb-1">
                        時間
                        </div>
                        <div class="col-8">
                        {{ $menu->minutes*30 }} 分
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 bg-success text-light mb-1">
                        料金
                        </div>
                        <div class="col-8">
                        {{ $menu->charge }} 円
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 bg-success text-light mb-1">
                        条件
                        </div>
                        <div class="col-8">
                        {{ $menu->requirements }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 bg-success text-light mb-1">
                        状態
                        </div>
                        <div class="col-8">
                        受付中
                        </div>
                    </div>
                    <br>
                    @endforeach

                    <form method="POST" action="{{route('calendar.destroy', ['id' => $calendar->id]) }}" id="delete_{{ $calendar->id }}">
                    @csrf
                    <a href="#" class="btn btn-outline-danger btn-block btn-sm" data-id="{{ $calendar->id }}" onclick="deletePost(this);">この予約枠を削除する</a>
                    </form>
                </div>
                    
                    
                @elseif($calendar->is_reserved == 1 )
                <div class="container">
                    <h4>メニュー詳細</h4>

                    <div class="row">
                        <div class="col-4 bg-secondary text-light mb-1">
                        メニュー名
                        </div>
                        <div class="col-8">
                        {{ $menuList->menu_name }} 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 bg-secondary text-light mb-1">
                        時間
                        </div>
                        <div class="col-8">
                        {{ $menuList->minutes*30 }} 分
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 bg-secondary text-light mb-1">
                        料金
                        </div>
                        <div class="col-8">
                        {{ $menuList->charge }} 円
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 bg-secondary text-light mb-1">
                        条件
                        </div>
                        <div class="col-8">
                        {{ $menuList->requirements }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 bg-secondary text-light mb-1">
                        状態
                        </div>
                        <div class="col-8">
                        予約確定
                        </div>
                    </div>
                    <br><br>
                    
                    <h4>予約者詳細</h4>
                    <div class="row">
                        <div class="col-4 bg-light mb-1">
                        名前
                        </div>
                        <div class="col-8">
                        {{ $reservation->name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 bg-light mb-1">
                        性別
                        </div>
                        <div class="col-8">
                        @if($reservation->gender == 0)
                        男
                        @elseif($reservation->gender == 1)
                        女
                        @elseif($reservation->gender == 2)
                        その他
                        @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 bg-light mb-1">
                        メール
                        </div>
                        <div class="col-8">
                        {{ $reservation->email }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 bg-light mb-1">
                        電話番号
                        </div>
                        <div class="col-8">
                        {{ $reservation->tel }}
                        </div>
                    </div>
                    <br>

                    <form method="POST" action="{{route('calendar.destroy', ['id' => $calendar->id]) }}" id="delete_{{ $calendar->id }}">
                    @csrf
                    <a href="#" class="btn btn-outline-danger btn-block btn-sm" data-id="{{ $calendar->id }}" onclick="deleteReservedPost(this);">この予約枠を削除する</a>
                    </form>
                </div>
                @endif
            </div>
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

<script>

function deletePost(e) {
    'use strict';
    if (confirm('本当に削除しますか？')) {
        document.getElementById('delete_' + e.dataset.id).submit();
    }
}

function deleteReservedPost(e) {
    'use strict';
    if (confirm('このメニューは予約されています。本当に削除しますか？')) {
        document.getElementById('delete_' + e.dataset.id).submit();
    }
}

</script>
        
@endsection