<?php
namespace Robust\Admin\Controllers\Admin;

use Robust\Admin\Repositories\Admin\UserRepository;
use Robust\Core\Controllers\Admin\Controller;
use Robust\Core\Controllers\Admin\Traits\CrudTrait;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;
use Robust\Core\Helpers\MenuHelper;
use Robust\Core\Repositories\Traits\CommonRepositoryTrait;
use Robust\Core\Services\MailService;
use Robust\DynamicForms\Models\Data;
use Robust\DynamicForms\Models\FormUser;

/**
 * Class UserController
 * @package Robust\Admin\Controllers\Admin
 */
class UserController extends Controller
{
    use CrudTrait, ViewTrait;

    /**
     * UserController constructor.
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->middleware('auth');
        $this->model = $user;
        $this->ui = 'Robust\Admin\UI\User';
        $this->package_name = 'admin';
        $this->view = 'admin.users';
        $this->title = 'Users';
        $this->events = [
            'store' => 'Robust\Core\Events\UserCreatedEvent',
            'update' => 'Robust\Core\Events\UserUpdatedEvent'
        ];

    }

    public function index()
    {
        $records = $this->model->paginate();
        return $this->display('core::admin.layouts.sub-layouts.table',
            [
                'records' => $records,
                'primary_menu' => (new MenuHelper())->getPrimaryMenu($this->package_name),
                'title' => (isset($this->title)) ? $this->title : '',
                'package' => $this->package_name,
                'default_data' => false,
                'view' => $this->view
            ]
        );
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, FormUser $formUser)
    {
        // Delete foreign table's data
        $formUser->where('user_id', $id)->delete();

        // Delete user
        $this->model->delete($id);
        return redirect()->back()->with('message', 'Record was successfully deleted!');
    }

}
