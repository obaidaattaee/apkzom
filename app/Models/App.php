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


    const APP_LOGO_PATH = 'apps/logos';

    public function getImageFileAttribute()
    {
        return $this->getAttribute('on_server') ?
            asset('uploads/'.self::APP_LOGO_PATH . '/' . $this->getAttribute('image')):
            config()->get('backblaze.base_image_url') . 'uploads/' .self::APP_LOGO_PATH . '/' . $this->getAttribute('image');
    }

    protected $appends = ['image_file'];
    protected $casts = ['published_at' , 'datetime'];
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

    public function OSType()
    {
        return $this->belongsTo(OSType::class , 'os_type_id' , 'id');
    }
    public function OSVersion()
    {
        return $this->belongsTo(OSVersion::class , 'os_version_id' , 'id');
    }

    public function versions()
    {
        return $this->hasMany(AppVersion::class , 'app_id' , 'id')->orderBy('sort_number');
    }
    public function translation($column , $locale = 'en')
    {
//        return $this->hasMany(AppTranslation::class , 'app_id' , 'id')
//            ->where('locale' , $locale)->first([$column])[$column];
        return $this->translations()->where('locale' , $locale)->orWhere('locale' , 'en')->first([$column])[$column];
    }
    public function translations()
    {
        return $this->hasMany(AppTranslation::class , 'app_id' , 'id');
    }
}
