@extends('layout.header')
@section('title', 'ユーザ一覧画面')
@section('content')

<div class="container">
    {{-- メニュー --}}
    <div class="table-menus">
        <h2>ユーザー一覧画面</h2>
        <form class="d-flex" action="{{ route('user.index') }}" method="GET">
            {{ Form::text('keyword', request('keyword'), ['class' => 'me-2', 'placeholder' => '名前、メールアドレスで検索']) }}
            <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>

    <table class="table table-hover" style="table-layout:fixed;">
        <thead>
            <tr>
                <th>@sortablelink('id', 'ID')</th>
                <th>名前</th>
                <th>メールアドレス</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($searched_users as $user)
                <tr>
                    <th>{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <div class="table-ctl">
                            <form action="" method="GET">
                                <button type="submit" class="btn btn-primary btn-sm">更新</button>
                            </form>
                            <form action="" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-primary btn-sm"
                                onclick="return confirm('削除してもよろしいですか？')">
                                    削除
                                </button>
                            </form>
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

@endsection
