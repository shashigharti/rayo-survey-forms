<?php


namespace Robust\Core\Helpers;
use Robust\Core\Models\Banner;

/**
 * Class BannerHelper
 * @package Robust\Core\Helpers
 */
class BannerHelper
{
    /**
     * @var Banner
     */
    private $model;

    /**
     * BannerHelper constructor.
     * @param Banner $model
     */
    public function __construct(Banner $model)
    {
        $this->model =$model;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->model->get();
    }

    /**
     * @param $types
     * @return mixed
     */
    public function getBannersByType($types)
    {
        return $this->model->whereIn('template', $types)
            ->get()
            ->sortBy('order')
            ->values()
            ->all();
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function getBannersBySlug($slug)
    {
        return $this->model->where('slug', $slug)
            ->first();
    }

    /**
     * @param $banners
     * @param $sort_by_array
     * @return array|\Illuminate\Support\Collection
     */
    public function sortBannersByArray($banners, $sort_by_array)
    {
        $banners_new = $banners;

        if (count($sort_by_array) > 0) {
            $banners_new = [];
            foreach ($banners as $banner) {
                if (in_array($banner->id, $sort_by_array)) {
                    $id = array_search($banner->id, $sort_by_array);
                    $banners_new[$id] = $banner;
                }
            }
            //push new banners at the end
            foreach ($banners as $banner) {
                if (!in_array($banner->id, $sort_by_array)) {
                    array_push($banners_new,$banner);
                }
            }
            ksort($banners_new);
            $banners_new = collect($banners_new);
        }
        return $banners_new;
    }
}
