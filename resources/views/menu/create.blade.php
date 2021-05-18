@extends('layouts.app')

@section('content')
<div class="container mb-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('menu.store') }}">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                メニュー名
                <input type="text" name="menu_name" required>
                <br>
                所要時間（分）
                <select name="minutes" required>
                    <option value="1">30</option>
                    <option value="2">60</option>
                    <option value="3">90</option>
                    <option value="4">120</option>
                    <option value="5">150</option>
                    <option value="6">180</option>
                    <option value="7">210</option>
                    <option value="8">240</option>
                    <option value="9">270</option>
                    <option value="10">300</option>
                </select>分
                <br>
                料金
                <input type="text" name="charge" required>円
                <br>
                条件
                <textarea name="requirements"></textarea>
                <br>
                <input type="submit" value="登録" class="btn btn-success">
                <br>
            </form>
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
            <a href="" class="text-secondary">
                <i class="far fa-bell"></i>
                <p>通知</p>
            </a>
        </div>

        <div class="col mt-2">
            <a href="" class="text-secondary">
                <i class="fas fa-cog"></i>
                <p>設定</p>
            </a>
        </div>
    </div>
</footer>
@endsection
