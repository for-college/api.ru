<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'quantity',
        'photo',
        'description',
        'category_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function cart(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
