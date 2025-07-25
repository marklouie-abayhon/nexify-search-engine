<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BasedEngine extends Model
{
    protected $fillable = [
        'name',
        'cx',
        'position',
        'image',
        'video',
        'news',
        'subtitle',
    ];

    public $timestamps = false;
}
