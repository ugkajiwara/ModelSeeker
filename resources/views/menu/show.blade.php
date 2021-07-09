@extends('layouts.app')

@section('content')
<div class="container mb-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="container">
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
                <br>
                <form method="GET" action="{{route('menu.edit', ['id' => $menu->id]) }}">
                    @csrf
                    <!-- <input type="submit" value="変更する" class="btn btn-primary"> -->
                </form>
                
                <form method="POST" action="{{route('menu.destroy', ['id' => $menu->id]) }}" id="delete_{{ $menu->id }}">
                    @csrf
                    <a href="#" class="btn btn-outline-danger btn-block btn-sm" data-id="{{ $menu->id }}" onclick="deletePost(this);">このメニューを削除する</a>
                </form>
                <p class="text-secondary">（このメニューを削除しても現在このメニューを登録している予約枠は削除されません。<br>
                    新しい予約枠登録の際に、このメニューを選択できなくなります。）</p>
            </div>
        </div>
    </div>
</div>
<footer class="fixed-bottom bg-white shadow footer-bar">
    <div class="row text-center">
        <div class="col mt-2">
            <a href="/calendar/index/" class="text-secondary">
                <i class="far fa-calendar-alt"></i>
                <p>カレンダー</p>
            </a>
        </div>

        <div class="col mt-2">
            <a href="/menu/index/" class="text-success">
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
    if (confirm('本当に削除していいですか？')) {
        document.getElementById('delete_' + e.dataset.id).submit();
    }
}
</script>

@endsection
