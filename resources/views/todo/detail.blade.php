@extends('layouts.master_bootstrap')
@section('title', 'TODO詳細') {{-- サイトタイトル定義 --}}
@section('subtitle', 'TODO管理') {{-- サブタイトル？定義 --}}
@section('content')
<!-- Page Content -->
<div class="container p-3">

<h1>TODO詳細</h1>

<div class="p-3 mt-3 bg-light border">
    <div class="mb-4">
        <label class="m-1 font-weight-bold">タイトル</label>
        <div class="m-1">{{ $todo->title }}</div>
    </div>

    <div class="mb-4">
        <label class="m-1 font-weight-bold">詳細内容</label>
        <div class="m-1">{{ $todo->content }}</div>
    </div>
    <div class="mb-4">
        <label class="m-1 font-weight-bold">開始日</label>
        <div class="m-1">{{ $todo->start_date }}</div>
    </div>
    <div class="mb-4">
        <label class="m-1 font-weight-bold">期限日</label>
        <div class="m-1">{{ $todo->end_date }}</div>
    </div>

    @if($todo->categories->isEmpty()) <label class="mb-4 m-1 font-weight-bold">カテゴリは登録されていません</label> @else
    <div class="mb-4">
        <label class="m-1 font-weight-bold">カテゴリ</label>
        @foreach($todo->categories as $category)
            <div class="m-1">{{ $category->name }}</div>
        @endforeach
    </div>
    @endif

    <div class="mb-4">
        <label class="m-1 font-weight-bold">ステータス</label>
        <div class="m-1">{{ $todo->statuses->name }}</div>
    </div>
    <div class="mt-5">
        <a href="../list/"><button type="button" class="btn btn-primary w-25">検索一覧へ</button></a>
        <a href="/todo/edit/{{$todo->id}}"><button type="button" class="btn btn-success w-25">編集へ</button></a>
    <div>
</div>

</div><!-- /container -->
@endsection