<?php


$url = explode("?",$_SERVER['HTTP_REFERER']);

$pag_referida=$url[0];

include ("Connections/datos_conex.php");

include_once("config_etiquetas.php");


$redir=$pag_referida;


if (isset($_POST['nom_usu']) && isset($_POST['pas_usu'])) {
	
	require_once("clases/bd/MySQLConex.php");
	
	require_once("clases/acceso/DatosUsuario.php");	
	
	unset($login);
    unset ($password);
	$con = new MySQLConex();
	try{
		$con->abrir("Connections/datos_conex.php");
		
		$p=$con->escape_string();
		$login = $p;
		$password = md5($_POST['pas_usu']);
		$datos_usuario=DatosUsuario::recuperar($con,$login,$password);		
		if($datos_usuario==NULL){
			Header ("Location: $redir?error_login=7",'parent');
			exit;
		}
		session_name($usuarios_sesion);
		session_start();
    	session_cache_limiter('nocache,private');
		$datos_usuario->publicarDatos();
		if(!isset($_SESSION['hoja_estilos']))
			$_SESSION['hoja_estilos']='sapred4.css';
		$pag=$_SERVER['PHP_SELF'];
		$con->cerrar();
		header("Location: $pag?");
		exit;	
	}catch(Exception $e){
		die($e->getMessage());
		header("Location: $redir?error_login=0",'parent');
		exit;
	}
}else {
	session_name($usuarios_sesion);
	session_start();
	if (!isset($_SESSION['usuario_login']) && isset($_SESSION['usuario_password'])){
		session_destroy();
		header("Location: ./index.php?error_login=0",'parent');
		exit;
	}
}
include('titulos.php');
?>
