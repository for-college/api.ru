<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'lastname',
        'name',
        'patronymic',
        'sex',
        'birth',
        'login',
        'password',
        'email',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function roles(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function generateToken(): string
    {
        $this->api_token = Hash::make(Str::random());
        $this->save();

        return $this->api_token;
    }
}
