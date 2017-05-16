<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = "v_marcas";
    protected $primaryKey ='cod_marca';
    protected $fillable =['cod_marca','MARCA'];

    

    public function asignaciones()
    {
        return $this->hasMany('App\AsignacionStock','cod_marca');
    }

    public function vehiculos()
    {
        return $this->hasMany('App\V_stock_gtauto','cod_marca');
    }

    public function detalles()
    {
        return $this->hasMany('App\Detalle','cod_marca');
    }
}
