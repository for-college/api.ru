<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
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

    public function carts (): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function orders (): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function roles (): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
