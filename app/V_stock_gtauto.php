<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class V_stock_gtauto extends Model
{
    protected $table = "v_stock_gtauto";
    protected $primaryKey ='CHASIS';
    public $incrementing=false;
   
    protected $fillable =['cod_marca','MARCA','MODELOS','COD_MODELO','MODELO','COD_MASTER','MASTER','ANIO_MOD','COLOR_EXTERNO','COLOR_INTERNO','CHASIS','COD_UBICACION','UBICACION','nom_localidad','estado	','estado_real','LIBERADO','nacionalizado'];

    public function master()
    {
    	return $this->belongsTo('App\Master','COD_MASTER');
    }

    public function modelo()
    {
    	return $this->belongsTo('App\Modelo','COD_MODELO');
    }
   
    public function marca()
    {
        return $this->belongsTo('App\Marca','cod_marca');
    } 

    public function modelo_gen()
    {
        return $this->belongsTo('App\Marca','MODELOS');
    }
    public function detalles()
    {
        return $this->hasMany('App\Detalle','CHASIS');
    }
    public function detalles_Chassis()
    {
        return $this->hasMany('App\Detalle_Chassis','CHASIS');
    }
}