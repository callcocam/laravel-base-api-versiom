<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Suports\Upload;


class Image extends File
{
    protected $table = 'files';
    protected $appends = ['thumb'];
    public function getThumbAttribute(): array
    {
        return collect(['s', 'm', 'l'])->flip()->map(function ($_, $size) {
            return URL::to(preg_replace('/^(images\/)/', "\$1{$size}/", $this->attributes['path']));
        })->toArray();
    }
}
