<h1>Model Seeker</h1>
<p>美容師アシスタント向け予約管理ツール。ターゲットとしては、SNSを利用して新規顧客や施術モデルを探している美容師アシスタントの方。
集客から予約獲得までを一貫して自身のページ内で行うためのSNSブランディングをして運用している方。</p>
<p>LaravelやGCPなどの学習の意味も込めて作成しました。</p>
<a href="https://model-seeker.com" target="_blank">ModelSeeker</a><br>
[<a href="https://www.icloud.com/keynote/0SwxYMOJQSxOcgc_-b3uaqEbA" target="_blank">keynote</a>]
美容師の方に作成意図をプレゼンするためにこちらのスライドを作成しました。


<h2>使用技術</h2>
<ul>
    <li>PHP 7.3</li>
    <li>Laravel 6.20</li>
    <li>MySQL 5.7</li>
    <li>Bootstrap 4.6</li>
    <li>Google Cloud</li>
    <ul>
        <li>App Engine</li>
        <li>Cloud SQL</li>
    </ul>
    <li>MAMP</li>
</ul>
<h2>設計</h2>
<img width="794" alt="概要" src="https://user-images.githubusercontent.com/61844847/143389614-125e4496-d725-4152-ba64-9988e8bc82ef.png">
<img width="615" alt="図" src="https://user-images.githubusercontent.com/61844847/143389780-6606dd3a-20f8-4421-8f1c-6ee19ec026c9.png">
<img width="915" alt="DB" src="https://user-images.githubusercontent.com/61844847/143390389-0bcb8540-19da-4329-9e11-aef016b924a6.png">

<h2>工夫した点</h2>

<ul>
    <li>実際に美容師の方々に使っていただくことを想定していたため、直感的に使えるシンプルな機能ということを意識して作りました。</li>
    <li>手間がかかり、不必要だと思ったため、お客様側のユーザー登録をなくし、予約完了までスムーズに進むような仕組みにしました。</li>
    <li>同時刻に複数予約枠を登録し、時刻の重複を認めない場合、同時間帯に複数予約が被らないように配列をうまく使い実装しました。</li>
</ul>


<h2>苦労した点</h2>

<ul>
    <li>GCPの設定（主にCloud SQL）　[<a href="https://qiita.com/ugkajiwara/items/64b5ac94d81ca13d1b5f" target="_blank">詳細</a>]</li>
</ul>





<!-- <p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[British Software Development](https://www.britishsoftware.co)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- [UserInsights](https://userinsights.com)
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)
- [Invoice Ninja](https://www.invoiceninja.com)
- [iMi digital](https://www.imi-digital.de/)
- [Earthlink](https://www.earthlink.ro/)
- [Steadfast Collective](https://steadfastcollective.com/)
- [We Are The Robots Inc.](https://watr.mx/)
- [Understand.io](https://www.understand.io/)
- [Abdel Elrafa](https://abdelelrafa.com)
- [Hyper Host](https://hyper.host)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT). -->
