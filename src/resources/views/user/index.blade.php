@extends('layout.header')
@section('title', 'ユーザー一覧画面')
@section('content')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">

<div class="container">
    {{-- メニュー --}}
    <div class="table-menus">
        <h2>ユーザー一覧画面</h2>
        <form class="d-flex" action="{{ route('user.index') }}" method="GET">
            {{ Form::text('keyword', request('keyword'), ['class' => 'me-2', 'placeholder' => '名前、メールアドレスで検索']) }}
            <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
        </form>
        <div>
            <span id="output_file" accept="text/csv">CSV保存</span>
        </div>
    </div>

    <table class="table table-hover" style="table-layout:fixed;">
        <thead>
            <tr>
                <th width="5%">@sortablelink('id', 'ID')</th>
                <th width="20%">名前</th>
                <th width="10%">@sortablelink('age', '年齢')</th>
                <th width="10%">@sortablelink('gender', '性別')</th>
                <th width="25%">メールアドレス</th>
                <th width="20%">備考</th>
                <th width="10%">操作</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($searched_users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->age }}歳</td>
                    <td>
                        @if ($user->gender === 1) 男性
                        @elseif ($user->gender === 2) 女性
                        @else 指定なし
                        @endif
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <label for="showtext" class="omitted note" name="msg">
                            {{ $user->note }}
                        </label>
                    </td>
                    <td>
                        <div class="">
                            <form action="{{ route('user.edit', $user->id) }}" method="GET">
                                <button type="submit" class="btn btn-primary btn-sm">更新</button>
                            </form>
                            <button class="btn btn-primary btn-sm delete" data-bs-id="{{ $user->id }}" id="{{ $user->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal">削除</button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        <div class="alert alert-warning" role="alert">データがありません</div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        <span>
            全{{ $searched_users->total() }}件中
            {{ ($searched_users->currentPage() -1) * $searched_users->perPage() + 1 }} -
            {{ (($searched_users->currentPage() -1) * $searched_users->perPage() + 1) +
            (count($searched_users) - 1) }}件
        </span>
        {{ $searched_users->appends(request()->query())->links('vendor.pagination.default') }}
    </div>
</div>

{{-- 削除確認モーダル --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</div>

<form action='' id='delete_form' method='POST'>@csrf</form>

<script src="{{ asset('js/index.js') }}"></script>

@endsection
