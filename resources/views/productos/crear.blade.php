@extends('layouts.app')

<style>
/* Estilos generales */
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f8f9fa;
}

.container {
    max-width: 760px;
    margin-top: 2rem;
}

/* Estilos para el formulario */
.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    font-weight: 500;
    color: #495057;
}

.form-control, .form-control-file, .form-control:focus {
    border-radius: 0.35rem;
    box-shadow: 0 0.15rem 0.3rem rgba(0, 0, 0, 0.1);
}

.form-control-file {
    padding: 0.35rem;
}

.input-group-text {
    background-color: #e9ecef;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    transition: background-color 0.3s ease, border-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #0069d9;
    border-color: #0062cc;
}

.btn-secondary {
    background-color: #0476da;
    border-color: #117fdf;
    transition: background-color 0.3s ease, border-color 0.3s ease;
}

.btn-secondary:hover {
    background-color: #5a6268;
    border-color: #545b62;
}

/* Estilos para el contenedor del formulario */
.form-container {
    background: #ffffff;
    padding: 2rem;
    border-radius: 0.5rem;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
}

.button-group {
    display: flex;
    justify-content: space-between;
    margin-top: 2rem;
}

.alert-danger {
    margin-top: 1rem;
}

h1.my-4 {
    text-align: center;
    font-size: 2rem;
    color: #343a40;
    margin-bottom: 2rem;
}

.input-group {
    margin-bottom: 1rem;
}

.input-group-prepend .input-group-text {
    border-top-left-radius: 0.35rem;
    border-bottom-left-radius: 0.35rem;
}

.input-group .form-control {
    border-top-right-radius: 0.35rem;
    border-bottom-right-radius: 0.35rem;
}

/* Estilos adicionales */
textarea.form-control {
    resize: vertical;
    min-height: 100px;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

input[type="file"].form-control-file {
    border: 1px solid #ced4da;
    padding: 0.5rem;
    border-radius: 0.35rem;
}

label.form-label {
    margin-bottom: 0.5rem;
}

button.btn {
    width: 48%;
}

@media (max-width: 576px) {
    .button-group {
        flex-direction: column;
    }

    button.btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }

    button.btn:last-child {
        margin-bottom: 0;
    }
}
</style>

@section('content')
<section class="section">
    <div class="container">
        <div class="form-container">
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
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" id="nombre" value="{{ old('nombre') }}" required>
                </div>

                <div class="form-group">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control" id="descripcion"
                        required>{{ old('descripcion') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="precio" class="form-label">Precio</label>
                    <input type="number" name="precio" class="form-control" id="precio" step="0.01"
                        value="{{ old('precio') }}" required>
                </div>

                <div class="form-group">
                    <label for="cantidad" class="form-label">Cantidad</label>
                    <input type="number" name="cantidad" class="form-control" id="cantidad" value="{{ old('cantidad') }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="imagen" class="form-label">Imagen</label>
                    <input type="file" name="imagen" class="form-control-file" id="imagen">
                </div>

                {{-- Campos para materias primas --}}
                <div class="form-group">
                    <label for="materias_primas" class="form-label">Materias Primas</label>
                    <select name="materias_primas[]" id="materias_primas" class="form-control" multiple required>
                        @foreach ($materiasPrimas as $materiaPrima)
                        <option value="{{ $materiaPrima->id }}">{{ $materiaPrima->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="cantidades" class="form-label">Cantidades</label>
                    <div id="cantidades-container"></div>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('productos.index') }}" class="btn btn-secondary">Regresar</a>
                </div>
            </form>
        </div>
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
