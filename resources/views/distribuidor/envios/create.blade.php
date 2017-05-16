@extends('layouts.main')

@section('content')
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Envios</h3>
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
            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Generacion de envios <small>Nuevo envio</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div >


                    <!-- Smart Wizard -->
                    
                      <div ">
                       
                          {!! Form::open (['route' => 'envios.store','method' => 'POST','class' => 'form-horizontal form-label-left'])!!}
                      
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">FECHA</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                      
                            <input type="text" name="fecha_creacion" value="<?php date_default_timezone_set('America/La_Paz');  $time = time();echo date("Y-m-d", $time);?> " readonly class='form-control'>
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">ORIGEN</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                             {!! Form::text('origen', 'DISTRIBUIDOR',['class'=> 'form-control', 'readonly'])!!}
                            </label>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">DESTINO</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                               {!! Form::select('destino',$ubica,NULL,['class'=>'form-control','placeholder'=>'Selccione una regional','required'])!!}
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">TIPO</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            
                              {!! Form::select('tipo',['REGULAR'=>'REGULAR','EXTRAORDINARIO'=>'EXTRAORDINARIO'],null,['class'=>'form-control ','required'])!!}

                            </div>
                          </div>

                          <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">OBSERVACIONES</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              {!! Form::text('observaciones', null,['class'=> 'form-control'])!!}
                            </div>
                          </div>
                          
                          <div class="form-group">
                           
                            {!! Form::submit('registrar',['class'=>'btn btn-primary'])!!}
                         
                          </div>

                          
                        </form>
                      </div>
                    </div>

                    <!-- End SmartWizard Content -->

                    <!-- Tabs -->
                    
                    <!-- End SmartWizard Content -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        
@endsection

@section('scripts')
