@extends('layout.header')
@section('title', '動画一覧画面')
@section('content')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">

<div class="container">
    {{-- メニュー --}}
    {{-- <div class="table-menus">
        <h2>動画一覧画面</h2>
        <form class="d-flex" action="{{ route('user.index') }}" method="GET">
            {{ Form::text('keyword', request('keyword'), ['class' => 'me-2', 'placeholder' => '名前、メールアドレスで検索']) }}
            <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div> --}}

    <div>
        <div class="list-header">
            <span style="width:10%">@sortablelink('id', 'ID')</span>
            <span style="width:30%">サムネイル</span>
            <span style="width:30%">タイトル</span>
            <span style="width:30%">操作</span>
        </div>
        <ul class="list">
            @forelse ($videos as $video)
                <li>
                    <span style="width:10%">{{ $video->id }}</span>
                    <span style="width:30%">
                        <img src="{{ $video->thumb_path }}" alt="画像" style="width:100px; height:80px;">
                    </span>
                    <span style="width:30%">{{ $video->title }}</span>
                    <span style="width:30%" class="ds-edit-button">
                        <div class="">
                            <form action="{{ route('user.edit', $video->id) }}" method="GET">
                                <button type="submit" class="btn btn-primary btn-sm">更新</button>
                            </form>
                            <button class="btn btn-primary btn-sm delete" data-bs-id="{{ $video->id }}" id="{{ $video->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal">削除</button>
                        </div>
                    </span>
                </li>
            @empty
                <div class="alert alert-warning" role="alert">動画がありません</div>
            @endforelse
        </ul>
    </div>

    @if (count($videos) > 10)
        <button class="more-show btn btn-primary btn-sm">もっと見る</button>
    @endif
    {{-- <div class="d-flex justify-content-center">
        <span>
            全{{ $searched_users->total() }}件中
            {{ ($searched_users->currentPage() -1) * $searched_users->perPage() + 1 }} -
            {{ (($searched_users->currentPage() -1) * $searched_users->perPage() + 1) +
            (count($searched_users) - 1) }}件
        </span>
        {{ $searched_users->appends(request()->query())->links('vendor.pagination.default') }}
    </div> --}}
</div>

{{-- 削除確認モーダル --}}
{{-- <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">調査項目削除</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>削除してよろしいですか？</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                <button type="submit" class="btn btn-primary" id="deleteSubmit">OK</button>
            </div>
        </div>
    </div>
</div> --}}

{{-- <form action='' id='delete_form' method='POST'>@csrf</form> --}}

<script src="{{ asset('js/video_index.js') }}"></script>

@endsection
