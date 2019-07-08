@extends('layouts.app')
@section('content')
	<section class="container">
		<div class="row">
			<article class="col-md-12">
				<a class="btn btn-success" href="inventario/create">Nuevo Producto</a>
				<table class="table table-condensed table-striped table-bordered ">
					<thead>
						<tr>
							<th>Producto</th>
							<th>Cantidad</th>
							<th>Número de lote</th>
							<th>Fecha de vencimiento</th>
							<th>Precio</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach($inventarios as $inventario)
						<tr>
							<td>{{$inventario->producto}}</td>
							<td>{{$inventario->cantidad}}</td>
							<td>{{$inventario->numero_lote}}</td>
							<td>{{$inventario->fecha_vencimiento}}</td>
							<td>{{$inventario->precio}}</td>
							<td>
								<a class="btn btn-primary btn-xs" href="{{route('inventario.edit',['id'=>$inventario->id])}}">Eliminar</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</article>
		</div>
	</section>
@endsection