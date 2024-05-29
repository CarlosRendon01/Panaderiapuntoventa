@extends('layouts.app')

@section('content')
<section class="section" style="background-color: #e0e0eb; min-height: 100vh; display: flex; align-items: center;">
    <div class="container custom-container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header d-flex align-items-center justify-content-between bg-primary text-white">
                        <a href="{{ url()->previous() }}" class="btn btn-back text-white">
                            <i class="fas fa-arrow-left mr-2"></i> Regresar
                        </a>
                        <h3 class="page__heading text-center flex-grow-1 m-0">
                            <i class="fas fa-user-plus mr-2"></i>Crear Productos
                        </h3>
                    </div>
                    <div class="card-body p-4 bg-white">
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>¡Revise los campos!</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <form id="productoForm" action="{{ route('productos.store') }}" method="POST" class="my-4">
                            @csrf

                            <div class="form-group floating-label">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre"
                                    class="form-control @error('nombre') is-invalid @enderror" id="nombre" required
                                    value="{{ old('nombre') }}">
                                <small class="form-text text-muted">Formato: Solo letras y espacios</small>
                                @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group floating-label">
                                <label for="descripcion">Descripción</label>
                                <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" required>{{ old('descripcion') }}</textarea>
                                <small class="form-text text-muted">Formato: Máximo 1000 caracteres</small>
                                @error('descripcion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group floating-label">
                                <label for="precio">Precio</label>
                                <input type="text" name="precio"
                                    class="form-control @error('precio') is-invalid @enderror" id="precio" maxlength="8"
                                    title="El número de control debe tener 8 dígitos numéricos" required
                                    value="{{ old('precio') }}">
                                <small class="form-text text-muted">Formato: 8 dígitos numéricos</small>
                                @error('precio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group floating-label">
                                <label for="cantidad">Cantidad</label>
                                <input type="text" name="cantidad"
                                    class="form-control @error('cantidad') is-invalid @enderror" id="cantidad"
                                    maxlength="8" title="El número de control debe tener 8 dígitos numéricos" required
                                    value="{{ old('cantidad') }}">
                                <small class="form-text text-muted">Formato: 8 dígitos numéricos</small>
                                @error('cantidad')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="materias_primas">Materias Primas</label>
                                <div id="materiaPrimaForm">
                                    <div class="materia-prima-row mb-3">
                                        <select class="form-control select2 materia-prima-select">
                                            <option value="" disabled selected>Seleccione una materia prima</option>
                                            @foreach($materiasPrimas as $materiaPrima)
                                                <option value="{{ $materiaPrima->id_materiaprima }}">{{ $materiaPrima->nombre }}</option>
                                            @endforeach
                                        </select>
                                        <input type="number" class="form-control materia-prima-quantity" placeholder="Cantidad">
                                        <button type="button" class="btn btn-success btn-sm add-materia-prima">Agregar</button>
                                    </div>
                                </div>
                                <div id="materiaPrimaInfo" class="mt-4"></div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-pink btn-block btn-submit">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('.select2').select2();

    // Añadir una nueva fila de materia prima
    $(document).on('click', '.add-materia-prima', function() {
        let selectedMateriaPrima = $(this).siblings('.materia-prima-select').find('option:selected').text();
        let selectedMateriaPrimaId = $(this).siblings('.materia-prima-select').val();
        let selectedCantidad = $(this).siblings('.materia-prima-quantity').val();

        if (selectedMateriaPrima && selectedCantidad) {
            let existingMateriaPrima = $(`#materiaPrimaInfo input[name="materias_primas[]"][value="${selectedMateriaPrimaId}"]`).closest('.card');

            if (existingMateriaPrima.length > 0) {
                let newCantidad = parseInt(existingMateriaPrima.find('.card-text').text().replace('Cantidad: ', '')) + parseInt(selectedCantidad);
                existingMateriaPrima.find('.card-text').text('Cantidad: ' + newCantidad);
                existingMateriaPrima.find('input[name="cantidades[]"]').val(newCantidad);
            } else {
                let infoHtml = `
                    <div class="card mt-3">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title">${selectedMateriaPrima}</h6>
                                <p class="card-text mb-0">Cantidad: ${selectedCantidad}</p>
                            </div>
                            <div>
                                <input type="hidden" name="materias_primas[]" value="${selectedMateriaPrimaId}">
                                <input type="hidden" name="cantidades[]" value="${selectedCantidad}">
                                <button type="button" class="btn btn-danger btn-sm remove-materia-prima">Eliminar</button>
                            </div>
                        </div>
                    </div>
                `;
                $('#materiaPrimaInfo').append(infoHtml);
            }

            // Resetear los campos del formulario de materia prima
            $(this).siblings('.materia-prima-select').val('').trigger('change');
            $(this).siblings('.materia-prima-quantity').val('');
        }
    });

    // Eliminar una fila de materia prima
    $(document).on('click', '.remove-materia-prima', function() {
        $(this).closest('.card').remove();
    });

    // Validación en tiempo real para los campos de nombre y descripción
    $('#nombre, #descripcion').on('input', function(event) {
        var regex = /[^a-zA-Z\s]/g;
        var newValue = $(this).val().replace(regex, '');
        $(this).val(newValue);
    });

    // Validación en tiempo real para "precio y cantidad"
    $('#precio, #cantidad').on('input', function(event) {
        var regex = /[^0-9]/g;
        var newValue = $(this).val().replace(regex, '');
        if (newValue.length > 8) {
            newValue = newValue.substring(0, 8);
        }
        $(this).val(newValue);
    });
});
</script>
@endsection

@section('styles')
<style>
.floating-label {
    position: relative;
    margin-bottom: 20px;
}

.floating-label label {
    position: absolute;
    top: 0;
    left: 0;
    pointer-events: none;
    transition: all 0.2s ease;
    color: #999;
}

.floating-label input:focus~label,
.floating-label input:not(:placeholder-shown)~label,
.floating-label select:focus~label,
.floating-label select:not([value=""])~label {
    top: -20px;
    font-size: 12px;
    color: #333;
}

.form-text.text-muted {
    margin-top: 5px;
    font-size: 12px;
    color: #6c757d;
}

.btn-submit {
    transition: all 0.3s ease;
    background-color: #4b479c;
    color: #fff;
    padding: 12px 20px;
    border: none;
    border-radius: 8px;
    font-size: 18px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    background-color: #3a2c70;
}

.btn-submit:focus {
    outline: none;
    box-shadow: 0 0 10px rgba(75, 71, 156, 0.3);
}

.section {
    padding: 60px 0;
    background-color: #e0e0eb;
    min-height: 100vh;
    display: flex;
    align-items: center;
}

.custom-container {
    max-width: 800px;
    margin: auto;
    border: 3px solid #4b479c;
    border-radius: 15px;
    padding: 20px;
    background-color: #ffffff;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
}

.custom-container:hover {
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
    transform: translateY(-2px);
}

.bg-primary {
    background-color: #AF8F6F;
}

.card-header {
    padding: 20px;
    background-color: #4b479c;
    border-bottom: none;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.card-header .btn-back {
    display: flex;
    align-items: center;
    font-size: 14px;
    padding: 8px 12px;
    border-radius: 8px;
    background-color: rgba(255, 255, 255, 0.1);
    transition: background-color 0.2s ease, color 0.2s ease;
}

.card-header .btn-back:hover {
    background-color: #fff;
    color: #4b479c;
}

.card-header .btn-back:hover .fa-arrow-left {
    color: #4b479c;
}

.card-header .page__heading {
    color: #ffffff;
}

.card-body {
    padding: 30px;
    background-color: #ffffff;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.alert {
    margin-bottom: 20px;
}

.select2-container .select2-selection--single {
    height: 45px;
    border-radius: 8px;
    padding: 8px;
    font-size: 16px;
    border: 1px solid #ccc;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 45px;
    padding-left: 10px;
    color: #333;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 45px;
}

.select2-dropdown {
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border: 1px solid #ccc;
}

.select2-results__option {
    padding: 8px 10px;
}

.select2-results__option--highlighted {
    background-color: #4b479c;
    color: #fff;
}

.card {
    margin-top: 20px;
}

.card-title {
    margin-bottom: 15px;
    font-size: 16px; /* Adjusted size */
}

.card-text {
    font-size: 14px; /* Adjusted size */
}

.btn-sm {
    font-size: 12px; /* Adjusted size */
}

.list-group-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.list-group-item .badge {
    background-color: #4b479c;
    color: #fff;
    font-size: 12px;
    padding: 5px 10px;
    border-radius: 5px;
}
</style>

@endsection
