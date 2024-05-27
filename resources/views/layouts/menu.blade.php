@if(auth()->user()->canAny(['ver-rol', 'crear-rol', 'editar-rol', 'borrar-rol', 'ver-producto', 'crear-producto', 'editar-producto', 'borrar-producto', 'ver-log']))
<ul class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    @canany(['ver-rol', 'crear-rol', 'editar-rol', 'borrar-rol'])
    <li class="{{ Request::is('home*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center" href="/home">
            <i class="fas fa-building" style="color: #9370DB; margin-right: 8px;"></i>
            <span class="menu-text" style="font-weight: 600; color: #333;">Dashboard</span>
        </a>
    </li>
    <li class="{{ Request::is('usuarios*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center" href="/usuarios">
            <i class="fas fa-users" style="color: #BA55D3; margin-right: 8px;"></i>
            <span class="menu-text" style="font-weight: 600; color: #333;">Usuarios</span>
        </a>
    </li>
    <li class="{{ Request::is('roles*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center" href="/roles">
            <i class="fas fa-user-lock" style="color: #8A2BE2; margin-right: 8px;"></i>
            <span class="menu-text" style="font-weight: 600; color: #333;">Roles</span>
        </a>
    </li>
    @endcanany

    @can('ver-producto')
    <li class="{{ Request::is('productos*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center" href="/productos">
            <i class="fas fa-user-graduate" style="color: #20B2AA; margin-right: 8px;"></i>
            <span class="menu-text" style="font-weight: 600; color: #333;">Productos</span>
        </a>
    </li>
    @endcan

    @can('ver-materiaprima')
    <li class="{{ Request::is('materiaprimas*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center" href="/materiaprimas">
            <i class="fas fa-user-graduate" style="color: #20B2AA; margin-right: 8px;"></i>
            <span class="menu-text" style="font-weight: 600; color: #333;">Materia prima</span>
        </a>
    </li>
    @endcan

    @can('ver-puntoventa')
    <li class="{{ Request::is('puntoventas*') ? 'active' : '' }}">
        <a class="nav-link d-flex align-items-center" href="/puntoventas">
            <i class="fas fa-user-graduate" style="color: #20B2AA; margin-right: 8px;"></i>
            <span class="menu-text" style="font-weight: 600; color: #333;">Punto venta</span>
        </a>
    </li>
    @endcan
</ul>
@endif
