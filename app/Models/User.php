<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function wishlist()
{
    return $this->hasMany(Wishlist::class);
}
 public function wishlistItems()
    {
        return $this->hasMany(Wishlist::class);
    }
    public function points()
{
    return $this->hasMany(Point::class);
}

// Méthode pour obtenir le total des points
public function totalPoints()
{
    return $this->points()->sum('points');
}
public function supportTickets()
{
    return $this->hasMany(SupportTicket::class);
}
public function reviews()
{
    return $this->hasMany(Review::class);
}

}
