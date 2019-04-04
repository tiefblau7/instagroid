@extends('../layout/layout')

@section('content')

<!-- エラーメッセージエリア -->
@if ($errors->any())
    <h2>エラーメッセージ</h2>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<div class = "space"></div>
<div class = "favme">この投稿をいいねしたユーザー</div>

@foreach ($favlist as $f)
    <div class = "favname">
      <a href='../profile/{{$f->github_id}}'><img class = "pro_avatar" src="{{ $user -> where('github_id', $f->github_id) -> value('avatar') }}" title="avatar"></a>
      <a href='../profile/{{$f->github_id}}'>{{$f->github_id}}</a>
    </div>
    <br><br>
@endforeach

@endsection
