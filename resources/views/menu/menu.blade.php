<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>メニュー</title>

    <!--Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!--Font Awesome5-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

</head>
<body class="d-flex flex-column">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">メニュー</a>
        <a href="/login/logout" role="button">ログアウト</a>
    </div>
</nav>

<div class="p-3 m-3 bg-light border">
    <div class="mb-4">
        <h1>ログイン情報</h1>
    </div>
    <div class="mb-4">
        <label class="m-1 font-weight-bold">氏名</label>
        <div class="m-1">{{session('user')->name}}</div>
    </div>

    <div class="mb-4">
        <label class="m-1 font-weight-bold">メールアドレス</label>
        <div class="m-1">{{session('user')->email}}</div>
    </div>
    <div class="mb-4">
        <label class="m-1 font-weight-bold">ユーザーID</label>
        <div class="m-1">{{session('user')->u_unique_id}}</div>
    </div>
    <div class="mb-5">
        <label class="m-1 font-weight-bold">権限タイプ</label>
        <div class="m-1">
            @switch(session('user')->auth)
                @case(1)
                    管理者
                    @break
                @case(2)
                    一般
                    @break
                @default
                    <!-- 表示なし -->
            @endswitch
        </div>
    </div>
    <div class="mt-5">
        <a href="user/list/"><button type="button" class="btn btn-primary w-25">アカウント一覧へ</button></a>
        <a href="todo/list/"><button type="button" class="btn btn-success w-25">TODOリスト一覧へ</button></a>
        <a href="category/list/"><button type="button" class="btn btn-warning w-25">カテゴリ一覧へ</button></a>
        @if(session('user')->auth == 1)
        <a href="status/list/"><button type="button" class="btn btn-info w-25 mt-3">ステータス一覧へ</button></a>
        @endif
    <div>
</div>

</body>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
</body>
</html>