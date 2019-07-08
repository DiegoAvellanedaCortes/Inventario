@extends('layouts.app')
@section('content')
	<section class="container">
		<div class="row">
			<article class="col-md-10 col-md-offset-1">
				<div id="alert"></div>
				{!!Form::open(['route'=>'inventario.store','method'=>'post', 'name'=> 'frm','novalidate'])!!}
					<div class="form-group">
						<label>Nombre de producto</label>
						<input type="text"  id="producto" name="producto" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Cantidad</label>
						<input type="number" name="cantidad"  id="cantidad" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Número de lote</label>
						<input type="number" name="numero_lote" id="numero_lote"  class="form-control" required>
					</div>
					<div class="form-group">
						<label>Fecha de vencimiento</label>
						<input type="date" name="fecha" id="fecha" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Precio</label>
						<input type="number" name="precio"  id="precio" class="form-control" required>
					</div>
					<div class="form-group">
						<button type="button" onclick="validation()" class="btn btn-success">Registrar producto</button>
					</div>
				{!!Form::close()!!}
			</article>
		</div>
	</section>
@endsection
<script type="text/javascript">
	function validation() {
		var producto = document.getElementById('producto').value;
		var cantidad = document.getElementById('cantidad').value;
		var numero_lote = document.getElementById('numero_lote').value;
		var fecha = document.getElementById('fecha').value;
		var precio = document.getElementById('precio').value;

		if (producto=="" || cantidad=="" || numero_lote=="" || fecha=="" || precio=="") {
			alert('Todos los campos son obligatorios');
		}else{
			document.frm.submit();
		}
	}
</script>