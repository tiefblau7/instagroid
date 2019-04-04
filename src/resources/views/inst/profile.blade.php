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
<div>
  <img class = "pro_avatar" src="{{ $avatar }}" title="avatar">
  <span class = "pro_name">{{$github_id}}</span>
  <span class = "num">いいね合計数：{{$count}}</span>
</div>
@isset($post)
<div class = "pro_photos">
@foreach ($post as $d)
    <span class="photo_frame">
        <img class="pro_photo" src="{{ asset('storage/' . $d->image) }}">
    </span>
@endforeach
</div>
@endisset

@endsection
