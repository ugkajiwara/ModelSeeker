@extends('layouts.app')

@section('content')
<div class="container mb-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form">

                <h5>新メニューを登録してください</h5>

                @if($errors->any())
                <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>・{{ $error }}</li>
                    @endforeach
                </ul>
                </div>
                @endif
    
                <form method="POST" action="{{ route('menu.store') }}" onsubmit="return checkDouble();">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
    
                    <div class="form-group row">
                        <label for="menu_name" class="col-3 col-form-label">メニュー名<span class="text-danger">※<span></label>
                        <div class="col-9">
                            <input type="text" name="menu_name" class="form-control" id="menu_name" placeholder="" value="{{ old('menu_name') }}" required>
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <label for="minutes" class="col-3 col-form-label">所要時間<span class="text-danger">※<span></label>
                        <div class="col-9">
                            <select type="text" name="minutes" class="form-control" id="minutes" required>
                                <option value="">選択してください</option>
                                <option value="1">30分</option>
                                <option value="2">60分</option>
                                <option value="3">90分</option>
                                <option value="4">120分</option>
                                <option value="5">150分</option>
                                <option value="6">180分</option>
                                <option value="7">210分</option>
                                <option value="8">240分</option>
                                <option value="9">270分</option>
                                <option value="10">300分</option>
                            </select>
                        </div>
                    </div>
    
                    <div class="form-group row">
                        <label for="charge" class="col-3 col-form-label">料金（円）<span class="text-danger">※<span></label>
                        <div class="col-9">
                            <input type="text" name="charge" class="form-control" id="charge" placeholder="" value="{{ old('charge') }}" required>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label for="requirements">条件（条件指定が特に無い場合は何も記入しないでください）</label>
                        <textarea name="requirements" class="form-control" id="requirements" rows="3">{{ old('requirements') }}</textarea>
                    </div>
    
                    <span class="text-danger">※は必須項目<span>
                    <input type="submit" value="登録" class="btn btn-success btn-block" id="btnSubmit">
                    <br>
                </form>
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
@endsection
