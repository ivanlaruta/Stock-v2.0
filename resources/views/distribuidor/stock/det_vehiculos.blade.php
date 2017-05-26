@extends('layouts.main')

@section('content')
<div class="right_col" role="main">
          <div class="">
      
            <div class="page-title">
              <div class="title_left">
                <h3>STOCK {{ $marca }} {{ $ciudad }}</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                </div>
              </div>
            </div>
<!-- Start to do list -->
            <div class="col-md-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>{{ $marca }} / {{ $modelos }} / {{ $modelo }} / {{ $mast->MASTER }}/<small>Vehiculos</small></h2>
                  
                  <div class="clearfix"></div>
                </div>
               
                <div class="x_content">
                  <table id="datatable1" class="table table-striped table-responsive">
                      <thead>
                        <tr>
                          <th>Marca</th>
                          <th>Modelo</th>
                          <th>Master</th>
                          <th>Año</th>
                          <th>Chassis</th>
                          <th>Exterior</th>
                          <th>Interior</th>
                          <th>Regional</th>
                          <th>Ubicacion</th>
                        </tr>
                      </thead>
                        
                      <tbody>
                        @foreach($v as $vs)
                        <tr>                
                          <td>{{ $vs-> MARCA }}</td>
                          <td>{{ $vs -> MODELO }}</td>
                          <td>{{ $vs -> MASTER }}</td>
                          <td>{{ $vs -> ANIO_MOD }}</td>
                          <td>{{ $vs -> CHASIS }}</td>
                          <td>{{ $vs -> COLOR_EXTERNO}}</td>
                          <td>{{ $vs -> COLOR_INTERNO }}</td>
                          <td>{{ $vs -> nom_localidad }}</td>
                          <td>{{ $vs -> UBICACION }}</td>
                        </tr>
                        @endforeach

                      </tbody>
                    </table>
                  
                    
                </div>

                </div>
              </div>
           
              
            <!-- End to do list -->
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
                     
                  