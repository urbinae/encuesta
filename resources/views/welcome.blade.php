<!DOCTYPE html>
<html lang="es">
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Laravel</title>
 
 {!! Html::style('assets/css/bootstrap.css') !!}
 {!! Html::style('css/app.css') !!}
 {!! Html::style('css/nav_side.css') !!}
 {!! Html::style('DataTables_1.10.16/css/jquery.dataTables.min.css') !!}
 
 <!-- Fonts 
 <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
 -->

</head>
<body>
@if (Auth::guest())

No estas autorizado

@else
<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-sm-2">
      <div class="nav-side-menu">
          <div class="brand"><h3>Sistema de Encuestas</h3></div>
          <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
          
        
          <div class="menu-list">
        
                <ul id="menu-content" class="menu-content collapse out">
                  <li>
                    <a href="#">
                    <h4><i class="glyphicon glyphicon-th"></i> {{ Auth::user()->name }}</h4>
                    </a>
                  </li>

                  <li  data-toggle="collapse" data-target="#products" class="collapsed @if (Request::path() == 'encuesta') active @endif">
                    <a href="{{ route('encuesta.index') }}"><i class="glyphicon glyphicon-list-alt"></i> Encuestas</a>
                  </li>

                  <li data-toggle="collapse" data-target="#new" class="collapsed @if (Request::path() == 'tiporepuesta') active @endif">
                    <a href="#"><i class="glyphicon glyphicon-thumbs-up"></i> Tipo de repuestas</a>
                  </li>
                 
                  @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Administrador</a></li>
                    {{-- <li><a href="{{ url('/register') }}">Register</a></li> --}}
                  @else
                      <li>
                        <a href="{{ url('/logout') }}">
                          <i class="glyphicon glyphicon-user"></i> Salir
                        </a>
                      </li>
                  @endif
          </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-10">
      @yield('content')
    </div>
  </div>
 </div>
 <!-- Scripts -->
 
 {!! Html::script('assets/js/jquery-3.2.1.js') !!}
 {!! Html::script('assets/js/bootstrap.min.js') !!}
 {!! Html::script('DataTables_1.10.16/js/jquery.dataTables.min.js') !!}
 @yield('codigo_js')

@endif
</body>
</html>