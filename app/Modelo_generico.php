<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modelo_generico extends Model
{
    protected $table = "v_modelos";
    protected $fillable =['MODELOS','cod_marca'];


    public function asignaciones()
    {
        return $this->hasMany('App\AsignacionStock','COD_MODELOS');
    }

    public function asignaciones()
    {
        return $this->hasMany('App\AsignacionStock','COD_MODELOS');
    }

    public function vehiculos()
    {
        return $this->hasMany('App\V_stock_gtauto','COD_MODELOS']);
    }
    public function detalles()
    {
        return $this->hasMany('App\Detalle','COD_MODELOS');
    }
}
