<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table="products";
    protected $fillale=['name','unit_id','category_id',' historical_cost',' sale_cost ','image'];
}
