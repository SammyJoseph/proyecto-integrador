<?php
error_reporting(E_ALL); ini_set('display_errors', '1');
$m_resultado = [];
include_once( "db.php" );
$conexion1 = new db();
//echo "<br><pre>"; print_r( $_GET ); echo "</pre>";exit;
$modo = "";
if( isset($_GET["modo"]) ) $modo = trim($_GET["modo"]);
$servmascid = 0;
if( isset($_GET["servmascid"]) ) $servmascid = trim($_GET["servmascid"]);
$servmascnom = "";
if( isset($_GET["servmascnom"]) ) $servmascnom = trim($_GET["servmascnom"]);
$servmascdes = "";
if( isset($_GET["servmascdes"]) ) $servmascdes = trim($_GET["servmascdes"]);
$servmascpre = "";
if( isset($_GET["servmascpre"]) ) $servmascpre = trim($_GET["servmascpre"]);
$servmascimg = "";
if( isset($_GET["servmascimg"]) ) $servmascimg = trim($_GET["servmascimg"]);
$servmascfec = "";
if( isset($_GET["servmascfec"]) ) $servmascfec = trim($_GET["servmascfec"]);
$servmaschor = "";
if( isset($_GET["servmaschor"]) ) $servmaschor = trim($_GET["servmaschor"]);
$servmascsta = "AC";
if( isset($_GET["servmascsta"]) ) $servmascsta = trim($_GET["servmascsta"]);


if( $modo == "LST" ){
	$where_id = "";
	if( $servmascid > 0 ){ $where_id = "WHERE servmascid=$servmascid"; }
    $sql = "SELECT * FROM tb_servicios $where_id ORDER BY servmascid;";
    //echo $sql ;// exit;
	$m_datos = $conexion1->getM( $sql );
    foreach( $m_datos as $reg ){
		$m_resultado[] = [
            "servmascid" => intval(trim($reg["servmascid"])),
            "servmascnom" => trim($reg["servmascnom"]),
            "servmascdes" => trim($reg["servmascdes"]),
            "servmascpre" => trim($reg["servmascpre"]),
			"servmascimg" => trim($reg["servmascimg"]),
            "servmascfec" => trim($reg["servmascfec"]),
			"servmaschor" => trim($reg["servmaschor"]),
            "servmascsta" => trim($reg["servmascsta"]),
		];
	}
	//echo "<br><pre>"; print_r( $m_datos ); echo "</pre>";
	$m_datos = null; // Limpiar Memoria
}elseif( $modo == "INS" ){
    $sql = "SELECT max( servmascid ) + 1 FROM tb_servicios;";
	$servmascid = trim( $conexion1->get( $sql ) );
	//echo $servmascid  ; exit;
	if( empty( $servmascid ) ) $servmascid = 1;
    $sql = "INSERT INTO tb_servicios 
		    ( servmascid,servmascnom,servmaschor,servmascfec,servmascimg,servmascdes,servmascpre,servmascsta )
            VALUES
            ('$servmascid','$servmascnom','$servmaschor','$servmascfec','$servmascimg','$servmascdes','$servmascpre','$servmascsta');";
    //echo $sql  ; //exit;
	$conexion1->ejecutar( $sql );
	$m_resultado = [ "resultado" => trim( $servmascid ) ];
}elseif( $modo == "UPD" ){
	$sql = "UPDATE `tb_servicios` 
		SET  `servmascnom` = '".$servmascnom."' , `servmascdes` = '".$servmascdes."' , `servmascpre` = '".$servmascpre."' , `servmaschor` = '".$servmaschor."' , `servmascfec` = '".$servmascfec."' , `servmascimg` = '".$servmascimg."', `servmascsta` = '".$servmascsta."' 
		WHERE `tb_servicios`.`servmascid` = $servmascid 
	";
	//echo $sql  ; exit;
	$conexion1->ejecutar( $sql );
	$m_resultado = [ "resultado" => intval(1) ];
}elseif( $modo == "DEL" ){
    $sql = "DELETE FROM tb_servicios WHERE servmascid = '".$servmascid."';";
	$conexion1->ejecutar( $sql );
	$m_resultado = [ "resultado" => intval(1) ];
}
$conexion1->link = null; // Desconectar BD
//echo "<br><hr> <pre>"; print_r( $m_resultado );	echo "</pre>"; exit;
include_once( "cabecera_json.php" );
echo json_encode( $m_resultado,JSON_UNESCAPED_UNICODE );
?>