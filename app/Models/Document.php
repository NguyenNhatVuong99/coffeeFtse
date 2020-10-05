<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table="documents";
    protected $fillable=['document_id','date','type_id','table_id','customer_id','content','user_id','reduce','total_price','time_in','time_out','prepay','debt','status'];
    public function type(){
        return $this->belongsTo('App\Models\TypeDocument');
    }
    
    // public function user(){
    //     return $this->belongsTo('App\Models\User');
    // }
    
}

