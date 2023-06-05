@extends('layouts.master_bootstrap')
@section('title', 'ステータス新規登録') {{-- サイトタイトル定義 --}}
@section('subtitle', 'ステータス管理') {{-- サブタイトル定義 --}}
@section('content')
<!-- Page Content -->
<div class="container p-3">

<h1>ステータス新規登録</h1>

<div class="p-3 mt-3 bg-light border">

<!--フォーム-->
<form action="/status/create-confirm" method="post" class="needs-validation" novalidate>
{{ csrf_field() }}

<!--氏名-->
<div class="form-group">
        <label for="name" class="mb-3">氏名<span class="badge badge-danger ml-2">必須</span></label>
        <input type="text" class="col-6 form-control" name="name" value="{{ old('name') }}" id="name">
        @if ($errors->has('name'))
            <p class="text-danger">※{{$errors->first('name')}}</p>
        @endif
</div>
<!--/氏名-->

<!--一般利用可否-->
<div class="form-group">
    <div class="row">
        <label for="use_general" class="col-5 mb-3">一般利用可否</label>
        <div class="col-10">
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline1" name="use_general" value="1" {{ old('use_general') == 'true' ? 'checked' : '' }} class="custom-control-input" checked>
                <label class="custom-control-label" for="customRadioInline1">使用可</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline2" name="use_general" value="0" {{ old('use_general') == 'false' ? 'checked' : '' }} class="custom-control-input">
                <label class="custom-control-label" for="customRadioInline2">使用不可</label>
            </div>
        </div>
    </div>
</div>
<!--/一般利用可否-->

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