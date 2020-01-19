<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers;


use App\Http\Requests\TranslationRequest;
use Illuminate\Filesystem\Filesystem;

class TranslationController extends AbstractController
{

    private $fileSystem;

    public function __construct(Filesystem $fileSystem)
    {

        $this->fileSystem = $fileSystem;

        if(!$this->fileSystem->exists(resource_path(sprintf("lang/%s.json", config('app.locale'))))){
            $this->fileSystem->put(resource_path(sprintf("lang/%s.json", config('app.locale'))),json_encode(["Welcome"=>"Seja Bem Vindo"]));
        }

    }

    public function index(){

        $sources = json_decode($this->fileSystem->get(resource_path(sprintf("lang/%s.json", config('app.locale')))),true);

        return response()->json($this->getTranslation($sources));

    }

    public function store(TranslationRequest $request){

        $sources = json_decode($this->fileSystem->get(resource_path(sprintf("lang/%s.json", config('app.locale')))),true);

        $key = request()->get("key");

        $value = request()->get("value");

        if(\Illuminate\Support\Arr::exists($sources,$key)){
            $sources[$key] = $value;
            $this->fileSystem->put(resource_path(sprintf("lang/%s.json", config('app.locale'))),json_encode($sources));
            $sources = json_decode($this->fileSystem->get(resource_path(sprintf("lang/%s.json", config('app.locale')))),true);
            $data = $this->getTranslation($sources);
            $data["message"] = sprintf("Tradução [ %s ] atualizada com sucesso!!", $key);
        }
        else{
            $this->fileSystem->put(resource_path(sprintf("lang/%s.json", config('app.locale'))),json_encode(\Illuminate\Support\Arr::add($sources,$key,$value)));
            $sources = json_decode($this->fileSystem->get(resource_path(sprintf("lang/%s.json", config('app.locale')))),true);
            $data = $this->getTranslation($sources);
            $data["message"] = sprintf("Tradução [ %s ] gerada com sucesso!!", $key);
        }

        $data = $this->getTranslation($sources);
        $data["message"] = sprintf("erro ao tentar traduzir [ %s ]!!", $key);

        return response()->json($data);
    }

    public function delete( $id ){

        $sources = json_decode($this->fileSystem->get(resource_path(sprintf("lang/%s.json", config('app.locale')))),true);


        if(\Illuminate\Support\Arr::exists($sources,$id)){
            if(isset($sources[$id])){
                unset($sources[$id]);
            }
            $this->fileSystem->put(resource_path(sprintf("lang/%s.json", config('app.locale'))),json_encode($sources));
            $data = $this->getTranslation($sources);
            $data["message"] = sprintf("Tradução [ %s ] excluida com sucesso!!", $id);
            return response()->json($data);
        }

        $data = $this->getTranslation($sources);
        $data["message"] = sprintf("erro ao tentar excluir [ %s ]!!", $id);

        return response()->json($data);
    }

    private function getTranslation($sources){

        $data = [];

        if($sources){

            foreach ($sources as $key => $source) {

                if($key){
                    $data[]=[

                        'key'=>$key,
                        "value"=>$source

                    ];
                }
            }
        }

        return $data;
    }

}
