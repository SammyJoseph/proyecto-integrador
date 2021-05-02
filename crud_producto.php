<?php 
  include_once("cabecera.php");
  if(empty($_SESSION["MASCOTAS"])){
	  print "<script>window.location='login.php';</script>";	
  }
  include_once( "ws/db.php" );
  $conexion1 = new db();
?>
			<div id="fw-container" class="fw-container container-crudproducto">
				<div class="container-fluid">
					<div class="row d-flex justify-content-end mb-3">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registrarMascota" onclick="fn_nuevo_producto();">
						Registrar nuevo producto
						</button>
					</div>
				</div>
				<div id="div_ajax"></div>
				<div class="modal fade" id="registrarMascota" tabindex="-1" role="dialog" aria-labelledby="titRegistrarMascota" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered sam-crudproducto" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="titRegistrarMascota">Registra un producto</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<input type="hidden" id="txt_url_img_1" value="" />
					<input type="hidden" id="txt_url_img_2" value="" />
					<input type="hidden" id="txt_url_img_3" value="" />
					<div class="modal-body sam-modal-body">
						<div class="container sam-lisu">
				<!-- <h2 class="sam-h2-white">Registra a tu mascota</h2> -->
				<div class="contactForm">
					<div class="row">
						<input type="hidden" id="txt_id" value="0"/>
						<div class="col-md-12">
							<div class="form-group">
								<label class="label sam-form-label" for="subject">Nombre</label>
								<input type="text" class="form-control sam-form-input"  id="txt_nombre" placeholder="Nombre del producto">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="label sam-form-label" for="subject">Precio</label>
								<input type="number" class="form-control sam-form-input"  id="txt_precio" placeholder="S/0.00">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="label sam-form-label" for="subject">Stock</label>
								<input type="number" class="form-control sam-form-input"  id="txt_stock" placeholder="Stock">
							</div>
						</div>	
						<div class="col-md-6">
							<div class="form-group">
								<label class="label sam-form-label" for="subject">Marca</label><br>
								<select class="form-control sam-form-input" id="sel_marca">
									<option selected disabled value="masculino">-- Seleccionar --</option>
									<option value="1">Ricocan</option>
									<option value="2">Pedigree</option>
									<option value="3">Mimascot</option>
									<option value="4">Purina</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="label sam-form-label" for="subject">Proveedor</label><br>
								<select class="form-control sam-form-input" id="sel_prov">
									<option selected disabled value="masculino">-- Seleccionar --</option>
									<option value="1">Proveedor 1</option>
									<option value="2">Proveedor 2</option>
									<option value="3">Proveedor 3</option>
									<option value="4">Proveedor 4</option>
								</select>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label class="label sam-form-label" for="subject">Descripción Simple</label><br>
								<textarea class="form-control" rows="3" id="txt_des" placeholder="Escribe una breve descripción aquí"></textarea>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label class="label sam-form-label" for="subject">Descripción HTML</label><br>
								<textarea class="form-control" rows="3" id="txt_html" placeholder="HTML"></textarea>
							</div>
						</div>
						<div class="col-md-12">
  							<label class="label sam-form-label">IMAGENES:</label>
							<p id="img_bd"></p>
							<p id="img_bd2"></p>
							<p id="img_bd3"></p>
							<br />
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="label sam-form-label" for="subject">Elegir imagen 1</label>
								<input type="file" class="form-control sam-form-input" id="txt_img">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="label sam-form-label" for="subject">Elegir imagen 2</label>
								<input type="file" class="form-control sam-form-input" id="txt_img2">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="label sam-form-label" for="subject">Elegir imagen 3</label>
								<input type="file" class="form-control sam-form-input" id="txt_img3">
							</div>
						</div>
					</div>
				</div>
			</div>
	      </div>
	      <div class="modal-footer sam-modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
	        <button type="button" class="btn btn-primary" onclick="fn_guardar_productos();"  data-dismiss="modal">Guardar</button>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="container-fluid sam-table sam-crudproducto-table">
		<div class="col-md-12">
			<table class="table">
			    <thead class="thead-dark">
			      <tr>
			        <th>Nombre</th>
			        <th>Precio</th>
			        <th>Stock</th>
			        <th>Marca</th>
			        <th>Proveedor</th>
			        <th>Descripción</th>
			        <th>HTML</th>
			        <th>Imagen</th>
			        <th>Imagen</th>
			        <th>Imagen</th>
			        <th></th>
			        <th></th>
			      </tr>
			    </thead>
			    <tbody>
				<?php
				  	$m_provprodid = [
						"1" => "Proveedor 1",
						"2" => "Proveedor 2",
						"3" => "Proveedor 3",
						"4" => "Proveedor 4",
					];
					$m_marcprodid = [
						"1" => "Ricocan",
						"2" => "Pedigree",
						"3" => "Mimascot",
						"4" => "Purina",
					];		
					$sql = "SELECT * FROM tb_productos ORDER BY mascprodid;";
					$m_datos = $conexion1->getM( $sql );
					foreach( $m_datos as $reg ){
						$mascprodid = intval(trim($reg["mascprodid"]));
						$mascprodnom = trim($reg["mascprodnom"]);
						$mascprodpre = trim($reg["mascprodpre"]);
						$mascprodstoc = trim($reg["mascprodstoc"]);
						$mascproddes = trim($reg["mascproddes"]);
						$mascprodhtml = trim($reg["mascprodhtml"]);
						$mascprodimg = trim($reg["mascprodimg"]);
						$mascprodimg2 = trim($reg["mascprodimg2"]);
						$mascprodimg3 = trim($reg["mascprodimg3"]);
						$marcprodid = intval(trim($reg["marcprodid"]));
						$provprodid = intval(trim($reg["provprodid"]));
						echo '
						<tr>
						<td>'.$mascprodnom.'</td>
						<td>S/'.$mascprodpre.'</td>
						<td>'.$mascprodstoc.' unidades</td>
						<td>'.$m_marcprodid[$marcprodid].'</td>
						<td>'.$m_provprodid[$provprodid].'</td>
						<td>'.$mascproddes.'</td>
						<td>'.$mascprodhtml.'</td>
						<td><img src="images/productos/'.$mascprodimg.'" alt=""></td>
						<td><img src="images/productos/'.$mascprodimg2.'" alt=""></td>
						<td><img src="images/productos/'.$mascprodimg3.'" alt=""></td>
						<td class="sam-flex-align-center"><button type="button" class="btn btn-info sam-crudmascota-btn" onclick="fn_editar_producto('.$mascprodid.');" data-toggle="modal" data-target="#registrarMascota">EDITAR</button></td>
						<td><button type="button" class="btn btn-danger sam-crudmascota-btn" onclick="fn_eliminar_producto('.$mascprodid.');">ELIMINAR</button></td>
					  </tr>
						';
					}
				?>
			    </tbody>
			</table>
		</div>
	</div>
	
</div>
<?php
include_once("pie_pagina.php");
?>