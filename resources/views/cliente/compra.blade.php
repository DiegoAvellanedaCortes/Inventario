@extends('layouts.app')
@section('content')
	<section class="container">
		<div class="row">
			<article class="col-md-12">
				<table class="table table-condensed table-striped table-bordered ">
					<thead>
						<tr>
							<th>Producto</th>
							<th>Cantidad disponible</th>
							<th>Precio</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody id="tablaInventario">
						
					</tbody>
				</table>
				</br>
			</article>
			<article class="col-md-12">
				<div id="productosSelec" style="display: none;"></div>
				<div id="btn" style="display: none;">
					<a class='btn btn-success' onclick='actualizarInventario()'>Continuar</a>
				</div>
				<div id="gestionar" style="display: none;">
					<table class="table table-condensed table-striped table-bordered ">
						<thead>
							<tr>
								<th>Producto</th>
								<th>Cantidad compra</th>
								<th>Precio</th>
							</tr>
						</thead>
						<tbody id="factura">
							
						</tbody>
					</table>
					<div id="total"></div>
				</div>
			</article>
		</div>
	</section>
@endsection
<script type="text/javascript">
	window.onload=function(){
		crearInventario();
	}
	var datosInventario=new Array();
	var listaProductos=new Array();
	var ltProducto= new Array();
	var venta=new Array();
	var dato=new Array();
	var updateid=new Array();
	var updateCantidad=new Array();

	function crearInventario(){
		datosInventario=[];
		venta=[];
		for (var i = 0; i < <?=$inventarios?>.length; i++) {
			datosInventario.push(<?=$inventarios?>[i]);
		}
		document.getElementById('gestionar').style.display='none';
		document.getElementById('tablaInventario').innerHTML='';
		cargarInventario();
	}


	function cargarInventario(){
		var tablaInventario="<tr>";
		for (var j = 0; j < datosInventario.length; j++) {
			tablaInventario+="<td>"+datosInventario[j].producto+"</td><td>"+datosInventario[j].cantidad+"</td><td>"+datosInventario[j].precio+"</td><td>";
			tablaInventario+="<a class='btn btn-success' onclick='productos("+datosInventario[j].id+")'>Agregar</a> "	
			tablaInventario+="<a class='btn btn-danger' onclick='borrarProductos("+datosInventario[j].id+")'>Cancelar</a> "	
			tablaInventario+="</td></tr>"
			$("#tablaInventario").html(tablaInventario);	
		}
	}

	function productos(id) {
		ltProducto=[];
		if (listaProductos.length==0) {
		  listaProductos.push(id);
		}else{
			for (var i = 0; i < this.listaProductos.length; i++) {
				if (listaProductos.indexOf(id)==-1) {
					listaProductos.push(id);
				}
			}	
		}

		for (var j = 0; j < <?=$inventarios?>.length; j++) {
			for (var l = 0; l < listaProductos.length; l++) {
				if(<?=$inventarios?>[j].id==listaProductos[l]){
					ltProducto.push(<?=$inventarios?>[j]);
				}
			}
		}
		
		console.log(ltProducto);
		datos();
	}

	function borrarProductos(item){
		if (listaProductos.indexOf(item)!=-1) {
			listaProductos.splice(listaProductos.indexOf(item),1);
		}
		for (var i = 0; i < ltProducto.length; i++) {
			if (ltProducto[i].id==item) {
				console.log(i)
				ltProducto.splice(i,1);
			}
		}
		console.log(ltProducto);
		datos();
	}

	function datos(){
		dato=[];
		document.getElementById('productosSelec').style.display='block';
		document.getElementById('productosSelec').innerHTML='';
		var select;
		for (var i = 0; i < ltProducto.length; i++) {
			var ids=ltProducto[i].id;
			select="<select id='ncantidad"+i+"' onchange='cantidades("+ids+")'>";
			for (var j = 0; j <= ltProducto[i].cantidad; j++) {
				select+="<option>"+j+"</option>"
			}
			select+="</select>"
			dato.push("<label>Producto: "+ltProducto[i].producto+" Cantidad: "+select+"</label></br>");
			$("#productosSelec").html(dato);
		}
		document.getElementById('btn').style.display='block';
	}

	function cantidades(item){
		for (var i = 0; i < ltProducto.length; i++) {
			if(ltProducto[i].id==item){
				venta.push({idProducto:item,cantidad:document.getElementById("ncantidad"+i).value});
			}
		}
		console.log(venta);
	}

	function actualizarInventario(){
		for (var i = 0; i < datosInventario.length; i++) {
			for (var j = 0; j < venta.length; j++) {
				if(datosInventario[i].id==venta[j].idProducto){
					id=datosInventario[i].id;
					datosInventario[i].cantidad=(datosInventario[i].cantidad-venta[j].cantidad);
				}
			}
		}
		document.getElementById('tablaInventario').innerHTML='';
		cargarInventario();
		cargarTabla();
	}

	function cargarTabla(){
		var total=0;
		var datosTabla="<tr>";
		document.getElementById('btn').style.display='none';
		document.getElementById('productosSelec').style.display='none';
		document.getElementById('gestionar').style.display='block';
		console.log(ltProducto);
		for (var i = 0; i < ltProducto.length; i++) {
			for (var j = 0; j < venta.length; j++) {
				if (ltProducto[i].id==venta[j].idProducto) {

				updateid.push(ltProducto[i].id);
				updateCantidad.push(venta[j].cantidad);
					datosTabla+="<td>"+ltProducto[i].producto+"</td> <td>"+venta[j].cantidad+"</td><td>"+(venta[j].cantidad*ltProducto[i].precio)+"</td></tr>";
					total+=(venta[j].cantidad*ltProducto[i].precio);
					$("#factura").html(datosTabla);			
				}
			}
		}

		$("#total").html("<label><strong>Total: </strong></label>"+" "+total+"<a onclick='update()' class='btn btn-success'>Comprar</a>"+"<a class='btn btn-danger' onclick='crearInventario()'>Cancelar</a>");
		console.log(total);
	}

	function update(){
		window.location.href='/inventario/update/'+updateid+"/"+updateCantidad
	}
 

</script>


