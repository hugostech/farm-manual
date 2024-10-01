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
        $history = new UserBookHistory();
        $history->page_id = $this->id;
        $history->user_id = $user->id;
        $history->book_id = $this->book_id;
        $history->save();
    }

    /**
     * Get page route
     */
    public function getUrl(): string
    {
        return route('pages.show', ['page' => $this]);
    }


}
