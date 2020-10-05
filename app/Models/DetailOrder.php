<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    protected $table="detail_orders";
    protected $fillable=['order_id','product_id','quantity','sub_price','note'];
    public function order(){
        return $this->belongsTo('App\Models\Order');
    }
    public function Product(){
        return $this->belongsTo('App\Models\Product');
    }
 
}
