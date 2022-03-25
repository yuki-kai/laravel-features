<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Services\SearchService;
use App\Services\UserService;


class UserController extends Controller
{
    /**
     * ユーザ一覧画面
     *
     * @return view
     */
    public function index(Request $request)
    {
        $keyword  = $request->input('keyword');
        list($searched_users) = SearchService::userSearch($keyword);

        return view('user.index', compact('searched_users'));
    }

    /**
     * ユーザ一削除
     *
     * @return view
     */
    public function delete($id)
    {
        // ユーザー削除
        UserService::deleteUser($id);

        // 削除時のURLかデフォルトのユーザー一覧に遷移
        if (session('previous_url')) {
            return redirect(session('previous_url'));
        } else {
            return redirect()->route('user.index');
        }
    }
}
