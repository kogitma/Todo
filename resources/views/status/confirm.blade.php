@extends('layouts.master_bootstrap')
@section('auth', 'ステータス新規登録') {{-- サイトタイトル定義 --}}
@section('subtitle', 'ステータス管理') {{-- サブタイトル定義 --}}
@section('content')
<!-- Page Content -->
<div class="container p-3">

<h1>ステータス確認</h1>

<div class="p-3 mt-3 bg-light border">

<!--フォーム-->
<form @if(Request::is('status/create-confirm')) action="/status/create-complete"
@else action="/status/edit-complete/{{$id}}" @endif method="post">
{{ csrf_field() }}
<input type="hidden" name="name" value="{{$name}}">
<input type="hidden" name="use_general" value="{{$use_general}}">

<div class="mb-4">
        <label class="m-1 font-weight-bold">タイトル</label>
        <div class="m-1">{{ $name }}</div>
    </div>
    <div class="mb-5">
        <label class="m-1 font-weight-bold">一般利用可否</label>
        <div class="m-1">
        @if($use_general)
            利用可
        @else
            利用不可
        @endif
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