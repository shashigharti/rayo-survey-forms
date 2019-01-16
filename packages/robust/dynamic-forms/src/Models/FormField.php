<?php
namespace Robust\DynamicForms\Models;

use Illuminate\Database\Eloquent\Model;
use Robust\Core\Models\BaseModel;

/**
 * Class FormField
 * @package Robust\DynamicForms\Models
 */
class FormField extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'dynform_fields';

    /**
     * @var boolean
     */
    public $timestamps = true;

    /**
     * @var string
     */
    protected $namespace = 'Robust\DynamicForms\Models\FormField';

    /**
     * @var string
     */
    protected $fillable = ['name', 'type', 'section_id','column_no','page_no', 'label', 'form_id', 'properties', 'conditions', 'status', 'required', 'order'];

    /**
     * @return mixed
     */
    public function form()
    {
        return $this->belongsTo('Robust\DynamicForms\Models\Form');
    }

    /**
     * @return mixed
     */
    public function conditions()
    {
        return $this->hasMany('Robust\DynamicForms\Models\FieldCondition', 'field_id');
    }

    /**
     * @param $form
     * @return mixed
     */
    public static function getFieldsForDropdown($form)
    {
        return FormField::where('form_id', $form)
            ->get();
    }
}
