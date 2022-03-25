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

        return redirect()->route('user.index');
    }
}
