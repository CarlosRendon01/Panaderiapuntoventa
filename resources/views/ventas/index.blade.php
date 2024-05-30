@extends('layouts.app')

<style>
/* Navbar Styles */
.navbar {
    background-color: #8B4513;
    /* Color café */
    border-bottom: 2px solid #A0522D;
    /* Línea inferior café más claro */
    padding: 1rem 1.5rem;
}

.navbar .navbar-brand {
    color: #fff;
    font-size: 1.5rem;
    font-weight: bold;
    transition: color 0.3s;
}

.navbar .navbar-brand:hover {
    color: #FFD700;
    /* Dorado */
}

.navbar .navbar-nav .nav-link {
    color: #fff;
    font-size: 1rem;
    margin: 0 0.5rem;
    transition: color 0.3s;
}

.navbar .navbar-nav .nav-link:hover {
    color: #FFD700;
    /* Dorado */
}

/* Sidebar Styles */
#sidebar-wrapper {
    background-color: #8B4513;
    /* Color café */
    color: #fff;
    transition: all 0.3s;
}

.sidebar-brand a {
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    padding: 10px 0;
}

.brand-name {
    font-family: 'Arial', sans-serif;
    font-size: 24px;
    font-weight: bold;
    color: #fff;
    padding: 0 10px;
}

.sidebar-menu {
    list-style: none;
    padding: 20px 10px;
}

.sidebar-menu li a {
    display: block;
    color: #fff;
    /* Color blanco para el texto de los enlaces */
    padding: 10px;
    border-radius: 4px;
    transition: color 0.3s, background-color 0.3s;
}

.sidebar-menu li a:hover {
    color: #FFD700;
    /* Dorado */
    background-color: #A0522D;
    /* Color café más claro */
    text-decoration: none;
}

.app-header-logo {
    transition: transform 0.3s ease-in-out;
}

.app-header-logo:hover {
    transform: scale(1.1);
}

.sidebar-brand-sm {
    display: none;
}

@media (max-width: 768px) {
    .sidebar-brand-sm {
        display: block;
    }

    .sidebar-brand {
        display: none;
    }
}

/* Table Styles */
#miTabla2 {
    font-family: 'Open Sans', sans-serif;
    border-collapse: collapse;
    width: 100%;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

#miTabla2 thead {
    background-color: #8B4513;
    /* Color café */
    color: #fff;
}

#miTabla2 thead th {
    padding: 15px;
    text-align: left;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

#miTabla2 tbody tr {
    border-bottom: 1px solid #ddd;
    transition: background-color 0.3s ease;
}

#miTabla2 tbody tr:hover {
    background-color: #f5f5f5;
}

#miTabla2 tbody td {
    padding: 12px 15px;
}

#miTabla2 tbody td .custom-badge {
    background-color: #000000;
    color: #fff;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

#miTabla2 tbody td .btn {
    padding: 6px 12px;
    font-size: 14px;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

#miTabla2 tbody td .btn-warning {
    background-color: #fff;
    color: #212529;
}

#miTabla2 tbody td .btn-warning:hover {
    background-color: #e0a800;
}

#miTabla2 tbody td .btn-danger {
    background-color: #fff;
    color: #041014;
}

#miTabla2 tbody td .btn-danger:hover {
    background-color: #c82333;
}

.css-button-sliding-to-left--red {
    min-width: 130px;
    height: 40px;
    color: #fff;
    padding: 5px 10px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    display: inline-block;
    outline: none;
    border-radius: 5px;
    z-index: 0;
    background: #fff;
    overflow: hidden;
    border: 2px solid #d90429;
    color: #d90429;
}

.css-button-sliding-to-left--red:hover {
    color: #fff;
}

.css-button-sliding-to-left--red:hover:after {
    width: 100%;
}

.css-button-sliding-to-left--red:after {
    content: "";
    position: absolute;
    z-index: -1;
    transition: all 0.3s ease;
    left: 0;
    top: 0;
    width: 0;
    height: 100%;
    background: #d90429;
}

.css-button-sliding-to-left--yellow {
    min-width: 130px;
    height: 40px;
    color: #fff;
    padding: 5px 10px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    display: inline-block;
    outline: none;
    border-radius: 5px;
    z-index: 0;
    background: #fff;
    overflow: hidden;
    border: 2px solid #ffd819;
    color: #ffd819;
}

.css-button-sliding-to-left--yellow:hover {
    color: #fff;
}

.css-button-sliding-to-left--yellow:hover:after {
    width: 100%;
}

.css-button-sliding-to-left--yellow:after {
    content: "";
    position: absolute;
    z-index: -1;
    transition: all 0.3s ease;
    left: 0;
    top: 0;
    width: 0;
    height: 100%;
    background: #ffd819;
}

/* Estilos para el campo de búsqueda */
.dataTables_filter {
    position: relative;
}

.dataTables_filter input[type="search"] {
    padding: 12px 40px 12px 20px;
    border: none;
    border-radius: 25px;
    background-color: #f2f2f2;
    font-size: 16px;
    width: 300px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.dataTables_filter input[type="search"]:focus {
    outline: none;
    width: 350px;
    background-color: #fff;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.dataTables_filter::after {
    content: "\f002";
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    position: absolute;
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
    color: #999;
    transition: color 0.3s ease;
}

.dataTables_filter input[type="search"]:focus+::after {
    color: #333;
}

/* Estilos para el menú de selección de registros */
.dataTables_length {
    position: relative;
    display: inline-block;
    margin-bottom: 20px;
}

.dataTables_length label {
    font-size: 16px;
    font-weight: bold;
    color: #555;
}

.btn-pink {
    transition: all 0.3s ease;
    background-color: #ff69b4;
    /* Fondo rosa */
    color: #fff;
    padding: 12px 20px;
    border: none;
    border-radius: 8px;
    font-size: 18px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.btn-pink:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    background-color: #ff1493;
    /* Cambiar a rosa oscuro */
}

.btn-pink:focus {
    outline: none;
    box-shadow: 0 0 10px rgba(255, 105, 180, 0.3);
    /* Cambiar a rosa */
}

.dataTables_length select {
    padding: 10px 40px 10px 20px;
    border: none;
    border-radius: 25px;
    background-color: #f2f2f2;
    font-size: 16px;
    width: 120px;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23999'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 15px center;
    background-size: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.dataTables_length select:focus {
    outline: none;
    background-color: #fff;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.dataTables_length select:hover {
    background-color: #e6e6e6;
}

.dataTables_length::after {
    content: "";
    position: absolute;
    top: 50%;
    right: 30px;
    transform: translateY(-50%);
    width: 0;
    height: 0;
    border-left: 6px solid transparent;
    border-right: 6px solid transparent;
    border-top: 6px solid #999;
    pointer-events: none;
    transition: border-color 0.3s ease;
}

.dataTables_length select:focus+::after {
    border-top-color: #333;
}

/* Estilos para dispositivos móviles */
@media (max-width: 992px) {
    #miTabla2 {
        display: none;
    }

    .mobile-table {
        display: block;
    }


    .mobile-card {
        background: #fff;
        border: none;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 16px;
        padding: 16px;
    }

    .mobile-card .row {
        margin-bottom: 8px;
    }

    .mobile-card label {
        font-weight: bold;
        color: #333;
    }

    .mobile-card .data {
        font-size: 14px;
        color: #666;
    }


    .action-buttons {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
    }

    .btn-mobile {
        flex: 0 1 48%;
        margin: 0;
        padding: 10px;
        border-radius: 4px;
        font-size: 14px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .btn-mobile i {
        font-size: 16px;
        margin-right: 5px;
    }

    .btn-mobile:hover {
        opacity: 0.8;
    }


    .btn-warning.btn-mobile {
        background-color: #ffc107;
        color: #212529;
    }

    .btn-danger.btn-mobile {
        background-color: #dc3545;
        color: #fff;
    }

    .btn-mobile-action {
        flex: 0 1 48%;
        margin: 0;
        padding: 10px;
        border-radius: 4px;
        font-size: 14px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .btn-mobile-action i {
        font-size: 16px;
        margin-right: 5px;
    }

    .btn-mobile-action:hover {
        opacity: 0.8;
    }
}

@media (min-width: 993px) {
    .mobile-table {
        display: none;
    }
}

.custom-badge {
    background-color: #483eff;
    color: white;
}
</style>

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Ventas</h3> <!-- Título de la página actualizado -->
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <!-- Formulario de búsqueda -->
                            <form class="form-inline my-2 my-lg-0" method="GET" action="{{ route('ventas.index') }}">
                                <input class="form-control mr-sm-2" type="search" placeholder="Buscar ventas"
                                    aria-label="Buscar" name="search" value="{{ request('search') }}">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                            </form>
                            <!-- Botón para añadir nueva venta -->
                            @can('crear-ventas')
                            <a class="btn btn-success" href="{{ route('ventas.create') }}">
                                <i class="fas fa-plus"></i> Nuevo
                            </a>
                            @endcan
                        </div>

                        <!-- Tabla de ventas -->
                       
                            <table class="table table-striped mt-2" id="miTabla2">
                                <thead style="background-color:#AF8F6F">
                                   
                                        <th style="color:#fff;" class="text-center">Opciones</th>
                                        <th style="color:#fff;" class="text-center">ID</th>
                                        <th style="color:#fff;" class="text-center">Cliente</th>
                                        <th style="color:#fff;" class="text-center">Descripción</th>
                                        <th style="color:#fff;" class="text-center">Total</th>
                                        <th style="color:#fff;" class="text-center">Imprimir ticket</th>
                
                                </thead>
                                <tbody>
                                    @foreach ($ventas as $venta)
                                    <tr>
                                        
                                        <td class="text-center">{{ $venta->id }}</td>
                                        <td class="text-center">{{ $venta->cliente }}</td>
                                        <td class="text-center">{{ $venta->descripcion }}</td>
                                        <td class="text-center">{{ $venta->total }}</td>
                                        <td class="text-center">
                                            @can('editar-ventas')
                                            <a href="{{ route('ventas.edit', $venta->id) }}"
                                                class="btn btn-warning mr-1 css-button-sliding-to-left--yellow">
                                                <i class="fas fa-edit"></i>
                                                Editar
                                            </a>
                                            @endcan
                                            @can('editar-ventas')

                                            <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST"
                                                class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-mobile"
                                                    onclick="return confirm('¿Estás seguro de eliminar este estudiante?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                            @endcan
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-info" onclick="printTicket()">Imprimir</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                     
                        <!-- Paginación -->
                        <div class="pagination justify-content-end">
                            {!! $ventas->appends(request()->query())->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function printTicket() {
        window.print();
    }

    function confirmarEliminacion(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('eliminar-form-' + id).submit();
            Swal.fire({
                title: 'Eliminado!',
                text: 'El ingrediente ha sido eliminado correctamente.',
                icon: 'success',
                timer: 4000,
                showConfirmButton: false
            });
        }
    });
}
</script>
@endsection