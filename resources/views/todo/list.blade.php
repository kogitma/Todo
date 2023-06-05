@extends('layouts.master_bootstrap')
@section('title', 'TODO一覧') {{-- サイトタイトル定義 --}}
@section('subtitle', 'TODO管理') {{-- サブタイトル？定義 --}}
@section('content')
<!-- Page Content -->
<div class="container p-3">

<h1>TODO一覧</h1>

<div class="p-3 mt-3 bg-light border">

    <form action="" method="get" class="form-horizontal">

        <!--タイトル-->
        <div class="form-row">
            <div class="col-5 mb-3">
                <label>タイトル</label>
                <input type="text" class="form-control" name="title" value="@if(old('title') == ""){{$request->title}}@endif{{ old('title') }}" placeholder="タイトル">
            </div>
        </div>
        <!--/タイトル-->

        <!--詳細内容-->
        <div class="form-row">
            <div class="col-5 mb-3">
                <label>詳細内容</label>
                <input type="text" class="form-control" name="content" value="@if(old('content') == ""){{$request->content}}@endif{{ old('content') }}" placeholder="詳細内容になります。">
            </div>
        </div>
        <!--/詳細内容-->

        <!--開始日-->
        <div class="form-row">
            <div class="col-5 mb-3">
                <label>開始日下限</label>
                <input type="text" class="form-control" name="start_date1" value="@if(old('start_date1') == ""){{$request->start_date1}}@endif{{ old('start_date1') }}" placeholder="2022/11/01">
                @if ($errors->has('start_date1'))
                <p class="text-danger">※{{$errors->first('start_date1')}}</p>
                @endif
            </div>
            <div class="col-5 mb-3">
                <label>開始日上限</label>
                <input type="text" class="form-control" name="start_date2" value="@if(old('start_date2') == ""){{$request->start_date2}}@endif{{ old('start_date2') }}" placeholder="2022/11/01">
                @if ($errors->has('start_date2'))
                <p class="text-danger">※{{$errors->first('start_date2')}}</p>
                @endif            
            </div>
        </div>
        <!--/開始日-->

        <!--期限日-->
        <div class="form-row">
            <div class="col-5 mb-3">
                <label>期限日下限</label>
                <input type="text" class="form-control" name="end_date1" value="@if(old('end_date1') == ""){{$request->end_date1}}@endif{{ old('end_date1') }}" placeholder="2022/11/07">
                @if ($errors->has('end_date1'))
                <p class="text-danger">※{{$errors->first('end_date1')}}</p>
                @endif
            </div>
            <div class="col-5 mb-3">
                <label>期限日上限</label>
                <input type="text" class="form-control" name="end_date2" value="@if(old('end_date2') == ""){{$request->end_date2}}@endif{{ old('end_date2') }}" placeholder="2022/11/07">
                @if ($errors->has('end_date2'))
                <p class="text-danger">※{{$errors->first('end_date2')}}</p>
                @endif
            </div>
        </div>
        <!--/期限日-->

        <!--ステータス -->
        <div class="form-group row">
            <label class="col-5 mb-3">ステータス</label>
            <div class="col-10">
                @foreach($statuses as $status)
                <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" id="{{$status->id}}" name="status[]" todo="{{$status->id}}" class="custom-control-input" 
                    {{ is_array(old("status")) && in_array("$status->id", old("status"), true)? ' checked' : '' }}
                    {{ is_array($request->status) && in_array("$status->id", $request->status, true)? ' checked' : '' }}
                    >
                    <label class="custom-control-label" for="{{$status->id}}">{{$status->name}}</label>
                </div>
                @endforeach
            </div>            
        </div>
        <!--/ステータス-->

        <!--カテゴリ-->
        @if($categories->isEmpty()) <label class="mb-4 m-1 font-weight-bold">カテゴリは登録されていません</label> @else
        <div class="form-group row">
            <label class="col-2 mb-3">カテゴリ</label>
            <select name="category" class="form-control col-2">
                <option value="">すべて</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}"
                @if($request->category == $category->id && old('category') == "") selected @endif
                {{ old('category') == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        @endif
        <!--/カテゴリ-->

        <!--表示件数-->
        <div class="form-group row">
            <label class="col-2 mb-3">表示件数</label>
            <select name="item" class="form-control col-1">
                <option todo="5"@if($request->item == 5 && old('item') == "") selected @endif{{ old('item') == '5' ? 'selected' : '' }}>5</option>
                <option todo="10"@if($request->item == 10 && old('item') == "") selected @endif{{ old('item') == '10' ? 'selected' : '' }}>10</option>
                <option todo="20"@if($request->item == 20 && old('item') == "") selected @endif{{ old('item') == '20' ? 'selected' : '' }}>20</option>
                <option todo="30"@if($request->item == 30 && old('item') == "") selected @endif{{ old('item') == '30' ? 'selected' : '' }}>30</option>
                <option todo="40"@if($request->item == 40 && old('item') == "") selected @endif{{ old('item') == '40' ? 'selected' : '' }}>40</option>
                <option todo="50"@if($request->item == 50 && old('item') == "") selected @endif{{ old('item') == '50' ? 'selected' : '' }}>50</option>
            </select>
        </div>
        <!--/表示件数-->

        <!--検索ボタン-->
        <div class="form-group row">
            <div class="col-12">
                <input type="submit" value="検索" class="btn btn-primary w-25" style="margin-left: 15px; color:white;">
            </div>
        </div>
        <!--/検索ボタン-->

    </form>
</div>
    </div><!-- /container -->

<div class="container p-3">

<!--リスト表示-->
@if($todos->isEmpty()) <p class="m-5 font-weight-bold text-center">登録されているデータがありません</p> @else
    <table class="table table-bordered table-hover">
    <thead class="text-center">
        <tr>
            <th scope="col" width="5%">No</th>
            <th scope="col" width="10%">タイトル</th>
            <th scope="col" width="10%">詳細内容</th>
            <th scope="col" width="10%">開始日</th>
            <th scope="col" width="10%">期限日</th>
            <th scope="col" width="10%">カテゴリ</th>
            <th scope="col" width="10%">ステータス</th>
            <th scope="col" width="20%" colspan="3">操作</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach ($todos as $todo)
            <tr>
                <td>{{ $todo->id }}</td>
                <td>{{ $todo->title }}</td>
                <td>{{ $todo->content }}</td>
                <td>{{date('Y/m/d', strtotime($todo->start_date))}}</td>
                <td>{{date('Y/m/d', strtotime($todo->end_date))}}</td>
                <td>
                    @foreach($todo->categories as $category)
                        <p>{{ $category->name }}</p>
                    @endforeach
                </td>
                <td>{{ $todo->statuses->name }}</td>
                <td>
                    <a href="detail/{{$todo->id}}"><button type="button" class="btn btn-warning">詳細</button></a>
                    <a href="edit/{{$todo->id}}"><button type="button" class="btn btn-success">編集</button></a>
                    <div style="display:inline-flex">
                        <form action="delete/{{$todo->id}}" method="POST">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-danger btn-dell" value="削除" onclick='return confirm("本当に削除しますか？")'>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
    </table>
<!--ページネーション-->
<div class="text-right pagination justify-content-end">
{{ $todos->appends(request()->input())->links('pagination::bootstrap-4') }}
</div>
<!--/ページネーション-->
@endif
<!--/リスト表示-->

<!--新規登録ボタン-->
    <div class="col-12">
        <a href="create/"><button type="submit" class="btn btn-primary btn-wide">新規登録</button></a>
    </div>
<!--/新規登録ボタン-->

</div><!-- /container -->
@endsection