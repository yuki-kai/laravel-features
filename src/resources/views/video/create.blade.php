@extends('layout.header')
@section('title', '動画登録画面')
@section('content')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">

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
        {{-- <form action="" id="form" name="video_form" enctype="multipart/form-data" method="POST"> --}}
        @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">動画名</label>
                {{ Form::text('title', request('title'), ['class' => 'form-control', 'id' => 'title']) }}
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">動画ファイル</label>
                <input type="file" accept="video/mp4,video/qt" name="" id="video_upload" class="form-control">
            </div>

            {{-- 動画が選択されたらプレビューを表示 --}}
            <div class="d-flex justify-content-center">
                <video
                    hidden
                    autoplay muted loop
                    id="video_preview"
                    style="width:240px; height:180px;"
                ></video>
            </div>
            {{-- サムネイル自動生成用 --}}
            <canvas hidden type="hidden" id="canvas" class="canvas"></canvas>

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
            <button id="submit" class="btn btn-primary">登録</button>

            {{-- 確認モーダル --}}
            <div class="modal fade" id="confirm_modal" tabindex="-1">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">入力内容の確認</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <p class="text-muted">動画名</p>
                                <p class="px-2" id="confirm_title"></p>
                            </div>
                            <div>
                                <p class="text-muted">動画</p>
                                <p class="px-2" id="confirm_video"></p>
                            </div>
                            <div>
                                <p class="text-muted">サムネイル</p>
                                <p class="px-2" id="confirm_thumb"></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                            <button id="submit" class="btn btn-primary">保存</button>
                            <div class="message"></div>
                            <progress value="0" id="prog" max=100></progress>(<span id="pv" style="color:#00b200">0%</span>)
                        </div>
                    </div>
                </div>
            </div>

        {{-- </form> --}}
    </div>
</div>

<script src="{{ asset('js/video.js') }}"></script>

@endsection
