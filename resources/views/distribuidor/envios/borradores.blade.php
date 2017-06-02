@extends('layouts.main')

@section('content')
        
  <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
              <div class="title_left">
                <h3>ENVIOS / <small>Lista de Envios</small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="pull-right">
                      <a href="{{ route('envios.create')}}" class="btn btn-success btn-round " data-toggle="tooltip" data-placement="bottom" title="Agregar" ><i class="fa fa-plus"></i> Crear nuevo envio</a>
                  </div>
                </div>
              </div>
            </div>

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><small>BORRADORES</small> </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                     
                    </p>

                  <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                     
                      <thead>
                        <tr>
                          <th>Envio</th>
                          <th>Origen</th>
                          <th>Destino</th>
                          <th>Tipo</th>
                          <th>Creacion</th>
                          <th>Observacion</th>
                          
                        </tr>
                      </thead>
                        
                      <tbody>
                        @foreach($env as $envs)
                        <tr class='clickable-row' data-href="{{ route('envios.detalle',$envs-> id_envio )}}" >                
                          <td>{{ $envs-> id_envio }}</td>
                          <td>{{ $envs -> origen }}</td>
                          <td>{{ $envs -> destino }}</td>
                          <td>{{ $envs -> tipo}}</td>
                          <td>{{ date('d-m-Y',strtotime($envs -> fecha_creacion)) }}</td>
                          <td>{{ $envs -> observaciones }}</td>
                          
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div></div>
                </div>
              </div>


              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><small>EN ESPERA DE APROBACION</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                     
                    </p>

                  <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                     
                      <thead>
                        <tr>
                          <th>Envio</th>
                          <th>Origen</th>
                          <th>Destino</th>
                          <th>Tipo</th>
                          <th>Creacion</th>
                          <th>Reserva</th>
                          <th>Observacion</th>
                          
                        </tr>
                      </thead>
                        
                      <tbody>
                        @foreach($env_esp as $envs1)
                        <tr class='clickable-row' data-href="{{ route('envios.detalle',$envs1-> id_envio )}}" >                
                          <td>{{ $envs1-> id_envio }}</td>
                          <td>{{ $envs1 -> origen }}</td>
                          <td>{{ $envs1 -> destino }}</td>
                          <td>{{ $envs1 -> tipo}}</td>
                          <td>{{ date('d-m-Y',strtotime($envs1 -> fecha_creacion)) }}</td>
                          <td>{{ date('d-m-Y',strtotime($envs1 -> fecha_espera)) }}</td>
                          <td>{{ $envs1 -> observaciones }}</td>
                          
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div></div>
                </div>
              </div>


            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><small>APROBADOS</small> </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                     
                    </p>

                  <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                     
                      <thead>
                        <tr>
                          <th>Envio</th>
                          <th>Origen</th>
                          <th>Destino</th>
                          <th>Tipo</th>
                          <th>Creacion</th>
                          <th>Aprobacion</th>
                          <th>Envio</th>
                          <th>Estado</th>

                         
                          
                        </tr>
                      </thead>
                        
                      <tbody>
                        @foreach($env_aprob as $envs2)
                        <tr @if($envs2 -> estado_envio == '3') class="clickable-row danger" @endif
                            @if($envs2 -> estado_envio == '4') class="clickable-row warning" @endif
                            @if($envs2 -> estado_envio == '5') class="clickable-row info" @endif
                            @if($envs2 -> estado_envio == '6') class="clickable-row success" @endif
                            id="clickable-row" data-href="{{ route('envios.detalle',$envs2-> id_envio )}}" >    

                          <td>{{ $envs2-> id_envio }}</td>
                          <td>{{ $envs2 -> origen }}</td>
                          <td>{{ $envs2 -> destino }}</td>
                          <td>{{ $envs2 -> tipo}}</td>
                          <td>{{ date('d-m-Y',strtotime($envs2 -> fecha_creacion)) }}</td>
                          <td>{{ date('d-m-Y',strtotime($envs2 -> fecha_aprobado)) }}</td>
                          <td>@if(is_null($envs2 -> fecha_envio)) --- @else {{ date('d-m-Y',strtotime($envs2 -> fecha_envio)) }}@endif</td>
                          <td>
                            @if($envs2 -> estado_envio == '3')Sin enviar @endif
                            @if($envs2 -> estado_envio == '4')Envio Incompleto @endif
                            @if($envs2 -> estado_envio == '5')Envio completo @endif
                            @if($envs2 -> estado_envio == '6')Finalizado @endif
                          </td>
                          
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div></div>
                </div>
              </div>






















             </div>
            </div>
              
@endsection

@section('scripts')
<script>

$(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});

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
