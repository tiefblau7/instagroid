@extends('../layout/layout')

@section('content')

<!-- エラーメッセージエリア -->
<br><br><br><br><br>
@if ($errors->any())
    <h2>エラーメッセージ</h2>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form class = "form_area" action="{{ url('upload') }}" method="POST" enctype="multipart/form-data">
    <label for="photo">写真を選択:</label>
    <input type="file" class="form-control" name="file">
    <br>
    コメント:<br>
    <textarea name="comment" class = "comment_area"></textarea>
    <br>
    <hr>
    {{ csrf_field() }}
    <button class="btn btn-success"> 投稿 </button>
</form>
@endsection
