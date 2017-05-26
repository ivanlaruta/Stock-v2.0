<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\V_stock_gtauto;
use App\V_ubicacion;
use Illuminate\Support\Facades\Auth;
use DB;
class VehiculosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $v = V_stock_gtauto::where('estado', '=', 'DISPONIBLE')->get();
        return view('distribuidor.stock.vehiculos')
            ->with('v',$v)
        ;
    }

    public function stock(Request $request)
    {
        $ubica =V_ubicacion::select('ciudad')->groupBy('ciudad')->orderBy('ciudad','ASC')->pluck('ciudad','ciudad');
        if(is_null($request->ciudad))
        { 

        $request->ciudad='TODOS';
        $mod_T = DB::select( DB::raw("select m.MODELOS,m.MARCA, COUNT(m.MODELOS) as STOCK_REAL FROM v_stock_gtauto m WHERE m.estado = 'DISPONIBLE' AND m.cod_marca = 'T'  GROUP BY m.MODELOS ,M.MARCA ORDER BY m.MODELOS ASC"));
        $mod_L = DB::select( DB::raw("select m.MODELOS,m.MARCA, COUNT(m.MODELOS) as STOCK_REAL FROM v_stock_gtauto m WHERE m.estado = 'DISPONIBLE' AND m.cod_marca = 'L' GROUP BY m.MODELOS ,M.MARCA ORDER BY m.MODELOS ASC"));
        $mod_Y = DB::select( DB::raw("select m.MODELOS,m.MARCA, COUNT(m.MODELOS) as STOCK_REAL FROM v_stock_gtauto m WHERE MODELOS NOT IN ('BOMBA DE AGUA','GENERADOR DIESEL','MOTOR A GASOLINA') AND m.estado = 'DISPONIBLE' AND m.cod_marca = 'Y' GROUP BY m.MODELOS ,M.MARCA ORDER BY m.MODELOS ASC"));
        }
        else
        {
        $mod_T = DB::select( DB::raw("select m.MODELOS,m.MARCA, COUNT(m.MODELOS) as STOCK_REAL FROM v_stock_gtauto m WHERE m.estado = 'DISPONIBLE' AND m.cod_marca = 'T' AND m.nom_localidad='".$request->ciudad."' GROUP BY m.MODELOS ,M.MARCA ORDER BY m.MODELOS ASC"));
        $mod_L = DB::select( DB::raw("select m.MODELOS,m.MARCA, COUNT(m.MODELOS) as STOCK_REAL FROM v_stock_gtauto m WHERE m.estado = 'DISPONIBLE' AND m.cod_marca = 'L' AND m.nom_localidad='".$request->ciudad."' GROUP BY m.MODELOS ,M.MARCA ORDER BY m.MODELOS ASC"));
        $mod_Y = DB::select( DB::raw("select m.MODELOS,m.MARCA, COUNT(m.MODELOS) as STOCK_REAL FROM v_stock_gtauto m WHERE  MODELOS NOT IN ('BOMBA DE AGUA','GENERADOR DIESEL','MOTOR A GASOLINA') AND m.estado = 'DISPONIBLE' AND m.cod_marca = 'Y' AND m.nom_localidad='".$request->ciudad." 'GROUP BY m.MODELOS ,M.MARCA ORDER BY m.MODELOS ASC"));
        }

        return view('distribuidor.stock.stock')
        ->with('mod_T',$mod_T)
        ->with('mod_L',$mod_L)
        ->with('mod_Y',$mod_Y)
        ->with('ubica',$ubica)
        ->with('request',$request)
        ;
    }
    
    public function modelos($modelos,$marca,$ciudad)
    {   

        if($ciudad=='TODOS')
        { 
        $mod = DB::select( DB::raw("select m.COD_MODELO,m.MODELO,m.MARCA, COUNT(m.MODELO) as STOCK_REAL FROM v_stock_gtauto m WHERE m.estado = 'DISPONIBLE' AND m.MODELOS = '".$modelos."' GROUP BY m.COD_MODELO,m.MODELO ,M.MARCA ORDER BY m.MODELO ASC")); 
        }
        else
        {
        $mod = DB::select( DB::raw("select m.COD_MODELO,m.MODELO,m.MARCA, COUNT(m.MODELO) as STOCK_REAL FROM v_stock_gtauto m WHERE m.estado = 'DISPONIBLE' AND m.MODELOS = '".$modelos."' AND m.nom_localidad='".$ciudad."' GROUP BY m.COD_MODELO,m.MODELO ,M.MARCA ORDER BY m.MODELO ASC")); 
        }
       return view('distribuidor.stock.modelos')
        ->with('marca',$marca)
        ->with('modelos',$modelos)
        ->with('mod',$mod)
        ->with('ubica',$mod)
        ->with('ciudad',$ciudad);
    }

    public function master($modelo,$modelos,$marca,$ciudad)
    {   
        if($ciudad=='TODOS')
        { 
        $mas = DB::select( DB::raw("select m.COD_MASTER,m.MASTER,m.MODELOS,m.MARCA, COUNT(m.MASTER)as STOCK_REAL  FROM v_stock_gtauto m  WHERE m.estado = 'DISPONIBLE'  AND m.COD_MODELO = '".$modelo."'  GROUP BY m.COD_MASTER,m.MODELOS,M.MARCA,M.MASTER ORDER BY m.MASTER ASC ")); 
                
        }
        else
        {
            $mas = DB::select( DB::raw("select s.stock_min, s.stock_asignado,m.COD_MASTER,m.MASTER,m.MODELOS,m.MARCA, COUNT(m.MASTER)as STOCK_REAL  FROM v_stock_gtauto m ,asignacion_stocks s WHERE m.estado = 'DISPONIBLE'  AND m.COD_MODELO = '".$modelo."' AND m.nom_localidad='".$ciudad."' AND  s.regional=m.nom_localidad AND m.COD_MASTER = s.cod_master GROUP BY m.COD_MASTER,m.MODELOS,M.MARCA,M.MASTER ,s.stock_min, s.stock_asignado ORDER BY m.MASTER ASC "));  
        }
        $modelo1 = V_stock_gtauto::select('MODELO')->where('COD_MODELO', '=', $modelo)->first();

       return view('distribuidor.stock.master')
        ->with('marca',$marca)
        ->with('modelo',$modelo1)
        ->with('modelos',$modelos)
        ->with('ciudad',$ciudad)
        ->with('mas',$mas);
    }

    public function det_vehiculos($master,$modelo,$modelos,$marca,$ciudad)
    {   
        if($ciudad=='TODOS')
        {
        $v = V_stock_gtauto::where('estado', '=', 'DISPONIBLE')
       ->where('COD_MASTER', '=', $master)
       ->get();
        }
        else
        {
        $v = V_stock_gtauto::where('estado', '=', 'DISPONIBLE')
       ->where('COD_MASTER', '=', $master)
       ->where('nom_localidad', '=', $ciudad)
       ->get();
        }
        $mast = V_stock_gtauto::select('MASTER')->where('COD_MASTER', '=', $master)->first();

        return view('distribuidor.stock.det_vehiculos')
        ->with('marca',$marca)
        ->with('modelo',$modelo)
        ->with('modelos',$modelos)
        ->with('master',$master)
        ->with('mast',$mast)
        ->with('ciudad',$ciudad)
            ->with('v',$v)
        ;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
