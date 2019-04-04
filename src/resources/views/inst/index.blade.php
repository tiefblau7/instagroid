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
@isset($post)
@foreach ($post as $d)
<div class = "rounded border cardsize">
  <div class = "cardsizein">
    <div>
      <h2 class = "editor"><a href="/profile/{{$d->github_id}}">{{$d->github_id}}</a>さんの投稿</h2>
    </div>
    <div>
      <img class = "post_avatar" src="{{ $d -> avatar }}" title="avatar">
    </div>
    @isset($token)
    @if($d->github_id == $github_id)
      <div class = "delete_key">
          {{ Form::open(['method' => 'delete', 'route' => ['post.delete', $d->id]]) }}
              {{ Form::submit('この記事を削除') }}
          {{ Form::close() }}
      </div>
    @endif
    @endisset
    <div class = "post_date">
      {{ $d->created_at }}
    </div><br>
    <div class ="photo">
        <img class="photoarea" src="{{ asset('storage/' . $d->image) }}">
    </div><br>
    <div class = "comment">{{ $d->comment}}</div>
    <div class = "fav_list"><a href="/favlist/{{$d->id}}">この投稿をいいねしたユーザー</a></div>
    @isset($token)
    @if($favs -> where('favs', $d ->id)->count() && $favs -> where('github_id', $github_id) -> where('favs', $d ->id)->count())
      <div class = "delete_key">
          {{ Form::open(['method' => 'delete', 'route' => ['fav.del', $d->id]]) }}
              {{ Form::submit('いいねをやめる', ['class' => "btn btn-primary btn-lg active"]) }}
          {{ Form::close() }}
      </div>
    @else
      <div class = "delete_key">
          {{ Form::open(['method' => 'post', 'route' => ['fav.add', $d->id]]) }}
              {{ Form::submit('いいね', ['class' => "btn btn-primary btn-lg active"]) }}
          {{ Form::close() }}
      </div>
    @endif
    @endisset
    <br><br>
  </div>
</div>
@endforeach

<div class="d-flex justify-content-center">
    {{ $post->links() }}
</div>
@endisset


@endsection
