@extends('layouts.main')

@section('content')
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            
            
            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel ">
                  <div class="x_title">
                    <h2>ENVIO {{$env->id_envio}} <small>Datos generales</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
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

             {{-- detalle (agregar unidades)--}}

            <div   class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>EDITAR <small>Editar Unidades</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up" ></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>     
              
                  <div  class="x_content">

                   {!! Form::open(array('route' => ['envios.update_detalle',$env->id_envio], 'method' => 'get')) !!}﻿
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="col-md-4">
                        <label class="control-label " for="first-name">MARCA</label>
                        {!! Form::text('marca',$request->marca,['class'=>'form-control','readonly'])!!}
                      </div>
                      <div class="col-md-4">                     
                        <label class="control-label " for="first-name">MODELO</label>
                        {!! Form::text('modelo',$request->modelo,['class'=>'form-control','readonly'])!!}           
                      </div>
                      <div class="col-md-4"> 
                        <label class="control-label " for="first-name">MASTER</label>
                        {!! Form::text('master',$request->master,['class'=>'form-control','readonly'])!!}
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="col-md-4">
                        <label class="control-label " for="first-name">AÑO</label>
                        {!! Form::text('anio',$request->anio,['class'=>'form-control','readonly'])!!}     
                      </div>
                      <div class="col-md-4"> 
                        <label class="control-label " for="first-name">COLOR EXTERIOR</label>
                        {!! Form::text('ext',$request->ext,['class'=>'form-control','readonly'])!!}                        
                      </div>
                      <div class="col-md-4"> 
                        <label class="control-label " for="first-name">COLOR INTERIOR</label>
                        {!! Form::text('int',$request->int,['class'=>'form-control','readonly'])!!}
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="col-md-4">
                        <label class="control-label " for="first-name">CANTIDAD DISPONIBLE</label>
                        {!! Form::text('disp',$count,['class'=>'form-control','readonly'])!!}
                      </div>
                    
                      <div class="col-md-4">
                        <label class="control-label " for="first-name">CANTIDAD A ASIGNAR</label>
                        {!! Form::number('cant',$cant,['class'=> 'form-control','placeholder'=>'Ingrese cantidad','min'=>'1' ,'max'=>$count,'required'])!!}<hr>
                      </div>
                    </div>
               
                    <div class="form-group">
                      <div class="col-md-6 col-xs-12 col-md-offset-3">
                        {!! Form::submit('ACEPTAR',['class'=>'btn btn-success btn-block animated pulse'])!!}
                      </div>
                    </div>
                           
                    {!! Form::close()!!}

                      </div>
                    </div>
                  </div>
                </div>
              
              {{-- fin detalle --}}   

              {{-- LISTA --}}   
               
              <div class="row"></div>

              {{-- fin LISTA --}}
          
              <div class="row"></div>

                </div>
              </div>
            </div>


            </div>
          </div>
        
@endsection

@section('scripts')
<script>

</script> 
@endsection

