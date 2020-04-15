<?php
namespace Robust\Core\Controllers\Admin;

use App\Http\Controllers\Controller;
use Robust\Admin\Repositories\Admin\PermissionRepository;
use Robust\Core\Controllers\Common\Traits\CrudTrait;

/**
 * Class PermissionController
 * @package Robust\Admin\Controllers\Admin
 */
class PermissionController extends Controller
{
    use CrudTrait;

    /**
     * PermissionController constructor.
     * @param PermissionRepository $permission
     */
    public function __construct(PermissionRepository $permission)
    {
        $this->middleware('auth');
        $this->roles = $permission;
    }

}
