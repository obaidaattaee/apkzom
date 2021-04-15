<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use SoftDeletes;
    use HasTranslations;
    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
        'title' => 'object'
    ];

    public $translatable = ['title'];

    const CATEGORIES = [
        [
            'id' => 1 ,
            'title' => '{"ar":"\u0627\u0644\u0639\u0627\u0628","en":"games"}',
            'description' => 'game category',
            'icon' => "fas fa-gamepad"
        ],[
            'id' => 2 ,
            'title' => '{"ar":"\u062a\u0637\u0628\u064a\u0642\u0627\u062a","en":"apps"}',
            'description' => 'app category',
            'icon' => "fab fa-app-store-ios"
        ]
    ];

}
