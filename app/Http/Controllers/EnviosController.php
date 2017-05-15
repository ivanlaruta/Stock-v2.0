<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\V_ubicacion;
use App\Envio;
use App\Marca;
use App\Modelo;
use App\Master;
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
              
       dd($request);
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
        $env = new Envio($request->all());
        $env->save();    
       
        return redirect()->route('envios.detalle', ['id' => $env->id_envio]);
    }

    public function detalle(Request $request,$id)
    {
        $env =Envio::find($id);
        $marcas =Marca::whereIn('MARCA', ['YAMAHA', 'TOYOTA', 'LEXUS'])
            ->orderBy('MARCA','ASC')
            ->pluck('MARCA','cod_marca')
            ;

        if(is_null($request->marca))
        {
            return view('distribuidor.envios.detalle')
            ->with('env',$env)
            ->with('marcas',$marcas)
            ->with('request',$request)
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

                    return view('distribuidor.envios.detalle')
                    ->with('env',$env)
                    ->with('marcas',$marcas)
                    ->with('modelos',$modelos)
                    ->with('masters',$masters)
                    ->with('anios',$anios)
                    ->with('request',$request)
                     ;
                }
            }
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
