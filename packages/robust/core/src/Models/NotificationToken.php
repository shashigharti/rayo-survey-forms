<?php

namespace Robust\Core\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Dashboard
 * @package Robust\Core\Models
 */
class NotificationToken extends Model
{
    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var string
     */
    protected $table = 'notification_tokens';

    protected $fillable = [
        'user_id',
        'email',
        'token',
        'app',
        'active'
    ];

}
