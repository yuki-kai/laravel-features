<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SearchService;

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
}
