<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gest&oacute;n de Programas Acad&eacute;micos</title>
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
        <button type="button" class="btn mi-texto" data-toggle="modal" data-target="#myModal"><i class="bi bi-person-fill-add"></i> REGISTRO DE PROGRAMAS ACAD&Eacute;MICOS</button>
    </div>
    <div class="col"></div>
    </div>
    <div class="container">
    <div class="row">
    <div class="col">
    <div class="modal" id="myModal">
        <div class="modal-dialog mi-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title"><strong>Formulario de Registro de Programas Acad&eacute;micos</strong></p>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form action="guardar.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-1">
                                        <label for="codigo" class="form-label">C&oacute;digo</label>
                                        <input type="text" class="form-control" id="codigo" name="codigo" required>
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
                                        <label for="descrip" class="form-label">Descripci&oacute;n</label>
                                        <input type="text" class="form-control" id="descrip" name="descrip" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-1">
                                        <label for="durac" class="form-label">Duraci&oacute;n</label>
                                        <input type="text" class="form-control" id="durac" name="durac" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-1">
                                        <label for="modali" class="form-label">Modalidad</label>
                                        <input type="text" class="form-control" id="modali" name="modali" required>
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
                                        <label for="logo" class="form-label">Logo</label>
                                        <input type="file" class="form-control" id="logo" name="logo" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-1">
                                        <label for="val_insc" class="form-label">Valor Inscripci&oacute;n</label>
                                        <input type="text" class="form-control" id="val_insc" name="val_insc" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-1">
                                        <label for="cost_sem" class="form-label">Costo Semestre</label>
                                        <input type="text" class="form-control" id="cost_sem" name="cost_sem" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-1">
                                        <label for="linea" class="form-label">Lineas de Trabajo</label>
                                        <input type="text" class="form-control" id="linea" name="linea" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-1">
                                        <label for="fec_res" class="form-label">Fecha de Resoluci&oacute;n</label>
                                        <input type="date" class="form-control" id="fec_res" name="fec_res" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-1">
                                        <label for="num_res" class="form-label">N&uacute;mero de Resoluci&oacute;n</label>
                                        <input type="text" class="form-control" id="num_res" name="num_res" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-1">
                                        <label for="acuerdo" class="form-label">Archivo de Resoluci&oacute;n</label>
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
    <div class="container mt-5">
        <h2 align="center">Informaci&oacute;n de Programas Acad&eacute;micos</h2>
        <?php
            
            $consulta_sql = "SELECT * FROM programa_academico"; // Reemplaza con tu consulta SQL
            $resultado = $conexion->query($consulta_sql);
            if ($resultado->num_rows > 0) { ?>
                <table class="table">
                <thead class="mi-th">
                    <tr>
                        <th>C&oacute;digo SNIES</th>
                        <th>Nombre</th>
                        <th>Modalidad</th>
                        <th>Correo</th>
                        <th>Resoluci&oacute;n</th>
                        <th>Archivo de Resoluci&oacute;n</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($fila = $resultado->fetch_assoc()) { ?>
                    <tr>
                        <td><?php print_r($fila['codigo'] ); ?></td>
                        <td><?php print_r($fila['nombre'] ); ?></td>
                        <td><?php print_r($fila['modalidad'] ); ?></td>
                        <td><?php print_r($fila['correo'] ); ?></td>
                        <td>Resolución N° <?php print_r($fila['num_resol_rc'] ); ?> de <?php $fecha=$fila['fecha_resol_rc'];print_r(date('F \d\e Y', strtotime($fecha))); ?> del MEN</td>
                        <td>
                            <a href="../programas/archivos_subidos/<?php echo $fila['arch_resol_rc'];?>" download="<?php echo $fila['arch_resol_rc'];?>">
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
    </div>
    </div>
    </div></div></div> <!-- fin del segundo bloque contenedor -->
    <!-- Add the link to the jQuery and Bootstrap JS files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>