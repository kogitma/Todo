@extends('layouts.master_bootstrap')
@section('title', 'カテゴリ新規登録') {{-- サイト名前定義 --}}
@section('subtitle', 'カテゴリ管理') {{-- サブタイトル定義 --}}
@section('content')
<!-- Page Content -->
<div class="container p-3">

<h1>カテゴリ新規登録</h1>

<div class="p-3 mt-3 bg-light border">

<!--フォーム-->
<form action="/test/create-confirm" method="post" class="needs-validation" novalidate>
{{ csrf_field() }}

<!--名前-->
<div class="form-group">
        <label for="name" class="mb-3">名前<span class="badge badge-danger ml-2">必須</span></label>
        <input type="text" class="col-6 form-control" name="name" value="{{ old('name') }}" id="name">
        @if ($errors->has('name'))
            <p class="text-danger">※{{$errors->first('name')}}</p>
        @endif
</div>
<!--/名前-->

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