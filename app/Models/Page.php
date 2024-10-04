<?php

namespace App\Models;

use App\Models\Traits\Historable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    use Historable;

    const STATUS_PUBLISHED = 'published';
    const STATUS_DRAFT = 'draft';

    protected $fillable = [
        'url',
        'title',
        'context',
        'sort',
        'book_id',
        'category_id',
        'status',
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

    public function book(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', self::STATUS_PUBLISHED);
    }

    public function nextPage(): ?Page
    {
        return $this->book->pages()->available()->where('sort', '>', $this->sort)->orderBy('sort')->first();
    }

    public function lastPage(): ?Page
    {
        return $this->book->pages()->available()->where('sort', '<', $this->sort)->orderBy('sort')->first();
    }

    public function isPublished(): bool
    {
        return $this->status === self::STATUS_PUBLISHED;
    }

    public function buildBreadcrumb(): array
    {
        return [
            [
                'title' => Str::ucfirst($this->book->title),
                'url' => $this->book->getUrl(),
            ],
            [
                'title' => Str::ucfirst($this->title),
                'url' => $this->getUrl(),
            ],
        ];
    }


}
