@extends('layouts.app')

@section('content')
<div class="container mb-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">通知日時</th>
                    <th scope="col">通知内容</th>
                </tr>
            </thead>
            @foreach($reservations as $reservation)
            <tbody>
                <tr>
                    <td>{{ $reservation->created_at }}</td>
                    <td>
                    <a href="/calendar/show/{{ $reservation->calendar_id }}" class="">
                    {{ $reservation->name }}様から新規予約
                    </a>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
        {{ $reservations->links() }}

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
            <a href="/menu/index/" class="text-secondary">
                <i class="fas fa-cut"></i>
                <p>メニュー</p>
            </a>
        </div>

        <div class="col mt-2">
            <a href="/notification/index/" class="text-success">
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
