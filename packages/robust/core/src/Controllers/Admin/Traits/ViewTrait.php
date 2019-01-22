<?php
namespace Robust\Core\Controllers\Admin\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Robust\Core\Helpers\MenuHelper;

/**
 * Class ViewTrait
 * @package Robust\Core\Controllers\Admin\Traits
 */
trait ViewTrait
{
    /**
     * @param $view
     * @param $data
     * @return $this
     */
    public function display($view, $data)
    {
        $data['ui'] = (isset($data['ui'])) ? $data['ui'] : $this->ui;
        $data['title'] = (isset($data['title'])) ? $data['title'] : ((isset($this->title)) ? $this->title : '');
        $data['package'] = (isset($data['package'])) ? $data['package'] : ((isset($this->package_name)) ? $this->package_name : '');
        $data['current_view'] = (isset($data['view'])) ? $data['view'] : ((isset($this->view)) ? $this->view : '');

        return view($view, $data);
    }

    /**
     * @param Collection $collection
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function customPagination(Collection $collection, $perPage = 0)
    {
        if ($perPage == 0 && settings('app-setting', 'pagination'))
            $perPage = settings('app-setting', 'pagination');
        return new LengthAwarePaginator($collection->forPage(Paginator::resolveCurrentPage(), $perPage), $collection->count(), $perPage, Paginator::resolveCurrentPage(), ['path' => Paginator::resolveCurrentPath()]);
    }

}
