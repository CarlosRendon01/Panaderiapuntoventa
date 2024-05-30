@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Nueva Venta</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Nueva Venta
                    </div>
                    <div class="card-body">
                        <form action="{{ route('puntoventas.store') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="cliente">Cliente</label>
                                    <input type="text" class="form-control" id="cliente" name="cliente" placeholder="Cliente Mostrador">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tipo_documento">Tipo Documento</label>
                                    <select id="tipo_documento" name="tipo_documento" class="form-control">
                                        <option selected>RFC</option>
                                        <option>DNI</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="numero_documento">Número Documento</label>
                                    <input type="text" class="form-control" id="numero_documento" name="numero_documento" placeholder="Ingresa el número de documento">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="productos">Productos</label>
                                    <input type="text" class="form-control" id="productos" name="productos" placeholder="12345 Producto de prueba">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="cantidad">Cantidad</label>
                                    <input type="number" class="form-control" id="cantidad" name="cantidad">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="stock">Stock</label>
                                    <input type="text" class="form-control" id="stock" name="stock" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="precio_venta">P. Venta</label>
                                    <input type="text" class="form-control" id="precio_venta" name="precio_venta" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="descuento">Descuento</label>
                                    <input type="number" class="form-control" id="descuento" name="descuento" value="0">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Acción</label>
                                    <button type="button" class="btn btn-success btn-block">Agregar</button>
                                </div>
                            </div>
                        </form>
                        <table class="table table-striped mt-2">
                            <thead style="background-color:#AF8F6F">
                                <tr>
                                    <th>Opciones</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio Venta</th>
                                    <th>Descuento</th>
                                    <th>Subtotal</th>
                                </tr>
                            </style=>
                            <tbody>
                                <tr>
                                    <td>TOTAL</td>
                                    <td colspan="5" class="text-right">$0.00</td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ route('puntoventas.index') }}" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>





.bg-cafe {
            background-color: #8B4513; /* Color café */
        }



        

        
    </style>
</section>
@endsection


    