@extends('layouts.main')

@section('content')
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            
            
            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel ">
                  <div class="x_title">
                    <h2>ENVIO 00{{$env->id_envio}} <small>Datos generales</small></h2>
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

            <div @if(is_null($request->marca)) class="row animated flash" @else  class="row" @endif>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>AGREGAR <small>Agregar Unidades</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i @if(is_null($request->marca)) class="fa fa-chevron-down" @else class="fa fa-chevron-up" @endif ></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                         
              
                  <div  class="x_content" @if(is_null($request->marca))  style="display: none;"  @endif>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="col-md-4">

                        {!! Form::open(array('route' => ['envios.detalle',$env->id_envio], 'method' => 'get','class' => 'form-horizontal form-label-left')) !!}﻿
                       
                            <label class="control-label " for="first-name">MARCA</label>
                           
                            {!! Form::select('marca',$marcas,$request->marca,['class'=>'form-control','placeholder'=>'seleccione una marca' ,'onchange'=>'this.form.submit();'])!!}

                        {!! Form::close()!!}
                        </div>
                        <div class="col-md-4">                       
                        
                        {!! Form::open(array('route' => ['envios.detalle',$env->id_envio], 'method' => 'get','class' => 'form-horizontal form-label-left')) !!}﻿
                          <input id="marca" name="marca" type="hidden" value="{{ $request->marca }}">
                         
                            <label class="control-label " for="first-name">MODELO</label>
                        

                            @if(is_null($request->marca))
                             {!! Form::text('modelo',null,['class'=>'form-control','placeholder'=>'seleccione una marca','readonly'])!!}
                            @else
                            
                            {!! Form::select('modelo',$modelos,$request->modelo,['class'=>'form-control','placeholder'=>'seleccione un modelo' ,'onchange'=>'this.form.submit();'])!!}
                            
                            @endif
                           
                        {!! Form::close()!!}
                        </div>
                        <div class="col-md-4"> 

                        {!! Form::open(array('route' => ['envios.detalle',$env->id_envio], 'method' => 'get','class' => 'form-horizontal form-label-left')) !!}﻿
                          <input id="marca" name="marca" type="hidden" value="{{ $request->marca }}">
                          <input id="modelo" name="modelo" type="hidden" value="{{ $request->modelo }}">
                         

                              <label class="control-label " for="first-name">MASTER</label>
                             
                              @if(is_null($request->marca) || is_null($request->modelo))
                               {!! Form::text('master',null,['class'=>'form-control','placeholder'=>'seleccione una marca y un modelo','readonly'])!!}
                            
                            @else
                              
                              {!! Form::select('master',$masters,$request->master,['class'=>'form-control','placeholder'=>'seleccione un master' ,'onchange'=>'this.form.submit();'])!!}
                              
                            @endif
                           

                        {!! Form::close()!!}
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-4">
                        {!! Form::open(array('route' => ['envios.detalle',$env->id_envio], 'method' => 'get','class' => 'form-horizontal form-label-left')) !!}﻿
                          <input id="marca" name="marca" type="hidden" value="{{ $request->marca }}">
                          <input id="modelo" name="modelo" type="hidden" value="{{ $request->modelo }}">
                          <input id="master" name="master" type="hidden" value="{{ $request->master }}">

                       
                              <label class="control-label " for="first-name">AÑO</label>
                             
                                @if(is_null($request->marca) || is_null($request->modelo) || is_null($request->master))
                               {!! Form::text('anio',null,['class'=>'form-control','placeholder'=>'seleccione una marca, modelo y master','readonly'])!!}
                               
                            @else
                              
                              {!! Form::select('anio',$anios,$request->anio,['class'=>'form-control','placeholder'=>'seleccione un año' ,'onchange'=>'this.form.submit();'])!!}
                              
                            @endif
                           
                        {!! Form::close()!!}
                        </div>
                        <div class="col-md-4"> 
                        {!! Form::open(array('route' => ['envios.detalle',$env->id_envio], 'method' => 'get','class' => 'form-horizontal form-label-left')) !!}﻿
                          <input id="marca" name="marca" type="hidden" value="{{ $request->marca }}">
                          <input id="modelo" name="modelo" type="hidden" value="{{ $request->modelo }}">
                          <input id="master" name="master" type="hidden" value="{{ $request->master }}">
                          <input id="anio" name="anio" type="hidden" value="{{ $request->anio }}">

                         

                              <label class="control-label " for="first-name">COLOR EXTERIOR</label>
                              
                                @if(is_null($request->marca) || is_null($request->modelo) || is_null($request->master) || is_null($request->anio))
                               {!! Form::text('ext',null,['class'=>'form-control','placeholder'=>'seleccione un color','readonly'])!!}
                               
                            @else
                              
                              {!! Form::select('ext',$exteriores,$request->ext,['class'=>'form-control','placeholder'=>'seleccione un color' ,'onchange'=>'this.form.submit();'])!!}
                              
                            @endif
                           
                        {!! Form::close()!!}
                        </div>
                        <div class="col-md-4"> 

                        {!! Form::open(array('route' => ['envios.detalle',$env->id_envio], 'method' => 'get','class' => 'form-horizontal form-label-left')) !!}﻿
                          <input id="marca" name="marca" type="hidden" value="{{ $request->marca }}">
                          <input id="modelo" name="modelo" type="hidden" value="{{ $request->modelo }}">
                          <input id="master" name="master" type="hidden" value="{{ $request->master }}">
                          <input id="anio" name="anio" type="hidden" value="{{ $request->anio }}">
                          <input id="ext" name="ext" type="hidden" value="{{ $request->ext }}">
                         
                              <label class="control-label " for="first-name">COLOR INTERIOR</label>
                              
                                @if(is_null($request->marca) || is_null($request->modelo) || is_null($request->master) || is_null($request->anio) || is_null($request->ext))
                               {!! Form::text('int',null,['class'=>'form-control','placeholder'=>'seleccione un color','readonly'])!!}
                            @else
                              {!! Form::select('int',$interiores,$request->int,['class'=>'form-control','placeholder'=>'seleccione un color' ,'onchange'=>'this.form.submit();'])!!}
                            @endif
                            

                        {!! Form::close()!!}
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        
                        {!! Form::open(array('route' => ['envios.addDetalle',$env->id_envio], 'method' => 'get','class' => 'form-horizontal form-label-left')) !!}﻿

                          <input id="marca" name="marca" type="hidden" value="{{ $request->marca }}">
                          <input id="modelo" name="modelo" type="hidden" value="{{ $request->modelo }}">
                          <input id="master" name="master" type="hidden" value="{{ $request->master }}">
                          <input id="anio" name="anio" type="hidden" value="{{ $request->anio }}">
                          <input id="ext" name="ext" type="hidden" value="{{ $request->ext }}">
                          <input id="int" name="int" type="hidden" value="{{ $request->int }}">

                          @if(is_null($request->marca) || is_null($request->modelo) || is_null($request->master) || is_null($request->anio) || is_null($request->ext) || is_null($request->int))

                          <div class="col-md-4">
                                <label class="control-label " for="first-name">CANTIDAD DISPONIBLE</label>
                                
                                {!! Form::text('disp',NULL,['class'=>'form-control','readonly'])!!}
                          </div>
                          <div class="col-md-4"> 
    

                                <label class="control-label " for="first-name">CANTIDAD A ASIGNAR</label>
                               
                                {!! Form::number('cant',null,['class'=> 'form-control','placeholder'=>'Ingrese cantidad','readonly'])!!}<hr>
                          </div>
                           </div>
                          
                            <div class="form-group">
                              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                  <button type="button" class = "btn btn-success btn-block disabled">AGREGAR A LA LISTA</button>
                         </div>  </div>
                        

                            @else
                            <div class="col-md-4"> 
                          
                                <label class="control-label " for="first-name">CANTIDAD DISPONIBLE</label>
                              
                                {!! Form::text('disp',$count,['class'=>'form-control','readonly'])!!}
                             </div>
                            <div class="col-md-4"> 

                                <label class="control-label " for="first-name">CANTIDAD A ASIGNAR</label>
                              
                                {!! Form::number('cant',null,['class'=> 'form-control','placeholder'=>'Ingrese cantidad','min'=>'1' ,'max'=>$count,'required'])!!}<hr>
                            </div>
                           </div>

                          
                            <div class="form-group">
                              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                {!! Form::submit('AGREGAR A LA LISTA',['class'=>'btn btn-success btn-block animated pulse'])!!}
                              </div>
                            </div>
                            
                            @endif
                    
                        {!! Form::close()!!}

                       
                        
                      </div>
                    </div>
                  </div>
                </div>
              
              {{-- fin detalle --}}   



              {{-- LISTA --}}   


               
              <div class="row">
             

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel ">
                  <div class="x_title">
                    <h2>SELECCIONES AGREGADAS <small>Lista resumen</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <!-- Smart Wizard -->
                      <div>
                       
                       <p class="text-muted font-13 m-b-30"></p>


                     <table id="datatable1" class="table table-hover">
                      <thead>
                        <tr>

                          <th>#</th>
                          <th>Marca</th>
                          <th>Modelo</th>
                          <th>Master</th>
                          <th>Año</th> 
                          <th>Exterior</th>
                          <th>Interior</th>
                          <th>Cantidad</th>
                          <th></th> 
                          
                        </tr>
                      </thead>
                        
                      <tbody>
                        @foreach($det as $dets)
                        <tr>
                        <td>{{ $dets -> ITEM}}</td>
                        <td>{{ $dets -> MARCA }}</td>
                        <td>{{ $dets -> MODELO }}</td>
                        <td>{{ $dets -> MASTER }}</td>
                        <td>{{ $dets -> ANIO_MOD }}</td>
                        <td>{{ $dets -> COLOR_EXTERNO }}</td>
                        <td>{{ $dets -> COLOR_INTERNO }}</td>
                        <td>{{ $dets -> CANTIDAD }}</td>

                        <td>
                        <div class="btn-group">
                            <button type="text" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-option-vertical"></span></button>
                            <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('envios.detalle_all',['id' => $env-> id_envio, 'id2' =>$dets -> MARCA , 'id3' =>$dets -> MODELO, 'id4' =>$dets -> MASTER, 'id5' =>$dets -> ANIO_MOD, 'id6' =>$dets -> COLOR_EXTERNO, 'id7' =>$dets -> COLOR_INTERNO])}}">Ver detalle</a></li>
                            <li><a href="#">Editar cantidad</a></li>
                            <li><a href="#">Quitar</a></li>
                          </ul>
                        </div>

                         {{--  <a href="#" class="btn btn-warning" title="Modificar"><span class="fa fa-edit "></span></a>
                          <a href="#" onclick ="return confirm('¿Desea quitar de la lista?')" class="btn btn-danger" title="Eliminar"><span class="fa fa-trash-o"></span></a>   --}}
                       
                        </td>
                        @endforeach
                       
                      </tbody>
                    </table>
                    <hr>
                    <a href="{{ route('envios.detalle_all',['id' => $env-> id_envio, 'id2' =>'0', 'id3' =>'0', 'id4' =>'0', 'id5' =>'0', 'id6' =>'0', 'id7' =>'0'])}}">
                        <div class="panel-footer">
                            <span class="pull-left">Ver Todo el detalle</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>

                    
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              {{-- fin LISTA --}}
              


              <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel ">
                  <div class="x_content">
                      <div>
                     
                        <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-2">
                          <button type="button" class="btn btn-primary">GUARDAR COMO BORRADOR</button>
                          <button type="reset" class="btn btn-primary">GUARDAR PARA APROBACION</button>
                          <button type="submit" class="btn btn-success">GUARDAR Y APROBAR </button>
                        </div>
                      </div>

                      </div>
                      <hr>
                      <br>
                    </div>
                  </div>
                </div>
              </div>


              

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

