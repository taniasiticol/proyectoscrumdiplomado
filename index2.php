<?php
require_once  "clases/bd/MySQLConex.php";
include "Connections/datos_conex.php";
$con=new MySQLConex();
$con->abrir('Connections/datos_conex.php');
$id_usu=$_GET['p'];
$query=$con->query("SELECT u.tip_usu, CONCAT(c.apellido,' ',c.nombre) AS nom_c, CONCAT(d.ape_dir,' ',d.nom_dir) AS nom_d
FROM ususis u
LEFT JOIN coordinadores c ON c.id_cordi=u.id_per
LEFT JOIN director d ON d.cod_dir=u.id_per
WHERE id_usu LIKE '$id_usu'");
$usu=$con->fetch($query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gest&oacute;n de Coordinadores</title>
    <!-- Add the link to the Bootstrap stylesheet -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <style>
        .mi-texto {
            color: black;
            text-shadow: -1px -1px 1px white, 1px -1px 1px white, -1px 1px 1px white, 1px 1px 1px white;
            background-color: #4CAF50;
        }
        .mi-body {
            background: linear-gradient(to bottom, #E5FDED  , ##E8F2FD); /* Degradado de azul a verde */
        }
        .mi-modal {
            max-width: 900px;
        }
        .mi-th {
            background-color: #C2E8F1;
        }
        .mi-down {
            color: #C22020;
        }
    </style>
</head>
<body class="mi-body">
    <br>
    <div class="container">
    <div class="row">
        <div class="col"></div>
        <div class="col"><h1> BIENVENID@</h1><br><h3><?php 
        if ($usu['nom_c']!='') {
            print_r($usu['nom_c']);
        }  
        else {
            print_r($usu['nom_d']);
        }
        ?></h3></div>
        <div class="col"></div>
    </div></div> 
    <!-- Add the link to the jQuery and Bootstrap JS files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>