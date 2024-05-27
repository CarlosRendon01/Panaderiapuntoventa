@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Ventas</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <form class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2" type="search" placeholder="Buscar puntos de venta"
                                    aria-label="Buscar">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                            </form>
                            <a class="btn btn-success" href="{{ route('puntoventas.create') }}">
                                <i class="fas fa-plus"></i> Nuevo
                            </a>

                        </div>

                        <table class="table table-striped mt-2">
                            <thead>
                                <tr>
                                    <th class="text-center">Opciones</th>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Cliente</th>
                                    <th class="text-center">Descripción</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Imprimir ticket</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($puntoventas as $puntoventa)
                                <tr>
                                    <td class="text-center">
                                        <a href="{{ route('puntoventas.edit', $puntoventa->id_punventa) }}"
                                            class="btn btn-warning mr-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('puntoventas.destroy', $puntoventa->id_punventa) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="text-center">{{ $puntoventa->id_punventa }}</td>
                                    <td class="text-center">{{ $puntoventa->descripcion }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Ubicamos la paginación a la derecha -->
                        <div class="pagination justify-content-end">
                            {!! $puntoventas->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection