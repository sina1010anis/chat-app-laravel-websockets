<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactorProduct extends Model
{
    use HasFactory;
    protected $fillable = ['product_id' , 'factor_id'];

    public function factor()
    {
        return $this->belongsTo(Factor::class , 'factor_id' , 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class , 'product_id' , 'id');
    }
}
