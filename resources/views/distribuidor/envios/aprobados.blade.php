@extends('layouts.main')

@section('content')
        
  <div class="right_col" role="main">
          <div class="">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>APROBADOS <small>Envios</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                     
                    </p>


                     <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Envio</th>
                          <th>Origen</th>
                          <th>Destino</th>
                          <th>Tipo</th>
                          <th>Observacion</th>
                          <th>Creacion</th>
                          <th>guardado</th>
                          <th>Aprobado</th>
                          <th></th>
                          
                        </tr>
                      </thead>
                        
                      <tbody>
                        @foreach($env as $envs)
                        <tr>                
                          <td>{{ $envs-> id_envio }}</td>
                          <td>{{ $envs -> origen }}</td>
                          <td>{{ $envs -> destino }}</td>
                          <td>{{ $envs -> tipo}}</td>
                          <td>{{ $envs -> observaciones }}</td>
                          <td>{{ date('d-m-Y',strtotime($envs -> fecha_creacion)) }}</td>
                          <td>{{ date('d-m-Y',strtotime($envs -> fecha_espera)) }}</td>
                          <td>{{ date('d-m-Y',strtotime($envs -> fecha_aprobado)) }}</td>
                          
                          <td>
                            <div class="btn-group">
                              <button type="text" class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                              <span class="glyphicon glyphicon-option-vertical"></span></button>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('envios.detalle',$envs-> id_envio )}}">Ver detalle</a></li>
                                <li><a href="#">Modificar</a></li>
                                <li><a href="#">Eliminar</a></li>
                              </ul>
                            </div>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
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
