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

/* Estilos para el formulario */
.form-group {
    margin-bottom: 1rem;
}

.form-label {
    font-weight: 500;
}

.form-control {
    border-radius: 0.25rem;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0069d9;
    border-color: #0062cc;
}
</style>

@section('content')
<section class="section">
    <div class="container">
        <h1 class="my-4">Crear Nuevo Producto</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Campos existentes (nombre, descripcion, precio, cantidad, imagen) --}}
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" id="nombre" value="{{ old('nombre') }}" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" class="form-control" id="descripcion"
                    required>{{ old('descripcion') }}</textarea>
            </div>

            <div class="form-group">
                <label for="precio">Precio</label>
                <input type="number" name="precio" class="form-control" id="precio" step="0.01"
                    value="{{ old('precio') }}" required>
            </div>

            <div class="form-group">
                <label for="cantidad">Cantidad</label>
                <input type="number" name="cantidad" class="form-control" id="cantidad" value="{{ old('cantidad') }}"
                    required>
            </div>

            <div class="form-group">
                <label for="imagen">Imagen</label>
                <input type="file" name="imagen" class="form-control-file" id="imagen">
            </div>

            {{-- Campos para materias primas --}}
            <div class="form-group">
                <label for="materias_primas">Materias Primas</label>
                <select name="materias_primas[]" id="materias_primas" class="form-control" multiple required>
                    @foreach ($materiasPrimas as $materiaPrima)
                    <option value="{{ $materiaPrima->id }}">{{ $materiaPrima->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="cantidades">Cantidades</label>
                <div id="cantidades-container"></div>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</section>

<script>
const selectMateriasPrimas = document.getElementById('materias_primas');
const cantidadesContainer = document.getElementById('cantidades-container');

selectMateriasPrimas.addEventListener('change', () => {
    cantidadesContainer.innerHTML = '';
    const selectedMateriasPrimas = Array.from(selectMateriasPrimas.selectedOptions);

    selectedMateriasPrimas.forEach(option => {
        const inputGroup = document.createElement('div');
        inputGroup.classList.add('input-group', 'mb-3');

        const prepend = document.createElement('div');
        prepend.classList.add('input-group-prepend');
        const span = document.createElement('span');
        span.classList.add('input-group-text');
        span.textContent = option.text;
        prepend.appendChild(span);

        const inputCantidad = document.createElement('input');
        inputCantidad.type = 'number';
        inputCantidad.name = 'cantidades[]';
        inputCantidad.min = 1;
        inputCantidad.placeholder = `Cantidad para ${option.text}`;
        inputCantidad.classList.add('form-control');

        inputGroup.appendChild(prepend);
        inputGroup.appendChild(inputCantidad);
        cantidadesContainer.appendChild(inputGroup);
    });
});
</script>

@endsection