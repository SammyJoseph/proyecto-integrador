<?php
error_reporting(E_ALL); ini_set('display_errors', '1');
$m_resultado = [];
include_once( "db.php" );
$conexion1 = new db();

$modo = "";
if( isset($_GET["modo"]) ) $modo = trim($_GET["modo"]);
$razid = 0;
if( isset($_GET["razid"]) ) $razid = trim($_GET["razid"]);
$masctpoid = 0;
if( isset($_GET["masctpoid"]) ) $masctpoid = trim($_GET["masctpoid"]);
$raznom = "";
if( isset($_GET["raznom"]) ) $raznom = trim($_GET["raznom"]);
$razsta = "AC";
if( isset($_GET["razsta"]) ) $razsta = trim($_GET["razsta"]);

if( $modo == "LST" ){
    $where_id =  "";
    if( $masctpoid > 0 ){ $where_id = "AND masctpoid=$masctpoid"; }
    $sql = "SELECT * FROM cat_raza_mascota WHERE razsta = 'AC' $where_id ORDER BY razid;";
    //echo $sql ; //exit;
	$m_datos = $conexion1->getM( $sql );
    foreach( $m_datos as $reg ){
		$m_resultado[] = [
            "razid" => intval(trim($reg["razid"])),
            "masctpoid" => intval(trim($reg["masctpoid"])),
			"raznom" => trim($reg["raznom"]),
			"razsta" => trim($reg["razsta"]),
		];
	}
	$m_datos = null; // Limpiar Memoria
}elseif( $modo == "INS" ){
    $sql = "SELECT max( razid ) + 1 FROM cat_raza_mascota;";
	$razid = trim( $conexion1->get( $sql ) );
	//echo $razid  ; exit;
	if( empty( $razid ) ) $razid = 1;
    $sql = "INSERT INTO cat_raza_mascota 
		    ( razid,masctpoid,raznom,razsta )
            VALUES
            ('$razid','$masctpoid','$raznom','$razsta');";
    $conexion1->ejecutar( $sql );
	$m_resultado = [ "resultado" => trim( $razid ) ];
}elseif( $modo == "UPD" ){
    $sql = "UPDATE cat_raza_mascota 
		SET
			raznom = '".$raznom."',
			razsta = '".$razsta."',
            masctpoid = '".$masctpoid."',
		WHERE razid = '".$razid."';
	";
	$conexion1->ejecutar( $sql );
	$m_resultado = [ "resultado" => intval(1) ];
}elseif( $modo == "DEL" ){
    $sql = "DELETE FROM cat_raza_mascota WHERE razid = '".$razid."';";
	$conexion1->ejecutar( $sql );
	$m_resultado = [ "resultado" => intval(1) ];
}
$conexion1->link = null; // Desconectar BD
//echo "<br><hr> <pre>"; print_r( $m_resultado );	echo "</pre>"; exit;
include_once( "cabecera_json.php" );
echo json_encode( $m_resultado,JSON_UNESCAPED_UNICODE );
?>