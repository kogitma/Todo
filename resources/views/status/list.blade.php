@extends('layouts.master_bootstrap')
@section('title', 'ステータス一覧') {{-- サイトタイトル定義 --}}
@section('subtitle', 'ステータス管理') {{-- サブタイトル定義 --}}
@section('content')
<!-- Page Content -->
<div class="container p-3">

<h1>ステータス一覧</h1>

<div class="container p-3">

<!--リスト表示-->
@if($statuses->isEmpty()) <p class="m-5 font-weight-bold text-center">登録されているデータがありません</p> @else
    <table class="table table-bordered table-hover">
    <thead class="text-center">
        <tr>
            <th scope="col" width="5%">No</th>
            <th scope="col" width="10%">名前</th>
            <th scope="col" width="10%">一般利用可否</th>
            <th scope="col" width="10%" colspan="3">操作</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach ($statuses as $status)
            <tr>
                <td>{{ $status->id }}</td>
                <td>{{ $status->name }}</td>
                <td>
                @if($status->use_general)
                    利用可
                @else
                    利用不可
                @endif
                </td>
                <td>
                    <a href="detail/{{$status->id}}"><button type="button" class="btn btn-warning">詳細</button></a>
                    <a href="edit/{{$status->id}}"><button type="button" class="btn btn-success">編集</button></a>
                </td>
            </tr>
        @endforeach
    </tbody>
    </table>
<!--ページネーション-->
<div class="text-right pagination justify-content-end">
{{ $statuses->appends(request()->input())->links('pagination::bootstrap-4') }}
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