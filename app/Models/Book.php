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
        if ($user->group === 'admin') {
            return self::all()->sortBy('title');
        }else{
            return self::where('status', self::STATUS_PUBLISHED)->get()->sortBy('title');
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

}
