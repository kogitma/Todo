@extends('layouts.master_bootstrap')
@section('title', 'TODO新規登録') {{-- サイトタイトル定義 --}}
@section('subtitle', 'TODO管理') {{-- サブタイトル？定義 --}}
@section('content')
<!-- Page Content -->
<div class="container p-3">

<h1>TODO確認</h1>

<div class="p-3 mt-3 bg-light border">

<!--フォーム-->
<form @if(Request::is('todo/create-confirm')) action="/todo/create-complete"
@else action="/todo/edit-complete/{{$id}}" @endif method="post">
{{ csrf_field() }}
<input type="hidden" name="title" value="{{$title}}">
<input type="hidden" name="content" value="{{$content}}">
<input type="hidden" name="start_date" value="{{$start_date}}">
<input type="hidden" name="end_date" value="{{$end_date}}">
<input type="hidden" name="status" value="{{$status}}">
@if(isset($categories))
@foreach($categories as $category)
<input type="hidden" name="categories[]" value="{{$category}}">
@endforeach
@endif

<div class="mb-4">
        <label class="m-1 font-weight-bold">タイトル</label>
        <div class="m-1">{{ $title }}</div>
    </div>

    <div class="mb-4">
        <label class="m-1 font-weight-bold">詳細内容</label>
        <div class="m-1">{{ $content }}</div>
    </div>
    <div class="mb-4">
        <label class="m-1 font-weight-bold">開始日</label>
        <div class="m-1">{{ $start_date }}</div>
    </div>
    <div class="mb-4">
        <label class="m-1 font-weight-bold">期限日</label>
        <div class="m-1">{{ $end_date }}</div>
    </div>
    <div class="mb-5">
        <label class="m-1 font-weight-bold">ステータス</label>
        <div class="m-1">
            @switch($status)
                @case(1)
                未着手
                @break
                @case(2)
                作業中
                @break
                @case(3)
                保留中
                @break
                @case(4)
                完了
                @break
                @default
                <!-- 表示なし -->
            @endswitch
        </div>
    </div>
    @if(isset($c_names))
    <div class="mb-4">
        <label class="m-1 font-weight-bold">カテゴリ</label>
        @foreach($c_names as $c_name)
        <div class="m-1">{{ $c_name->name }}</div>
        @endforeach
    </div>
    @endif
    <div class="mt-5">
        <button type="submit" class="btn btn-primary w-25">登録する</button>
        <button type="button" class="btn btn-warning w-25" onClick="history.back();">入力画面へ戻る</button>
    <div>

</form>
<!--/フォーム-->

</div>

</div><!-- /container -->
@endsection