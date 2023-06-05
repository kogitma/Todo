@extends('layouts.master_bootstrap')
@section('title', 'アカウント一覧') {{-- サイトタイトル定義 --}}
@section('subtitle', 'アカウント管理') {{-- サブタイトル定義 --}}
@section('content')
<!-- Page Content -->
<div class="container p-3">

<h1>アカウント一覧</h1>

<div class="p-3 mt-3 bg-light border">

    <form action="" method="get" class="form-horizontal">

        <!--氏名-->
        <div class="form-row">
            <div class="col-5 mb-3">
                <label>氏名</label>
                <input type="text" class="form-control" name="name" value="@if(old('name') == ""){{$request->name}}@endif{{ old('name') }}" placeholder="管理者 太郎">
            </div>
        </div>
        <!--/氏名-->

        <!--メールアドレス-->
        <div class="form-row">
            <div class="col-5 mb-3">
                <label>メールアドレス</label>
                <input type="text" class="form-control" name="email" value="@if(old('email') == ""){{$request->email}}@endif{{ old('email') }}" placeholder="test@test.co.jp">
            </div>
        </div>
        <!--/メールアドレス-->

        <!--ユーザーID-->
        <div class="form-row">
            <div class="col-5 mb-3">
                <label>ユーザーID</label>
                <input type="text" class="form-control" name="u_unique_id" value="@if(old('u_unique_id') == ""){{$request->u_unique_id}}@endif{{ old('u_unique_id') }}" placeholder="01234567">
            </div>
        </div>
        <!--/ユーザーID-->

        <!--ステータス-->
        <div class="form-group row">
            <label class="col-5 mb-3">ステータス</label>
            <div class="col-10">
                <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" id="customcheckboxInline1" name="auth[]" value="1" class="custom-control-input" 
                    @if (isset(request()->auth) && in_array('1', request()->auth, true)) checked @endif
                    {{ old('auth') == '1' ? 'checked' : '' }}>
                    <label class="custom-control-label" for="customcheckboxInline1">管理者</label>
                </div>
                <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" id="customcheckboxInline2" name="auth[]" value="2" class="custom-control-input"
                    @if (isset(request()->auth) && in_array('2', request()->auth, true)) checked @endif
                    {{ old('auth') == '2' ? 'checked' : '' }}>
                    <label class="custom-control-label" for="customcheckboxInline2">一般</label>
                </div>
            </div>            
        </div>
        <!--/ステータス-->

        <!--表示件数-->
        <div class="form-group row">
            <label class="col-2 mb-3">表示件数</label>
            <select name="item" class="form-control col-1">
                <option value="5"@if($request->item == 5 && old('item') == "") selected @endif{{ old('item') == '5' ? 'selected' : '' }}>5</option>
                <option value="10"@if($request->item == 10 && old('item') == "") selected @endif{{ old('item') == '10' ? 'selected' : '' }}>10</option>
                <option value="20"@if($request->item == 20 && old('item') == "") selected @endif{{ old('item') == '20' ? 'selected' : '' }}>20</option>
                <option value="30"@if($request->item == 30 && old('item') == "") selected @endif{{ old('item') == '30' ? 'selected' : '' }}>30</option>
                <option value="40"@if($request->item == 40 && old('item') == "") selected @endif{{ old('item') == '40' ? 'selected' : '' }}>40</option>
                <option value="50"@if($request->item == 50 && old('item') == "") selected @endif{{ old('item') == '50' ? 'selected' : '' }}>50</option>
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
    
<!--ソート
<div class="text-right col-md-12">
    <select name="sort">
        <option value="asc">ID昇順</option>
        <option value="desc">ID降順</option>
    </select>
</div>
/ソート-->

<div class="container p-3">

<!--リスト表示-->
@if($user->isEmpty()) <p class="m-5 font-weight-bold text-center">登録されているデータがありません</p> @else
    <table class="table table-bordered table-hover">
    <thead class="text-center">
        <tr>
            <th scope="col" width="5%">No</th>
            <th scope="col" width="10%">名前</th>
            <th scope="col" width="10%">メールアドレス</th>
            <th scope="col" width="10%">ユーザーID</th>
            <th scope="col" width="8%">権限タイプ</th>
            <th scope="col" width="16%" colspan="3">操作</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach ($user as $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->email }}</td>
                <td>{{ $value->u_unique_id }}</td>
                <td>
                @switch($value->auth)
                    @case(1)
                        管理者
                        @break
                    @case(2)
                        一般
                        @break
                    @default
                        <!-- 表示なし -->
                @endswitch
                </td>
                <td>
                    <a href="detail/{{$value->id}}"><button type="button" class="btn btn-warning">詳細</button></a>
                    <a href="edit/{{$value->id}}"><button type="button" class="btn btn-success">編集</button></a>
                    <div style="display:inline-flex">
                        <form action="delete/{{$value->id}}" method="POST">
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
{{ $user->appends(request()->input())->links('pagination::bootstrap-4') }}
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