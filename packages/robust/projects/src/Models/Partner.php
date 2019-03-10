<?php
namespace Robust\Projects\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Partner
 * @package Robust\Projects\Models
 */
class Partner extends Model
{
    /**
     * @var string
     */
    protected $table = 'project_partners';

    /**
     * @var boolean
     */
    public $timestamps = true;

    /**
     * @var string
     */
    protected $namespace = 'Robust\Projects\Models\Partner';

    /**
     * @var string
     */
    protected $fillable = [
        'name',
        'acronym',
        'description',
        'organization_type',
        'contact_person',
        'contact_number',
        'contact_email',
        'contact_address',
        'designation',
        'type',
        'project_id'
    ];

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * @return array
     */
    public function getTypes()
    {
        return ['Partner' => 'Partner', 'Donor' => 'Donor', 'Lead Organization' => 'Lead Organization', 'Service Provider' => 'Service Provider', 'Implementation Partner' => 'Implementation Partner', 'Financial Institution' => 'Financial Institution', 'Suppliers' => 'Suppliers', 'Auditor' => 'Auditor', 'Network' => 'Network', 'Others' => 'Others'];
    }
}
