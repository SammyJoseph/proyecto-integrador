<?php 
  include_once("cabecera.php");
  if(empty($_SESSION["MASCOTAS"])){
	print "<script>window.location='login.php';</script>";	
	}
	include_once( "ws/db.php" );
	$conexion1 = new db();
?>

			<div id="fw-container" class="fw-container container-crudservicio">
				<div class="container-fluid">
					<div class="row d-flex justify-content-end mb-3 mr-3">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registrarMascota" onclick="fn_nuevo_servicio();">
						Registrar nuevo servicio
						</button>
					</div>
				</div>
				<div id="div_ajax"></div>
				<div class="modal fade" id="registrarMascota" tabindex="-1" role="dialog" aria-labelledby="titRegistrarMascota" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered sam-crudproducto" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="titRegistrarMascota">Registra un servicio</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body sam-modal-body">
						<div class="container sam-lisu">
				<!-- <h2 class="sam-h2-white">Registra a tu mascota</h2> -->
				<div class="contactForm">
					<div class="row">
						<input type="hidden" id="txt_id">
						<div class="col-md-12">
							<div class="form-group">
								<label class="label sam-form-label" for="subject">Nombre</label>
								<input type="text" class="form-control sam-form-input" id="txt_nom" placeholder="Nombre del servicio">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label class="label sam-form-label" for="subject">Descripción</label><br>
								<textarea class="form-control" rows="3" id="txt_des" placeholder="Descripción del servicio"></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="label sam-form-label" for="subject">Precio</label>
								<input type="number" class="form-control sam-form-input"  id="txt_pre" placeholder="S/0.00">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="label sam-form-label" for="subject">Elegir imagen</label>
								<input type="file" class="form-control sam-form-input" id="txt_img" >
							</div>
						</div>
						<div class="col-md-12">
							<p>IMAGEN CARGADA:</p>
							<p id="img_bd"></p>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="label sam-form-label" for="subject">Fecha del servicio</label><br>
								<input class="sam-date-input" type="date" id="txt_fec"   min="2006-01-01" max="2021-04-24">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="label sam-form-label" for="subject">Horario</label><br>
								<select class="form-control sam-form-input" id="sel_hor">
									<option selected disabled value="masculino">-- Seleccionar --</option>
									<option value="1">08:00 - 09:00 a.m.</option>
									<option value="2">09:00 - 10:00 a.m.</option>
									<option value="3">10:00 - 11:00 a.m.</option>
									<option value="4">11:00 - 12:00 p.m.</option>
									<option value="5">12:00 - 01:00 p.m.</option>
									<option value="6">01:00 - 02:00 p.m.</option>
									<option value="7">02:00 - 03:00 p.m.</option>
									<option value="8">03:00 - 04:00 p.m.</option>
									<option value="9">04:00 - 05:00 p.m.</option>
									<option value="10">05:00 - 06:00 p.m.</option>
									<option value="11">06:00 - 07:00 p.m.</option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
	      </div>
	      <div class="modal-footer sam-modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
	        <button type="button" class="btn btn-primary" onclick="fn_guardar_sevicio();"  data-dismiss="modal">Registrar</button>
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
			        <th>Descripción</th>
			        <th>Precio</th>
			        <th>Fecha</th>
			        <th>Horario</th>
			        <th>Imagen</th>
			        <th></th>
			        <th></th>
			      </tr>
			    </thead>
			    <tbody>
				<?php
					$m_cat_fech = [
						"1" =>  "08:00 - 09:00 a.m.",
						"2" =>  "09:00 - 10:00 a.m.",
						"3" =>  "10:00 - 11:00 a.m.",
						"4" =>  "11:00 - 12:00 p.m.",
						"5" =>  "12:00 - 01:00 p.m.",
						"6" =>  "01:00 - 02:00 p.m.",
						"7" =>  "02:00 - 03:00 p.m.",
						"8" =>  "03:00 - 04:00 p.m.",
						"9" =>  "04:00 - 05:00 p.m.",
						"10" => "05:00 - 06:00 p.m.",
						"11" => "06:00 - 07:00 p.m.",
					];		
					$sql = "SELECT * FROM tb_servicios ORDER BY servmascid;";
					$m_datos = $conexion1->getM( $sql );
					foreach( $m_datos as $reg ){
						$servmascid = intval(trim($reg["servmascid"]));
						$servmascnom = trim($reg["servmascnom"]);
						$servmascdes = trim($reg["servmascdes"]);
						$servmascpre = trim($reg["servmascpre"]);
						$servmascimg = trim($reg["servmascimg"]);
						$servmascfec = trim($reg["servmascfec"]);
						$servmaschor = trim($reg["servmaschor"]);
						$servmascsta = trim($reg["servmascsta"]);
						echo '
						<tr>
							<td>'.$servmascnom.'</td>
							<td>'.$servmascdes.'</td>
							<td>'.$servmascpre.'</td>
							<td>'.$servmascfec.'</td>
							<td>'.$m_cat_fech[$servmaschor].'</td>
							<td><img src="images/productos/'.$servmascimg.'" alt=""></td>
							<td class="sam-flex-align-center"><button type="button" class="btn btn-info sam-crudmascota-btn" onclick="fn_editar_servicio('.$servmascid.');" data-toggle="modal" data-target="#registrarMascota">EDITAR</button></td>
							<td><button type="button" class="btn btn-danger sam-crudmascota-btn" onclick="fn_eliminar_servicio('.$servmascid.');">ELIMINAR</button></td>
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