<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    /**
     * ユーザ一削除機能
     *
     * @param user_id
     */
    public static function deleteUser($id)
    {
        // ログに発行されるSQL文を吐く
        // DB::listen(function ($query) {
        //     Log::info("Query Time:{$query->time}s] $query->sql");
        // });

        // 直前のURLをセッションに保存
        session()->put('previous_url', url()->previous());

        User::findOrFail($id)->delete();
    }

}
