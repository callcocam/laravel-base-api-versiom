<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Suports\Upload\Plugins;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;
use Intervention\Image\Facades\Image;

class ImagePlugin
{
    public function handle($path)
    {
        $image = Image::make($path);
        if (Config::get('upload.use_image_orientate', false)) {
            $image->orientate();
        }
        $image->save($path, 100);
        foreach (Config::get('upload.thumbs', []) as $name => $size) {
            $img = clone $image;
            [$width, $height] = explode('x', $size);
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($this->getThumbFilePath($img, $name), 100);
        }
    }
    public function getThumbsDirectory($baseDir, $name)
    {
        $directory = $baseDir . DIRECTORY_SEPARATOR . $name . DIRECTORY_SEPARATOR;
        if (!File::exists($directory)) {
            File::makeDirectory($directory);
        }
        return $directory;
    }
    public function getThumbFilePath($image, $name)
    {
        return $this->getThumbsDirectory($image->dirname, $name) .
            $image->filename .
            '.' .
            $image->extension;
    }
}
