<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
	protected $table = "v_masters";

    protected $primaryKey ='COD_MASTER';

    protected $fillable =['COD_MASTER','MASTER','COD_MODELO','MODELO','MODELOS','cod_marca'];

    public function asignaciones()
    {
        return $this->hasMany('App\AsignacionStock','COD_MASTER');
    }

    public function vehiculos()
    {
        return $this->hasMany('App\V_stock_gtauto','COD_MASTER');
    }

    public function detalle()
    {
        return $this->hasMany('App\Detalle','COD_MASTER');
    }
}    