<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Tag extends Model
{
    use SoftDeletes;
    use HasTranslations;

    public $translatable = ['title'];
    protected $guarded = [];

}
