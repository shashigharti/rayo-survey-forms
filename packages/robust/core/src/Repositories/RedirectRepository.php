<?php

namespace Robust\Core\Repositories;

use Robust\Core\Models\Redirect;
use Robust\Core\Repositories\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Traits\SearchRepositoryTrait;


class RedirectRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;

    public function __construct(Redirect $model)
    {
        $this->model = $model;
    }
}
