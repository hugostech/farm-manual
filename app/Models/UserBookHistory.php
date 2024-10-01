<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBookHistory extends Model
{
    protected $fillable = [
        'book_id',
        'user_id',
        'page_id',
    ];
}
