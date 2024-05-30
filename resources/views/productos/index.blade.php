@extends('layouts.app')

<style>
    /* Estilos generales */
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f8f9fa;
    }

    .container {
        max-width: 960px;
    }

    /* Estilos para la tarjeta de producto */
    .card {
        border: none;
        border-radius: 0.5rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease-in-out;
    }

    .card:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.25);
        transform: translateY(-5px);
    }

    .card-img-container {
        overflow: hidden;
    }

    .card-img-top {
        transition: transform 0.3s ease-in-out;
    }

    .card:hover .card-img-top {
        transform: scale(1.1);
    }

    .card-body {
        padding: 1.5rem;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
    }

    .card-text {
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .btn {
        font-size: 0.9rem;
        font-weight: 500;
        padding: 0.5rem 1rem;
        border-radius: 0.25rem;
        transition: all 0.3s ease-in-out;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0069d9;
        border-color: #0062cc;
    }

    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #212529;
    }

    .btn-warning:hover {
        background-color: #e0a800;
        border-color: #d39e00;
        color: #212529;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }

    /* Estilos para la paginación */
    .pagination {
        margin-bottom: 0;
    }

    .page-link {
        color: #007bff;
        background-color: #fff;
        border-color: #dee2e6;
        transition: all 0.3s ease-in-out;
    }

    .page-link:hover {
        color: #0056b3;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }

    .page-item.active .page-link {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }

    .page-item.disabled .page-link {
        color: #6c757d;
        background-color: #fff;
        border-color: #dee2e6;
    }
</style>
@section('content')
<div class="container">
    <h1 class="text-center my-4">Productos</h1>

    @if(session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
    @endif

    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('productos.create') }}" class="btn btn-success">Crear Producto</a>
    </div>

    <div class="row justify-content-center">
        @foreach($productos as $producto)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                <div class="card-img-container"
                    style="height: 250px; display: flex; justify-content: center; align-items: center; background-color: #f8f9fa;">
                    @if($producto->imagen_url)
                    <img src="{{ asset('storage/' . $producto->imagen_url) }}" class="card-img-top img-fluid"
                        alt="{{ $producto->nombre }}" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                    @else
                    <img src="https://via.placeholder.com/150" class="card-img-top img-fluid"
                        alt="{{ $producto->nombre }}" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                    @endif
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $producto->nombre }}</h5>
                    <p class="card-text">{{ $producto->descripcion }}</p>
                    <p class="card-text"><strong>Precio:</strong> ${{ number_format($producto->precio, 2) }}</p>
                    <p class="card-text"><strong>Cantidad:</strong> {{ $producto->cantidad }}</p>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-primary">Ver Detalles</a>
                        <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $productos->links() }}
    </div>
</div>
@endsection
