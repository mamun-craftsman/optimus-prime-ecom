<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'photo',
        'phone',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $attributes = [
        'photo' => 'avatar.png',
        'role' => 'customer',
        'status' => 'active',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (empty($user->username)) {
                $user->username = static::generateUsername($user->name, $user->phone);
            }
        });
    }

    public static function generateUsername($name, $phone = null)
    {
        $baseUsername = Str::slug($name) . '_' . substr($phone, -4);
        $username = Str::lower($baseUsername);
        $counter = 1;

        while (static::where('username', $username)->exists()) {
            $username = Str::lower($baseUsername) . $counter;
            $counter++;
        }

        return $username;
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function getPhotoUrlAttribute()
    {
        return asset($this->photo ? 'storage/' . $this->photo : 'avatar.png');
    }
}
