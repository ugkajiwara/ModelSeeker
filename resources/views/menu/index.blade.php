@extends('layouts.app')

@section('content')
<div class="container mb-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('menu.create')}}" class="text-success btn btn-outline-success btn-block btn-sm">+新規登録</a>
            <br>

            <table class="table menuselection">
                <thead>
                    <tr>
                    <th scope="col">メニュー名</th>
                    <th scope="col">施術時間</th>
                    <th scope="col">料金</th>
                    <th scope="col">条件</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($menus as $menu)
                @if($menu->is_deleted == 0)
                <tr>
                <td>{{ $menu->menu_name }}</td>
                <td>{{ $menu->minutes*30 }}分</td>
                <td>{{ $menu->charge }}円</td>
                <td>{{ $menu->requirements }}</td>
                <td><a href="{{ route('menu.show',['id' => $menu->id ])}}" class="btn btn-success btn-sm">詳細</a></td>
                </tr>
                @endif
                @endforeach
                </tbody>
            </table>



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
