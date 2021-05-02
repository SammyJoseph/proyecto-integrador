<?php
error_reporting(E_ALL); ini_set('display_errors', '1');
$m_resultado = [];
include_once( "db.php" );
$conexion1 = new db();
//echo "<br><pre>"; print_r( $_GET ); echo "</pre>";exit;
$modo = "";
if( isset($_GET["modo"]) ) $modo = trim($_GET["modo"]);
$mascprodid = 0;
if( isset($_GET["mascprodid"]) ) $mascprodid = trim($_GET["mascprodid"]);
$marcprodid = 0;
if( isset($_GET["marcprodid"]) ) $marcprodid = trim($_GET["marcprodid"]);
$provprodid = 0;
if( isset($_GET["provprodid"]) ) $provprodid = trim($_GET["provprodid"]);
$mascprodnom = "";
if( isset($_GET["mascprodnom"]) ) $mascprodnom = trim($_GET["mascprodnom"]);
$mascprodpre = "";
if( isset($_GET["mascprodpre"]) ) $mascprodpre = trim($_GET["mascprodpre"]);
$mascprodstoc = "";
if( isset($_GET["mascprodstoc"]) ) $mascprodstoc = trim($_GET["mascprodstoc"]);
$mascproddes = "";
if( isset($_GET["mascproddes"]) ) $mascproddes = trim($_GET["mascproddes"]);
$mascprodhtml = "";
if( isset($_GET["mascprodhtml"]) ) $mascprodhtml = trim($_GET["mascprodhtml"]);
$mascprodsta = "AC";
if( isset($_GET["mascprodsta"]) ) $mascprodsta = trim($_GET["mascprodsta"]);
//UPDATE IMAGES
$mascprodimg = "";
if( isset($_GET["mascprodimg"]) ) $mascprodimg .= trim($_GET["mascprodimg"]);
$mascprodimg2 = "";
if( isset($_GET["mascprodimg2"]) ) $mascprodimg2 .= trim($_GET["mascprodimg2"]);
$mascprodimg3 = "";
if( isset($_GET["mascprodimg3"]) ) $mascprodimg3 .= trim($_GET["mascprodimg3"]);


if( $modo == "LST" ){
	$where_id = "";
	if( $mascprodid > 0 ){ $where_id = "WHERE mascprodid=$mascprodid"; }
    $sql = "SELECT * FROM tb_productos $where_id ORDER BY mascprodid;";
    //echo $sql ;// exit;
	$m_datos = $conexion1->getM( $sql );
    foreach( $m_datos as $reg ){
		$m_resultado[] = [
            "mascprodid" => intval(trim($reg["mascprodid"])),
            "marcprodid" => intval(trim($reg["marcprodid"])),
			"provprodid" => intval(trim($reg["provprodid"])),
            "mascprodnom" => trim($reg["mascprodnom"]),
            "mascprodpre" => trim($reg["mascprodpre"]),
            "mascprodstoc" => trim($reg["mascprodstoc"]),
			"mascproddes" => trim($reg["mascproddes"]),
			"mascprodhtml" => trim($reg["mascprodhtml"]),
            "mascprodimg" => trim($reg["mascprodimg"]),
            "mascprodimg2" => trim($reg["mascprodimg2"]),
            "mascprodimg3" => trim($reg["mascprodimg3"]),
            "mascprodsta" => trim($reg["mascprodsta"]),
		];
	}
	//echo "<br><pre>"; print_r( $m_datos ); echo "</pre>";
	$m_datos = null; // Limpiar Memoria
}elseif( $modo == "INS" ){
    $sql = "SELECT max( mascprodid ) + 1 FROM tb_productos;";
	$mascprodid = trim( $conexion1->get( $sql ) );
	//echo $mascprodid  ; exit;
	if( empty( $mascprodid ) ) $mascprodid = 1;
    $sql = "INSERT INTO tb_productos 
		    ( mascprodid,mascprodnom,marcprodid,provprodid,mascprodhtml,mascproddes,mascprodpre,mascprodstoc,mascprodimg,mascprodimg2,mascprodimg3,mascprodsta )
            VALUES
            ('$mascprodid','$mascprodnom','$marcprodid','$provprodid','$mascprodhtml','$mascproddes','$mascprodpre','$mascprodstoc','$mascprodimg','$mascprodimg2','$mascprodimg3','$mascprodsta');";
    //echo $sql  ; //exit;
	$conexion1->ejecutar( $sql );
	$m_resultado = [ "resultado" => trim( $mascprodid ) ];
}elseif( $modo == "UPD" ){
	$sql = "UPDATE `tb_productos` 
		SET `provprodid` = '".$provprodid."' , `marcprodid` = '".$marcprodid."' , `mascprodnom` = '".$mascprodnom."' , `mascprodpre` = '".$mascprodpre."' , `mascprodstoc` = '".$mascprodstoc."' , `mascprodimg` = '".$mascprodimg."', `mascprodimg2` = '".$mascprodimg2."', `mascprodimg3` = '".$mascprodimg3."', `mascprodhtml` = '".$mascprodhtml."', `mascproddes` = '".$mascproddes."', `mascprodsta` = '".$mascprodsta."' 
		WHERE `tb_productos`.`mascprodid` = $mascprodid 
	";
	//echo $sql  ; exit;
	$conexion1->ejecutar( $sql );
	$m_resultado = [ "resultado" => intval(1) ];
}elseif( $modo == "DEL" ){
    $sql = "DELETE FROM tb_productos WHERE mascprodid = '".$mascprodid."';";
	$conexion1->ejecutar( $sql );
	$m_resultado = [ "resultado" => intval(1) ];
}
$conexion1->link = null; // Desconectar BD
//echo "<br><hr> <pre>"; print_r( $m_resultado );	echo "</pre>"; exit;
include_once( "cabecera_json.php" );
echo json_encode( $m_resultado,JSON_UNESCAPED_UNICODE );
?>