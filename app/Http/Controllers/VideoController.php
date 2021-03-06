<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Video;
use App\Services\VideoService;

class VideoController extends Controller
{
    /**
     * 動画一覧画面
     *
     * @return view
     */
    public function index(Request $request)
    {
        $videos = Video::sortable()->get();
        
        return view('video.index', compact('videos'));
    }

    /**
     * 動画登録画面
     *
     * @return view
     */
    public function create()
    {
        return view('video.create');
    }

    /**
     * 動画登録 (非同期処理)
     *
     * @return view
     */
    public function store(Request $request)
    {
        return VideoService::storeVideo($request);
    }
}
