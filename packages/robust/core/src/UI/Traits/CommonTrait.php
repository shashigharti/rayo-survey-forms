<?php

namespace Robust\Core\UI\Traits;


    /**
     * Class CommonTrait
     * @package Robust\Core\UI\Traits
     */
/**
 * Class CommonTrait
 * @package Robust\Core\UI\Traits
 */
trait CommonTrait
{

    /**
     * @param $model
     * @return array
     */
    public function getRoute($model)
    {
        return $model->exists ? ["admin.{$this->route_name}.update", $model->id] : ["admin.{$this->route_name}.store"];
    }

    /**
     * @param $model
     * @return string
     */
    public function getMethod($model)
    {
        return $model->exists ? 'PUT' : 'POST';
    }

    /**
     * @return array
     */
    public function getSubmitText()
    {
        return 'Save';
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return '';
    }

    /**
     * @param $model
     * @return array
     */
    public function getTabs($model)
    {
        return [];
    }


    /**
     * @return string
     */
    public function getSearchURL()
    {
        return "admin.{$this->route_name}.index";
    }


    /**
     * @return string
     */
    public function getSearchable()
    {
        $class = $this->getModel();
        $model = new $class;
        return isset($model) ?  array_combine($model->searchable, $model->searchable): [];
    }
}




