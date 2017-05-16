@extends('layouts.main')

@section('content')
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Stock Regionalizado {{$request->ciudad}}</h3>
              </div>
              <div class="title_right">
              {!! Form::open(['route' => 'vehiculos.stock','method' => 'GET'])!!}
                <div class="col-md-10 col-sm-10 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    {!! Form::select('ciudad',$ubica,$request->ciudad,['class'=>'form-control','placeholder'=>'TODAS LAS REGIONALES' ,'onchange'=>'this.form.submit();'])!!}
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="submit">Buscar</button>
                    </span>
                  </div>
                </div>
                {!! Form::close()!!} 
              </div>
              
            </div>
<!-- Start to do list -->
            <div class="col-md-4 ">
              <div class="x_panel">
                <div class="x_title">
                  <h2>LEXUS<small>Modelos</small></h2>
                  
                  <div class="clearfix"></div>
                </div>
                <p class="text-right">Real @if($request->ciudad <> 'TODOS')| Asignados @endif</p>
                <div class="x_content">
                	<div class="list-group">
                	@foreach($mod_L as $modl)
                        <a href="{{ route('vehiculos.modelos',['id'=>$modl -> MODELOS,'id2'=>$modl -> MARCA ,'id4'=>$request->ciudad ])}}" class="list-group-item">

                         @if ($request->ciudad <>'TODOS')
                         <span class="badge" style="background-color: #00cc88">542</span>
                         @endif

                         <span class="badge">{{ $modl-> STOCK_REAL }}</span>
                        {{ $modl-> MODELOS }}
                        </a>
                     @endforeach
               		</div>
               		
                    <a href="#">Ver detalle <i class="fa fa-arrow-circle-right"></i></a>
                </div>

                </div>
              </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>YAMAHA<small>Modelos</small></h2>
                  
                  <div class="clearfix"></div>
                </div>
                <p class="text-right">Real @if($request->ciudad <> 'TODOS')| Asignados @endif</p>
                <div class="x_content">
                  <div class="list-group">
                  @foreach($mod_Y as $mody)
                        <a href="{{ route('vehiculos.modelos',['id'=>$mody -> MODELOS,'id2'=>$mody -> MARCA ,'id4'=>$request-> ciudad])}}" class="list-group-item">
                        @if ($request->ciudad <>'TODOS')
                         <span class="badge" style="background-color: #00cc88">542</span>
                         @endif
                         <span class="badge badge-info">{{ $mody-> STOCK_REAL }}</span>
                        {{ $mody-> MODELOS }}
                        </a>
                     @endforeach
                  </div>
                  
                    <a href="#">Ver detalle <i class="fa fa-arrow-circle-right"></i></a>
                </div>

                </div>
              </div>

              <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>TOYOTA<small>Modelos</small></h2>
                  
                  <div class="clearfix"></div>
                </div>
                 <p class="text-right">Real @if($request->ciudad <> 'TODOS')| Asignados @endif</p>
                <div class="x_content">

                  <div class="list-group">
                  @foreach($mod_T as $modt)
                        <a href="{{ route('vehiculos.modelos',['id'=>$modt -> MODELOS,'id2'=>$modt -> MARCA ,'id4'=>$request-> ciudad])}}" class="list-group-item">
                        @if ($request->ciudad <>'TODOS')
                         <span class="badge" style="background-color: #00cc88">542</span>
                         @endif
                         <span class="badge">{{ $modt-> STOCK_REAL }}</span>
                        {{ $modt-> MODELOS }}
                        </a>
                     @endforeach
                  </div>
                  
                    <a href="#">Ver detalle <i class="fa fa-arrow-circle-right"></i></a>
                </div>

                </div>
              </div>
            <!-- End to do list -->
         </div>
      </div>
@endsection