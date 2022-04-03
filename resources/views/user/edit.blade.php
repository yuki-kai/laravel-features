@extends('layout.header')
@section('title', 'ユーザー更新画面')
@section('content')

<div class="container mt-4">
    <div class="border p-4">
        <h1 class="h4 mb-4 font-weight-bold">ユーザー更新画面</h1>
        <form action="{{ route('user.update', $user->id) }}" class="edit_video" enctype="multipart/form-data" method="POST">
        @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">名前</label>
                <input type="text" name="name" class="form-control" value="{{ old("name", $user->name) }}">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">メールアドレス</label>
                <input type="text" name="email" class="form-control" value="{{ old("email", $user->email) }}">
            </div>
            <button type="submit" class="btn btn-primary">更新</button>
        </form>
    </div>
</div>

@endsection
