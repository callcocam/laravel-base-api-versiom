<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers;


use App\Suports\Upload\Uploader;
use Illuminate\Http\Request;

class EditorController extends AbstractController
{

    public function __invoke(Request $request)
    {
        return Uploader::simpleUpload($request->file('upload'));
    }

}
