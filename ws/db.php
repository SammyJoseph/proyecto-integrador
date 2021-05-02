<?php
error_reporting(E_ALL); ini_set('display_errors', '1');
class db{	
	function __construct(){			
		date_default_timezone_set( 'America/Lima' );
		set_time_limit( 99999 );
		$this->link = "";
		$this->conectar_base_datos();
	}
	private function conectar_base_datos(){
		try {
			$this->link = new PDO( "mysql:host=localhost;dbname=vet;charset=utf8mb4;", "root","mysql06" );
			$this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->link->exec( "SET NAMES utf8;" );
		}catch(PDOException $e){
			die('<div>Error de Conexion a MYSQL: vet ('.$e->getMessage().')</div>');
		}
		//echo "<br>Conexion MYSQL OK";										
		return $this->link;	
	}
	public function ejecutar( $sql ){
		$sql = str_replace( '\\\'','\'\'',$sql );			  
		$sql = str_replace( '#','',$sql );			
		
		$sql = trim( $sql );		
		// echo "<br>ejecutar( $sql )";
		$resultado = "";	
		$inicio = trim( strtolower( substr( $sql,0,6 ) ) );
		//$resultado = "[".$inicio."] = ".$sql;
		switch( $inicio ){
			case "insert":
				if( !$this->link->exec( $sql ) ) die( "<br>Error SQL: $sql" );
				// $resultado = $this->link->lastInsertId();	
				$resultado = true;	
				break;
			case "update":
				$resultado = $this->link->exec( $sql );	
				break;
			case "delete":
				$resultado = $this->link->exec( $sql );
				break;
			case "alter":
				$resultado = $this->link->exec( $sql );
				break;
			case "create":
				$resultado = $this->link->exec( $sql );
				break;				
		}
		return $resultado;
	}
	public function get( $sql ){
		$sql = str_replace( '\\\'','\'\'',$sql );			  
		$sql = str_replace( '\"','"',$sql );		
		
		// echo "<br>get( $sql )";
		foreach( $this->link->query( $sql ) as $row ) {
			return trim( $row[0] ); 
		}
		return "";
	}	
	
	public function getM( $sql ){
		$sql = str_replace( '\\\'','\'\'',$sql );			  
		$sql = str_replace( '\"','"',$sql );				
		$resultado = array();
		foreach( $this->link->query( $sql ) as $row ) {
			array_push( $resultado, $row );	
		}
		return $resultado;
	}	
}	
?>