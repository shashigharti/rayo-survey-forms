<?php
namespace Robust\Admin\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Robust\Admin\Repositories\Admin\UserRepository;
use Robust\Core\Controllers\API\Traits\CrudTrait;


/**
 * Class UserController
 * @package Robust\Admin\Controllers\API
 */
class UserController extends Controller
{
    use CrudTrait;


    /**
     * UserController constructor.
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->model = $user;
    }


}
