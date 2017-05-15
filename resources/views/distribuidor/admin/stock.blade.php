@extends('layouts.main')

@section('content')
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>ADMINISTRACION </h3>
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
                  <h2>Lista de Stocks asigandos<small>Masters</small></h2>
                  
                  <div class="clearfix"></div>
                </div>
               
                <div class="x_content">
                  <table id="" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Marca</th>
                          <th>Cod Modelo</th>
                          <th>Modelo</th>
                          <th>Cod Master</th>
                          <th>Master</th>
                          <th>Regional</th>
                          <th>Stock_min</th>
                          <th>Stock_asignado</th>
                          <th>Accion</th>
                        </tr>
                      </thead>
                        
                      <tbody>
                        @foreach($v as $vs)
                        <tr>
                          <td>{{ $vs-> MARCA}}</td>
                          <td>{{ $vs-> cod_modelo }}</td>
                          <td>{{ $vs-> MODELO }}</td>
                          <td>{{ $vs-> cod_master }}</td>
                          <td>{{ $vs-> cod_master }}</td>
                          <td>{{ $vs -> regional }}</td>
                          <td class="red">{{ $vs -> stock_min }}</td>
                          <td class="green">{{ $vs -> stock_asignado }}</td>
                          <td>
                            <a href="#" class="btn btn-info btnEditar" cod='{{ $vs-> cod_master }}' title="Modificar"><span class="fa fa-edit"></span></a>
                          </td>
                        </tr>
                        @endforeach

                      </tbody>
                    </table>
                  
                    
                </div>
                {{ $v->Links() }} 

                </div>
              </div>
              
              
            <!-- End to do list -->
         </div>
      </div>
@endsection

@section('scripts')
<script>


 var btnEditar = $(".btnEditar");
  btnEditar.on("click",function(){
    alert($(this).attr("cod"));
  })


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
                     
                  