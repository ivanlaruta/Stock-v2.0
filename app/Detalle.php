<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    protected $table = "detalles";
    protected $primaryKey =['id_envio', 'chassis'];
    public $incrementing=false;
    protected $fillable =['id_envio','chassis','fecha_envio','fecha_entrega_estimada','fecha_entrega','observaciones','estado'];

    protected $dates =['fecha_creacion'];
    protected $dateFormat = 'Y-m-d H:i:s';
    public $timestamps = true;

    public function vehiculo()
    {
    	return $this->belongsTo('App\V_stock_gtauto','chassis');
    }
}
