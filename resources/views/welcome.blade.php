<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ModelSeeker</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">

        <link href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" rel="stylesheet">
        
    </head>
    <body>
        <div class="header">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/calendar/index/') }}">マイページ</a>
                    @else
                        <a href="{{ route('login') }}">ログイン</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">新規登録</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>

        <div class="firstview pl-0">
            <div class="row">
                <div class="col-5">
                    <img src="{{ asset('img/img2.jpg') }}" class="img-fluid" alt="">
                </div>
                <div class="col-7 d-flex align-items-center justify-content-center">
                    <div class="fv-text text-center align-items-center my-5">
                        <h5>SNS集客に特化した美容師アシスタント向け予約管理システム</h5>
                        <p>インスタグラムのプロフィールにリンクを貼るだけで、
                        あなたのプロフィールが予約サイトに変わります。</p>
                    </div>
                </div>
            </div>
        </div>

        <h1 class="mb-0 text-center modelseeker">Model Seeker</h1>

        <div class="bg-ligh pb-1 features-wrapper">
            <div class="container">
                <div class="features text-center justify-content-center">
    
                    <h3 class="py-3">どんなサービスなのか？</h3>

                    <div class="row justify-content-center">
                        <div class="col-sm-4 col-md-3">
                            <img src="{{ asset('img/feature1.png') }}" class="img-fluid px-5 px-sm-0 rounded-circle mb-3" alt="">
                            <h4>完全無料</h4>
                            <p class="text-left">いまなら完全無料で使えます。<br>
                            元美容師が、こんなのあったら良かったなという思いで作ってみました。</p>
                        </div>
    
                        <div class="col-sm-4 col-md-3">
                            <img src="{{ asset('img/feature2.png') }}" class="img-fluid px-5 px-sm-0  rounded-circle mb-3" alt="">
                            <h4>使いやすさ</h4>
                            <p class="text-left">アシスタントの時にモデルさん探しが大変だったから、何が必要なのかわかります。<br>
                                無駄な機能を省き、モデルさん募集に対する条件など提示できるようにしました。<br>
                            </p>
                        </div>
    
                        <div class="col-sm-4 col-md-3">
                            <img src="{{ asset('img/feature3.png') }}" class="img-fluid px-5 px-sm-0  rounded-circle mb-3" alt="">
                            <h4>SNS集客特化</h4>
                            <p class="text-left">SNS集客、
                                DMでやりとりをして、日にちを決定して、、、色々と手間でした。
                                そこで、プロフィールのリンクから直接予約のページに飛べたらDMのやり取りの手間もいらず、
                                モデルさんにとっても予約のハードルが下がるなと思い生まれたのがこのサービスです。
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="why_i_made_this">
            <div class="container pb-5 pt-2">
                <h3 class="py-3 text-center">このサービスができるまで</h3>
                <p class="mt-3 mb-5">昨今、インスタグラムなどSNSの台頭により、SNSでの個人ブランディングが美容師として売れていく上で、
                    非常に重要な要素となってきました。<br>
                    私自身、多くはアシスタントですが、さまざまな美容師の方達と関わってきました。
                    そんな中で、アシスタントの集客の仕組みがまだまだアナログだなと思ったのです。<br>
                    そこで今まで関わってきた人たちの手助けをしたいと思い、今回のサービス作成に至りました。<br>
                    使い勝手がいいなと思ったら、ぜひ店舗内で、仲間内で、広めてもらえると嬉しいです。
                </p>
                <a href="{{ route('register') }}" class="">
                <button class="btn btn-outline-success btn-block">
                    新規登録してみる
                </button>
                </a>
            </div>
        </div>

        
        <footer class="bg-dark text-white text-center py-3">
            <a href="/setting/how_to_use/" target="_blank" rel="noopener noreferrer">使い方を見る <i class="fas fa-external-link-alt"></i></a>
            |
            <a href="/setting/faq/" target="_blank" rel="noopener noreferrer">よくある質問 <i class="fas fa-external-link-alt"></i></a>
            |
            <a href="/setting/contact/" target="_blank" rel="noopener noreferrer">問い合わせる <i class="fas fa-external-link-alt"></i></a>
            <p class="created_by">created by Yuji Kajiwara <a href="https://www.instagram.com/ug_ka/" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram text-white"></i></a></p>
        </footer>
    </body>
</html>
