<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

/**
 * Class App
 * @package App\Models
 */
class App extends Model
{
    use SoftDeletes;
    use HasTranslations;

    /**
     * @var string[]
     */
    public $translatable = ['title', 'description'];

    /**
     * @var array
     */
    protected $guarded = [];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'app_tag', 'app_id', 'tag_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'app_id', 'id');
    }

    public function parts()
    {
        return $this->hasMany(AppParts::class, 'app_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function owner()
    {
        return $this->belongsTo(Vendor::class, 'owner_id', 'id');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'description'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'description';
    }
}
