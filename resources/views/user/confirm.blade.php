@extends('layouts.master_bootstrap')
@section('auth', 'アカウント新規登録') {{-- サイトタイトル定義 --}}
@section('subtitle', 'アカウント管理') {{-- サブタイトル定義 --}}
@section('content')
<!-- Page Content -->
<div class="container p-3">

<h1>アカウント確認</h1>

<div class="p-3 mt-3 bg-light border">

<!--フォーム-->
<form @if(Request::is('user/create-confirm')) action="/user/create-complete"
@else action="/user/edit-complete/{{$id}}" @endif method="post">
{{ csrf_field() }}
<input type="hidden" name="name" value="{{$name}}">
<input type="hidden" name="email" value="{{$email}}">
<input type="hidden" name="u_unique_id" value="{{$u_unique_id}}">
<input type="hidden" name="password" value="{{$password}}">
<input type="hidden" name="auth" value="{{$auth}}">

<div class="mb-4">
        <label class="m-1 font-weight-bold">タイトル</label>
        <div class="m-1">{{ $name }}</div>
    </div>

    <div class="mb-4">
        <label class="m-1 font-weight-bold">詳細内容</label>
        <div class="m-1">{{ $email }}</div>
    </div>
    <div class="mb-4">
        <label class="m-1 font-weight-bold">開始日</label>
        <div class="m-1">{{ $u_unique_id }}</div>
    </div>
    <div class="mb-5">
        <label class="m-1 font-weight-bold">権限タイプ</label>
        <div class="m-1">
            @switch($auth)
                @case(1)
                管理者
                @break
                @case(2)
                一般
                @break
                @default
                <!-- 表示なし -->
            @endswitch
        </div>
    </div>
    <div class="mt-5">
        <button type="submit" class="btn btn-primary w-25">登録する</button>
        <button type="button" class="btn btn-warning w-25" onClick="history.back();">入力画面へ戻る</button>
    <div>

</form>
<!--/フォーム-->

</div>

</div><!-- /container -->
@endsection