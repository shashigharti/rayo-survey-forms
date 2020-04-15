<?php
namespace Robust\Core\Controllers\Admin;
use Illuminate\Http\Request;
use Robust\Core\Controllers\Common\Traits\CrudTrait;
use Robust\Core\Controllers\Common\Traits\ViewTrait;
use Robust\Core\Repositories\Admin\WidgetRepository;
/**
 * Class WidgetController
 * @package Robust\Core\Controllers
 */
class WidgetController extends Controller
{
    use CrudTrait, ViewTrait;
    /**
     * WidgetController constructor.
     * @param Request $request
     * @param WidgetRepository $widget
     */
    public function __construct(
        Request $request,
        WidgetRepository $widget
    ) {
        $this->model = $widget;
        $this->request = $request;
        $this->ui = 'Robust\Core\UI\Widget';
        $this->package_name = 'core';
        $this->view = 'admin.widgets';
        $this->ajax_view = 'admin.ajax.widgets';
        $this->title = 'Widgets';
        $this->previous_url = url()->previous();
    }
}