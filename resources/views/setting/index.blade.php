@extends('layouts.app')

@section('content')
<div class="container pb-3">
    <div class="row justify-content-center">
        <div class="col-md-8">


            <div class="card shadow-sm bg-white my-3" style="width: 100%;">
                <div class="card-header">
                    アカウント情報
                    [<a href="/setting/edit/">編集する</a>]
                </div>
                <div class="card-body py-3">
                    <div class="card-body-detail">
                        <p class="card-text m-0">【名前】{{ $user->name }}</p>
                        <p class="card-text m-0">
                            【性別】
                            @if($user->gender == 0)
                            男
                            @elseif($user->gender == 1)
                            女
                            @elseif($user->gender == 2)
                            その他
                            @endif
                        </p>
                        <p class="card-text m-0">【メールアドレス】{{ $user->email }}</p>
                        <p class="card-text m-0">【サロン名】{{ $user->salon_name }}</p>
                        <p class="card-text m-0">【住所】{{ $user->salon_address }}</p>
                        <p class="card-text m-0">【電話】{{ $user->salon_tel }}</p>
                    </div>
                </div>
            </div>

            <div class="py-3">
                <p class="mb-0">
                {{ $user->name }}様専用予約ページリンク<br>
                （コピーしてお使いください）
                </p>
                <div class="input-group mb-2 mr-sm-2">
                    <input type="text"  id="copyTarget" class="form-control rounded" value="https://model-seeker.com/reservation/index?user_id={{$user->id}}" readonly>
                    <button onclick="copyToClipboard()" class="btn btn-primary rounded-right"><i class="fas fa-clipboard"></i></button>
                </div>
            </div>

        </div>
    </div>
</div>

<ul class="list-group list-group-flush border-top border-bottom mb-5">
  <li class="list-group-item bg-light">ヘルプ</li>
  <li class="list-group-item"><a href="/setting/how_to_use/" target="_blank" rel="noopener noreferrer">使い方を見る　<i class="fas fa-external-link-alt"></i></a></li>
  <li class="list-group-item"><a href="/setting/faq/" target="_blank" rel="noopener noreferrer">よくある質問　<i class="fas fa-external-link-alt"></i></a></li>
  <li class="list-group-item"><a href="/setting/contact/" target="_blank" rel="noopener noreferrer">問い合わせる　<i class="fas fa-external-link-alt"></i></a></li>
  <li class="list-group-item"><a href="/setting/terms/" target="_blank" rel="noopener noreferrer">利用規約　<i class="fas fa-external-link-alt"></i></a></li>
  <li class="list-group-item"><a href="/setting/privacy_policy/" target="_blank" rel="noopener noreferrer">プライバシーポリシー　<i class="fas fa-external-link-alt"></i></a></li>
  <li class="list-group-item">
    <a href="{{ route('logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        ログアウト
    </a>
  </li>
</ul>

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
            <a href="/notification/index/" class="text-secondary">
                <i class="far fa-bell"></i>
                <p>通知</p>
            </a>
        </div>

        <div class="col mt-2">
            <a href="/setting/index/" class="text-success">
                <i class="fas fa-cog"></i>
                <p>設定</p>
            </a>
        </div>
    </div>
</footer>

@endsection

<script>
    function copyToClipboard() {
        var copyTarget = document.getElementById("copyTarget");

        copyTarget.select();

        document.execCommand("Copy");

        alert("リンクをコピーしました : " + copyTarget.value);
        }
</script>



