<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Suports\Upload;


use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Uploader
{
    const IMAGE_MIME_TYPES = [
        'image/gif',
        'image/jpeg',
        'image/jpg',
        'image/png'
    ];
    public static function upload($file, $model=null)
    {

        $name = $file->getClientOriginalName();
        $mime = $file->getMimeType();
        $size = $file->getSize();
        switch (true) {
            case in_array($mime, static::IMAGE_MIME_TYPES):
                $type = 'image';
                $class =  $model->image();
                break;
            default:
                $type = 'file';
                $class =  $model->file();
                break;
        }
        $path = $file->store(Str::plural($type));

        foreach (Config::get("upload.plugins.{$type}", []) as $plugin) {
            $storagePath = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix();

            $fullPath = $storagePath . DIRECTORY_SEPARATOR . $path;

            (new $plugin)->handle($fullPath);
        }

        $path = sprintf("storage/%s", $path);

        if($class->first()):
            return $class->update(compact('name', 'mime', 'size', 'path'));
        else:
            return $class->create(compact('name', 'mime', 'size', 'path'));
        endif;
    }

    public static function simpleUpload($file)
    {

        $name = $file->getClientOriginalName();
        $mime = $file->getMimeType();
        $size = $file->getSize();
        switch (true) {
            case in_array($mime, static::IMAGE_MIME_TYPES):
                $type = 'image';
                $class =  Image::class;
                break;
            default:
                $type = 'file';
                $class =  File::class;
                break;
        }
        $path = $file->store(Str::plural($type));

        foreach (Config::get("upload.plugins.{$type}", []) as $plugin) {
            $storagePath = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix();

            $fullPath = $storagePath . DIRECTORY_SEPARATOR . $path;

            (new $plugin)->handle($fullPath);
        }

        $path = sprintf("/storage/%s", $path);

         $class::create(compact('name', 'mime', 'size', 'path'));

        return [
            'default'=>$path
        ];

    }
}
