<?php

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
        <div class="col">
            <button type="button" class="btn mi-texto" data-toggle="modal" data-target="#myModal"><i class="bi bi-person-fill-add"></i> REGISTRO DE COORDINADORES</button>
        </div>
        <div class="col"></div>
    </div>
    <div class="row">
        <div class="col">
            <label>Descargar Plantilla de Coordinadores:</label>
            <a href="pdf.php">
            <i class="bi bi-file-earmark-pdf-fill mi-down" style="font-size: 30px;"></i></a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            <div class="modal" id="myModal">
                <div class="modal-dialog mi-modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <p class="modal-title"><strong>Formulario de Registro de Coordinadores</strong></p>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <form action="guardar.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-1">
                                                <label for="id" class="form-label">Identificaci&oacute;n</label>
                                                <input type="text" class="form-control" id="id" name="id" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-1">
                                                <label for="nombre" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-1">
                                                <label for="apellido" class="form-label">Apellido</label>
                                                <input type="text" class="form-control" id="apellido" name="apellido" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-1">
                                                <label for="direccion" class="form-label">Direcci&oacute;n</label>
                                                <input type="text" class="form-control" id="direccion" name="direccion" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-1">
                                                <label for="telefono" class="form-label">Tel&eacute;fono</label>
                                                <input type="text" class="form-control" id="telefono" name="telefono" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-1">
                                                <label for="correo" class="form-label">Correo</label>
                                                <input type="email" class="form-control" id="correo" name="correo" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-1">
                                                <label for="genero" class="form-label">Genero: </label>
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="masculino" name="genero" value="m" required>
                                                <label class="form-check-label" for="masculino">Masculino</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="femenino" name="genero" value="f" required>
                                                <label class="form-check-label" for="femenino">Femenino</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="otro" name="genero" value="o" required>
                                                <label class="form-check-label" for="otro">Otro</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-1">
                                                <label for="fec_nac" class="form-label">Fecha de Nacimiento</label>
                                                <input type="date" class="form-control" id="fec_nac" name="fec_nac" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-1">
                                                <label for="fec_vincu" class="form-label">Fecha de Vinculaci&oacute;n</label>
                                                <input type="date" class="form-control" id="fec_vincu" name="fec_vincu" required>
                                            </div>
                                        </div>
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
                                        <div class="col">
                                            <div class="mb-1">
                                                <label for="acuerdo" class="form-label">Acuerdo de Nombramiento</label>
                                                <input type="file" class="form-control" id="acuerdo" name="acuerdo" required>
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
        </div>
    </div>
    <br>
    <div class="row">
    <div class="col">
        <h2 align="center">Informaci&oacute;n de Coordinadores</h2>
        <?php
            $consulta_sql = "SELECT c.*,pa.nombre AS programa
                FROM coordinadores c
                JOIN programa_academico pa ON pa.id_programa=c.id_programa"; // Reemplaza con tu consulta SQL
            $resultado = $conexion->query($consulta_sql);
            if ($resultado->num_rows > 0) { ?>
                <table class="table">
                <thead class="mi-th">
                    <tr>
                        <th width="10%">Identificaci&oacute;n</th>
                        <th width="10%">Nombre</th>
                        <th width="10%">Direcci&oacute;n</th>
                        <th width="10%">Telefono</th>
                        <th width="10%">Correo</th>
                        <th width="10%">Genero</th>
                        <th width="10%">Fecha de Nacimiento</th>
                        <th width="10%">Fecha de Vinculaci&oacute;n</th>
                        <th width="15%">Programa</th>
                        <th width="5%">Acuerdo de Nombramiento</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($fila = $resultado->fetch_assoc()) { ?>
                    <tr>
                        <td width="10%"><?php print_r($fila['id_cordi'] ); ?></td>
                        <td width="10%"><?php print_r($fila['nombre'].' '.$fila['apellido'] ); ?></td>
                        <td width="10%"><?php print_r($fila['direccion'] ); ?></td>
                        <td width="10%"><?php print_r($fila['telefono'] ); ?></td>
                        <td width="10%"><?php print_r($fila['correo'] ); ?></td>
                        <td width="10%"><?php if ($fila['genero']=='m') {
                            echo 'Masculino';
                        }else {
                            if ($fila['genero']=='f') {
                                echo 'Femenino';
                            }
                            else {
                                echo 'Otro';
                            }
                        } ?></td>
                        <td width="10%"><?php print_r($fila['fecha_nac'] ); ?></td>
                        <td width="10%"><?php print_r($fila['fecha_vin'] ); ?></td>
                        <td width="15%"><?php print_r($fila['programa'] ); ?></td>
                        <td width="5%">
                            <a href="../coordinadores/archivos_subidos/<?php echo $fila['acuerdo'];?>" download="<?php echo $fila['acuerdo'];?>">
                            <i class="bi bi-file-earmark-pdf-fill mi-down"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
                </table>
                <?php
            } else {
                echo 'No se encontraron resultados.';
            }
        $conexion->close();  ?>
    </div></div> <!-- fin del segundo bloque contenedor -->
    <!-- Add the link to the jQuery and Bootstrap JS files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>