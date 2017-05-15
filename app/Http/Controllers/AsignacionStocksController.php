<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AsignacionStock;
use DB;
class AsignacionStocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $v = DB::table('asignacion_stocks as s')
        ->select('s.id_stock','ma.MARCA','s.cod_modelo','s.cod_master','s.regional','s.stock_min','s.stock_asignado','m.MODELO')
        ->Join ('v_modelos as m' ,'s.cod_modelo','=','m.cod_modelo')
         ->Join ('v_marcas as ma' ,'ma.cod_marca','=','m.cod_marca')    
         ->orderBy('id_stock','ASC')->paginate(10);
        
        return view('distribuidor.admin.stock')
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
