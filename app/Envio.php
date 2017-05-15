<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Envio extends Model
{
    protected $table = "envios";
    protected $primaryKey ='id_envio';
    protected $fillable =['id_envio','fecha_creacion','fecha_enviado','fecha_aprovado','fecha_envio','fecha_entrega_estimada','fecha_entrega','estado_envio','tipo','observaciones','origen','destino'];

    protected $dates =['fecha_creacion'];
    protected $dateFormat = 'Y-m-d H:i:s';
    public $timestamps = true;

}
