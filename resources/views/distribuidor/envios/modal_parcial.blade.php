<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
  </button>
  <h4 class="modal-title" id="myModalLabel">Envio Parcial de unidades</h4>
</div>

{!! Form::open(array('route' => ['envios.enviar_parcial'], 'method' => 'get')) !!}

<input id="id" name="id" type="hidden" value="{{$det->id_envio}}">
<input id="id_detalle" name="id_detalle" type="hidden" value="{{ $det->id_detalle }}">

<div class="modal-body">
	<div class=" row">
		<div class="col-md-5 col-lg-offset-4">
			
			<div class="col-md-12">
				<div class="form-group">
				    <label class="control-label col-md-6" >Cantidad Aprobada: </label>
				    <div class="col-md-6">
				    	{{$det->cantidad_aprobada}}
				    </div>
	 			</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
				    <label class="control-label col-md-6" >Cantidad Enviada: </label>
				    <div class="col-md-6">
				    	{{$det->cantidad_enviada}}
				    </div>
	 			</div>
			</div>

			<div class="col-md-12">
				<div class="form-group">
				<hr>
				    <label class="control-label col-md-6" ><p class="text-danger">Cantidad Restante:</p> </label>
				    <div class="col-md-6">
				    	<p class="text-danger">{{$det->cantidad_aprobada-$det->cantidad_enviada}}</p>
				    	
				    </div>
	 			</div>
			</div>
		</div>
	</div>
	<hr>
	<div class=" row">
		<div class="col-md-12">
			
			<div class="col-md-6">
				<div class="form-group">
				    <label class="control-label col-md-6" >Cantidad a enviar: </label>
				    <div class="col-md-6">
				    	{!! Form::number('cant',null,['class'=> 'form-control','placeholder'=>'Ingrese cantidad','min'=>'1' ,'max'=>$det->cantidad_aprobada-$det->cantidad_enviada,'required'])!!}
				    </div>
	 			</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
				    <label class="control-label col-md-6" >Fecha estimada de arribo: </label>
				    <div class="col-md-6">
				    	<input type="text" name = "f_env" class="form-control has-feedback-left" id="f_env" aria-describedby="inputSuccess2Status2">
                                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                        <span id="inputSuccess2Status2" class="sr-only">(success)</span>
				    </div>
	 			</div>
			</div>
		</div>
	</div>
</div>



<div class="modal-footer">
<div class="form-group">
    <div class="col-md-6 col-lg-offset-3">
	<div class="btn-group btn-group-justified">
		<a href="#" class=" btn btn-default btn-round" data-dismiss="modal">Cerrar</a>
		<a href="#"  class=" btn btn-success btn-round" onclick="$(this).closest('form').submit() ">Enviar</a>
		
	</div>
	</div>
</div>
</div>

{!! Form::close()!!}


<script type="text/javascript">

  var eta = $("#f_env");
  eta.daterangepicker({
    singleDatePicker:true,
    minDate: moment(),
    locale: {
            format: 'YYYY-MM-DD'
        }
  });
</script>