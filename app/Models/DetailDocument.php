<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailDocument extends Model
{
    protected $table="detail_documents";
    protected $fillable=['document_id','product_id','quantity','price','note'];
    public function order(){
        return $this->belongsTo('App\Models\Order');
    }
    public function Product(){
        return $this->belongsTo('App\Models\Product');
    }
 
}
