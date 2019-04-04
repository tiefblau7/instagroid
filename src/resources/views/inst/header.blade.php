<header class="site">
  <nav class = "navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <ul class="row">
      <li class="col"><a href="/home">ホーム</a></li>
      @isset($token)
          <li class="col"><a href="/logout">ログアウト</a></li>
          <li class="col"><a href="/post">投稿</a></li>
      @endisset
      @empty($token)
          <li class="col"><a href="/login/github">ログイン</a></li>
          <li class="col"><a href="/">投稿</a></li>
      @endempty

    </ul>
  </nav>
</header>
