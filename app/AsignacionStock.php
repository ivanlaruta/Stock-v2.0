<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsignacionStock extends Model
{
    protected $table = "asignacion_stocks";
    protected $fillable =['id_stock','cod_marca','cod_modelo','cod_master','regional','stock_min','stock_asignado'];

    
    public function modelo()
    {
    	return $this->belongsTo('App\Modelo','cod_modelo');
    }
   
    public function marca()
    {
        return $this->belongsTo('App\Marca','cod_marca');
    } 

}

