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

    public function readers(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(User::class, UserBookHistory::class, 'page_id', 'user_id');
    }

    public function recordReader(User $user): void
    {
        $this->readers()->attach($user);
    }


}
