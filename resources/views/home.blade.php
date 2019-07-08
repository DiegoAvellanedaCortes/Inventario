@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @switch($rol)
                        @case('proveedor')
                          <a href="/inventario">Registrar Producto</a>
                        @break
                        @case('cliente')
                          <a href="/compra">Comprar</a>
                        @break
                      @endswitch
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
