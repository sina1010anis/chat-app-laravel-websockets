<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factor extends Model
{
    use HasFactory;
    protected $fillable = ['total_price' , 'pyment_id' , 'product_id' , 'customer_id'];

    public function products()
    {
        return $this->hasMany(FactorProduct::class , 'factor_id' , 'id');
    }
}
