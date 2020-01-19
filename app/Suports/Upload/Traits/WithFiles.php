<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Suports\Upload\Traits;


use App\Suports\Upload\File;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait WithFiles
{
    use Helpers;

    public static function bootWithFiles(): void
    {
        static::deleted(function ($model) {
            $model->files->each(function ($file) {
                $file->delete();
            });
        });
    }
    public function file(): MorphOne
    {
        return $this->morphOne(File::class, 'uploadable')->latest('id');
    }
    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'uploadable');
    }
    public function bindFile(File $file, $extra = null): self
    {
        return $this->bindUpload($file, $extra);
    }
}
