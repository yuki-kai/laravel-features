<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Video;

class VideoController extends Controller
{
    /**
     * 動画一覧画面
     *
     * @return view
     */
    public function index(Request $request)
    {
        return view('video.index');
    }

    /**
     * 動画作成画面
     *
     * @return view
     */
    public function create()
    {
        return view('video.create');
    }
}