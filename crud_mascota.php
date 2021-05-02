<?php 
	include_once("cabecera.php");
	if(empty($_SESSION["MASCOTAS"])){
		print "<script>window.location='login.php';</script>";	
	}
	include_once( "ws/db.php" );
	$conexion1 = new db();
?>
<div id="fw-container" class="fw-container-crudmascota">
	<div class="container">
		<div class="row d-flex justify-content-end mb-3 mr-3">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registrarMascota" onclick="fn_nueva_mascota();">
			  Registrar nueva mascota
			</button>
		</div>
	</div>
	<div id="div_ajax"></div>
	<div class="modal fade" id="registrarMascota" tabindex="-1" role="dialog" aria-labelledby="titRegistrarMascota" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered sam-crudmascota" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="titRegistrarMascota">Registra a tu mascota</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body sam-modal-body">
	        <div class="container sam-lisu">
				<!-- <h2 class="sam-h2-white">Registra a tu mascota</h2> -->
				<div class="contactForm">
					<div class="row">
						<input type="hidden" id="txt_id" value="0">
						<div class="col-md-12">
							<div class="form-group">
								<label class="label sam-form-label" for="subject">Nombre</label>
								<input type="text" class="form-control sam-form-input" id="txt_nom" placeholder="Nombre de tu mascota">
							</div>
						</div>		
						<div class="col-md-6">
							<div class="form-group">
								<label class="label sam-form-label" for="subject">Tipo<i class="fas fa-plus <?php echo $ADMIN; ?>" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#agregarMascota" ></i></label><br>
								<select class="form-control sam-form-input" id="sel_tipo" onchange="fn_combo2(this.value);">
									<option selected disabled value="NA ">-- Seleccionar --</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="label sam-form-label" for="subject">Raza<i class="fas fa-plus  <?php echo $ADMIN; ?>" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#agregarRaza"></i></label><br>
								<select class="form-control sam-form-input" id="sel_raza">
									<option selected disabled value="NA">-- Seleccionar --</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="label sam-form-label" for="subject">Género</label><br>
								<select class="form-control sam-form-input" id="sel_gen">
								<option selected disabled value="NA">-- Seleccionar --</option>
								<option value="M">Macho</option>
								<option value="H">Hembra</option>
								</select>
							</div>
						</div>	
						<div class="col-md-6">
							<div class="form-group">
								<label class="label sam-form-label" for="subject">Fecha de nacimiento</label><br>
								<input class="sam-date-input" type="date" id="txt_fec" min="2006-01-01" max="2021-04-24">
							</div>
						</div>
						<!-- <div class="col-md-12">
							<div class="form-group">
								<input type="submit" value="REGISTRAR" class="btn btn-primary">
								<div class="submitting"></div>
							</div>
						</div> -->
					</div>
				</div>
			</div>
	      </div>
	      <div class="modal-footer sam-modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
	        <button type="button" class="btn btn-primary" onclick="fn_agregar_mascota();" data-dismiss="modal">Guardar</button>
		  </div>
	    </div>
	  </div>
	</div>
	<div class="modal fade" id="agregarMascota" tabindex="-1" role="dialog" aria-labelledby="titRegistrarMascota" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered sam-crudmascota" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="titRegistrarMascota">Agrega un tipo de Mascota</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"  data-toggle="modal" data-target="#registrarMascota">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body sam-modal-body">
	        <div class="container sam-lisu">
				<!-- <h2 class="sam-h2-white">Registra a tu mascota</h2> -->
				<div class="contactForm">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="label sam-form-label" for="subject">Nombre del Tipo</label>
								<input type="text" class="form-control sam-form-input" id="txt_add_tpo" placeholder="Tipo de mascota">
							</div>
						</div>		
					</div>
				</div>
			</div>
	      </div>
	      <div class="modal-footer sam-modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="modal" data-target="#registrarMascota">Cerrar</button>
	        <button type="button" class="btn btn-primary" onclick="fn_agregar_tpo();" data-dismiss="modal" data-toggle="modal" data-target="#registrarMascota">Agregar</button>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="modal fade" id="agregarRaza" tabindex="-1" role="dialog" aria-labelledby="titRegistrarMascota" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered sam-crudmascota" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="titRegistrarMascota">Agrega un tipo de Mascota</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#registrarMascota"> 
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body sam-modal-body">
	        <div class="container sam-lisu">
				<!-- <h2 class="sam-h2-white">Registra a tu mascota</h2> -->
				<div class="contactForm">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="label sam-form-label" for="subject">Tipo de mascota</label>
								<select class="form-control sam-form-input" id="sel_tipo_raza">
									<option selected disabled value="NA ">-- Seleccionar --</option>
								</select>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label class="label sam-form-label" for="subject">Nombre Raza</label>
								<input type="text" class="form-control sam-form-input" id="txt_add_raza" placeholder="Tipo de mascota">
							</div>
						</div>	
					</div>
				</div>
			</div>
	      </div>
	      <div class="modal-footer sam-modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="modal" data-target="#registrarMascota">Cerrar</button>
	        <button type="button" class="btn btn-primary" onclick="fn_agregar_raza();" data-dismiss="modal" data-toggle="modal" data-target="#registrarMascota">Agregar</button>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="container sam-table sam-crudmascota-table">
		<div class="col-md-12">
			<table class="table">
			    <thead class="thead-dark">
			      <tr>
			        <th>Nombre de tu mascota</th>
			        <th>Tipo</th>
			        <th>Raza</th>
			        <th>Género</th>
			        <th>Fecha de nacimiento</th>
			        <th>Edad</th>
			        <th></th>
			        <th></th>
			      </tr>
			    </thead>
			    <tbody>
				<?php
					function calculaedad($fechanacimiento){
						list($ano,$mes,$dia) = explode("-",$fechanacimiento);
						$ano_diferencia  = date("Y") - $ano;
						$mes_diferencia = date("m") - $mes;
						$dia_diferencia   = date("d") - $dia;
						if ( $mes_diferencia < 0 && $dia_diferencia < 0){$ano_diferencia--;}
						if ( $ano_diferencia < 0){$ano_diferencia = 0;}
						$respuesta = "";
						$años = "";
						$meses = "";
						if( $ano_diferencia > 0 ){if( $ano_diferencia >= 2 ){ $años = "s"; }$respuesta.= $ano_diferencia." año".$años." "; }
						if( $mes_diferencia > 0 ){if( $mes_diferencia >= 2 ){ $meses = "es"; }$respuesta.= $mes_diferencia." mes".$meses." "; }
						return $respuesta;
					}
					$usuid = $_SESSION["MASCOTAS"]["usuid"];
					$m_genero=[
						"M"=>"Macho",
						"H"=>"Hembra"
					];
					$sql = "SELECT * FROM tb_mascotas WHERE usuid = '$usuid' ORDER BY mascid;";
					$m_datos = $conexion1->getM( $sql );
					//echo '<td colspan="8"></td>';
					foreach( $m_datos as $reg ){
						$mascid = intval(trim($reg["mascid"]));
						$usuid = trim($reg["usuid"]);
						$mascnom = trim($reg["mascnom"]);
						$mascgen = $m_genero[trim($reg["mascgen"])];
						$mascfec = trim($reg["mascfec"]);
						$masctpoid = intval(trim($reg["masctpoid"]));
						$razid = intval(trim($reg["razid"]));
						$sql2 = "SELECT masctponom FROM cat_mascota_tpo WHERE masctpoid=$masctpoid;";
						$masctponom = $conexion1->get( $sql2 );
						$sql3 = "SELECT raznom FROM cat_raza_mascota WHERE razid=$razid;";
						$raznom = $conexion1->get( $sql3 );
						echo '
						<tr>
							<td>'.$mascnom.'</td>
							<td>'.$masctponom.'</td>
							<td>'.$raznom.'</td>
							<td>'.$mascgen.'</td>
							<td>'.$mascfec.'</td>
							<td>'.calculaedad ($mascfec) .'</td>
							<td><button type="button" class="btn btn-info sam-crudmascota-btn" onclick="fn_editar_mascota('.$mascid.');" data-toggle="modal" data-target="#registrarMascota">EDITAR</button></td>
							<td><button type="button" class="btn btn-danger sam-crudmascota-btn" onclick="fn_eliminar_mascota('.$mascid.');">ELIMINAR</button></td>
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