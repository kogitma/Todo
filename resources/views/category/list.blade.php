@extends('layouts.master_bootstrap')
@section('title', 'カテゴリ一覧') {{-- サイトタイトル定義 --}}
@section('subtitle', 'カテゴリ管理') {{-- サブタイトル定義 --}}
@section('content')
<!-- Page Content -->
<div class="container p-3">

<h1>カテゴリ一覧</h1>

<div class="container p-3">

@if(session('user')->auth == 1)
<div class="p-3 mt-3 bg-light border">
    <form action="" method="get" class="form-horizontal">
        <div class="form-group row">
            <label class="col-2 mb-3">ユーザーID</label>
            <select name="user_id" class="form-control col-2">
                <option value="">すべて</option>
                @foreach($users as $user)
                <option value="{{$user->id}}"
                @if($request->user_id == $user->id && old('user_id') == "") selected @endif
                {{ old('user_id') == $user->id ? 'selected' : '' }}>{{$user->id}}</option>
                @endforeach
            </select>
        </div>

        <!--検索ボタン-->
        <div class="form-group row">
            <div class="col-12">
                <input type="submit" value="検索" class="btn btn-primary w-25" style="margin-left: 15px; color:white;">
            </div>
        </div>
        <!--/検索ボタン-->

    </form>
</div>
@endif
</div>

<div class="container p-3">
<!--リスト表示-->
@if($categories->isEmpty()) <p class="m-5 font-weight-bold text-center">登録されているデータがありません</p> @else
    <table class="table table-bordered table-hover">
    <thead class="text-center">
        <tr>
            <th scope="col" width="5%">No</th>
            <th scope="col" width="10%">名前</th>
            @if(session('user')->auth == 1)
                <th scope="col" width="10%">user_id</th>
                <th scope="col" width="10%">ユーザー名</th>
            @endif
            <th scope="col" width="16%" colspan="3">操作</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                @if(session('user')->auth == 1)
                    <td>{{ $category->user_id }}</td>
                    <td>{{ $category->user->name }}</td>
                @endif
                <td>
                    <a href="detail/{{$category->id}}"><button type="button" class="btn btn-warning">詳細</button></a>
                    <a href="edit/{{$category->id}}"><button type="button" class="btn btn-success">編集</button></a>
                    <div style="display:inline-flex">
                        <form action="delete/{{$category->id}}" method="POST">
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
{{ $categories->appends(request()->input())->links('pagination::bootstrap-4') }}
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