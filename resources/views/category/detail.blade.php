@extends('layouts.master_bootstrap')
@section('title', 'カテゴリ詳細') {{-- サイトタイトル定義 --}}
@section('subtitle', 'カテゴリ管理') {{-- サブタイトル定義 --}}
@section('content')
<!-- Page Content -->
<div class="container p-3">

<h1>カテゴリ詳細</h1>

<div class="p-3 mt-3 bg-light border">
    <div class="mb-4">
        <label class="m-1 font-weight-bold">名前</label>
        <div class="m-1">{{ $category->name }}</div>
    </div>
    <div class="mb-4">
        <label class="m-1 font-weight-bold">ユーザー名</label>
        <div class="m-1">{{ $category->user->name }}</div>
    </div>
    <div class="mt-5">
        <a href="../list/"><button type="button" class="btn btn-primary w-25">検索一覧へ</button></a>
        <a href="/category/edit/{{$category->id}}"><button type="button" class="btn btn-success w-25">編集へ</button></a>
    <div>
</div>

</div><!-- /container -->
@endsection