<?php

namespace App\Models;

use Database\Factories\FactorFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseTruncation;

class Corce extends Model
{
    use HasFactory, DatabaseTruncation ;

    public bool $buy_status=false;

    protected $fillable = ['title' , 'price' , 'type'];

    public function updateVip(Corce $corce, Bool $vip= true):bool
    {
        return ($vip)? $this->find($corce->id)->update(['type' => 'vip']) : false;
    }

    public function buyCorceVip(Corce $corce , Customer $customer):void
    {
        if($customer->role == "vip"){
            $corce->buyCorce($corce , $customer);
            $this->buy_status = true;
        }else{
            $this->buy_status = false;
        }
    }

    public function buyCorce(Corce $corce , Customer $customer)
    {
        return FactorFactory::new()->count(1)->create();
    }

    public function getBuy_status()
    {
        return $this->buy_status;
    }
}
