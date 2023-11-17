<?php include_once "encabezado.php" ?>

<div class="col-xs-12">
	<h1>Nuevo producto</h1>
	<form method="post" action="nuevo.php">
		
			<label for="nombre">Nombre:</label>
			<input  class="form-control" name="nombre" required type="text" id="nombre" placeholder="Escribe el nombre">

			<label for="descripcion">Categoria:</label>
			<input  class="form-control" name="categoria" required type="text" id="categoria" placeholder="Escribe la categoria">

			<label for="precio">Precio:</label>
			<input class="form-control" name="precio" required type="number" id="precio" placeholder="Precio">

			<label for="stock">Existencias:</label>
			<input class="form-control" name="stock" required type="number" id="stock" placeholder="Existencias">
			
			<label for="marca">Marca:</label>
			<input class="form-control" name="marca" required type="text" id="marca" placeholder="Escribe la marca">

			<label for="codigo">Codigo:</label>
			<input class="form-control" name="codigo" required type="number" id="codigo" placeholder="codigo">

			<label for="tamano">Color:</label>
			<input  class="form-control" name="color" required type="text" id="color" placeholder="Escribe el color">
		<br><br><input class="btn btn-info" type="submit" value="Guardar">
	</form>
</div>
<?php include_once "pie.php" ?>