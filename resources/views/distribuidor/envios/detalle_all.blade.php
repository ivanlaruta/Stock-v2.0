@extends('layouts.main')

@section('content')
        
  <div class="right_col" role="main">
          <div class="">
          <div class="page-title">
              <div class="title_left">
                <h2>
                @if($env->estado_envio == '1')<a href="{{ route('envios.index')}}">BORRADORES /  </a>@endif
                    @if($env->estado_envio == '2') <a href="{{ route('envios.index')}}">EN ESPERA DE APROBACION /  </a> @endif
                    @if($env->estado_envio == '3')<a href="{{ route('envios.index')}}">APROBADOS /  </a>@endif
                    @if($env->estado_envio == '4')<a href="{{ route('envios.index')}}">APROBADOS EN ENVIO /  </a>@endif
                    <a href="{{ route('envios.detalle',$id)}}">ENVIO {{$env->id_envio}} </a>
                </h2>
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

              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>
                   
                   <small>Detalle de unidades reservadas</small></h2>
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
                          <th>#</th>
                          <th>Marca</th>
                          <th>Modelo</th>
                          <th>Master</th>
                          <th>Año</th> 
                          <th>Exterior</th>
                          <th>Interior</th>
                          <th>Chassis</th>
                          <th>Envio</th>
                          <th>ETA</th>
                          <th>Estado</th>
                          
                        </tr>
                      </thead>
                        
                      <tbody>
                        @foreach($det_all as $dets)
                        <tr>
                        <td>{{ $dets -> ITEM }}</td>
                        <td>{{ $dets -> vehiculo -> MARCA }}</td>
                        <td>{{ $dets -> vehiculo -> MODELO }}</td>
                        <td>{{ $dets -> vehiculo -> MASTER }}</td>
                        <td>{{ $dets -> vehiculo -> ANIO_MOD }}</td>
                        <td>{{ $dets -> vehiculo -> COLOR_EXTERNO }}</td>
                        <td>{{ $dets -> vehiculo -> COLOR_INTERNO }}</td>
                        <td>{{ $dets -> chassis }}</td>
                        <td>{{ date('d-m-Y',strtotime($dets -> fecha_envio)) }}</td>
                        <td>{{ date('d-m-Y',strtotime($dets -> fecha_estimada_arribo)) }}</td>
                        <td>{{ $dets -> estado }}</td>
                         </tr>                 
                        @endforeach
                        
                      </tbody>
                    </table>
                  </div>
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
