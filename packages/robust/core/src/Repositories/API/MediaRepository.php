<?php

namespace Robust\Core\Repositories\API;

use Illuminate\Database\Eloquent\Collection;
use Robust\Core\Models\Media;
use Robust\Core\Repositories\Common\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Common\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Common\Traits\SearchRepositoryTrait;


/**
 * Class MediaRepository
 * @package Robust\Core\Repositories
 */
class MediaRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;

    /**
     * @var array
     */
    public $mimes = [
        'image' => 'png,jpg,jpeg,gif,JPG',
        'doc' => 'doc,docx',
        'pdf' => 'pdf'
    ];

    /**
     * MediaRepository constructor.
     * @param Media $model
     */
    public function __construct(Media $model)
    {
        $this->model = $model;
    }

}
