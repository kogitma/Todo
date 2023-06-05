@extends('layouts.master_bootstrap')
@section('title', 'アカウント詳細') {{-- サイトタイトル定義 --}}
@section('subtitle', 'アカウント管理') {{-- サブタイトル定義 --}}
@section('content')
<!-- Page Content -->
<div class="container p-3">

<h1>アカウント詳細</h1>

<div class="p-3 mt-3 bg-light border">
    <div class="mb-4">
        <label class="m-1 font-weight-bold">氏名</label>
        <div class="m-1">{{ $user->name }}</div>
    </div>

    <div class="mb-4">
        <label class="m-1 font-weight-bold">メールアドレス</label>
        <div class="m-1">{{ $user->email }}</div>
    </div>
    <div class="mb-4">
        <label class="m-1 font-weight-bold">ユーザーID</label>
        <div class="m-1">{{ $user->u_unique_id }}</div>
    </div>
    <div class="mb-5">
        <label class="m-1 font-weight-bold">権限タイプ</label>
        <div class="m-1">
            @switch($user->auth)
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
        <a href="../list/"><button type="button" class="btn btn-primary w-25">検索一覧へ</button></a>
        <a href="/user/edit/{{$user->id}}"><button type="button" class="btn btn-success w-25">編集へ</button></a>
    <div>
</div>

</div><!-- /container -->
@endsection