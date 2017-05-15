@extends('layouts.main')

@section('content')
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Envios</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="...">
                    <span class="input-group-btn">
                              <button class="btn btn-default" type="button">Buscar</button>
                          </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel ">
                  <div class="x_title">
                    <h2>ENVIO # {{$env->id_envio}} <small>Datos generales</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content " style="display: none;" >


                    <!-- Smart Wizard -->
                    
                      <div>
                        <form class="form-horizontal form-label-left">

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">FECHA CREACION</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                      
                            {!! Form::text('fecha_creacion', $env->fecha_creacion,['class'=> 'form-control', 'readonly'])!!}
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">ORIGEN</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                             {!! Form::text('origen', $env->origen,['class'=> 'form-control', 'readonly'])!!}
                            
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">DESTINO</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                               {!! Form::text('destino',$env->destino,['class'=>'form-control','readonly'])!!}
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">TIPO</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            
                              {!! Form::text('tipo',$env->tipo,['class'=>'form-control ','readonly'])!!}

                            </div>
                          </div>

                          <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">OBSERVACIONES</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              {!! Form::text('observaciones', $env->observaciones,['class'=> 'form-control','readonly'])!!}
                            </div>
                          </div>      
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              {{-- fin general --}}

             {{-- detalle --}}

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>ITEMS <small>Agregar Unidades</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div>
                        
                         
                        {!! Form::open(array('route' => ['envios.detalle',$env->id_envio], 'method' => 'get','class' => 'form-horizontal form-label-left')) !!}﻿
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">MARCA</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            {!! Form::select('marca',$marcas,$request->marca,['class'=>'form-control','placeholder'=>'seleccione una marca' ,'onchange'=>'this.form.submit();'])!!}
                            </div>
                          </div>
                        {!! Form::close()!!}
                       
                        
                        {!! Form::open(array('route' => ['envios.detalle',$env->id_envio], 'method' => 'get','class' => 'form-horizontal form-label-left')) !!}﻿
                          <input id="marca" name="marca" type="hidden" value="{{ $request->marca }}">
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">MODELO</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">

                            @if(is_null($request->marca))
                             {!! Form::text('modelo',null,['class'=>'form-control','placeholder'=>'seleccione una marca','readonly'])!!}
                            @else
                            
                            {!! Form::select('modelo',$modelos,$request->modelo,['class'=>'form-control','placeholder'=>'seleccione una marca' ,'onchange'=>'this.form.submit();'])!!}
                            
                            @endif
                            </div>
                          </div>
                        {!! Form::close()!!}


                        {!! Form::open(array('route' => ['envios.detalle',$env->id_envio], 'method' => 'get','class' => 'form-horizontal form-label-left')) !!}﻿
                          <input id="marca" name="marca" type="hidden" value="{{ $request->marca }}">
                          <input id="modelo" name="modelo" type="hidden" value="{{ $request->modelo }}">
                          <div class="form-group">
                            

                            @if(is_null($request->marca) || is_null($request->modelo))
                             <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">MASTER</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                               {!! Form::text('master',null,['class'=>'form-control','placeholder'=>'seleccione una marca y un modelo','readonly'])!!}
                               </div>
                             </div>
                            @else
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">MASTER</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                              {!! Form::select('master',$masters,$request->master,['class'=>'form-control','placeholder'=>'seleccione una master' ,'onchange'=>'this.form.submit();'])!!}
                              </div>
                            @endif
                          </div>
                        {!! Form::close()!!}


                        {!! Form::open(array('route' => ['envios.detalle',$env->id_envio], 'method' => 'get','class' => 'form-horizontal form-label-left')) !!}﻿
                          <input id="marca" name="marca" type="hidden" value="{{ $request->marca }}">
                          <input id="modelo" name="modelo" type="hidden" value="{{ $request->modelo }}">
                          <input id="master" name="master" type="hidden" value="{{ $request->master }}">

                          <div class="form-group">
                            @if(is_null($request->marca) || is_null($request->modelo) || is_null($request->master))
                             <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">AÑO</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                               {!! Form::text('anio',null,['class'=>'form-control','placeholder'=>'seleccione una marca, modelo y master','readonly'])!!}
                               </div>
                             </div>
                            @else
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">AÑO</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                              {!! Form::select('anio',$anios,$request->anio,['class'=>'form-control','placeholder'=>'seleccione una master' ,'onchange'=>'this.form.submit();'])!!}
                              </div>
                            @endif
                          </div>
                        {!! Form::close()!!}


                        {!! Form::open(array('route' => ['envios.detalle',$env->id_envio], 'method' => 'get','class' => 'form-horizontal form-label-left')) !!}﻿
                          <input id="marca" name="marca" type="hidden" value="{{ $request->marca }}">
                          <input id="modelo" name="modelo" type="hidden" value="{{ $request->modelo }}">
                          <input id="master" name="master" type="hidden" value="{{ $request->master }}">

                          <div class="form-group">
                           
                             <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">COLOR EXTERIOR</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                               {!! Form::text('col_ext',null,['class'=>'form-control','placeholder'=>'seleccione un color','readonly'])!!}
                               </div>
                             </div>
                            
                          </div>
                        {!! Form::close()!!}


                        {!! Form::open(array('route' => ['envios.detalle',$env->id_envio], 'method' => 'get','class' => 'form-horizontal form-label-left')) !!}﻿
                          <input id="marca" name="marca" type="hidden" value="{{ $request->marca }}">
                          <input id="modelo" name="modelo" type="hidden" value="{{ $request->modelo }}">
                          <input id="master" name="master" type="hidden" value="{{ $request->master }}">

                          <div class="form-group">
                             <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">COLOR INTERIOR</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                               {!! Form::text('col_int',null,['class'=>'form-control','placeholder'=>'seleccione un color','readonly'])!!}
                               </div>
                             </div>
                          </div>
                        {!! Form::close()!!}

                        {!! Form::open(array('route' => ['envios.detalle',$env->id_envio], 'method' => 'get','class' => 'form-horizontal form-label-left')) !!}﻿
                          <input id="marca" name="marca" type="hidden" value="{{ $request->marca }}">
                          <input id="modelo" name="modelo" type="hidden" value="{{ $request->modelo }}">
                          <input id="master" name="master" type="hidden" value="{{ $request->master }}">

                          <div class="form-group">
                             
                             <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">CANTIDAD</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                               {!! Form::text('cantidad',null,['class'=>'form-control','placeholder'=>'seleccione una cantidad','readonly'])!!}
                               </div>
                             </div>
                          </div>

                          <div class="form-group">
                            {!! Form::submit('AGREGAR A LISTA',['class'=>'btn btn-primary'])!!}
                          </div>
                        {!! Form::close()!!}

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              {{-- fin detalle --}}
            </div>
          </div>
        
@endsection

@section('scripts')
