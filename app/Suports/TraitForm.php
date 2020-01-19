<?php


namespace App\Suports;


use Illuminate\Support\Str;

trait TraitForm
{

    protected $value;
    protected $elements = [];
    protected $attrs = [
        "class" => "form-control",
        "type" => "text"
    ];

    abstract public function initForm($data = []);

    public function render($data){

       $this->addMessage();

        if($data){

            foreach ($data as $key => $value) {

                if(isset($this->elements[$key])){
                    $this->elements[$key]['value'] = $value;
                    $this->elements[$key]['staticValue'] = $value;
                }

            }
        }
        return $this->elements;

    }
    /**
     * @param $name
     * @param array $attributes
     * @return TraitForm
     */
    protected function add($name, $attributes = []){

        $attributes['name'] = $name;

        $this->elements[$name] = array_merge($this->attrs, $attributes);

        return $this;
    }

    /**
     * @return string
     */
    protected function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    protected function setValue(string $value): void
    {
        $this->value = $value;
    }

    protected function addFile($name, $attributes = []){

        $attributes['type'] = 'file';

        return $this->add($name, $attributes);
    }

    protected function addHiden($name, $attributes = []){

        $attributes['type'] = 'hidden';

        return $this->add($name, $attributes);
    }

    protected function addSeparator($attributes = []){

        $attributes['type'] = 'separator';

        return $this->add(Str::random(), $attributes);
    }

    protected function addMessage( $attributes = []){

        $attributes['value'] = $this->getMessage();

        unset($this->attrs['type']);

        return $this->add("message", $attributes);
    }

}
