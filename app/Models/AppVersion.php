<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppVersion extends Model
{
    protected $guarded = ['id'];
    protected $casts = ['published_at' => 'date'];
}
