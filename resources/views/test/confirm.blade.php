@extends('layouts.master_bootstrap')
@section('title', 'カテゴリ新規登録') {{-- サイトタイトル定義 --}}
@section('subtitle', 'カテゴリ管理') {{-- サブタイトル定義 --}}
@section('content')
<!-- Page Content -->
<div class="container p-3">

<h1>カテゴリ確認</h1>

<div class="p-3 mt-3 bg-light border">

<!--フォーム-->
<form @if(Request::is('test/create-confirm')) action="/test/create-complete"
@else action="/test/edit-complete/{{$id}}" @endif method="post">
{{ csrf_field() }}
<input type="hidden" name="name" value="{{$name}}">

<div class="mb-4">
        <label class="m-1 font-weight-bold">名前</label>
        <div class="m-1">{{ $name }}</div>
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