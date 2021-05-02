<?php
error_reporting(E_ALL); ini_set('display_errors', '1');
$m_resultado = [];
include_once( "db.php" );
$conexion1 = new db();

$modo = "";
if( isset($_GET["modo"]) ) $modo = trim($_GET["modo"]);
$masctponid = 0;
if( isset($_GET["masctponid"]) ) $masctponid = trim($_GET["masctponid"]);
$masctponom = "";
if( isset($_GET["masctponom"]) ) $masctponom = trim($_GET["masctponom"]);
$masctposta = "AC";
if( isset($_GET["masctposta"]) ) $masctposta = trim($_GET["masctposta"]);

if( $modo == "LST" ){
    $sql = "SELECT * FROM cat_mascota_tpo WHERE masctposta = 'AC'  ORDER BY masctpoid;";
    //echo $sql ; //exit;
	$m_datos = $conexion1->getM( $sql );
    foreach( $m_datos as $reg ){
		$m_resultado[] = [
            "masctpoid" => intval(trim($reg["masctpoid"])),
			"masctponom" => trim($reg["masctponom"]),
			"masctposta" => trim($reg["masctposta"]),
		];
	}
	$m_datos = null; // Limpiar Memoria
}elseif( $modo == "INS" ){
    $sql = "SELECT max( masctpoid ) + 1 FROM cat_mascota_tpo;";
	$masctpoid = trim( $conexion1->get( $sql ) );
	//echo $masctpoid  ; exit;
	if( empty( $masctpoid ) ) $masctpoid = 1;
    $sql = "INSERT INTO cat_mascota_tpo 
		    ( masctpoid,masctponom,masctposta )
            VALUES
            ('$masctpoid','$masctponom','$masctposta');";
    $conexion1->ejecutar( $sql );
	$m_resultado = [ "resultado" => trim( $masctpoid ) ];
}elseif( $modo == "UPD" ){
    $sql = "UPDATE cat_mascota_tpo 
		SET
			masctponom = '".$masctponom."',
			masctposta = '".$masctposta."',
		WHERE masctpoid = '".$masctpoid."';
	";
	$conexion1->ejecutar( $sql );
	$m_resultado = [ "resultado" => intval(1) ];
}elseif( $modo == "DEL" ){
    $sql = "DELETE FROM cat_mascota_tpo WHERE masctpoid = '".$masctpoid."';";
	$conexion1->ejecutar( $sql );
	$m_resultado = [ "resultado" => intval(1) ];
}
$conexion1->link = null; // Desconectar BD
//echo "<br><hr> <pre>"; print_r( $m_resultado );	echo "</pre>"; exit;
include_once( "cabecera_json.php" );
echo json_encode( $m_resultado,JSON_UNESCAPED_UNICODE );
?>