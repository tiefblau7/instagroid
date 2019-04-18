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
  <div>
    <img class = "pro_avatar" src="{{ $avatar }}" title="avatar">
  </div>
  <div>
    <span class = "pro_name">{{$github_id}}</span>
  </div>
  <div>
    <span class = "num">いいね合計数：{{$count}}</span>
  </div>
</div>
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
