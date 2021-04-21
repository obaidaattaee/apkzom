<?php

namespace App\Models;

use App\Traits\TranslationTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OSType
 * @package App\Models
 */
class OSType extends Model
{
    use SoftDeletes;
    use TranslationTrait;

    /**
     * @var array
     */
    protected $guarded = [];
    /**
     * @var string[]
     */
    protected $casts = [
        'is_active' => 'boolean',
        'on_server' => 'boolean',
        'title' => 'array'
    ];
    /**
     * @var string[]
     */
    protected $appends = ['image'];

    /**
     * @return string
     */
    public function getImageAttribute()
    {
        return $this->getAttribute('on_server') ?
            asset('uploads/1000*1000/' . $this->getAttribute('logo')) :
            config()->get('backblaze.base_image_url') . 'uploads/1000*1000/' . $this->getAttribute('logo');
    }


}
