<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Conservación y mantenimiento sist</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
  <link rel="apple-touch-icon" href="{{asset('img/favicon.png')}}">
  <link rel="shortcut icon" href="{{asset('img/favicon.png')}}">
  <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
  <!--Aqui es de startbootstrap -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">

      <!-- Logo -->
      <a href="{{url('/home')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">SS<b>O</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
          <img src="{{asset('img/SALUD.png')}}" height="50px" width="126px" class="img-logo" style="margin-top: -5px;">
        </span>
      </a>

      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Navegación</span>
        </a>



        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->

            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <small class="bg-red">Online</small>
                <!-- {{ Auth::user()->name }} -->
                <span class="hidden-xs">{{ Auth::user()->name }}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">

                  <p>
                    {{ Auth::user()->name }}
                    <small>{{ Auth::user()->email }}</small>
                  </p>
                  <a href="#" class="btn btn-default">Cambiar nombre</a>
                  <br>
                  <a href="#" class="btn btn-default">Cambiar contraseña</a>
                </li>

                <!-- Menu Footer-->
                <li class="user-footer">

                  <div class="pull-right">
                    <!-- {{url('/logout')}} -->
                    <a href="{{url('/logout')}}"><button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-sign-out"></i> Cerrar sesión
                      </button></a>

                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>


      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header"></li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-laptop"></i>
              <span>Jefatura</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{url('administracion/seguimiento')}}"><i class="fa fa-circle-o"></i> Seguimientos</a></li>
              <li><a href="{{url('administracion/solicitudes')}}"><i class="fa fa-circle-o"></i> Solicitudes</a></li>
              <li><a href="{{url('administracion/ordenes')}}"><i class="fa fa-circle-o"></i> Ordenes</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> Folios</a></li>
            </ul>
          </li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-th"></i>
              <span>Coord administrativa</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="#"><i class="fa fa-circle-o"></i> Fondo revolvente</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> Remisiones</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-user"></i>
              <span>RH</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{url('administracion/trabajadores')}}"><i class="fa fa-circle-o"></i> Trabajadores</a></li>
              <!--<li><a href="#"><i class="fa fa-circle-o"></i> Permisos y vacaciones</a></li>-->
              <li><a href="{{url('seguridad/usuario')}}"><i class="fa fa-circle-o"></i> Usuarios</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-money"></i> <span>Viaticos</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="#"><i class="fa fa-circle-o"></i> Inventario</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> Viaticos</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-industry"></i> <span>Almacen</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{url('almacen/articulos')}}"><i class="fa fa-circle-o"></i> Articulo</a></li>
              <li><a href="{{url('almacen/ingresos')}}"><i class="fa fa-circle-o"></i> Ingresos</a></li>
              <li><a href="{{url('almacen/egresos')}}"><i class="fa fa-circle-o"></i> Egresos</a></li>
            </ul>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-plus-square"></i> <span>Ayuda</span>
              <small class="label pull-right bg-red">PDF</small>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
              <small class="label pull-right bg-yellow">INFO</small>
            </a>
          </li>

        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>





    <!--Contenido-->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Main content -->
      <section class="content">

        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-header with-border">
                <div class="box-tools pull-right">
                  <button class="btn btn-box-tool" data-widget="collapse" style="margin-top: -9px;"><i class="fa fa-minus"></i></button>
                  <!-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <!--Contenido-->
                    @yield('contenido')
                    <!--Fin Contenido-->
                  </div>
                </div>

              </div>
            </div><!-- /.row -->
          </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->

  </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 0.9.4
    </div>
    <strong>Copyright &copy; 2015-2021 <a href="https://www.oaxaca.gob.mx/salud/">SSO</a>.</strong> All rights reserved.
  </footer>


  <!-- jQuery 2.1.4 -->

  <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
  @stack('scripts')
  <!-- Bootstrap 3.3.5 -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('js/app.min.js')}}"></script>
  <script src="{{asset('js/jsimage.js')}}"></script>
  <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
  


</body>

</html>