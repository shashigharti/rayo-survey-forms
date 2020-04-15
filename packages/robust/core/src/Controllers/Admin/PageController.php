<?php


namespace Robust\Core\Controllers\Admin;


use Robust\Core\Controllers\Common\Traits\CrudTrait;
use Robust\Core\Controllers\Common\Traits\ViewTrait;
use Robust\Core\Repositories\Admin\PageRepository;


/**
 * Class PageController
 * @package Robust\Core\Controllers\Admin
 */
class PageController extends Controller
{
    use CrudTrait,ViewTrait;


    /**
     * @var PageRepository
     */
    protected $model;


    /**
     * PageController constructor.
     * @param PageRepository $model
     */
    public function __construct(PageRepository $model)
    {

        $this->middleware('auth');
        $this->model = $model;
        $this->ui = 'Robust\Core\UI\Page';
        $this->package_name = 'core';
        $this->view = 'admin.pages';
        $this->title = 'Pages';
    }
}
