<?php
namespace Robust\Core\Repositories\Admin;
use Robust\Core\Repositories\Common\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Common\Traits\SearchRepositoryTrait;

/**
 * Class GroupRepository
 * @package Robust\DynamicForms\Repositories
 */
class SearchRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait;

    /**
     * @param $data
     * @return mixed
     */
    public function search($data)
    {
        $keyword = $data['keyword'];
        $model = $this->getModel($data['model']);
        $searchable = $model->searchable;
        $query = $model->select("*");
        foreach ($searchable as $key => $each) {
            $query->orwhere($each, 'like', '%' . $keyword . '%');
        }
        $data = $query->paginate(10000);
        return $data;
    }

    /**
     * @param $model
     * @return mixed
     */
    public function getModel($model)
    {
        return (new $model);
    }

    /**
     * @param $model
     * @return mixed
     */
    public function getPackageName($model)
    {
        $model = new $model;
        return $model->getPackageName();
    }

    /**
     * @param $model
     * @return mixed
     */
    public function getUI($model)
    {
        $model = new $model;
        return $model->getUI();
    }
}

