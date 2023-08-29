<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'number_price',
        'product_id',
    ];

    public function add($sum_price)
    {
        return $sum_price;
    }
}
