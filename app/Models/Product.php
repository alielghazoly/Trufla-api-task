<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'details',
        'price',
        'count',
        'discount',
        'seller_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'seller_id');
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class,'product_order');
    }
}
