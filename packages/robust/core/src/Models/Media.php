<?php
namespace Robust\Core\Models;


use Robust\Banners\Models\Image;

/**
 * Class Media
 * @package Robust\Core\Models
 */
class Media extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'medias';

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'slug',
        'file',
        'type',
        'extension'
    ];

    public function image()
    {
        return $this->belongsTo(Image::class,'media_id','id');
    }
}
