<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBookHistory extends Model
{
    protected $table = 'user_book_histories';
    protected $fillable = [
        'book_id',
        'user_id',
        'page_id',
    ];

    public function scopeToday($query)
    {
        return $query->whereBetween('created_at', [now()->startOfDay(), now()->endOfDay()]);
    }

    public function page(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
