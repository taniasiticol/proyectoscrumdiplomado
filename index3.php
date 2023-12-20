<?php
//PHP7
	//error_reporting(E_ALL);
	//ini_set('display_errors', 1);
$ret_db_con='s';
/*$usu_sis=($_POST['nom_usu']);
$query=$con->query("SELECT * from ususis where nom_usu like '$usu_sis'");
$usu=$con->fetch($query);
$tipo_usu=$usu['tip_usu'];
*/
include("aut_verifica.inc.php");

$meses=array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');	
require_once "clases/base/menus.php";

require_once  "clases/bd/MySQLConex.php";
require_once("clases/gui/select.php");
include "Connections/datos_conex.php";
$con=new MySQLConex();
$con->abrir('Connections/datos_conex.php');

header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$r_i=$con->query("SELECT * FROM institucion ");
$fIns=$con->fetch($r_i);
$nom_ins=$fIns['nom_ins'];


//$imagenes=imagenes::getFilteredBy($con,'LOGO_INS');
//$carp_logos=_sapred::getFilteredBy($con,'CARPETA_LOGOS');
//$usu_sis=($_POST);

$carp=array();
$LogoIns=array();
$rutaLogo="";
if(is_array($carp_logos))
	$carp=current($carp_logos);
//if(is_array($imagenes))
//	$LogoIns=current($imagenes);
$rutaLogo=$carp->val_var.$LogoIns->url_img;
?>
<!DOCTYPE html>
<html lang="es">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sistema de Gesti&oacute;n de Postgrados UDENAR</title>

<style>
    body {
      padding-top: 56px; /* Altura del Navbar */
    }

    #contenido {
      margin-top: 20px;
    }
    .navbar-nav .nav-link {
      font-size: 14px;
    }
    .navbar-brand { 
      font-size: 35px;
      background: linear-gradient(to right, #4CAF50 , #2196F3); /* Cambia los colores según tus preferencias */
      -webkit-background-clip: text;
      color: transparent;
    }
  </style>
  <style>
        .mi-texto {
            color: white;
            text-shadow: -1px -1px 1px black, 1px -1px 1px black, -1px 1px 1px black, 1px 1px 1px black;
        }
        .mi-salir {
            color: #C22020;
            text-shadow: -1px -1px 1px black, 1px -1px 1px black, -1px 1px 1px black, 1px 1px 1px black;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

</head>
<body  id="body_sapred" class="body-sapred" >
<?php 
    $usu_sis=($_SESSION['usuario_login']);
    $query=$con->query("SELECT * from ususis where nom_usu like '$usu_sis'");
    $usu=$con->fetch($query);
    $tipo_usu=$usu['tip_usu'];
    $id_usu=$usu['id_usu'];
    //print_r($usu);exit;
?>
<nav class="navbar navbar-expand-lg bg-dark fixed-top navbar-green">
        <a style="font-size: 30px;" class="navbar-brand" href="index2.php?p=<?php echo $id_usu; ?>" target="contenido">
        <img src="postgrados.png" alt="Postgrados UDENAR" width="100" height="60">
        GESTI&Oacute;N DE POSTGRADOS
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <?php if ($tipo_usu=='1') { ?>
                <li class="nav-item">
                    <a class="nav-link mi-texto" href="./coordinadores/index.php" target="contenido"><i class="bi bi-people-fill"></i> COORDINADORES</a>
                </li>
            <?php } ?>
            <?php if ($tipo_usu=='1') { ?>
            <li class="nav-item">
                <a class="nav-link mi-texto" href="./programas/index.php" target="contenido"><i class="bi bi-file-earmark-text-fill"></i> PROGRAMAS ACADEMICOS</a>
            </li>
            <?php } ?>
            <li class="nav-item">
                <a class="nav-link mi-texto" href="./cohortes/index.php?p=<?php echo $id_usu; ?>" target="contenido"><i class="bi bi-calendar2-week-fill"></i> COHORTES</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mi-texto" href="./estudiantes/index.php" target="contenido"><i class="bi bi-person-walking"></i> ESTUDIANTES</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mi-texto" href="./docentes/index.php" target="contenido"><i class="bi bi-person-vcard-fill"></i> DOCENTES</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="aut_logout.php">SALIR</a>
            </li> -->
            </ul>
        </div>
        <div><a class="nav-link mi-salir" href="aut_logout.php"><i class="bi bi-x-circle-fill"></i> SALIR</a></div>
        </nav>

        <div id="contenido">
        <iframe name="contenido" width="100%" height="550px" frameborder="0"></iframe>
        </div>

        <!-- Agrega los enlaces a los archivos JS de Bootstrap y jQuery -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        
</body>
</html>
