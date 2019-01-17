<?php
namespace Robust\Admin\Controllers\Admin\API;

use Illuminate\Support\Facades\DB;
use Robust\Admin\Models\User;
use Robust\Core\Controllers\Admin\Controller;
use Robust\Core\Controllers\API\Traits\CrudTrait;

/**
 * Class UserController
 * @package Robust\Admin\Controllers\Admin\API
 */
class UserController extends Controller
{

   
    /**
     * @return string
     */
    public function getAllOrganizations()
    {
        $orgs = User::select(\DB::raw('organization as id, organization as name'))->get();
        return json_encode($orgs);
    }

    /**
     * @return string
     */
    public function getAllDepartments()
    {
        $orgs = User::select(\DB::raw('department as id, department as name'))->get();
        return json_encode($orgs);
    }

}
