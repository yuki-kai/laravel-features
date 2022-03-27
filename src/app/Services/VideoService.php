<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Video;
use Illuminate\Pagination\LengthAwarePaginator;

class VideoService
{
    /**
     * 動画登録処理
     *
     * @param
     */
    public static function storeVideo($request)
    {
        // 発行されるSQL文をログに吐く
        // DB::listen(function ($query) {
        //     Log::info("Query Time:{$query->time}s] $query->sql");
        // });

        // 動画パス取得
            // ファイル名が重複していれば連番を生成
            $video = self::renameFileNameIfConflict($request->file('video')->getClientOriginalName());
            $video_url = $request->video->storeAs('videos', $video, 'public');
            $video_path = Storage::disk('public')->url($video_url);

        // サムネイルパス取得
            // $thumb = self::renameFileNameIfConflict($request->file('thumb')->getClientOriginalName());
            // $thumb_url = $request->thumb->storeAs('thumbnails', $thumb, 'public');
            // $thumb_path = Storage::disk('public')->url($thumb_url);

        $video = new Video();
        $video->create([
            'title'      => $request->title,
            'video_path' => $video_path,
            'thumb_path' => $request->thumb_path,
        ]);
        return $request;
    }

    /**
     * ファイル名重複時のファイル名に連番の付加処理
     *
     * @param
     */
    public static function renameFileNameIfConflict($file_name)
    {


        if (Storage::disk('public')->exists('videos/'.$file_name)) {
            // ファイル名を拡張子と分離
            $only_name = substr($file_name, 0, strrpos($file_name, '.'));
            $extension = substr($file_name, strrpos($file_name, '.'));
            $i = 1;
            while (Storage::disk('public')->exists('videos/'.$file_name)) {
                $file_name = $only_name .'_'. $i . $extension;
                $i++;
            }
            return $file_name;
        } else {
            return $file_name;
        }
    }

}
