<?php

namespace Robust\Core\Controllers\Website\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

trait ViewTrait
{
    public function customPagination(Collection $collection, $perPage = 0)
    {
        if ($perPage == 0 && settings('app-setting', 'pagination'))
            $perPage = settings('app-setting', 'pagination');
        return new LengthAwarePaginator($collection->forPage(Paginator::resolveCurrentPage(), $perPage), $collection->count(), $perPage, Paginator::resolveCurrentPage(), ['path' => Paginator::resolveCurrentPath()]);
    }
}