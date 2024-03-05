<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'invitation_code',
        'name',
        'email',
        'password',
        'provider',
        'line_id',
        'gtoken',
        'avatar',
        'invited_users_count',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Item::class, 'favorites', 'user_id', 'item_id')->withTimestamps();
    }

    public function sentComments()
    {
        return $this->hasMany(Comment::class, 'sender_id');
    }

    public function receivedComments()
    {
        return $this->hasMany(Comment::class, 'receiver_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }


    public function isFavorite($itemId)
    {
        return $this->favorites()->where('item_id', $itemId)->exists();
    }

    public function purchasedItems()
    {
        return $this->hasMany(SoldItem::class, 'buyer_id');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id')->withTimestamps();
    }

    public function isFollowing($user)
    {
        return $this->following()->where('followed_id', $user->id)->exists();
    }

    public function points()
    {
        return $this->hasOne(Point::class);
    }

    public function incrementInvitedUsersCount($amount = 1)
    {
        $this->increment('invited_users_count', $amount);

        return $this;
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'to_user_id');
    }

    public function averageRating()
    {
        if ($this->ratings->isEmpty()) {
            return null;
        }

        return $this->ratings->avg('rating');
    }
}
