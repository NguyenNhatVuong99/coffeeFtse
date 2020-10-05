<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $tables = "tables";
    protected $fillable=['name','status','area_id'];
    public function Area(){
        return $this->belongsTo('App\Models\Area');
        
    } 

}
