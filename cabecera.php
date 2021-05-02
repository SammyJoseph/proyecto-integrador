<?php 
	session_start();
	$LOGIN = "";
	$LOGOUT= "invisible";
	$ADMIN= "invisible";
	if(empty($_SESSION["MASCOTAS"])){
	//echo "NO TENEMOS SESIÓN";
	}else{
		//echo "<br><pre>"; print_r( $_SESSION ); echo "</pre>";
		$LOGIN = "invisible";
		$LOGOUT= "";
		if($_SESSION["MASCOTAS"]["usuid"] == "Admin"){
			$ADMIN= "";	
		}
		$mysession = $_SESSION["MASCOTAS"]["usunom"];
		// print "<script>console.log('$mysession');</script>";
	}
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Patitas</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link rel="icon" type="image/png" href="images/favicon.png">
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/sam.css">
	<link rel="stylesheet" type="text/css" href="fonts/fontawesome/css/all.css">

  </head>
  <body>

    <div class="wrap">
			<div class="container">
				<div class="row">
					<div class="col-md-6 d-flex align-items-center">
						<p class="mb-0 phone pl-md-2">
							<a href="#" class="mr-2"><span class="fa fa-phone mr-1"></span> +51 971 893 196</a> 
							<a href="#"><span class="fa fa-paper-plane mr-1"></span> contacto@4patitas.com</a>
						</p>
					</div>
					<div class="col-md-6 d-flex justify-content-md-end">
						<div class="social-media">
			    		<p id="sam-login" class="mb-0 d-flex align-items-center text-light sam-login <?php echo $LOGIN ; ?>"><a href="login.php" class="d-flex align-items-center justify-content-center "><span class="fa fa-user"><i class="sr-only"></i></span></a><span>Iniciar Sesión</span></p>
						<p id="sam-logout" class="mb-0 d-flex align-items-center text-light sam-login <?php echo $LOGOUT; ?>"><a href="login.php" class="d-flex align-items-center justify-content-center "><span class="fa fa-user"><i class="sr-only"></i></span></a><span>Hola, <?php echo $mysession ?></span></p>
		        </div>
					</div>
				</div>
			</div>
		</div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	    	<a class="navbar-brand" href="index.php"><span class="flaticon-pawprint-1 mr-2"></span>PATITAS</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="fa fa-bars"></span> Menú
	      </button>
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	        	<li class="nav-item"><a href="index.php" class="nav-link">Inicio</a></li>
	          <li class="nav-item"><a href="galeria.php" class="nav-link">Galería</a></li>
	          <li class="nav-item <?php echo $LOGOUT; ?>"><a href="crud_mascota.php" class="nav-link">Mis Mascotas</a></li>
	          <li class="nav-item <?php echo $ADMIN ; ?>"><a href="crud_producto.php" class="nav-link">Productos</a></li>
	          <li class="nav-item <?php echo $ADMIN ; ?>"><a href="crud_servicio.php" class="nav-link">Servicios</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
