<?php 
error_reporting(E_ALL); ini_set('display_errors', '1');
session_start();
include_once( "db.php" );
$conexion1 = new db();
//strtolower()
if(!empty($_POST)){
	$html = trim( $_POST["html"] );
	$m_items = json_decode($html);
	$usu=trim( $m_items->usu );
	$pass=trim( $m_items->pass );
	if(isset($usu) &&isset($pass)){
		if($usu!=""&&$pass!=""){			
			$usuid=null;
			
			$sql= "SELECT * FROM tb_usuarios WHERE (usuid='$usu' OR usumail='$usu')  AND usucon='$pass';";
			$m_datos = $conexion1->getM( $sql );
			//echo "<br>(".count($m_datos).") $sql"; echo "<br><pre>"; print_r( $m_datos ); echo "</pre><br>";//exit;
			foreach( $m_datos as $reg ){
				$m_resultado[] = [
					$usuid =trim($reg["usuid"]),
					$usunom =trim($reg["usunom"]),
					$usumail =trim($reg["usumail"]),
					$rolid = trim($reg["rolid"]),
				];
			}

			if($usuid==null){
				echo"<script>alert('Usuario o Contraseña Incorrectos');</script>";
				// echo "<br><pre>"; print_r( $_SESSION ); echo "</pre>";
			}else{
				$loading=".";
				for($i=0;$i>3;$i++){
					echo"<span>".$loading."</span>";
				}
				//exit;
				$_SESSION["MASCOTAS"]=[
                    "usuid" => $usuid,
                    "usunom" => $usunom,
                ];
                echo "<br><pre>"; print_r( $_SESSION ); echo "</pre>";
				if( $_SESSION["MASCOTAS"]["usuid"] == "Admin" ){
					print "<script>window.location='crud_producto.php';</script>";	
				}else{

					print "<script>window.location='crud_mascota.php';</script>";
				}
			}
		}
	}
}

?>