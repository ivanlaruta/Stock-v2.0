<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>STOCK REGIONALES </title>

    <!-- Bootstrap -->
    
    <link href="{{asset('bower_components/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('bower_components/gentelella/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('bower_components/gentelella/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="{{asset('bower_components/gentelella/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('bower_components/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
    
    <!-- iCheck -->
    <link href="{{asset('bower_components/gentelella/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="{{asset('bower_components/gentelella/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- PNotify -->
    <link href="{{asset('bower_components/gentelella/vendors/pnotify/dist/pnotify.css')}}" rel="stylesheet">
    <link href="{{asset('bower_components/gentelella/vendors/pnotify/dist/pnotify.buttons.css')}}" rel="stylesheet">
    <link href="{{asset('bower_components/gentelella/vendors/pnotify/dist/pnotify.nonblock.css')}}" rel="stylesheet">


    <!-- Custom Theme Style -->
    <link href="{{asset('bower_components/gentelella/build/css/custom.min.css')}}" rel="stylesheet">


    <!-- animate.css -->
    <link href="{{asset('bower_components/animate.css/animate.min.css')}}" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">

        <!-- sidebar menu -->
        @include('partials.sidebar')
        <!-- /sidebar menu -->
        
        <!-- top navigation -->
        @include('partials.top')
          
        <!-- /top navigation -->

        <!-- page content -->
                    
                            
                        
        @yield('content')

         
        <!-- /page content -->
        
       
        
        <!-- footer content -->
        @include('partials.footer')
        <!-- /footer content -->

      </div>
    </div>

    @if(!session('mensaje')==null)
        <script type="text/javascript"> 
            function init_PNotify() {
            new PNotify({title: "Correcto",type: "success",text: "Se agrego la seleccion correctamente.",styling: 'bootstrap3',});
            }; 
        </script>>    
    @endif﻿
    <!-- jQuery -->

    <script src="{{asset('bower_components/gentelella/vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('bower_components/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('bower_components/gentelella/vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{asset('bower_components/gentelella/vendors/nprogress/nprogress.js')}}"></script>
    <!-- Chart.js -->
    <script src="{{asset('bower_components/gentelella/vendors/Chart.js/dist/Chart.min.js')}}"></script>
    <!-- jQuery Sparklines -->
    <script src="{{asset('bower_components/gentelella/vendors/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
    <!-- morris.js -->
    <script src="{{asset('bower_components/gentelella/vendors/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('bower_components/gentelella/vendors/morris.js/morris.min.js')}}"></script>
    <!-- gauge.js -->
    <script src="{{asset('bower_components/gentelella/vendors/gauge.js/dist/gauge.min.js')}}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{asset('bower_components/gentelella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <!-- Skycons -->
    <script src="{{asset('bower_components/gentelella/vendors/skycons/skycons.js')}}"></script>
    <!-- Flot -->
    <script src="{{asset('bower_components/gentelella/vendors/Flot/jquery.flot.js')}}"></script>
    <script src="{{asset('bower_components/gentelella/vendors/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('bower_components/gentelella/vendors/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{asset('bower_components/gentelella/vendors/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{asset('bower_components/gentelella/vendors/Flot/jquery.flot.resize.js')}}"></script>
    <!-- Flot plugins -->
    <script src="{{asset('bower_components/gentelella/vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{asset('bower_components/gentelella/vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{asset('bower_components/gentelella/vendors/flot.curvedlines/curvedLines.js')}}"></script>
    <!-- DateJS -->
    <script src="{{asset('bower_components/gentelella/vendors/DateJS/build/date.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{asset('bower_components/gentelella/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('bower_components/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    
    <!-- iCheck -->
    <script src="{{asset('bower_components/gentelella/vendors/iCheck/icheck.min.js')}}"></script>

    <!-- PNotify -->
    <script src="{{asset('bower_components/gentelella/vendors/pnotify/dist/pnotify.js')}}"></script>
    <script src="{{asset('bower_components/gentelella/vendors/pnotify/dist/pnotify.buttons.js')}}"></script>
    <script src="{{asset('bower_components/gentelella/vendors/pnotify/dist/pnotify.nonblock.js')}}"></script>


    <!-- Datatables -->
    <script src="{{asset('bower_components/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('bower_components/gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('bower_components/gentelella/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('bower_components/gentelella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('bower_components/gentelella/vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('bower_components/gentelella/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('bower_components/gentelella/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('bower_components/gentelella/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{asset('bower_components/gentelella/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('bower_components/gentelella/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('bower_components/gentelella/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{asset('bower_components/gentelella/vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
    <script src="{{asset('bower_components/gentelella/vendors/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{asset('bower_components/gentelella/vendors/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('bower_components/gentelella/vendors/pdfmake/build/vfs_fonts.js')}}"></script>
    

     <!-- jQuery Smart Wizard -->
    <script src="{{asset('bower_components/gentelella/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js')}}"></script>
    
    

    <!-- Custom Theme Scripts -->
{{--     <script src="{{asset('bower_components/gentelella/build/js/custom.min.js')}}"></script> --}}   
    <script src="{{asset('js/custom.js')}}"></script>
    @yield('scripts')
  </body>
</html>


