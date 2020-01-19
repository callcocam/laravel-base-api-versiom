<?php


namespace App\Suports\Common;


class Header
{
    private $actions = [];
    private $name;
    private $label;
    private $visible = false;
    private $variant=null;
    private $sortable = false;
    private $format = "text";
    private $width;


    /**
     * Header constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $format
     * @return Header
     */
    public function setFormat(string $format): Header
    {
        $this->format = $format;
        return $this;
    }

    /**
     * @param bool $sortable
     * @return Header
     */
    public function setSortable(bool $sortable): Header
    {
        $this->sortable = $sortable;
        return $this;
    }

    /**
     * @param null $variant
     * @return Header
     */
    public function setVariant($variant)
    {
        $this->variant = $variant;
        return $this;
    }

    /**
     * @param bool $visible
     * @return Header
     */
    public function setVisible(bool $visible): Header
    {
        $this->visible = $visible;
        return $this;
    }

    /**
     * @param mixed $label
     * @return Header
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @param mixed $width
     * @return Header
     */
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }

    public function addActions($route, $array = []){

        $buttons[] = [
            'to'=>[
                'name'=>sprintf("api.admin.%s.edit", $route)
            ],
            'variant'=>'outline-success',
            'visible'=>$this->visible,
        ];

        $buttons[] = [
            'to'=>[
                'name'=>sprintf("api.admin.%s.delete", $route)
            ],
            'variant'=>'outline-danger',
            'visible'=>$this->visible,
        ];
        return [$this->name=>array_merge($buttons, $array)];
    }

    public function render(){


        return [$this->name=>array_filter([
            'label'=>$this->label,
            'key'=>$this->name,
            'visible'=>$this->visible,
            'variant'=>$this->variant,
            'sortable'=>$this->sortable,
            'format'=>$this->format,
            'width'=>$this->width,
        ])];
    }




}
