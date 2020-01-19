<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Suports\Common;

use App\Suports\Upload\Uploader;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

trait Helper
{

    public $slug_fixed = false;

    protected function slug(&$input)
    {

        if (!$this->slug_fixed) {

            if (isset($input[Options::DEFAULT_COLUMN_SLUG])) {

                if (isset($input[Options::DEFAULT_COLUMN_SLUG_ORIGEM])) {

                    $input[Options::DEFAULT_COLUMN_SLUG] = Str::slug($input[Options::DEFAULT_COLUMN_SLUG_ORIGEM]);
                }
            }
        }

        return $input;
    }

    protected function convert_date(&$input)
    {

        if (!isset($input['id'])) {

            $input['created_at'] = date("Y-m-d H:i:s");
            $input['updated_at'] = date("Y-m-d H:i:s");
        } else {
            unset($input['created_at']);
            $input['updated_at'] = date("Y-m-d H:i:s");
        }

        return $input;
    }

    protected function convert_password(&$input)
    {

        if (isset($input['password']) && !empty($input['password'])) {

            $input['password'] = Hash::make($input['password']);

            return $input;
        }

        unset($input['password']);

        return $input;
    }


    protected function initCover(&$input)
    {

        if (!isset($input[Options::DEFAULT_COLUMN_COVER])) {

            return $input;

        }

        $image = $input[Options::DEFAULT_COLUMN_COVER];

        array_push($this->fillable,'company_id','uuid');

        $file = new \Intervention\Image\File();

        $info = $file->setFileInfoFromPath($image);

        $remove = sprintf("%s://%s",request()->getScheme(),request()->getHost());

        $fileName = Str::replaceFirst($remove,'',$info->basePath());

        $dirName = Str::replaceFirst($remove,'',$info->dirname);

        $data = [
            'company_id'=>get_tenant_id(),
            'uuid'=>\Str::uuid(),
            'name'=>$info->filename,
            'mime'=>$info->mime,
            'size'=>$info->filesize(),
            'path'=>$dirName
        ];

        /**
         * @var $fileExist MorphOne
         */
        $fileExist = $this->model->image();

        if($fileExist->first()):
            $fileExist->update($data);
        else:
            $fileExist->create($data);
        endif;

        return $input;
    }

    protected function initFile(&$input)
    {

        if (!isset($input[Options::DEFAULT_COLUMN_FILE])) {

            return $input;

        }
        if (is_string($input[Options::DEFAULT_COLUMN_FILE])) {

            return $input;

        }
        if (!request()->hasFile(Options::DEFAULT_COLUMN_FILE) && !request()->file(Options::DEFAULT_COLUMN_FILE)->isValid()) {

            return $input;

        }
        $image = $input[Options::DEFAULT_COLUMN_FILE];

        Uploader::upload( $image, $this->model);

        return  $input;
    }

    protected function initAvatar(&$input)
    {

        if (!isset($input[Options::DEFAULT_COLUMN_AVATAR])) {

            return $input;

        }
        if (is_string($input[Options::DEFAULT_COLUMN_FILE])) {

            return $input;

        }
        if (!request()->hasFile(Options::DEFAULT_COLUMN_AVATAR) && !request()->file(Options::DEFAULT_COLUMN_AVATAR)->isValid()) {

            return $input;

        }
        $image = $input[Options::DEFAULT_COLUMN_AVATAR];

        Uploader::upload( $image, $this->model);

        return  $input;
       // return $this->upload($input, $image);
    }

    private function upload(&$input,UploadedFile  $image)
    {


        array_push($this->fillable,'company_id','uuid');

        $date = Str::slug(date("Y|m"));

        $extension = $image->clientExtension();

        $original = explode('.', $image->getClientOriginalName());

        $name = sprintf("%s-%s-%s.%s", rand(),time(),Str::slug(reset($original)), $extension);

        $result = $image->storePubliclyAs(sprintf("%s/%s",$this->getTable(), $date),$name);

        $data = [
            'company_id'=>get_tenant_id(),
            'uuid'=>\Str::uuid(),
            'name'=>$name,
            'fullPath'=>sprintf("storage/%s",$result),
            'dir'=>'/dist/upload/images',
            'fileType'=>$image->getMimeType(),
            'ext'=>$image->getExtension(),
            'size'=>$image->getSize()
        ];

        /**
         * @var $fileExist MorphOne
         */
        $fileExist = $this->model->file();

        if($fileExist->first()):
            $fileExist->update($data);
        else:
            $fileExist->create($data);
        endif;

        return $input;
    }

    protected function initTags(&$input)
    {

        if (!isset($input['tag'])) {

            return $input;

        }

        //REMOVE TODAS AS TAGS
        $this->model->untag();
        //CADASTARS AS NOVAS
        $this->model->tag($input['tag']);

        return $input;
    }


    protected function initMenuss(&$input)
    {
        if (!isset($input['submenus'])) {

            return $input;

        }

        //ADD PERMISSIONS
        $this->model->submenus()->sync($input['submenus']);

        return $input;
    }

    protected function initPermissions(&$input)
    {
        if (!isset($input['privilege'])) {

            return $input;

        }

        //ADD PERMISSIONS
        $this->model->permissions()->sync($input['privilege']);

        return $input;
    }

    protected function initRoles(&$input)
    {
        if (!isset($input['role'])) {

            return $input;

        }
         //REMOVE TODAS AS TAGS
        $this->model->roles()->sync($input['role']);

        return $input;
    }

    protected function initTasks(&$input)
    {


        $data = $input;

        unset($data['id']);

        foreach ($data as $key => $value) {

            if(Str::contains($key,"tasks")){

                $task = array_filter($value);

                if($task):
                    array_push($this->fillable,'company_id','uuid');
                    /**
                     * @var $fileExist MorphOne
                     */
                    $tasksExist = $this->model->tasks();

                    if($current = $tasksExist->where('name',$task['name'])->first()):
                        $tasksExist->update(array_merge($current->toArray(),$task));
                    else:
                        $tasksExist->create($task);
                    endif;
                endif;

            }
        }


        return $input;
    }


    protected function initCategorizable(&$input)
    {
        if (!isset($input['categories'])) {

            return $input;

        }

        if (isset($input['id'])) {

            //UPDATE AT CATEGORIA
            $this->model->recategorize($input['categories']);

            return $input;
        }

        //CADASTARS AS NOVAS
        $this->model->categorize($input['categories']);

        return $input;
    }


    protected function initCategory(&$input)
    {
        if (!isset($input['category'])) {

            return $input;

        }
        //REMOVE TODAS AS TAGS
        $this->model->categories()->sync($input['category']);

        return $input;
    }
    protected function initVideozable(&$input)
    {
        if (!isset($input['video'])) {

            return $input;

        }

        if (isset($input['id'])) {

            //UPDATE AT VIDEO
            $this->model->revideoze($input['video']);

            return $input;
        }

        //CADASTARS AS NOVOS
        $this->model->videoze($input['video']);

        return $input;
    }

    protected function initAddress(&$input)
    {

        if (!isset($input['address'])) {

            return $input;

        }

        $data = $input;

        unset($data['id']);

        array_push($this->fillable,'company_id','uuid');
        /**
         * @var $fileExist MorphOne
         */
        $addressExist = $this->model->address();

        $data = $input['address'];

        if($addressExist->first()):
            $current = $addressExist->first()->toArray();
            $addressExist->update(array_merge($current,$data));
        else:
            $addressExist->create($data);
        endif;

        return $input;
    }


    public function initArray(&$input)
    {

        if ($input) :

            foreach ($input as $key => $value) :

                if (is_array($value)) :

                    if (!in_array($key, ['tags'])) :

                        //$input[$key] = json_encode($value);

                    endif;

                endif;

            endforeach;

        endif;

        return $input;
    }


    protected $titile = 'Lista de Company';

    protected $messages =  'Operação finalizada com sucesso!!';

    /**
     * @return array
     */
    public function getMessage(): string
    {
        return $this->messages;
    }
}
