<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Group extends Model
{
    CONST TYPE_ADMIN = 'admin';
    CONST TYPE_SUB = 'subscriber';

    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->hasManyThrough(User::class, UserToGroup::class, 'group_id', 'id', 'id', 'user_id');
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, BookToGroups::class, 'group_id', 'book_id');
    }

    public function assignedBooks(): Collection
    {
        $books = Book::all()->pluck('title', 'id');
        $assignedBooks = $this->books->pluck('id');
        return $books->transform(function ($title, $bookId) use ($assignedBooks) {
            return [
                'title' => $title,
                'id' => $bookId,
                'assigned' => $assignedBooks->contains($bookId)?1:0,
            ];
        });
    }
}
