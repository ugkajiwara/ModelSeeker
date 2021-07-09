<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">


        <link href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" rel="stylesheet">

        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref">
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

        <div class="container pl-0 mt-5">
            <div class="row">
                <div class="col-5">
                    <img src="{{ asset('img/img2.jpg') }}" class="img-fluid" alt="">
                </div>
                <div class="col-7 d-flex align-items-center justify-content-center">
                    <div class="text-center align-items-center my-5">
                        <h5>SNSを頑張っているアシスタントの皆さんへ</h5>
                        <p>SNS集客に特化した美容師アシスタント向け予約管理システム</p>
                    </div>
                </div>
            </div>
        </div>
        
        <h1 class="my-5 text-center" style="font-size:45px;">Model Seeker</h1>

        <div class="bg-light">
            <div class="container">
                <div class="features text-center justify-content-center">
    
                    <h3 class="py-3">特徴</h3>

                    <div class="row">
                        <div class="col-sm-4">
                            <img src="{{ asset('img/feature1.png') }}" class="img-fluid px-5 px-sm-0 rounded-circle mb-3" alt="">
                            <h4>完全無料</h4>
                            <p class="text-left">いまなら完全無料で使えます。<br>元美容師が、あったらよかったなという思いで作ってみました。</p>
                        </div>
    
                        <div class="col-sm-4">
                            <img src="{{ asset('img/feature2.png') }}" class="img-fluid px-5 px-sm-0  rounded-circle mb-3" alt="">
                            <h4>使いやすさ</h4>
                            <p class="text-left">これがあったらいいな、あれがあったらいいな。
                                アシスタントの時にモデルさん探しが大変だったから、何が必要だったかわかります。<br>
                                無駄な機能を省き、モデルさん募集に対する条件など提示できるようにしました。
                            </p>
                        </div>
    
                        <div class="col-sm-4">
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

        <div class="container mb-5 mt-3">
            <h3 class="py-3 text-center">このサービスができるまで</h3>
            <p class="mt-3 mb-5">昨今、インスタグラムなどのSNSの台頭により、SNSでの個人ブランディングが美容師として売れていく上で、
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

        
        <footer class="bg-dark text-white text-center py-3">
            <a href="/setting/how_to_use/" target="_blank" rel="noopener noreferrer">使い方を見る<i class="fas fa-external-link-alt"></i></a>
            <a href="/setting/faq/" target="_blank" rel="noopener noreferrer">よくある質問<i class="fas fa-external-link-alt"></i></a>
            <a href="/setting/contact/" target="_blank" rel="noopener noreferrer">問い合わせる<i class="fas fa-external-link-alt"></i></a>
            <p>created by Yuji Kajiwara<a href="https://www.instagram.com/ug_ka/" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram text-white"></i></a></p>
        </footer>
    </body>
</html>

    






    <!-- <a href="https://laravel.com/docs">Docs</a>
    <a href="https://laracasts.com">Laracasts</a>
    <a href="https://laravel-news.com">News</a>
    <a href="https://blog.laravel.com">Blog</a>
    <a href="https://nova.laravel.com">Nova</a>
    <a href="https://forge.laravel.com">Forge</a>
    <a href="https://vapor.laravel.com">Vapor</a>
    <a href="https://github.com/laravel/laravel">GitHub</a> -->