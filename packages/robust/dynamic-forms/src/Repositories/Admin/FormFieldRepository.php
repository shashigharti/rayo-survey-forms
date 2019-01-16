<?php

namespace Robust\DynamicForms\Repositories\Admin;

use Robust\Core\Repositories\Traits\CommonRepositoryTrait;
use Robust\Core\Repositories\Traits\CrudRepositoryTrait;
use Robust\Core\Repositories\Traits\SearchRepositoryTrait;
use Robust\DynamicForms\Models\FormField;

/**
 * Class FormFieldRepository
 * @package Robust\DynamicForms\Repositories
 */
class FormFieldRepository
{
    use CrudRepositoryTrait, SearchRepositoryTrait, CommonRepositoryTrait;

    public function __construct(FormField $model)
    {
        $this->model = $model;
    }

    /**
     * @param $data
     */
    public function duplicateByRelation($data)
    {
        $this->model->create($data);
    }


    /**
     * @return array
     */
    public function getAllFieldsTree($form_id)
    {
        $all_form_fields = [];
        $form_fields = $this->model->where('form_id', $form_id)
            ->orderBy('page_no')
            ->orderBy('order')->get();
        foreach ($form_fields as $field) {
            if ($field->section_id == 0) {
                $all_form_fields[$field->id] = array_merge($field->toArray(), ['childrens' => []]);
            } else {
                $all_form_fields[$field->section_id]['childrens'][$field->column_no][] = $field->toArray();
            }
        }
        $new_form_fields = [];
        foreach ($all_form_fields as $field) {
            $new_form_fields[$field['page_no']][] = $field;
        }
        return $new_form_fields;
    }

    /**
     * @return array
     */
    public function getAllFieldsTreeByFieldId($form_field_id)
    {
        $all_form_fields = [];
        $form_fields = $this->model->where('id', $form_field_id)
            ->orWhere('section_id', $form_field_id)
            ->orderBy('page_no')
            ->orderBy('order')->get();

        foreach ($form_fields as $field) {
            if ($field->section_id == 0) {
                $all_form_fields[$field->id] = array_merge($field->toArray(), ['childrens' => []]);
            } else {
                $all_form_fields[$field->section_id]['childrens'][$field->column_no][] = $field->toArray();
            }
        }
        return $all_form_fields[$form_field_id];
    }

}
