@extends('layouts.master_bootstrap')
@section('title', 'ステータス登録・編集完了') {{-- サイトタイトル定義 --}}
@section('subtitle', 'ステータス管理') {{-- サブタイトル定義 --}}
@section('content')
<!-- Page Content -->
<div class="container p-3">

<h1>ステータス登録・編集完了</h1>

<div class="p-3 mt-3 bg-light border">

    <div class="mt-5">
        <a href="list/"><button type="button" class="btn btn-primary w-25">検索一覧へ</button></a>
        @if(isset(session('status')->id))
        <a href="edit/{{session('status')->id}}"><button type="button" class="btn btn-success w-25">編集へ</button></a>
        @endif
    </div>

</div>

</div><!-- /container -->
@endsection