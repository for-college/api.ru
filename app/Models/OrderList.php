<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderList extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'quantity',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function orders (): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function products (): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
