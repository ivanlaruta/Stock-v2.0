@extends('layouts.main')

@section('content')
        
  <div class="right_col" role="main">
          <div class="">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>HOJA DE APROBACION /  
                   
                    <a href="{{ route('envios.detalle',$id)}}">PEDIDO {{$id}} /</a><small>Aprobacion de unidades </small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                     

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

                          {{-- <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">OBSERVACIONES</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              {!! Form::text('observaciones', $env->observaciones,['class'=> 'form-control','readonly'])!!}
                            </div>
                          </div>    --}}   
                        </form>
                      </div>
                    
<hr>

                    <?php $a = 0; ?>
                    </p>
                      <table id="datatabl" class="table table-sm">
                      <thead>
                        <tr>
                          <th>Marca</th>
                          <th>Modelo</th>
                          <th>Master</th>
                          <th>Año</th> 
                          <th>Exterior</th>
                          <th>Interior</th>
                          <th>Chassis</th>
                         
                          <th></th> 
                          
                        </tr>
                      </thead>
                        
                      <tbody>

                        @foreach($det_all as $dets)

                        <tr @if($dets -> estado == '0') class="success"  @else class="danger" @endif>
                        <td>{{ $dets -> MARCA }}</td>
                        <td>{{ $dets -> MODELO }}</td>
                        <td>{{ $dets -> MASTER }}</td>
                        <td>{{ $dets -> ANIO_MOD }}</td>
                        <td>{{ $dets -> COLOR_EXTERNO }}</td>
                        <td>{{ $dets -> COLOR_INTERNO }}</td>
                        <td>{{ $dets -> CHASIS }}</td>
                        
                        <td>
                          <div class="btn-group">
                            <button type="text" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-option-vertical"></span></button>
                            <ul class="dropdown-menu" role="menu">
                            
                            <li><a href="{{ route('envios.quitar_chassis',['id'=>$id ,'id2'=>$dets -> CHASIS ])}}">Quitar</a></li>
                            @if($dets -> estado == '1')
                            <?php $a=1; ?>
                            {!! Form::open(array('route' => ['envios.renovar_chassis',$env->id_envio], 'method' => 'get')) !!}﻿
                            <input id="marca" name="marca" type="hidden" value="{{ $dets -> MARCA }}">
                            <input id="modelo" name="modelo" type="hidden" value="{{ $dets -> MODELO }}">
                            <input id="master" name="master" type="hidden" value="{{ $dets -> MASTER }}">
                            <input id="anio" name="anio" type="hidden" value="{{ $dets -> ANIO_MOD }}">
                            <input id="ext" name="ext" type="hidden" value="{{ $dets -> COLOR_EXTERNO }}">
                            <input id="int" name="int" type="hidden" value="{{ $dets -> COLOR_INTERNO }}">
                            <input id="chassis" name="chassis" type="hidden" value="{{ $dets -> CHASIS }}">

                            <li><a href="#" onclick="$(this).closest('form').submit()"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Renovar </a></li>
                            {!! Form::close()!!}
                            @endif
                          </ul>
                        </div>
                        </td>                        
                        @endforeach
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
             </div>

             <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel ">
                  <div class="x_content">
                      <div>               
                        <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">                                    
                          

                          <a href="{{ route('envios.aprobacion',$env)}}" @if($a == 1 ) class="btn btn-success btn-block disabled"  @else class="btn btn-success btn-block" @endif >ACEPTAR </a>

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
              
@endsection

@section('scripts')
<script>

    $(document).ready(function() {
         //alert('1');
        $('#datatable1').DataTable({
          
             "language": {
            
              "sProcessing":     "Procesando...",
              "sLengthMenu":     "Mostrar _MENU_ registros",
              "sZeroRecords":    "No se encontraron resultados",
              "sEmptyTable":     "Ningún dato disponible en esta tabla",
              "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
              "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
              "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
              "sInfoPostFix":    "",
              "sSearch":         "Buscar:",
              "sUrl":            "",
              "sInfoThousands":  ",",
              "sLoadingRecords": "Cargando...",
              "oPaginate": {
                  "sFirst":    "Primero",
                  "sLast":     "Último",
                  "sNext":     "Siguiente",
                  "sPrevious": "Anterior"
              },
              "oAria": {
                  "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                  "sSortDescending": ": Activar para ordenar la columna de manera descendente"
              }

        },
      responsive: true

        });
    });

</script> 
@endsection
