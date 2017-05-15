<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Toyosa</title>
<link href="{{asset('bower_components/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('bower_components/gentelella/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
         <link href="{{asset('bower_components/animate.css/animate.min.css')}}" rel="stylesheet">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }
            .algo {
               color: #636b6f;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Ingresar</a>
                    @endif
                </div>
            @endif
            <div class="content">

                <div class="title m-b-md">
                   <div id="charging" class="fa"></div>
                   Stock Regionalizados
                </div>
                <div class="animated tada " >
                   <h3>PAGINA DE PRESENTACION EN CONSTRUCCION</h3>
                </div>
            </div>
        </div>
    </body>
</html>


<script>
function chargebattery() {
  var a;
  a = document.getElementById("charging");
  a.innerHTML = "&#xf244;";
  setTimeout(function () {
    a.innerHTML = "&#xf243;";
  }, 1000);
  setTimeout(function () {
    a.innerHTML = "&#xf242;";
  }, 2000);
  setTimeout(function () {
    a.innerHTML = "&#xf241;";
  }, 3000);
  setTimeout(function () {
    a.innerHTML = "&#xf240;";
  }, 4000);
}
chargebattery();
setInterval(chargebattery, 5000);
</script>