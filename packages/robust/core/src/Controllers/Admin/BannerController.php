<?php


namespace Robust\Core\Controllers\Admin;


use Robust\Core\Controllers\Common\Traits\CrudTrait;
use Robust\Core\Controllers\Common\Traits\ViewTrait;
use Robust\Core\Repositories\Admin\BannerRepository;

/**
 * Class BannerController
 * @package Robust\Core\Controllers\Admin
 */
class BannerController extends Controller
{
    use CrudTrait,ViewTrait;

    /**
     * @var BannerRepository
     */
    protected $model;

    /**
     * BannerController constructor.
     * @param BannerRepository $model
     */
    public function __construct(BannerRepository $model)
    {

        $this->middleware('auth');
        $this->model = $model;
        $this->ui = 'Robust\Core\UI\Banner';
        $this->package_name = 'core';
        $this->view = 'admin.banners';
        $this->title = 'Banners';
    }
}
