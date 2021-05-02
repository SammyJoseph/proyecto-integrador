<?php
error_reporting(E_ALL); ini_set('display_errors', '1');
session_start();
$m_resultado = [];
include_once( "db.php" );
$conexion1 = new db();

$modo = "";
if( isset($_GET["modo"]) ) $modo = trim($_GET["modo"]);

// $usuid = "";	if( isset($_GET["usuid"]) ) $usuid = trim($_GET["usuid"]);
$usunom = "";	if( isset($_GET["usunom"]) ) $usunom = trim($_GET["usunom"]);
$usuape = "";	if( isset($_GET["usuape"]) ) $usuape = trim($_GET["usuape"]);
$usudni = "";	if( isset($_GET["usudni"]) ) $usudni = trim($_GET["usudni"]);
$usuid = ""; 	$usuid = trim(strtolower(substr($usunom, 0, 3)) . substr($usudni, 0, 4));
$usugen = "";	if( isset($_GET["usugen"]) ) $usugen = trim($_GET["usugen"]);
$usudis = "";	if( isset($_GET["usudis"]) ) $usudis = trim($_GET["usudis"]);
$usudir = "";	if( isset($_GET["usudir"]) ) $usudir = trim($_GET["usudir"]);
$usuemail = "";	if( isset($_GET["usuemail"]) ) $usuemail = trim($_GET["usuemail"]);
$usutel = "";	if( isset($_GET["usutel"]) ) $usutel = trim($_GET["usutel"]);
$usupw = "";	if( isset($_GET["usupw"]) ) $usupw = trim($_GET["usupw"]);
// $ususta = "";	if( isset($_GET["ususta"]) ) $ususta = trim($_GET["ususta"]);
$ususta = "AC";
$rolid = "";	if( isset($_GET["rolid"]) ) $rolid = trim($_GET["rolid"]);


$sql1 = "SELECT EXISTS(SELECT * FROM tb_usuarios WHERE usudni = $usudni)";
$dni = $conexion1->get($sql1);
$sql2 = "SELECT EXISTS(SELECT * FROM tb_usuarios WHERE usumail = '$usuemail')";
$email = $conexion1->get($sql2);
$sql3 = "SELECT EXISTS(SELECT * FROM tb_usuarios WHERE usutel = '$usutel')";
$tel = $conexion1->get($sql3);

if($dni == "1"){
	$m_resultado = [ "resultado" => 1 ];
}
else if($email == "1"){
	$m_resultado = [ "resultado" => 2 ];
}
else if($tel == "1"){
	$m_resultado = [ "resultado" => 3 ];
}
else{
	if( $modo == "INS" ){
	    $sql = "INSERT INTO tb_usuarios 
			    (usuid,usunom,usuape,usudni,usugen,usudis,usudir,usumail,usutel,usucon,ususta,rolid)
	            VALUES
	            ('$usuid','$usunom','$usuape','$usudni','$usugen','$usudis','$usudir','$usuemail','$usutel','$usupw','$ususta','$rolid');";
	    
		$conexion1->ejecutar( $sql );
		$m_resultado = [ "resultado" => 4 ];
		// print "<script>alert('Registro exitoso. Por favor, inicie sesión.');</script>";
	}
}


$conexion1->link = null; // Desconectar BD
//echo "<br><hr> <pre>"; print_r( $m_resultado );	echo "</pre>"; exit;
include_once( "cabecera_json.php" );
echo json_encode( $m_resultado,JSON_UNESCAPED_UNICODE );
?>