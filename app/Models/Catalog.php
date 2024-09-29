<?php

namespace App\Models;

use App\Models\Traits\Historable;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use Historable;

    const STATUS_DRAFT = 'draft';
    const STATUS_PUBLISHED = 'published';

    public function parent()
    {
        return $this->belongsTo(Catalog::class, 'parent_id');
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }
}
