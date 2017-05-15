<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class V_ubicacion extends Model
{
    protected $table = "v_ubicaciones";
    public $incrementing=false;
   
    protected $fillable =['codigo','nombre','ciudad'];
}
