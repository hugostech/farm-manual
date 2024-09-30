<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    CONST TYPE_ADMIN = 'admin';
    CONST TYPE_SUB = 'subscriber';

    public function users()
    {
        return $this->hasManyThrough(User::class, UserToGroup::class, 'group_id', 'id', 'id', 'user_id');
    }
}
