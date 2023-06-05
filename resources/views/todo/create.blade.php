@extends('layouts.master_bootstrap')
@section('title', 'TODO新規登録') {{-- サイトタイトル定義 --}}
@section('subtitle', 'TODO管理') {{-- サブタイトル？定義 --}}
@section('content')
<!-- Page Content -->
<div class="container p-3">

<h1>TODO新規登録</h1>

<div class="p-3 mt-3 bg-light border">

<!--フォーム-->
<form action="/todo/create-confirm" method="post" class="needs-validation" novalidate>
{{ csrf_field() }}

<!--タイトル-->
<div class="form-group">
        <label for="title" class="mb-3">タイトル<span class="badge badge-danger ml-2">必須</span></label>
        <input type="text" class="col-6 form-control" name="title" value="{{ old('title') }}" id="title">
        @if ($errors->has('title'))
            <p class="text-danger">※{{$errors->first('title')}}</p>
        @endif
</div>
<!--/タイトル-->

<!--詳細内容-->
<div class="form-group">
        <label for="content" class="mb-3">詳細内容<span class="badge badge-danger ml-2">必須</span></label>
        <input type="text" class="col-6 form-control" name="content" value="{{ old('content') }}" id="content">
        @if ($errors->has('content'))
            <p class="text-danger">※{{$errors->first('content')}}</p>
        @endif
</div>
<!--/詳細内容-->

<!--開始日-->
<div class="form-row">
    <div class="col-5 mb-3">
        <label for="start_date">開始日<span class="badge badge-danger ml-2">必須</span></label>
        <input type="text" class="form-control" name="start_date" id="start_date" value="{{ old('start_date') }}" placeholder="2022/11/01">
        @if ($errors->has('start_date'))
            <p class="text-danger">※{{$errors->first('start_date')}}</p>
        @endif
    </div>
    <div class="col-5 mb-3">
        <label for="end_date">期限日<span class="badge badge-danger ml-2">必須</span></label>
        <input type="text" class="form-control" name="end_date" id="end_date" value="{{ old('end_date') }}" placeholder="2022/11/07">
        @if ($errors->has('end_date'))
            <p class="text-danger">※{{$errors->first('end_date')}}</p>
        @endif
    </div>
</div>
<!--/期限日-->

<!--ステータス-->
<div class="form-group">
    <div class="row">
        <label for="status" class="col-5 mb-3">ステータス</label>
        <div class="col-10">
            @foreach($statuses as $status)
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="{{$status->id}}" name="status" value="{{$status->id}}" {{ old('status') == $status->id ? 'checked' : '' }} class="custom-control-input">
                <label class="custom-control-label" for="{{$status->id}}">{{$status->name}}</label>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!--/ステータス-->

<!--カテゴリ-->
@if($categories->isEmpty()) <label class="m-1 font-weight-bold">カテゴリは登録されていません</label> @else
<div class="form-group row">
    <label class="col-5 mb-3">カテゴリ</label>
    <div class="col-10">
        <div class="form-check form-check-inline">
            @foreach($categories as $category)
                <input class="form-check-input" type="checkbox" id="{{$category->id}}" name="categories[]" value="{{$category->id}}" 
                @if (isset(request()->category) && in_array('$category->id', request()->category, true)) checked @endif
                {{ old('category') == '$category->id' ? 'checked' : '' }}>
                <label class="form-check-label" for="{{$category->id}}">{{ $category->name }}　</label>
            @endforeach
        </div>
    </div>            
</div>
@endif
<!--/カテゴリ-->

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