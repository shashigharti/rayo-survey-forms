<?php

namespace Robust\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Contact extends Model
{
    use Notifiable;

    /**
     * @var string
     */
    protected $table = 'contacts';

    /**
     * @var boolean
     */
    public $timestamps = true;

    /**
     * @var string
     */
    protected $namespace = 'Robust\Core\Models\Contact';

    /**
     * @var string
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'type'
    ];

}
