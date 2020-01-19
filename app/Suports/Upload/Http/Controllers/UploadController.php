<?php


namespace App\Suports\Upload\Http\Controllers;


use App\Http\Controllers\AbstractController;
use App\Suports\Upload\File;
use App\Suports\Upload\Uploader;
use Illuminate\Http\Request;

class UploadController extends AbstractController
{
    public function store(Request $request)
    {
        return Uploader::upload(array_first($request->file()));
    }

    public function destroy(File $file)
    {
        $file->remove();
        return ['success' => true];
    }
}
