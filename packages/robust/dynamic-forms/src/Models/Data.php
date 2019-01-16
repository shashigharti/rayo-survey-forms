<?php
namespace Robust\DynamicForms\Models;

use Illuminate\Database\Eloquent\Model;
use Robust\Core\Models\BaseModel;

class Data extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'dynform_datas';

    /**
     * Submitted Form Data Status
     */
    const SUBMISSION_COMPLETED = 1;

    /**
     * @var boolean
     */
    public $timestamps = true;

    /**
     * @var string
     */
    protected $namespace = 'Robust\DynamicForms\Models\FormDisplay';

    /**
     * @var string
     */
    protected $fillable = ['form_id', 'values', 'user_id', 'completed'];

    /**
     * @var array
     */
    public $searchable = ['form_id'];
}
