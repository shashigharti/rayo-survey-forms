<?php
namespace Robust\DynamicForms\Controllers\Admin;

use App\Http\Controllers\Controller;
use Robust\Core\Controllers\Admin\Traits\ViewTrait;
use Robust\Core\Controllers\Admin\Traits\CrudTrait;
use Illuminate\Http\Request;
use Robust\DynamicForms\Repositories\Admin\FormFieldRepository;
use Robust\DynamicForms\Repositories\Admin\FormRepository;
use Robust\DynamicForms\Repositories\Admin\PageRepository;

/**
 * Class PageController
 * @package Robust\DynamicForms\Controllers\Admin
 */
class PageController extends Controller
{
    use CrudTrait, ViewTrait;


    /**
     * PageController constructor.
     * @param Request $request
     * @param FormRepository $model
     */
    public function __construct(
        Request $request,
        FormRepository $model
    )
    {
        $this->request = $request;
        $this->model = $model;
        $this->ui = 'Robust\DynamicForms\UI\Form';
        $this->package_name = 'dynamic-forms';
        $this->view = 'admin.forms.design';
        $this->title = 'Design';

    }


    /**
     * @param $form_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($form_id)
    {
        $form = $this->model->find($form_id);
        $form->pages = $form->pages + 1;
        $form->update();

        return redirect()->route('admin.forms.design', ['form' => $form_id])
            ->with(['success' => "New page added!", 'altered' => true]);
    }


    /**
     * @param PageRepository $page
     * @param $form_id
     * @param $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(PageRepository $page, $form_id, $page_no)
    {
        $form = $this->model->find($form_id);

        if ($form->pages > 1) {
            $page->destroy($form_id, $page_no);

            return redirect(route('admin.forms.design', [$form_id, ($page_no - 1)]))
                ->with(['success' => "Deleted!", 'altered' => true]);
        }
        return \Redirect::back()->with(['error' => 'Sorry !, We are unable to delete this page, looks like you are trying to delete default page.']);
    }



}
