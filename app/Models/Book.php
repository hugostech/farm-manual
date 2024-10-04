<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Book extends Model
{
    const STATUS_DRAFT = 'draft';
    const STATUS_PUBLISHED = 'published';
    protected $fillable = [
        'title',
        'subtitle',
        'author',
        'cover_image',
        'status',
        'published_at',
    ];
    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function storeCoverImage($image)
    {
        $path = $image->store('covers', 'public');
        $this->update([
            'cover_image' => $path,
        ]);
    }

    public function getCoverImageAttribute($value)
    {
        return asset('storage/' . $value);
    }

    public static function availableBooksForUser(User $user): Collection
    {
        // If the user is an admin, return all books
        if ($user->isAdmin()) {
            return self::all()->sortBy('title');
        }else{
            return $user->getAvailableBooks()->sortBy('title');
        }

    }

    public function catalogs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Catalog::class);
    }

    public function availableCatalogs(): Collection
    {
        return $this->catalogs()->whereNull('parent_id')->where('status', Catalog::STATUS_PUBLISHED)->get()->sortBy('sort');
    }

    /**
     * return all pages with status published
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function availablePages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Page::class)->available();
    }

    /**
     * return all pages
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Page::class);
    }

    /**
     * return all todays readers of the book
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function todayReaders(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, UserBookHistory::class)
            ->whereBetween('user_book_histories.created_at', [now()->startOfDay(), now()->endOfDay()])
            ->distinct('users.id');
    }

    /**
     * return all readers of the book
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getLastReadPage(User $user): ?Page
    {
        $history = UserBookHistory::where('book_id', $this->id)
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->first();
        return $history ? $history->page : null;
    }

    public function getUrl(): string
    {
        return route('books.show', ['book' => $this]);
    }

    public function buildBreadcrumb(): array
    {
        $breadcrumbs = new Collection();
        $breadcrumbs->push([
            'title' => 'Dashboard',
            'url' => url('/'),
        ]);
        $breadcrumbs->push([
            'title' => $this->title,
            'url' => $this->getUrl(),
        ]);
        return $breadcrumbs->toArray();
    }

}
