@extends('layouts.main')

@section('content')
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
               
            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel ">
                  <div class="x_title">
                    <h2>
                    
                   <a href="{{ route('envios.detalle',$id)}}">ENVIO {{$id}} / </a>HOJA DE ENVIO PARCIAL /
                    <small>Datos generales</small>
                    </h2>
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

              {{-- LISTA --}}   
        
              <div class="row">
                
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel ">
                  <div class="x_title">
                    <h2>ENVIO DE UNIDADES <small>Asignacion de envios parciales.</small></h2>
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

                     <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                      <thead>
                        <tr >
                          <th>#</th>
                          <th>Marca</th>
                          <th>Modelo</th>
                          <th>Master</th>
                          <th>Año</th> 
                          <th>Exterior</th>
                          <th>Interior</th>
                          <th>Cantidad aprovada</th>
                          <th>Cantidad enviada</th>
                          <th>Restante</th>
                          <th></th>
                          
                        </tr>
                      </thead>
                        
                      <tbody>
                      <?php $a = 0; ?>
                        @foreach($det as $dets)
                        @if($dets->sin_env > 0)
                        
                        <tr>
                        <td>{{ $dets -> id_detalle}}</td>
                        <td>{{ $dets -> marca -> MARCA}}</td>
                        <td>{{ $dets -> modelo -> MODELO}}</td>
                        <td>{{ $dets -> master -> MASTER}}</td>
                        <td>{{ $dets -> anio }}</td>
                        <td>{{ $dets -> col_ext }}</td>
                        <td>{{ $dets -> col_int }}</td>
                        <td>{{ $dets -> cantidad_aprobada}}</td>
                        <td>{{ $dets -> cantidad_enviada}}</td>
                        <td>{{ $dets -> sin_env}}</td>
                       
                        <td><a href="#" class=" btn btn-warning btn-round btn-xs btnEnviar" id_detalle = '{{ $dets -> id_detalle}}' id = '{{$id}}' data-toggle="tooltip" data-placement="bottom" title="Asignar cantidad"><i class="fa fa-sign-out"></i></a></td>

                        @endif                       
                        @endforeach
                       
                      </tbody>
                    </table>


                    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                          

                              
                            
                            </div>
                          </div>
                        </div>


                    
                  </div>
                      
                    
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
                        <div class="col-md-12">
                          <div class="btn-group btn-group-justified">
                            <a href="#" class= "btn btn-primary btn-round "  >TERMINAR </a>
                           
                            
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
<script type="text/javascript">

var btnEnviar = $(".btnEnviar");
btnEnviar.on("click",function(){
  // alert($(this).attr('id'));
  frm_parcial($(this));
});

var modalContent = $(".modal-content");
var modal=$(".bs-example-modal-lg");

var frm_parcial = function(objeto){ 
  $.ajax({
    type: "GET",
    cache: false,
    dataType: "html",
    url: "{{ route('envios.modal_parcial')}}",
    data: {
      id: objeto.attr("id"),
      id_detalle: objeto.attr("id_detalle")
    },
    // beforeSend: function(xhr)
    // {
    //   NProgress.start();
    // },
    success: function(dataResult)
    {
      console.log(dataResult);
      modalContent.empty().html(dataResult);                        
      modal.modal('show');

      NProgress.done();
    },
    error: function(jqXHR, exception)
    {
      var msg = '';
      if (jqXHR.status === 0) {
          msg = 'Not connect.\n Verify Network.';
      } else if (jqXHR.status == 404) {
          msg = 'Requested page not found. [404]';
      } else if (jqXHR.status == 500) {
          msg = 'Internal Server Error [500].';
      } else if (exception === 'parsererror') {
          msg = 'Requested JSON parse failed.';
      } else if (exception === 'timeout') {
          msg = 'Time out error.';
      } else if (exception === 'abort') {
          msg = 'Ajax request aborted.';
      } else {
          msg = 'Uncaught Error.\n' + jqXHR.responseText;
      }

      alert(msg);
      NProgress.done();
    }
  });
}



</script>

@endsection

