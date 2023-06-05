<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ログイン</title>

    <!--Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!--Font Awesome5-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

</head>
<body class="d-flex flex-column">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">ログイン</a>
    </div>
</nav>
<div class="row">
    <div class="col-4 m-5">
        <form action="{{ route('login') }}" method="post">
            <div class="form-group">
                @if (session('info'))
                    <div class="alert alert-warning">
                    {{ session('info') }}
                    </div>
                @endif
                <label for="u_unique_id">ユーザーID</label>
                <input type="text" id="u_unique_id" name="u_unique_id" class="form-control">
                @if ($errors->has('u_unique_id'))
                <p class="text-danger">※{{$errors->first('u_unique_id')}}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" id="password" name="password" class="form-control">
                @if ($errors->has('password'))
                <p class="text-danger">※{{$errors->first('password')}}</p>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">ログイン</button>
            {{ csrf_field() }}
        </form>
    </div>
</div>

</body>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
</body>
</html>