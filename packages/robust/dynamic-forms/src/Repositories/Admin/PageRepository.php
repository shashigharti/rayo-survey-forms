<?php
namespace Robust\DynamicForms\Repositories\Admin;

use Robust\Core\Repositories\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Traits\SearchRepositoryTrait;
use Robust\DynamicForms\Models\Form;
use Robust\DynamicForms\Models\FormField;


class PageRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;
    /**
     * PageRepository constructor.
     * @param Form $form
     * @param FormField $field
     */
    public function __construct(Form $form, FormField $field)
    {
        $this->form = $form;
        $this->field = $field;
    }

    /**
     * @param $form_id
     * @param $page
     * @return mixed
     */
    public function destroy($form_id, $page)
    {
        $this->field->where('form_id', $form_id)->where('page_no', '=', $page)->forceDelete();

        // decrement all the page_no
        $this->field->where('form_id', $form_id)->where('page_no', '>', $page)->decrement('page_no');

        $form = $this->form->find($form_id);
        $form->pages = $form->pages - 1;

        $form->save();
    }

}
