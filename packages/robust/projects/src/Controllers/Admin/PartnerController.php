<?php
namespace Robust\Projects\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Robust\Core\Controllers\Admin\Traits\CrudTrait;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;
use Robust\Core\Repositories\Traits\CommonRepositoryTrait;
use Robust\Projects\Repositories\PartnerRepository;

class PartnerController extends Controller
{
    use CrudTrait, ViewTrait;

    public function __construct(
        Request $request,
        PartnerRepository $project
    )
    {
        $this->model = $project;
        $this->request = $request;
        $this->ui = 'Robust\Projects\UI\Partner';
        $this->package_name = 'projects';
        $this->view = 'admin.partners';
        $this->title = 'Partners';
        $this->table = 'core::admin.layouts.sub-layouts.list';
        $this->ajax_view = 'admin.ajax.partners';
    }

}
