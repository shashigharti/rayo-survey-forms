<?php
namespace Robust\Core\Controllers\Admin;

use Robust\Core\Controllers\Admin\Traits\CrudTrait;
use Illuminate\Http\Request;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;
use Robust\Core\Helpers\MenuHelper;
use Robust\Core\Repositories\ContactRepository;
use Robust\Core\Events\ReplyContactEvent;

/**
 * Class ContactController
 * @package Robust\Core\Controllers\Admin
 */
class ContactController extends Controller
{
    use CrudTrait, ViewTrait;

    /**
     * ContactController constructor.
     * @param Request $request
     * @param ContactRepository $contacts
     */
    public function __construct(Request $request, ContactRepository $contacts)
    {
        $this->model = $contacts;
        $this->request = $request;
        $this->ui = 'Robust\Core\UI\Contact';
        $this->package_name = 'core';
        $this->view = 'admin.contact';
        $this->title = 'Contacts';
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function index(Request $request)
    {
        $query = $this->model;
        if ($request->has('type') && $request->has('keyword')) {
            $type = $request->get('type');
            $keyword = $request->get('keyword');
            $query = $query->where($type, "%" . $keyword . "%", 'LIKE');
        }

        if (isset($this->scopes)) {
            foreach ($this->scopes as $scope) {
                $query = $query->$scope();
            }
        }
        $records = $this->model->orderBy('id', 'desc')->paginate(settings('app-setting',
            'pagination'));
        return $this->display($this->table,
            [
                'records' => $records,
                'primary_menu' => (new MenuHelper())->getPrimaryMenu($this->package_name),
                'title' => (isset($this->title)) ? $this->title : '',
                'package' => $this->package_name,
            ]
        );
    }

    /**
     * @param $id
     * @return $this
     */
    public function show($id)
    {
        $contact = $this->model->find($id);
        return $this->display('core::admin.contacts.detail',
            [
                'contact' => $contact
            ]
        );
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function replyContact(Request $request, $id)
    {
        $contact = $this->model->find($id);
        $messages = $request->get('message');
        event(new ReplyContactEvent($contact, $messages));
        return redirect(route("admin.contacts.index"))->with('message',
            'Message Replied successfully');
    }
}
