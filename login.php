<?php 
  include_once("cabecera.php");
?>
<div id="fw-container" class="fw-container">
	<div class="container sam-lisu">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li id="sam-login-tab" class="nav-item">
      <a  class="nav-link active" data-toggle="tab" href="#login">INICIAR SESIÓN</a>
    </li>
    <li class="nav-item">
      <a id="sam-signup-tab" class="nav-link" data-toggle="tab" href="#signup">REGISTRARSE</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
  	<!-- CONTENIDO TAB 1 -->
    <div id="login" class="container tab-pane active"><br>
    	<form method="POST" id="contactForm" name="contactForm" class="contactForm">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group w-50">
						<label class="label sam-form-label" for="subject">Usuario</label>
						<input type="text" class="form-control sam-form-input" id="txt_usu" autofocus placeholder="tu@email.com">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group w-50">
						<label class="label sam-form-label" for="subject">Clave</label>
						<input type="password" class="form-control sam-form-input" id="txt_pass" placeholder="•••••••••">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<input id="btnLogIn" type="button" value="INGRESAR" class="btn btn-primary" onclick="fn_login();">
						<!-- <input type="submit" value="INGRESAR" class="btn btn-primary"> -->
						<div class="submitting"></div>
						<!-- <div id="div_ajax">...</div> -->
					</div>
				</div>
			</div>
		</form>
   </div>
    <!-- CONTENIDO TAB 2 -->
    <div id="signup" class="container tab-pane fade sam-tab-signup"><br>
      <div class="contactForm">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="label sam-form-label" for="subject">Nombres</label>
					<input type="text" class="form-control sam-form-input" name="subject" id="inp_usunom" placeholder="Nombres">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="label sam-form-label" for="subject">Apellidos</label>
					<input type="text" class="form-control sam-form-input" name="subject" id="inp_usuape" placeholder="Apellidos">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="label sam-form-label" for="subject">DNI / Carnet de Extranjería</label>
					<input type="number" class="form-control sam-form-input" name="subject" id="inp_usudni" placeholder="DNI">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="label sam-form-label" for="subject">Género</label><br>
					<select class="form-control sam-form-input" id="sel_usugen">
					<option selected disabled value="genero">-- Seleccionar --</option>
					<option value="1">Masculino</option>
					<option value="2">Femenino</option>
					</select>
				</div>
			</div>			
			<div class="col-md-6">
				<div class="form-group">
					<label class="label sam-form-label" for="subject">Distrito</label><br>
					<select class="form-control sam-form-input" id="sel_usudis">
						<option selected disabled value="NA">-- Seleccionar --</option>
						<option value="1">Ancón</option>
						<option value="2">Ate</option>
						<option value="3">Barranco</option>
						<option value="4">Breña</option>
						<option value="5">Carabayllo</option>
						<option value="6">Chaclacayo</option>
						<option value="7">Chorrillos</option>
						<option value="8">Cieneguilla</option>
						<option value="9">Comas</option>
						<option value="10">El Agustino</option>
						<option value="11">Independencia</option>
						<option value="12">Jesús María</option>
						<option value="13">La Molina</option>
						<option value="14">La Victoria</option>
						<option value="15">Lima</option>
						<option value="16">Lince</option>
						<option value="17">Los Olivos</option>
						<option value="18">Lurigancho</option>
						<option value="19">Lurín</option>
						<option value="20">Magdalena del Mar</option>
						<option value="21">Miraflores</option>
						<option value="22">Pachacamac</option>
						<option value="23">Pucusana</option>
						<option value="24">Pueblo Libre</option>
						<option value="25">Puente Piedra</option>
						<option value="26">Punta Hermosa</option>
						<option value="27">Punta Negra</option>
						<option value="28">Rímac</option>
						<option value="29">San Bartolo</option>
						<option value="30">San Borja</option>
						<option value="31">San Isidro</option>
						<option value="32">San Juan de Lurigancho</option>
						<option value="33">San Juan de Miraflores</option>
						<option value="34">San Luis</option>
						<option value="35">San Martín de Porres</option>
						<option value="36">San Miguel</option>
						<option value="37">Santa Anita</option>
						<option value="38">Santa María del Mar</option>
						<option value="39">Santa Rosa</option>
						<option value="40">Santiago de Surco</option>
						<option value="41">Surquillo</option>
						<option value="42">Villa El Salvador</option>
						<option value="43">Villa María del Triunfo</option>
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="label sam-form-label" for="subject">Dirección</label>
					<input type="email" class="form-control sam-form-input" name="subject" id="inp_usudir" placeholder="Av. Tu Direccion Mz1">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="label sam-form-label" for="subject">Email</label>
					<input type="email" class="form-control sam-form-input" name="subject" id="inp_usuemail" placeholder="tu@email.com">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="label sam-form-label" for="subject">Teléfono</label>
					<input type="phone" class="form-control sam-form-input" name="subject" id="inp_usutel" placeholder="987654321">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="label sam-form-label" for="subject">Clave</label>
					<input type="password" class="form-control sam-form-input" name="subject" id="inp_usupw" placeholder="•••••••••">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="label sam-form-label" for="subject">Confirmar clave</label>
					<input type="password" class="form-control sam-form-input" name="subject" id="subject" placeholder="•••••••••">
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<input type="button" value="REGISTRARSE" class="btn btn-primary" onclick="fn_agregar_usuario();">
					<div class="submitting"></div>
					<div id="div_ajax">...</div>
				</div>
			</div>
		</div>
	</div>
    </div>
  </div>
</div>
</div>
<?php
include_once("pie_pagina.php");
?>