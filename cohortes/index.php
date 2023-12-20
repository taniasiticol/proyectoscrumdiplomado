<?php
require_once  "../clases/bd/MySQLConex.php";
include "../Connections/datos_conex.php";
$con=new MySQLConex();
$con->abrir('../Connections/datos_conex.php');
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
    <title>Gest&oacute;n de Cohortes</title>
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
    <?php if ($usu['tip_usu']=='1') { ?>
    <div class="row">
    <div class="col"></div>
    <div class="col">
        <button type="button" class="btn mi-texto" data-toggle="modal" data-target="#myModal"><i class="bi bi-person-fill-add"></i> REGISTRO DE COHORTES</button>
    </div>
    <div class="col"></div>
    </div>
        <?php } ?>
    <div class="container">
    <div class="row">
    <div class="col">
    <div class="modal" id="myModal">
        <div class="modal-dialog mi-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title"><strong>Formulario de Registro de Cohortes</strong></p>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form action="guardar.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-1">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-1">
                                        <label for="num_estu" class="form-label">N&uacute;mero de Estudiantes</label>
                                        <input type="number" class="form-control" id="num_estu" name="num_estu" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-1">
                                        <label for="fec_ini" class="form-label">Fecha de Inicio</label>
                                        <input type="date" class="form-control" id="fec_ini" name="fec_ini" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-1">
                                        <label for="fec_fin" class="form-label">Fecha de Finalizaci&oacute;n</label>
                                        <input type="date" class="form-control" id="fec_fin" name="fec_fin" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-1">
                                        <label for="prog_vincu" class="form-label">Programa de Vinculaci&oacute;n</label>
                                        <select id="prog_vincu" name="prog_vincu"class="form-select" aria-label="Default select example">
                                        <option selected>Seleccionar una opci&oacute;n</option>
                                        <?php 
                                            $consulta_pa = "SELECT * from programa_academico order by id_programa";
                                            $rpa = $conexion->query($consulta_pa);
                                            if ($rpa->num_rows > 0) {
                                                while ($fil = $rpa->fetch_assoc()) { ?>
                                                    <option value="<?php echo $fil['id_programa'] ?>"><?php echo $fil['nombre']; ?></option>
                                                <?php }
                                            } else {
                                                echo 'No hay programas academicos.';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <h2 align="center">Informaci&oacute;n de Cohortes</h2>
        <?php
           
            $consulta_sql = "SELECT c.*,pa.nombre as programa FROM cohortes c
            JOIN programa_academico pa ON pa.id_programa=c.progra_vinc"; // Reemplaza con tu consulta SQL
            $resultado = $conexion->query($consulta_sql);
            if ($resultado->num_rows > 0) { ?>
                <table class="table">
                <thead class="mi-th">
                    <tr>
                        <th>C&oacute;digo</th>
                        <th>Nombre</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Finalizaci&oacute;n</th>
                        <th>N&uacute;mero de Estudiantes</th>
                        <th>Programa Academico</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($fila = $resultado->fetch_assoc()) { ?>
                    <tr>
                        <td><?php print_r($fila['codigo'] ); ?></td>
                        <td><?php print_r($fila['nombre'] ); ?></td>
                        <td><?php print_r($fila['fecha_inicio'] ); ?></td>
                        <td><?php print_r($fila['fecha_finalizacion'] ); ?></td>
                        <td><?php print_r($fila['numero_estudiantes'] ); ?></td>
                        <td><?php print_r($fila['programa'] ); ?></td>
                    </tr>
                <?php } ?>
                </tbody>
                </table>
                <?php
            } else {
                echo 'No se encontraron resultados.';
            }
        $conexion->close();  ?>
    </div>
    </div>
    </div></div></div> <!-- fin del segundo bloque contenedor -->
    <!-- Add the link to the jQuery and Bootstrap JS files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>