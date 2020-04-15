<?php


namespace Robust\Core\Models;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Page
 * @package Robust\Core\Models
 */
class Page extends Model
{
    /**
     * @var string
     */
    protected $table = 'pages';
    /**
     * @var bool
     */
    public $timestamps = true;
    /**
     * @var string
     */
    protected $namespace = 'Robust\Core\Models\Page';

    /**
     * @var array
     */
    public $searchable = ['name', 'slug', 'content', 'name_ne', 'excerpt', 'content_ne'];
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'url',
        'slug',
        'content',
        'status',
        'page_type',
        'route_type',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'created_at',
        'updated_at'
    ];
}
