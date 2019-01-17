<?php
namespace Robust\Core\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EmailSetting
 * @package Robust\Core\Models
 */
class EmailSetting extends Model
{
    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var string
     */
    protected $table = 'email_settings';

    /**
     * @var string
     */
    protected $namespace = 'Robust\Core\Models\EmailSetting';

    /**
     * @var array
     */
    protected $fillable = [
        'setting_name',
        'event',
        'email'
    ];
}
