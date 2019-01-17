<?php

namespace Robust\Core\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Intervention\Image\Facades\Image;
use Robust\Core\Models\Media;
use Robust\Core\Repositories\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Traits\SearchRepositoryTrait;


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

    /**
     * @param $uploads
     * @return Collection
     */
    public function store($uploads)
    {
        $collection = new Collection();
        foreach ($uploads as $upload) {
            $file_name = \Carbon\Carbon::now()->timestamp . '.' . $this->cleanName($upload->getClientOriginalName());
            $extension = $upload->getClientOriginalExtension();
            $name = $this->cleanName($upload->getClientOriginalName());
            $type = $this->getTypeByExtension($upload->getClientOriginalExtension());
            $model = $this->model->create([
                'name' => $name,
                'slug' => $name,
                'extension' => $extension,
                'type' => $type,
                'file' => $file_name
            ]);

            $collection->push($model);
            $upload->move(storage_path() . '/uploads/' . $model->id . '/', $file_name);

        }
        return $collection;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function cleanName($name)
    {
        return preg_replace('/[^0-9a-zA-Z-_.]/', '', $name);
    }

    /**
     * @param $mime
     * @return int|string
     */
    public function getTypeByExtension($mime)
    {

        foreach ($this->mimes as $key => $each) {
            if (in_array($mime, explode(',', $each))) {
                return $key;
            }
        }
    }

}
