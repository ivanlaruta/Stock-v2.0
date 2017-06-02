<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\V_ubicacion;
use App\Envio;
use App\Marca;
use App\Modelo;
use App\Master;
use App\Detalle;
use App\Detalle_Chassis;
use App\V_stock_gtauto;
use DB;
class EnviosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $env =Envio::where('estado_envio', '=', '1')->get();
       
        $env_esp =Envio::where('estado_envio', '=', '2')->get();
       
        $env_aprob =Envio::where('estado_envio', '>=', '3')->get();

       return view('distribuidor.envios.borradores')
            ->with('env',$env)
            ->with('env_esp',$env_esp)
            ->with('env_aprob',$env_aprob)
        ;
    }

    public function index_espera(Request $request)
    {
       $env =Envio::where('estado_envio', '=', '2')->get();
        return view('distribuidor.envios.espera')
            ->with('env',$env)
            
        ;
    }

    public function index_aprobados(Request $request)
    {
       $env =Envio::where('estado_envio', '=', '3')->get();
        return view('distribuidor.envios.aprobados')
            ->with('env',$env)
        ;
    }

    public function espera(Request $request,$id)
    {
       date_default_timezone_set('America/La_Paz');
       $time = time();
       $now =date("Y-m-d", $time);

       $env =Envio::find($id);
       
       if($env->estado_envio<2)
       {
            $det = Detalle::where('id_envio','=',$id)->get();

            foreach($det as $dd)
            {
              
                $count = DB::table('V_stock_gtauto')
                    ->where('cod_marca','=',$dd->cod_marca)
                    ->where('COD_MODELO','=',$dd->cod_modelo)
                    ->where('COD_MASTER','=',$dd->cod_master)
                    ->where('ANIO_MOD','=',$dd->anio)
                    ->where('COLOR_EXTERNO','=',$dd->col_ext)
                    ->where('COLOR_INTERNO','=',$dd->col_int)
                    ->whereNotIn('CHASIS', function($query) {
                                                    $query->select('chassis')
                                                    ->from(with(new Detalle_Chassis)->getTable())
                                                    ->where('estado','<','2');})
                    ->count();
                
                if ($dd->cantidad <= $count)
                {
                    $unidades = V_stock_gtauto::
                      where('cod_marca','=',$dd->cod_marca)
                    ->where('COD_MODELO','=',$dd->cod_modelo)
                    ->where('COD_MASTER','=',$dd->cod_master)
                    ->where('ANIO_MOD','=',$dd->anio)
                    ->where('COLOR_EXTERNO','=',$dd->col_ext)
                    ->where('COLOR_INTERNO','=',$dd->col_int)
                    ->whereNotIn('CHASIS', function($query) {
                        $query->select('chassis')
                        ->from(with(new Detalle_Chassis)->getTable())
                        ->where('estado','<','2');})

                    ->paginate($dd->cantidad);

                    foreach($unidades as $add)
                    {
                        $det = new Detalle_Chassis();
                        $det -> id_envio = $id;
                        $det -> id_detalle = $dd->id_detalle;
                        $det -> chassis = $add->CHASIS;
                        $det -> estado = '1';
                        $det -> save();
                    }
                }
            }
            $env->estado_envio = '2';
            $env -> fecha_espera = $now;
            $env->save();
            return redirect()->route('envios.index')->with('mensaje',"Envio en espera de aprobacion, Se reservaron unidades automaticamente."); 
        }


    }

    public function aprobacion(Request $request,$id)
    {
       date_default_timezone_set('America/La_Paz');
       $time = time();
       $now =date("Y-m-d", $time);

       $det_all = Detalle_Chassis::where('id_envio','=',$id)
        ->get();

       foreach ($det_all as $deta) { 

            if($deta->validado == '1')
            {
                DB::update("update detalles_chassis set estado = '2' where chassis = '".$deta->chassis."'");
            }

        }

       $cant_ap = DB::select( DB::raw("select id_envio,id_detalle, COUNT (chassis) as cantidad_aprobada from detalles_chassis where estado = '2' and id_envio = '".$id."' GROUP BY id_envio,id_detalle ORDER BY id_detalle ASC"));

       foreach ($cant_ap as $cant) { 

            DB::update("update detalles set cantidad_aprobada = ".$cant->cantidad_aprobada." , cantidad_enviada = 0  , cantidad_entregada = 0 where id_detalle = '".$cant->id_detalle."' and id_envio = '".$id."'");
        }

       $env =Envio::find($id);
       $env->estado_envio = '3';
       $env -> fecha_aprobado = $now;
       $env->save();

       return redirect()->route('envios.index')->with('mensaje',"Envio aprobado correctamente."); 
    }
    
    public function aprobar(Request $request,$id)
    {
      
        $env =Envio::find($id);

        $det = Detalle_Chassis::select(DB::raw('ROW_NUMBER() OVER(ORDER BY id_detalle DESC) AS ITEM'),'*', DB::raw("CASE WHEN (SELECT COUNT (dd.chassis) from detalles_chassis dd where dd.estado >= 2 and dd.chassis = detalles_chassis.chassis) >  0   THEN 'n' ELSE 's' END AS estado_disp"))
        ->where('id_envio','=',$id)
        ->get();

        foreach ($det as $deta) {
           
            if($deta->estado_disp == 's')
            {
                DB::update("update detalles_chassis set validado = '1' where chassis = '".$deta->chassis."'");
            }
            else
            {
                DB::update("update detalles_chassis set validado = '0' where chassis = '".$deta->chassis."'");
            }
        }

        $det_all = Detalle_Chassis::select(DB::raw('ROW_NUMBER() OVER(ORDER BY id_detalle DESC) AS ITEM'),'*')
            ->where('id_envio','=',$id)
        ->get();

        return view('distribuidor.envios.hoja_aprobacion')
            ->with('det_all',$det_all)
            ->with('id',$id)
            ->with('env',$env)
            ;
    }

       
    public function enviar(Request $request,$id)
    {
        date_default_timezone_set('America/La_Paz');
        $time = time();
        $now =date("Y-m-d", $time);

        DB::update("update detalles_chassis set estado = '3' , fecha_envio = '".$now."' ,fecha_estimada_arribo ='".$request->f_env."' where id_envio = '".$id."'");
           
       $cant_env = DB::select( DB::raw("select id_envio,id_detalle, COUNT (chassis) as cantidad_enviada from detalles_chassis where estado = '3' and id_envio = '".$id."' GROUP BY id_envio,id_detalle ORDER BY id_detalle ASC"));

       foreach ($cant_env as $cant) { 

            DB::update("update detalles set cantidad_enviada = ".$cant->cantidad_enviada."  where id_detalle = '".$cant->id_detalle."' and id_envio = '".$id."'");
        }

           $env =Envio::find($id);
           $env->estado_envio = '5';
           $env -> fecha_envio = $now;
           $env -> fecha_entrega_estimada = $request->f_env;
           $env->save();

        return redirect()->route('envios.index');
    }

    public function envio_parcial(Request $request,$id)
    {
        $env =Envio::find($id);

        $det = Detalle::select(DB::raw("*,cantidad_aprobada - cantidad_enviada as sin_env"))
        ->where('id_envio','=',$id)
        ->get();
        return view('distribuidor.envios.hoja_envio_parcial')
         ->with('det',$det)
         ->with('id',$id)
         ->with('env',$env)
         ;
    }

    public function enviar_parcial(Request $request)
    {
        
        date_default_timezone_set('America/La_Paz');
        $time = time();
        $now =date("Y-m-d", $time);

        $env =Envio::find($request->id);
        
        $det =$request->id_detalle;
        $unidades = Detalle_Chassis::
                      where('id_envio','=',$request->id)
                    ->where('id_detalle','=',$request->id_detalle)
                    ->where('estado','<','3')
                    ->paginate($request->cant);
        
        foreach($unidades as $add)
        {
            DB::update("update detalles_chassis set estado = '3' , fecha_envio = '".$now."' ,fecha_estimada_arribo ='".$request->f_env."' where id_detalle = '".$request->id_detalle."' and id_envio = '".$request->id."' and chassis = '".$add->chassis."'");
        }

        $enviados = Detalle_Chassis::
            where('id_envio','=',$request->id)
            ->where('id_detalle','=',$request->id_detalle)
            ->where('estado','=','3')
            ->count();

        DB::update("update detalles set fecha_envio = '".$now."' ,cantidad_enviada ='".$enviados."' where id_detalle = '".$request->id_detalle."' and id_envio = '".$request->id."'");

        $aprr = Detalle::
            where('id_envio','=',$request->id)
            ->sum('cantidad_aprobada');

        $envv = Detalle::
            where('id_envio','=',$request->id)
            ->sum('cantidad_enviada');
        

        $env =Envio::find($request->id);

        if ($aprr == $envv)
        {
            $env->estado_envio = '5';
        }
        else
        {
            $env->estado_envio = '4';
        }
        
        $env -> fecha_envio = $now;
        $env->save();

        
        if ($aprr == $envv)
        {
            return redirect()->route('envios.index', ['id' =>$request->id]);
        }
        else
        {
            return redirect()->route('envios.envio_parcial', ['id' =>$request->id]);
        }

        
    }

    public function modal_parcial(Request $request)
    {
        $env =Envio::find($request->id);
        $id = $request->id;
        $det = Detalle::where('id_envio','=',$request->id)
        ->where('id_detalle','=',$request->id_detalle)
        ->first();
        return view('distribuidor.envios.modal_parcial')
         ->with('det',$det)
         ->with('id',$id)
         ->with('env',$env);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $ubica =V_ubicacion::select('ciudad')->groupBy('ciudad')->orderBy('ciudad','ASC')->pluck('ciudad','ciudad');

        return view('distribuidor.envios.create')
         ->with('ubica',$ubica)
         ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        date_default_timezone_set('America/La_Paz');
        $time = time();
        $now =date("Y-m-d", $time);

        $env = new Envio($request->all());
        $env->fecha_creacion = $now;
        $env->fecha_modificacion = $now;
        $env->save();    
       
        return redirect()->route('envios.detalle', ['id' => $env->id_envio]);
    }

    public function detalle_all(Request $request,$id,$id2)
    {   
        $env =Envio::find($id);

        if($id2  <> '0')
        {
            $det_all = Detalle_Chassis::select(DB::raw('ROW_NUMBER() OVER(ORDER BY id_detalle DESC) AS ITEM'),'*')
             ->where('id_envio','=',$id)
             ->where('id_detalle','=',$id2)
             ->get();

        }
        else
        {
             $det_all = Detalle_Chassis::select(DB::raw('ROW_NUMBER() OVER(ORDER BY id_detalle DESC) AS ITEM'),'*')
             ->where('id_envio','=',$id)
             
             ->get();
        }

        
        return view('distribuidor.envios.detalle_all')
            ->with('det_all',$det_all)
            ->with('id',$id)
            ->with('env',$env)
            ;
    }


    public function detalle(Request $request,$id)
    {
        $env =Envio::find($id);
        $marcas =Marca::whereIn('MARCA', ['YAMAHA', 'TOYOTA', 'LEXUS'])
        ->orderBy('MARCA','ASC')
        ->pluck('MARCA','cod_marca')
        ;

        $det_all = Detalle::where('id_envio','=',$id)->get();

        // select('V_stock_gtauto.MARCA','V_stock_gtauto.MODELO','V_stock_gtauto.MASTER','V_stock_gtauto.ANIO_MOD','V_stock_gtauto.COLOR_EXTERNO','V_stock_gtauto.COLOR_INTERNO',DB::raw('count(detalles.chassis) as user_count')

        $det = Detalle::where('id_envio','=',$id)->get();

        // $det = V_stock_gtauto::select(DB::raw('ROW_NUMBER() OVER(ORDER BY MARCA DESC) AS ITEM,count(detalles.chassis) as CANTIDAD,V_stock_gtauto.MARCA,V_stock_gtauto.MODELO,V_stock_gtauto.MASTER, V_stock_gtauto.ANIO_MOD, V_stock_gtauto.COLOR_EXTERNO, V_stock_gtauto.COLOR_INTERNO'))
        //      ->join('detalles', 'detalles.chassis', '=', 'V_stock_gtauto.CHASIS')
        //      ->where('id_envio','=',$id)
        //      ->groupBy('V_stock_gtauto.MARCA','V_stock_gtauto.MODELO','V_stock_gtauto.MASTER','V_stock_gtauto.ANIO_MOD','V_stock_gtauto.COLOR_EXTERNO','V_stock_gtauto.COLOR_INTERNO')
        //      ->get();

        

       
        if(is_null($request->marca))
        {
            return view('distribuidor.envios.detalle')
            ->with('env',$env)
            ->with('marcas',$marcas)
            ->with('request',$request)
            ->with('det',$det)
            ->with('det_all',$det_all)
            ;
        }
        else
        {
            $modelos =Modelo::where('cod_marca','=',$request->marca)
            ->orderBy('MODELO','ASC')
            ->pluck('MODELO','cod_modelo')
            ;

            if(is_null($request->modelo))
            {
                return view('distribuidor.envios.detalle')
                ->with('env',$env)
                ->with('marcas',$marcas)
                ->with('modelos',$modelos)
                ->with('request',$request)
                ->with('det',$det)
                ->with('det_all',$det_all)
                ;
            }
            else
            {
                 $masters =Master::where('cod_marca','=',$request->marca)
                    ->where('cod_modelo','=',$request->modelo)
                    ->orderBy('MASTER','ASC')
                    ->pluck('MASTER','COD_MASTER')
                    ;

                if(is_null($request->master))
                {
                    return view('distribuidor.envios.detalle')
                    ->with('env',$env)
                    ->with('marcas',$marcas)
                    ->with('modelos',$modelos)
                    ->with('masters',$masters)
                    ->with('request',$request)
                    ->with('det',$det)
                    ->with('det_all',$det_all)
                     ;
                }
                else
                {
                    $anios = V_stock_gtauto::select('ANIO_MOD')
                    ->where('cod_marca','=',$request->marca)
                    ->where('COD_MODELO','=',$request->modelo)
                    ->where('COD_MASTER','=',$request->master)
                    ->orderBy('ANIO_MOD', 'desc')
                    ->groupBy('ANIO_MOD')
                    ->pluck('ANIO_MOD','ANIO_MOD');

                    if(is_null($request->anio))
                    {
                        return view('distribuidor.envios.detalle')
                        ->with('env',$env)
                        ->with('marcas',$marcas)
                        ->with('modelos',$modelos)
                        ->with('masters',$masters)
                        ->with('anios',$anios)
                        ->with('request',$request)
                        ->with('det',$det)
                        ->with('det_all',$det_all)
                        ;
                    }
                    else
                    {
                        $exteriores = V_stock_gtauto::select('COLOR_EXTERNO')
                        ->where('cod_marca','=',$request->marca)
                        ->where('COD_MODELO','=',$request->modelo)
                        ->where('COD_MASTER','=',$request->master)
                        ->where('ANIO_MOD','=',$request->anio)
                        ->orderBy('COLOR_EXTERNO', 'desc')
                        ->groupBy('COLOR_EXTERNO')
                        ->pluck('COLOR_EXTERNO','COLOR_EXTERNO');

                        if(is_null($request->ext))
                        {
                            return view('distribuidor.envios.detalle')
                            ->with('env',$env)
                            ->with('exteriores',$exteriores)
                            ->with('marcas',$marcas)
                            ->with('modelos',$modelos)
                            ->with('masters',$masters)
                            ->with('anios',$anios)
                            ->with('request',$request)
                            ->with('det',$det)
                            ->with('det_all',$det_all)
                            ;
                        }
                        else
                        {  
                            $interiores = V_stock_gtauto::select('COLOR_INTERNO')
                            ->where('cod_marca','=',$request->marca)
                            ->where('COD_MODELO','=',$request->modelo)
                            ->where('COD_MASTER','=',$request->master)
                            ->where('ANIO_MOD','=',$request->anio)
                            ->where('COLOR_EXTERNO','=',$request->ext)
                            ->orderBy('COLOR_INTERNO', 'desc')
                            ->groupBy('COLOR_INTERNO')
                            ->pluck('COLOR_INTERNO','COLOR_INTERNO');

                            if(is_null($request->int))
                            {
                                return view('distribuidor.envios.detalle')
                                ->with('env',$env)
                                ->with('interiores',$interiores)
                                ->with('exteriores',$exteriores)
                                ->with('marcas',$marcas)
                                ->with('modelos',$modelos)
                                ->with('masters',$masters)
                                ->with('anios',$anios)
                                ->with('request',$request)
                                ->with('det',$det)
                                ->with('det_all',$det_all)
                                ;
                            }
                            else
                            {
                                $count = DB::table('V_stock_gtauto')
                                ->where('cod_marca','=',$request->marca)
                                ->where('COD_MODELO','=',$request->modelo)
                                ->where('COD_MASTER','=',$request->master)
                                ->where('ANIO_MOD','=',$request->anio)
                                ->where('COLOR_EXTERNO','=',$request->ext)
                                ->where('COLOR_INTERNO','=',$request->int)
                                ->whereNotIn('CHASIS', function($query) {
                                                    $query->select('chassis')
                                                    ->from(with(new Detalle_Chassis)->getTable())
                                                    ->where('estado','<','2');})
                                ->count();

                                return view('distribuidor.envios.detalle')
                                ->with('env',$env)
                                ->with('count',$count)
                                ->with('interiores',$interiores)
                                ->with('exteriores',$exteriores)
                                ->with('marcas',$marcas)
                                ->with('modelos',$modelos)
                                ->with('masters',$masters)
                                ->with('anios',$anios)
                                ->with('request',$request)
                                ->with('det',$det)
                                ->with('det_all',$det_all)
                                ;
                            }
                        }
                    }
                }
            }
        }
    }

    public function addDetalle(Request $request,$id)
    {
      
        $count = DB::table('detalles')->where ('id_envio','=',$id)->count();

        $remp =  Detalle::where('id_envio',$id)
            ->where('cod_marca',$request->marca)
            ->where('cod_modelo',$request->modelo)
            ->where('cod_master',$request->master)
            ->where('anio',$request->anio)
            ->where('col_ext',$request->ext)
            ->where('col_int',$request->int)
            ->first();

        if(is_null($remp))
        {
            $det = new Detalle();
            $det ->id_detalle = $count +1;
            $det ->id_envio = $id;
            $det ->cod_marca  = $request->marca;
            $det ->cod_modelo = $request->modelo;
            $det ->cod_master = $request->master;
            $det ->anio = $request->anio;
            $det ->col_ext = $request->ext;
            $det ->col_int = $request->int;
            $det ->cantidad = $request->cant;
            $det ->estado = '1';

            $det -> save();
            return redirect()->route('envios.detalle', ['id' => $id])->with('mensaje',"Seleccion ingresada correctamente"); 
        }
        else
        {
           return redirect()->route('envios.detalle', ['id' => $id])->with('mensaje_error',"Ya existe un registro con las mismas caracteristicas"); 
        } 
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function quitar_chasis($id)
    {
        //
    }

    public function quitar_detalle($id,$id_detalle)
    {   
        
        $det = Detalle::where('id_envio','=',$id)
        ->where('id_detalle','=',$id_detalle)
        ->delete();

         return redirect()->route('envios.detalle', ['id' => $id])->with('mensaje_info',"Seleccion eliminada correctamente"); 
    }

    public function editar_detalle(Request $request,$id)
    {   
        $env =Envio::find($id);

        $det_all = Detalle::where('id_envio','=',$id)->get();
        
        $det = Detalle::
            join('V_stock_gtauto', 'chassis', '=','V_stock_gtauto.CHASIS')
            ->where('V_stock_gtauto.MARCA','=',$request->marca)
            ->where('V_stock_gtauto.MODELO','=',$request->modelo)
            ->where('V_stock_gtauto.MASTER','=',$request->master)
            ->where('V_stock_gtauto.ANIO_MOD','=',$request->anio)
            ->where('V_stock_gtauto.COLOR_EXTERNO','=',$request->ext)
            ->where('V_stock_gtauto.COLOR_INTERNO','=',$request->int)
            ->where('id_envio','=',$id)
            ->get();

        $count = DB::table('V_stock_gtauto')
            ->where('MARCA','=',$request->marca)
            ->where('MODELO','=',$request->modelo)
            ->where('MASTER','=',$request->master)
            ->where('ANIO_MOD','=',$request->anio)
            ->where('COLOR_EXTERNO','=',$request->ext)
            ->where('COLOR_INTERNO','=',$request->int)
            ->whereNotIn('CHASIS', function($query) {
                                            $query->select('chassis')
                                            ->from(with(new Detalle)->getTable())
                                            ->join('envios','detalles.id_envio','envios.id_envio')
                                            ->where('envios.estado_envio','>','2');})
            ->count();

        $cant = DB::table('detalles')
            ->join('V_stock_gtauto', 'chassis', '=','V_stock_gtauto.CHASIS')
            ->where('V_stock_gtauto.MARCA','=',$request->marca)
            ->where('V_stock_gtauto.MODELO','=',$request->modelo)
            ->where('V_stock_gtauto.MASTER','=',$request->master)
            ->where('V_stock_gtauto.ANIO_MOD','=',$request->anio)
            ->where('V_stock_gtauto.COLOR_EXTERNO','=',$request->ext)
            ->where('V_stock_gtauto.COLOR_INTERNO','=',$request->int)
            ->where('id_envio','=',$id)
            ->count();

        return view('distribuidor.envios.detalle_edit')
            ->with('request',$request)
            ->with('det',$det)
            ->with('count',$count)
            ->with('cant',$cant)
            ->with('env',$env)
            ;
    }

    public function update_detalle(Request $request,$id)
    {   
        $det = Detalle::
            join('V_stock_gtauto', 'chassis', '=','V_stock_gtauto.CHASIS')
            ->where('V_stock_gtauto.MARCA','=',$request->marca)
            ->where('V_stock_gtauto.MODELO','=',$request->modelo)
            ->where('V_stock_gtauto.MASTER','=',$request->master)
            ->where('V_stock_gtauto.ANIO_MOD','=',$request->anio)
            ->where('V_stock_gtauto.COLOR_EXTERNO','=',$request->ext)
            ->where('V_stock_gtauto.COLOR_INTERNO','=',$request->int)
            ->where('id_envio','=',$id)
            ->delete();


        $count = DB::table('V_stock_gtauto')
            ->where('MARCA','=',$request->marca)
            ->where('MODELO','=',$request->modelo)
            ->where('MASTER','=',$request->master)
            ->where('ANIO_MOD','=',$request->anio)
            ->where('COLOR_EXTERNO','=',$request->ext)
            ->where('COLOR_INTERNO','=',$request->int)
            ->whereNotIn('CHASIS', function($query) {
                                            $query->select('chassis')
                                            ->from(with(new Detalle)->getTable())
                                            ->join('envios','detalles.id_envio','envios.id_envio')
                                            ->where('envios.estado_envio','>','2');})
            ->count();

        if ($request->cant <= $count)
        {
            $unidades = V_stock_gtauto::
              where('marca','=',$request->marca)
            ->where('MODELO','=',$request->modelo)
            ->where('MASTER','=',$request->master)
            ->where('ANIO_MOD','=',$request->anio)
            ->where('COLOR_EXTERNO','=',$request->ext)
            ->where('COLOR_INTERNO','=',$request->int)
            ->whereNotIn('CHASIS', function($query) use ($id){
                $query->select('chassis')
                ->from(with(new Detalle)->getTable())
                ->where('id_envio', $id);})
            ->whereNotIn('CHASIS', function($query) {
                                            $query->select('chassis')
                                            ->from(with(new Detalle)->getTable())
                                            ->join('envios','detalles.id_envio','envios.id_envio')
                                            ->where('envios.estado_envio','>','2');})
            ->paginate($request->cant);

            foreach($unidades as $add)
            {
                $det = new Detalle();
                $det -> id_envio = $id;
                $det -> chassis = $add->CHASIS;
                $det -> save();
            }

            return redirect()->route('envios.detalle', ['id' => $id])->with('mensaje_info',"Se cambio la cantidad correctamentente");    
        }  
    }

    public function quitar_chassis($id2,$id)
    {   
        $det = Detalle::
           
            where('id_envio','=',$id)
            ->where('chassis','=',$id2)
            ->delete();

         return redirect()->route('envios.detalle_all', ['id' => $id])->with('mensaje_info',"Chassis eliminado de la lista"); 
    }

    public function renovar_chassis(Request $request,$id)
    {   
        $det = Detalle::
            where('id_envio','=',$id)
            ->where('chassis','=',$request->chassis)
            ->delete();


        $count = DB::table('V_stock_gtauto')
            ->where('MARCA','=',$request->marca)
            ->where('MODELO','=',$request->modelo)
            ->where('MASTER','=',$request->master)
            ->where('ANIO_MOD','=',$request->anio)
            ->where('COLOR_EXTERNO','=',$request->ext)
            ->where('COLOR_INTERNO','=',$request->int)
            ->whereNotIn('CHASIS', function($query) {
                                            $query->select('chassis')
                                            ->from(with(new Detalle)->getTable())
                                            ->join('envios','detalles.id_envio','envios.id_envio')
                                            ->where('envios.estado_envio','>','2');})
            ->count();

        if ($count > 0)
        {
            $unidades = V_stock_gtauto::
              where('marca','=',$request->marca)
            ->where('MODELO','=',$request->modelo)
            ->where('MASTER','=',$request->master)
            ->where('ANIO_MOD','=',$request->anio)
            ->where('COLOR_EXTERNO','=',$request->ext)
            ->where('COLOR_INTERNO','=',$request->int)
            ->whereNotIn('CHASIS', function($query) use ($id){
                $query->select('chassis')
                ->from(with(new Detalle)->getTable())
                ->where('id_envio', $id);})
            ->whereNotIn('CHASIS', function($query) {
                                            $query->select('chassis')
                                            ->from(with(new Detalle)->getTable())
                                            ->join('envios','detalles.id_envio','envios.id_envio')
                                            ->where('envios.estado_envio','>','2');})
            ->paginate(1);


            foreach($unidades as $add)
            {
                $det = new Detalle();
                $det -> id_envio = $id;
                $det -> chassis = $add->CHASIS;
                $det -> save();
            }

        return redirect()->route('envios.aprobar', ['id' => $id])->with('mensaje_info',"Chassis renovado "); 
        }
    }
}
