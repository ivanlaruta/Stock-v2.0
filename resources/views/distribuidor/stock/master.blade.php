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
                  <h2>{{ $marca }} / {{ $modelos }} / {{ $modelo -> MODELO}}/<small>Master</small></h2>
                  
                  <div class="clearfix"></div>
                </div>
                <p class="text-right">Real @if($ciudad <> 'TODOS')| Asign | Min @endif &nbsp &nbsp &nbsp  </p>
                <div class="x_content">
                  <div class="list-group">
                  @foreach($mas as $masl)
                        <a href="{{ route('vehiculos.det_vehiculos',['id'=>$masl ->COD_MASTER ,'id1'=>$modelo -> MODELO,'id2'=> $modelos ,'id3'=>$marca,'id4'=>$ciudad])}}" class="list-group-item">
                        @if($ciudad <> 'TODOS')
                        <span class="badge" style="background-color: #ff751a">{{ $masl-> stock_min }}</span>
                        <span class="badge" style="background-color: #00cc88">{{ $masl-> stock_asignado }}</span>
                        @endif
                        <span class="badge">{{ $masl-> STOCK_REAL }}</span>
                        {{ $masl-> MASTER }}
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