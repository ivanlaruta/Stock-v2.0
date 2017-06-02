<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    protected $table = "detalles";
    protected $primaryKey =['id_envio', 'id_detalle'];
    public $incrementing=false;
    

    protected $dates =['fecha_creacion','fecha_envio','fecha_estimada_arribo','fecha_arribo'];
    protected $dateFormat = 'Y-m-d H:i:s';
    public $timestamps = true;

    public function vehiculo()
    {
    	return $this->belongsTo('App\V_stock_gtauto','chassis');
    }

    public function master()
    {
        return $this->belongsTo('App\Master','cod_master');
    }

    public function modelo()
    {
        return $this->belongsTo('App\Modelo','cod_modelo');
    }
   
    public function marca()
    {
        return $this->belongsTo('App\Marca','cod_marca');
    } 

}


