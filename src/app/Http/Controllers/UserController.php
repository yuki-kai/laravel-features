<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * ユーザ一覧画面
     *
     * @return view
     */
    public function index()
    {
        return view('user.index');
    }
}
