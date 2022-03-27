@extends('layout.header')
@section('title', '動画登録画面')
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container mt-4">
    <div class="border p-4">
        <h1 class="h4 mb-4 font-weight-bold">動画登録画面</h1>
        <form action="" id="form" name="video_form" enctype="multipart/form-data" method="POST">
        @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">動画名</label>
                <input type="text" name="" class="form-control" value="">
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">動画ファイル</label>
                <input type="file" name="" id="video_upload" class="form-control">
            </div>

            {{-- 動画が選択されたらプレビューを表示 --}}
            <div class="d-flex justify-content-center">
                <video
                    hidden
                    autoplay muted loop
                    id="video_preview"
                    style="width:240px; height:180px;"
                ></video>
                {{-- サムネイル自動生成用 --}}
                <canvas hidden type="hidden" id="canvas" class="canvas"></canvas>
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">動画サムネイル (未選択の場合、自動的に動画の先頭が設定されます)</label>
                <input type="file" name="" id="thumb_upload" class="form-control">
            </div>

            {{-- サムネイルが選択されたらプレビューを表示 --}}
            <div class="d-flex justify-content-center">
                <img
                    hidden
                    id="thumb_preview"
                    style="width:240px; height:180px;"
                >
            </div>
            <button type="submit" class="btn btn-primary">更新</button>

        </form>
    </div>
</div>

<script src="{{ asset('js/video.js') }}"></script>

@endsection
