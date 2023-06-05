<!-- Navigation -->
        <h5 class="m-1 p-3">リンク</h5>
        <nav class ="navbar-secondary">
            <ul class="nav flex-column m-1 p-3">
                <li class="nav-item mt-3"><a href="/" class="text-secondary">メニュー</a></li>
                <li class="nav-item mt-3"><a @if(!Request::is('user/*')) href="/user/list/" @endif class="text-secondary">アカウント一覧</a></li>
                <li class="nav-item mt-3"><a @if(!Request::is('todo/*')) href="/todo/list/" @endif class="text-secondary">TODOリスト一覧</a></li>
                <li class="nav-item mt-3"><a @if(!Request::is('category/*')) href="/category/list/" @endif class="text-secondary">カテゴリ一覧</a></li>
                @if(session()->has('user') && session('user')->auth == 1)
                <li class="nav-item mt-3"><a @if(!Request::is('status/*')) href="/status/list/" @endif class="text-secondary">ステータス一覧</a></li>
                @endif
            </ul>
        </nav>
<!-- / Navigation -->