<?php
error_reporting(E_ALL); ini_set('display_errors', '1');
session_start();
$m_resultado = [];
include_once( "db.php" );
$conexion1 = new db();

$modo = "";
if( isset($_GET["modo"]) ) $modo = trim($_GET["modo"]);
$mascid = 0;
if( isset($_GET["mascid"]) ) $mascid = trim($_GET["mascid"]);
$usuid = $_SESSION["MASCOTAS"]["usuid"];
if( isset($_GET["usuid"]) ) $usuid = trim($_GET["usuid"]);
$mascnom = "";
if( isset($_GET["mascnom"]) ) $mascnom = trim($_GET["mascnom"]);
$mascgen = "";
if( isset($_GET["mascgen"]) ) $mascgen = trim($_GET["mascgen"]);
$mascfec = "0000-00-00";
if( isset($_GET["mascfec"]) ) $mascfec = trim($_GET["mascfec"]);
$masctpoid = 0;
if( isset($_GET["masctpoid"]) ) $masctpoid = trim($_GET["masctpoid"]);
$razid = 0;
if( isset($_GET["razid"]) ) $razid = trim($_GET["razid"]);

if( $modo == "LST" ){
	$where_id = "";
    $where_usuid =  "";
	if( $mascid > 0 ){ $where_id = "AND mascid=$mascid"; }
    if( $usuid !="" ){ $where_usuid = "WHERE usuid LIKE '%$usuid%'"; }
    $sql = "SELECT * FROM tb_mascotas $where_usuid $where_id ORDER BY mascid;";
    //echo $sql ;// exit;
	$m_datos = $conexion1->getM( $sql );
    foreach( $m_datos as $reg ){
		$m_resultado[] = [
            "mascid" => intval(trim($reg["mascid"])),
            "usuid" => trim($reg["usuid"]),
			"mascnom" => trim($reg["mascnom"]),
			"mascgen" => trim($reg["mascgen"]),
			"mascfec" => trim($reg["mascfec"]),
            "masctpoid" => intval(trim($reg["masctpoid"])),
            "razid" => intval(trim($reg["razid"])),
		];
	}
	//echo "<br><pre>"; print_r( $m_datos ); echo "</pre>";
	$m_datos = null; // Limpiar Memoria
}elseif( $modo == "INS" ){
    $sql = "SELECT max( mascid ) + 1 FROM tb_mascotas;";
	$mascid = trim( $conexion1->get( $sql ) );
	//echo $mascid  ; exit;
	if( empty( $mascid ) ) $mascid = 1;
    $sql = "INSERT INTO tb_mascotas 
		    ( mascid,usuid,mascnom,mascfec,mascgen,masctpoid,razid )
            VALUES
            ('$mascid','$usuid','$mascnom','$mascfec','$mascgen','$masctpoid','$razid');";
    //echo $sql  ; exit;
	$conexion1->ejecutar( $sql );
	$m_resultado = [ "resultado" => trim( $mascid ) ];
}elseif( $modo == "UPD" ){
	$sql = "UPDATE `tb_mascotas` 
		SET `mascnom` = '".$mascnom."', `masctpoid` = '".$masctpoid."', `razid` = '".$razid."', `mascfec` = '".$mascfec."', `mascgen` = '".$mascgen."' 
		WHERE `tb_mascotas`.`mascid` = $mascid AND `tb_mascotas`.`usuid` = '$usuid' 
	";
	//echo $sql  ; exit;
	$conexion1->ejecutar( $sql );
	$m_resultado = [ "resultado" => intval(1) ];
}elseif( $modo == "DEL" ){
    $sql = "DELETE FROM tb_mascotas WHERE mascid = '".$mascid."' AND usuid = '".$usuid."' ;";
	$conexion1->ejecutar( $sql );
	$m_resultado = [ "resultado" => intval(1) ];
}
$conexion1->link = null; // Desconectar BD
//echo "<br><hr> <pre>"; print_r( $m_resultado );	echo "</pre>"; exit;
include_once( "cabecera_json.php" );
echo json_encode( $m_resultado,JSON_UNESCAPED_UNICODE );
?>