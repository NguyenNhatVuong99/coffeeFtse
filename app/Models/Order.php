<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table="orders";
    protected $fillable=['table_id','total_quantity','sub_price','reduce_price','total_price','time_in','time_out','user_id','status'];
    public function details(){
        return $this->hasMany('App\Models\DetailOrder');
    }
}
