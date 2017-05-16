<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    protected $table = "v_modelos";
    protected $primaryKey ='COD_MODELO';
    protected $fillable =['COD_MODELO','MODELO','MODELOS','cod_marca'];


    public function asignaciones()
    {
        return $this->hasMany('App\AsignacionStock','COD_MODELO');
    }

   

    public function vehiculos()
    {
        return $this->hasMany('App\V_stock_gtauto','COD_MODELO');
    }

     public function detalles()
    {
        return $this->hasMany('App\Detalle','COD_MODELO');
    }
}
