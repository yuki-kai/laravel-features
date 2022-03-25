@extends('layout.header')
@section('title', 'ユーザ一覧画面')
@section('content')

<div class="container">
    <h2>ユーザー一覧画面</h2>
    <!-- ここから検索 -->
    <div class="table-menus">
        <nav class="navbar">
            <div>
                <form class="d-flex" action="{{ route('user.index') }}" method="GET">
                    {{ Form::text('title', request('title'), ['class' => 'me-2', 'placeholder' => '会社名、担当者名で検索']) }}
                    <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </nav>
    </div>
    <!-- ここまで検索 -->

    <table class="table table-hover" style="table-layout:fixed;">
        <thead>
            {{-- <p>
                全{{ $searched_users->total() }}件中
                {{ ($searched_users->currentPage() -1) * $searched_users->perPage() + 1 }} -
                {{ (($searched_users->currentPage() -1) * $searched_users->perPage() + 1) +
                (count($searched_users) -1) }}件
            </p> --}}
            <tr>
                <th style="width:100px;">@sortablelink('id', 'ID')</th>
                <th >会社名</th>
                <th >担当者名</th>
                <th >@sortablelink('deviceCount', '機器数')</th>
                <th >機器名</th>
                <th >メールアドレス</th>
                <th >@sortablelink('updated_at', '更新日')</th>
                <th >操作</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($searched_users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>

                    <td>{{ $user->company ? $user->company : '未登録' }}</td>
                    <td>{{ $user->user ? $user->user : '未登録' }}</td>
                    <td>{{ $user->devices->count() }}</td>

                    @if ($user->devices->count() == 0)
                        <td>未登録</td>
                    @elseif ($user->devices->count() == 1)
                        @foreach ($user->devices as $device)
                            <td class="overflow">{{ $device->name }}</td>
                        @endforeach
                    @else
                        @foreach ($user->devices as $device)
                            @php
                                $lists[] = $device->name;
                            @endphp
                        @endforeach
                        <td class="overflow">{{ implode(",", $lists)}}</td>
                    @endif

                    <td class="overflow">{{ $user->email }}</td>
                    <td>{{ $user->updated_at }}</td>
                    <td>
                        <div class="table-ctl">
                            <form action="{{ route('admins.user.edit_view', [$user->id]) }}" method="GET">
                                <button type="submit" class="btn btn-primary btn-sm">更新</button>
                            </form>
                            <form action="{{ route('admins.user.delete', [$user->id]) }}" method="POST">
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
                    <td colspan="8">
                        <div class="alert alert-warning" role="alert">データがありません</div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $searched_users->appends(request()->query())->links('vendor.pagination.default') }}
    </div>
</div>

@endsection
