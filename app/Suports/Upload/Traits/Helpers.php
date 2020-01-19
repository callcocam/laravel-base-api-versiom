<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Suports\Upload\Traits;


use App\Suports\Upload\File;

trait Helpers
{
    protected function bindUpload(File $file, $extra = null): self
    {
        if ($extra) {
            $file->extra = $extra;
        }
        $file->uploadable()->associate($this)->save();
        return $this;
    }
}
