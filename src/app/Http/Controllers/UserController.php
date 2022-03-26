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
     * ユーザー一覧画面
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
     * ユーザ一更新画面
     *
     * @return view
     */
    public function edit($id)
    {
        // 直前のURLをセッションに保存
        session()->put('previous_url', url()->previous());
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    /**
     * ユーザ一更新
     *
     * @return view
     */
    public function update(Request $request)
    {
        // ユーザー更新
        UserService::updateUser($request);
        // セッションのURLかデフォルトのユーザー一覧に遷移
        if (session('previous_url')) {
            return redirect(session('previous_url'));
        } else {
            return redirect()->route('user.index');
        }
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
        // セッションのURLかデフォルトのユーザー一覧に遷移
        if (session('previous_url')) {
            return redirect(session('previous_url'));
        } else {
            return redirect()->route('user.index');
        }
    }
}
