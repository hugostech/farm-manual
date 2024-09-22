<?php

namespace App\Models;

use App\Models\Traits\Historable;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use Historable;

    protected $fillable = [
        'url',
        'title',
        'content',
    ];


}
