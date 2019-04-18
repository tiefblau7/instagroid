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
<!-- アバター表示 -->
<div class = "profiles">
  <div class = "pro_avatar_before">
    <div class = "avap">
      <img class = "pro_avatar" src="{{ $avatar }}" title="avatar">
    </div>
  </div>
  <div class = "pro_name">
    {{$github_id}}
  </div>
  <div class = "num">
    いいね合計数：{{$count}}
  </div>
</div><hr>
@isset($post)
<div class = "pro_photos">
@foreach ($post as $d)
    <span class="photo_frame">
      <span class="inner_photo">
        <img class="pro_photo" src="data:image/png;base64,<?= $d->image ?>">
      </span>
    </span>
@endforeach
</div>
@endisset

@endsection
