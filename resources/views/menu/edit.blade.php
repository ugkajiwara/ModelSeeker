@extends('layouts.app')

@section('content')
<div class="container mb-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
        menu/edit です。
        </div>

        <form method="POST" action="{{ route('menu.update', ['id' => $menu->id ]) }}">
        @csrf
        メニュー名
        <input type="text" name="menu_name" value="{{ $menu->menu_name }}">
        <br>
        所要時間（分）
        <input type="text" name="minutes" value="{{ $menu->minutes }}">分
        <br>
        料金
        <input type="text" name="charge" value="{{ $menu->charge }}">円
        <br>
        条件
        <textarea name="requirements">{{ $menu->requirements }}</textarea>
        <br>
        <input type="submit" value="更新する" class="btn btn-primary">
        </form>

    </div>
</div>
@endsection
