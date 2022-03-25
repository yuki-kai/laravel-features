<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchService
{
    /**
     * ユーザー一覧画面の検索
     *
     * @return Array
     */
    public static function userSearch($keyword)
    {
        $query = User::query();

        // 名前かメールアドレスで検索された時
        if ($keyword) {
            $searched_users = $query
                ->sortable()
                ->where('name', 'LIKE', '%'.$keyword.'%')
                ->orWhere('email', 'LIKE', '%'.$keyword.'%')
                ->paginate(10);
        }

        // 検索されていない時
        if (empty($searched_users)) {
            $searched_users = $query
                ->sortable()
                // ->where('name', $name)
                ->paginate(10);
        }
        return [$searched_users];
    }
}
