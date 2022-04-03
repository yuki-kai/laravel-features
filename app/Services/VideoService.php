<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        // DB::listen(function ($query) { Log::info("Query Time:{$query->time}s] $query->sql"); });

        // 動画パス取得
            // ファイル名が重複していれば連番を生成
            $video = self::renameFileNameIfConflict($request->file('video')->getClientOriginalName());
            Storage::putFileAs('public/videos', $request->file('video'), $video);
            $video_path = Storage::disk('local')->url('public/videos/'.$video);

        // サムネイルパス取得 サムネイルが選択されていなければ自動生成
            if ($request->file('thumb')) {
                $thumb = self::renameFileNameIfConflict($request->file('thumb')->getClientOriginalName());
                Storage::putFileAs('public/thumbnails', $request->file('thumb'), $thumb);
                $thumb_path = Storage::disk('local')->url('public/thumbnails/'.$thumb);
            } else {
                list($fileName, $fileData) = self::base64ToFile($request->auto_thumb);
                Storage::put('public/thumbnails/'.$fileName, $fileData, 'public');
                $thumb_path = Storage::disk('local')->url('public/thumbnails/'.$fileName);
            }

        $video = new Video();
        $video->create([
            'title'      => $request->title,
            'video_path' => $video_path,
            'thumb_path' => $thumb_path,
        ]);
        return response()->json($request, 200);
    }

    /**
     * ファイル名重複時のファイル名に連番の付加処理
     *
     * @param
     */
    public static function renameFileNameIfConflict($file_name)
    {
        // ファイルが画像か動画かによってパスを変える
        $file_extension = self::isImgOrVideo($file_name);
        $path = ($file_extension === 'video' ? 'videos/' : 'thumbnails/');

        if (Storage::disk('public')->exists($path.$file_name)) {
            // ファイル名を拡張子と分離
            $only_name = substr($file_name, 0, strrpos($file_name, '.'));
            $extension = substr($file_name, strrpos($file_name, '.'));
            $i = 1;
            while (Storage::disk('public')->exists($path.$file_name)) {
                $file_name = $only_name .'_'. $i . $extension;
                $i++;
            }
            return $file_name;
        } else {
            return $file_name;
        }
    }

    /**
     * ファイルが画像か動画か判定
     *
     * @param 動画か画像file
     */
    public static function isImgOrVideo($file)
    {
        $image_extension = '/\.gif$|\.png$|\.jpg$|\.jpeg$|\.bmp$|\.svg$/i';
        // ファイルが画像ファイルだった場合
        if (preg_match($image_extension, $file)) {
            return 'image';
        }
        $video_extension = '/\.mp4$|\.mov$|\.wmv$|\.mpg$|\.mkv$|\.avi$/i';
        // ファイルが動画ファイルだった場合
        if (preg_match($video_extension, $file)){
            return 'video';
        }
        return 'image'; // デフォルトはimageを返す
    }

    /**
     * ファイル名重複時のファイル名に連番の付加処理
     *
     * @param
     */
    public static function base64ToFile($base64)
    {
        // "date:"と"base64,"で区切る
        list($fileInfo, $fileData) = explode(';', $base64);
        // 拡張子を取得
        $extension = explode('/', $fileInfo)[1];
        // $fileDataにある"base64,"を削除する
        list(, $fileData) = explode(',', $fileData);
        // base64をデコード
        $fileData = base64_decode($fileData);
        // ランダムなファイル名生成
        $fileName = Str::random(10). ".$extension";
        return [$fileName, $fileData];
    }

}
