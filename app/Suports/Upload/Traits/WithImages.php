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
use App\Suports\Upload\Image;

trait WithImages
{
    use Helpers;

    public static function bootWithImages(): void
    {
        static::deleted(function ($model) {
            $model->images->each(function ($image) {
                $image->delete();
            });
        });
    }
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'uploadable')->whereNull('extra')->latest('id');
    }
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'uploadable');
    }
    public function bindImage(File $image, $extra = null): self
    {
        return $this->bindUpload($image, $extra);
    }
}
