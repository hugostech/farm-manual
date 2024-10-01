<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'location',
        'about_me',
        'last_login_at',
        'profile_image',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'user_to_groups');
    }

    public function getGroupAttribute()
    {
        return $this->groups->first();
    }

    public function getGroupNameAttribute()
    {
        return $this->groups->first()?->name ?? Group::TYPE_SUB;
    }

    public function hasRole(string $role): bool
    {
        return $this->groups->contains('name', $role);
    }

    public function isAdmin(): bool
    {
        return $this->hasRole(Group::TYPE_ADMIN);
    }

    public function getAvailableBooks(): \Illuminate\Support\Collection
    {
        if ($this->isAdmin()) {
            return Book::all();
        }
        return $this->groups()->first()?->books ?? collect();
    }

    public function getAvatarAttribute()
    {
        if ($this->profile_image) {
            return asset('storage/' . $this->profile_image);
        }
        return url('assets/img/team-2.jpg');
    }

    public function storeProfileImage($image)
    {
        $path = $image->store('profile_images', 'public');
        $this->update(['profile_image' => $path]);
    }

    public function disable()
    {
        $this->update(['status' => false]);
    }

    public function isDisabled(): bool
    {
        return !$this->status;
    }
}
