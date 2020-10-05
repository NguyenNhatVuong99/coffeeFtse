<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $tables = "areas";
    protected $fillable=['name'];
    public function Area(){
        return $this->hasMany('App\Models\Table');
        
    } 

}
