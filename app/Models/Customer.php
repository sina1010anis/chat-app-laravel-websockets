<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['name' , 'role'];


    public function updateVip(Customer $customer,Bool $vip= true):bool
    {
        return ($vip)? $this->find($customer->id)->update(['type' => 'vip']) : false;

    }


}
