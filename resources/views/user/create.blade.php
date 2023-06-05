@extends('layouts.master_bootstrap')
@section('title', 'アカウント新規登録') {{-- サイトタイトル定義 --}}
@section('subtitle', 'アカウント管理') {{-- サブタイトル定義 --}}
@section('content')
<!-- Page Content -->
<div class="container p-3">

<h1>アカウント新規登録</h1>

<div class="p-3 mt-3 bg-light border">

<!--フォーム-->
<form action="/user/create-confirm" method="post" class="needs-validation" novalidate>
{{ csrf_field() }}

<!--氏名-->
<div class="form-group">
        <label for="name" class="mb-3">氏名<span class="badge badge-danger ml-2">必須</span></label>
        <input type="text" class="col-6 form-control" name="name" value="{{ old('name') }}" id="name">
        @if ($errors->has('name'))
            <p class="text-danger">※{{$errors->first('name')}}</p>
        @endif
</div>
<!--/氏名-->

<!--メールアドレス-->
<div class="form-group">
        <label for="email" class="mb-3">メールアドレス<span class="badge badge-danger ml-2">必須</span></label>
        <input type="text" class="col-6 form-control" name="email" value="{{ old('email') }}" id="email">
        @if ($errors->has('email'))
            <p class="text-danger">※{{$errors->first('email')}}</p>
        @endif
</div>
<!--/メールアドレス-->

<!--ユーザーID-->
<div class="form-group">
        <label for="u_unique_id" class="mb-3">ユーザーID<span class="badge badge-danger ml-2">必須</span></label>
        <input type="text" class="col-6 form-control" name="u_unique_id" value="{{ old('u_unique_id') }}" id="u_unique_id">
        @if ($errors->has('u_unique_id'))
            <p class="text-danger">※{{$errors->first('u_unique_id')}}</p>
        @endif
</div>
<!--/ユーザーID-->

<!--パスワード-->
<div class="form-group">
        <label for="password" class="mb-3">パスワード<span class="badge badge-danger ml-2">必須</span></label>
        <input type="password" class="col-6 form-control" name="password" value="{{ old('password') }}" id="password">
        @if ($errors->has('password'))
            <p class="text-danger">※{{$errors->first('password')}}</p>
        @endif
</div>
<!--/パスワード-->

<!--権限タイプ-->
<div class="form-group">
    <div class="row">
        <label for="auth" class="col-5 mb-3">権限タイプ</label>
        <div class="col-10">
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline1" name="auth" value="1" {{ old('auth') == '1' ? 'checked' : '' }} class="custom-control-input" checked>
                <label class="custom-control-label" for="customRadioInline1">管理者</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline2" name="auth" value="2" {{ old('auth') == '2' ? 'checked' : '' }} class="custom-control-input">
                <label class="custom-control-label" for="customRadioInline2">一般</label>
            </div>
        </div>
    </div>
</div>
<!--/権限タイプ-->

<!--ボタンブロック-->
<div class="form-group row mt-5">
    <div class="col-3">
        <button type="submit" class="btn btn-primary btn-block">確認画面へ</button>
    </div>
</div>
<!--/ボタンブロック-->

</form>
<!--/フォーム-->

</div>

</div><!-- /container -->
@endsection