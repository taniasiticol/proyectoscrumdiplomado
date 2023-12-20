<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//  Autentificator
// Motor autentificación usuarios.
// Cargar datos conexion y otras variables.

$url = explode("?",$_SERVER['HTTP_REFERER']);

$pag_referida=$url[0];

include ("Connections/datos_conex.php");

include_once("config_etiquetas.php");

// chequear página que lo llama para devolver errores a dicha página.

$redir=$pag_referida;

// chequear si se llama directo al script.
/*if ($_SERVER['HTTP_REFERER'] == ""){
	die("Acceso incorrecto! - Usted debe logearse primero");
	// ("Acceso incorrecto! - Usted debe logearse primero");
	//exit;
}*/
// Chequeamos si se está autentificandose un usuario por medio del formulario
if (isset($_POST['nom_usu']) && isset($_POST['pas_usu'])) {
	
	require_once("clases/bd/MySQLConex.php");
	
	require_once("clases/acceso/DatosUsuario.php");	
	
	unset($login);
    unset ($password);
	// Conexión base de datos.
	$con = new MySQLConex();
	// Conexión base de datos.
	// si no se puede conectar a la BD salimos del scrip con error 0 y
	// redireccionamos a la pagina de error.
	
	try{
		
		$con->abrir("Connections/datos_conex.php");
		
		$p=$con->escape_string();
		
		//print_r($p);
		//print_r("si pasa");
		//exit;
		
		//print_r($con->escape_string());exit;
		// eliminamos barras invertidas y dobles en sencillas
		//
		//$login = $_POST['nom_usu'];
		//print_r($login);exit;
		
		$login = $p;
		//print_r($login);
		// encriptamos el password en formato md5 irreversible.
		$password = md5($_POST['pas_usu']);
		// chequeamos el nombre y la contraseña en la BD
		//print_r($password);exit;
		$datos_usuario=DatosUsuario::recuperar($con,$login,$password);		
		//print_r();exit;
		if($datos_usuario==NULL){
			Header ("Location: $redir?error_login=7",'parent');
			exit;
		}
		
		// En este punto, el usuario ya esta validado.
		// Grabamos los datos del usuario en una sesion.
		
		 // le damos un mobre a la sesion.
		session_name($usuarios_sesion);
		 // incia sessiones
		session_start();
		// Paranoia: decimos al navegador que no "cachee" esta página.
    	session_cache_limiter('nocache,private');
		//inicias la variables de sesion
		$datos_usuario->publicarDatos();
		
		
		if(!isset($_SESSION['hoja_estilos']))
			$_SESSION['hoja_estilos']='sapred4.css';
		// Hacemos una llamada a si mismo (scritp) para que queden disponibles
		// las variables de session en el array asociado $HTTP_...
		$pag=$_SERVER['PHP_SELF'];
		$con->cerrar();
		header("Location: $pag?");
		exit;	
	}catch(Exception $e){
		//echo $e->getMessage(); 
		die($e->getMessage());
		header("Location: $redir?error_login=0",'parent');
		exit;
	}
}else {
	// -------- Chequear sesión existe -------
	// usamos la sesion de nombre definido.
	session_name($usuarios_sesion);
	// Iniciamos el uso de sesiones
	session_start();
	//print_r($_SESSION);
	// Chequeamos si estan creadas las variables de sesión de identificación del usuario,
	// El caso mas comun es el de una vez "matado" la sesion se intenta volver hacia atras
	// con el navegador.
	if (!isset($_SESSION['usuario_login']) && isset($_SESSION['usuario_password'])){
		// Borramos la sesion creada por el inicio de session anterior
		session_destroy();
		header("Location: ./index.php?error_login=0",'parent');
		exit;
	}
}
include('titulos.php');
?>