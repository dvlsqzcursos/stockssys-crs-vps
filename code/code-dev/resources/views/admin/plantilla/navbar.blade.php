<nav class="navbar navbar-expand-lg ">
  <div class="container-fluid">    
    <a class="navbar-brand" href="{{url('/admin')}}"><img src="{{url('/static/imagenes/crs_1.png')}}" alt="" width="24px" height="24px" style="margin-top: -4px;">  StocksSys</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item d-none d-sm-inline-block"> 
          <a href="{{url('/admin')}}" class="nav-link"><i class="fa-solid fa-chart-line"></i> Panel Principal</a>
        </li>
         

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-user-gear"></i> Configuraciones
          </a>
          <ul class="dropdown-menu">
            @if(kvfj(Auth::user()->permisos, 'ubicaciones'))
              <li><a class="dropdown-item" href="{{url('/admin/ubicaciones')}}"><i class="fa-solid fa-earth-americas"></i> Ubicaciones</a></li>
            @endif
            @if(kvfj(Auth::user()->permisos, 'instituciones'))
              <li><a class="dropdown-item" href="{{url('/admin/instituciones')}}"><i class="fa-solid fa-building"></i> Instituciones</a></li>
            @endif
            @if(kvfj(Auth::user()->permisos, 'entregas'))
              <li><a class="dropdown-item" href="{{url('/admin/entregas')}}"><i class="fa-solid fa-people-carry-box"></i> Entregas</a></li>
            @endif
          </ul>
        </li>

        @if(kvfj(Auth::user()->permisos, 'usuarios'))
          <li class="nav-item d-none d-sm-inline-block">
            <a href="{{url('/admin/usuarios')}}" class="nav-link"><i class="fa-solid fa-users"></i> Usuarios</a>
          </li>
        @endif

        @if(kvfj(Auth::user()->permisos, 'escuelas'))
          <li class="nav-item d-none d-sm-inline-block">
            <a href="{{url('/admin/escuelas')}}" class="nav-link"><i class="fa-solid fa-school"></i> Escuelas</a>
          </li>
        @endif

        @if(kvfj(Auth::user()->permisos, 'rutas'))
          <li class="nav-item d-none d-sm-inline-block">
            <a href="{{url('/admin/rutas')}}" class="nav-link"><i class="fa-solid fa-route"></i> Rutas</a>
          </li>
        @endif

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-boxes-packing"></i> Bodega
          </a>
          <ul class="dropdown-menu">
            @if(kvfj(Auth::user()->permisos, 'bodega_principal_insumos'))
              <li><a class="dropdown-item" href="{{url('/admin/bodega_principal/insumos')}}"><i class="fa-solid fa-warehouse"></i> Bodega Principal </a></li>
            @endif

            @if(kvfj(Auth::user()->permisos, 'bodega_socio_insumos'))
              <li><a class="dropdown-item" href="{{url('/admin/bodega_socio/insumos')}}"><i class="fa-solid fa-warehouse"></i> Bodega Socio </a></li>
            @endif
          </ul>
        </li>          

        @if(kvfj(Auth::user()->permisos, 'solicitudes'))
          <li class="nav-item d-none d-sm-inline-block">
            <a href="{{url('/admin/solicitudes_despachos')}}" class="nav-link"><i class="fa-solid fa-file-invoice"></i> Solicitudes de Despacho</a>
          </li>
        @endif

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-box-archive"></i> Reportería
          </a>
          <ul class="dropdown-menu">
            @if(kvfj(Auth::user()->permisos, 'reportes'))
              <li><a class="dropdown-item" href="{{url('/admin/reportes')}}"><i class="fa-solid fa-file-lines"></i> Reportes</a></li>
            @endif
            <div class="dropdown-divider"></div>
            @if(kvfj(Auth::user()->permisos, 'bitacoras'))
              <li><a class="dropdown-item" href="{{url('/admin/bitacoras')}}"><i class="fa-solid fa-user-clock"></i> Bitacoras del Sistema</a></li>
            @endif
          </ul>
        </li>


      </ul> 

      <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-user"></i> {{ Auth::user()->usuario }}
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{url('/admin/cuenta_usuario')}}"><i class="fa-solid fa-user-gear"></i> Cuenta</a></li>
            <div class="dropdown-divider"></div>
            <li><a href="{{url('/cerrar_sesion')}}" class="nav-link"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</a></li>
          </ul>
        </li>

      </ul>

    </div>

  </div>
</nav>