@extends('layouts.app')

@section('content')

    <div class="container">

        <h2>Model Seekerの使い方</h2>

        <h4>管理側ページの利用に関して</h4>

        <div class="row justify-content-center py-3">
            <div class="col-5">
                <img src="{{ asset('img/htu1.png') }}" class="img-fluid border border-success" alt="">
            </div>
            <div class="col-7">
                <h5>新規登録</h5>
                <p class="mb-0">トップページの、</p>
                <a href="{{ route('register') }}" class="">
                    <button class="btn btn-outline-success btn-block">
                        新規登録してみる
                    </button>
                  </a>
                <p>というボタンを押して、新機器ユーザー登録をします。
                    （こちらのボタンからも登録できます。）</p>
            </div>
        </div>

        <div class="row justify-content-center py-3">
            <div class="col-5">
                <img src="{{ asset('img/htu3.png') }}" class="img-fluid border border-success" alt="">
            </div>
            <div class="col-7">
                <h5>募集しているメニューの登録</h5>
                <p>後の予約枠登録の際に掲載するための、探しているメニューを、下メニューバーメニューより登録します。<br>
                    必要な項目は、メニュー、所要時間、料金、そして条件です。<br>
                    条件というのは、画像にある通り、例えば男性のカットモデルを探している場合や、
                    カラーのトーンアップ、トーンダウンのモデルの募集など、柔軟に記載することができます。<br>
                    条件を記入した場合のみ、お客様予約ページにて、この条件を承認しないと予約を確定できない仕組みになっております。
                </p>
            </div>
        </div>

        <div class="row justify-content-center py-3">
            <div class="col-5">
                <img src="{{ asset('img/htu4.png') }}" class="img-fluid border border-success" alt="">
            </div>
            <div class="col-7">
                <h5>予約枠の登録</h5>
                <p>予約枠を、下メニューバーカレンダーより登録します。<br>
                    登録したい日付をカレンダーから選択し、予約枠追加ボタンを押下後、画像のようなページに切り替わります。<br>
                    必要入力事項は、施術の開始時間と、先ほど説明した登録済みメニューの選択です。<br>
                    ここで初めてお客様が、日付、メニューを選択して予約をすることが可能となります。
                </p>
            </div>
        </div>

        <div class="row justify-content-center py-3">
            <div class="col-5">
                <img src="{{ asset('img/htu5.png') }}" class="img-fluid border border-success" alt="">
            </div>
            <div class="col-7">
                <h5>登録メニュー複数選択時の挙動について</h5>
                <p>メニューは複数同時登録できますが、その場合お客様は複数のメニューからひとつしか選択できず、
                    どちらかの予約が確定してしまうと、そのほかに同時に登録していたメニューは表示されない仕様となっており、
                    同時に複数メニューをあわせて予約する仕様とはなっておりませんのでご注意ください。</p>
            </div>
        </div>

        <div class="row justify-content-center py-3">
            <div class="col-5">
                <img src="{{ asset('img/htu6.png') }}" class="img-fluid border border-success" alt="">
            </div>
            <div class="col-7">
                <h5>予約ページのリンクについて</h5>
                <p>下メニューバー設定より、自身の登録情報などを確認、変更することが可能です。<br>
                    また、SNSで予約用のページを利用することがほとんどだと思われますが、
                    その際は、〇〇様専用予約ページリンクと表示されている箇所の下に、専用URLを用意しておりますので、こちらをコピーしてご活用ください。
                </p>
            </div>
        </div>

        <h4>予約者側ページの利用に関して</h4>

        <div class="row justify-content-center py-3">
            <div class="col-5">
                <img src="{{ asset('img/htu7.png') }}" class="img-fluid border border-success" alt="">
            </div>
            <div class="col-7">
                <h5>予約者用画面に関して</h5>
                <p>カレンダーにて、日付、メニューを選択後、左画像のような予約者情報入力画面へと遷移します。<br>
                   「登録メニュー複数選択時の挙動について」で記載したように、ここでは条件がある場合、その承認が必須となっております。
                    メニュー登録の際に間違いが内容にお気をつけください。</p>
            </div>
        </div>

        <div class="row justify-content-center py-3">
            <div class="col-5">
                <img src="{{ asset('img/htu8.png') }}" class="img-fluid border border-success" alt="">
            </div>
            <div class="col-7">
                <h5>予約完了の画面に関して</h5>
                <p>予約が完了すると、左画像のような画面へと遷移します。
                    このタイミングで、予約者に予約完了通知メール、ユーザーに新規登録通知メールが届きます。
                </p>
            </div>
        </div>

        <div>
            こちらに記載されていることや、その他のことに関してご不明な点等ございましたら、
            気兼ねなく
            <a href="/setting/contact/" target="_blank" rel="noopener noreferrer">問い合わせる　<i class="fas fa-external-link-alt"></i></a>
            にてお問い合わせください。
        </div>

    </div>

@endsection


