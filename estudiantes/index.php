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
    <title>Gest&oacute;n de Estudiantes</title>
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
            <button type="button" class="btn mi-texto" data-toggle="modal" data-target="#myModal"><i class="bi bi-person-fill-add"></i> REGISTRO DE ESTUDIANTES</button>
        </div>
        <div class="col"></div>
    </div>
    <?php } ?>
    <br>
    <div class="row">
        <div class="col">
        <form method="post">
            <label for="opciones">Filtro de Busqueda por Cohorte:</label>
            <select id="opciones" class="form-control" name="opciones" onchange="this.form.submit()">
            <option selected value="%">Seleccionar una opci&oacute;n</option>
            <?php 
            $consulta_pa = "SELECT c.*, if(pa.id_programa='1','MGTIC',if(pa.id_programa='2','MISC',pa.nombre)) AS programa
            from cohortes c
            JOIN programa_academico pa ON pa.id_programa=c.progra_vinc
            ORDER BY c.codigo";
            $rpa = $conexion->query($consulta_pa);
            if ($rpa->num_rows > 0) {
                while ($fil = $rpa->fetch_assoc()) { ?>
                    <option value="<?php echo $fil['codigo'] ?>"><?php echo $fil['nombre'].' - '.$fil['programa']; ?></option>
                <?php }
            } else {
                echo 'No hay programas academicos.';
            }
            ?>
            </select>
        </form>
      </div>
      <div class="col">
        <label>Descargar Plantilla de Estudiantes:</label>
        <a href="pdf.php">
        <i class="bi bi-file-earmark-pdf-fill mi-down" style="font-size: 30px;"></i></a>
      </div>
    </div>
    <div class="row">
    <div class="col">
        <div class="modal" id="myModal">
            <div class="modal-dialog mi-modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title"><strong>Formulario de Registro de Estudiantes</strong></p>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <form action="guardar.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-1">
                                            <label for="codigo" class="form-label">Identificaci&oacute;n</label>
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
                                            <label for="fec_nac" class="form-label">Fecha de Nacimiento</label>
                                            <input type="date" class="form-control" id="fec_nac" name="fec_nac" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col">
                                        <div class="mb-1">
                                            <label for="telefono" class="form-label">Telefono</label>
                                            <input type="text" class="form-control" id="telefono" name="telefono" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-1">
                                            <label for="correo" class="form-label">Correo</label>
                                            <input type="email" class="form-control" id="correo" name="correo" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-1">
                                            <label for="semestre" class="form-label">Semestre</label>
                                            <input type="nnumber" class="form-control" id="semestre" name="semestre" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-1">
                                            <label for="foto" class="form-label">Foto</label>
                                            <input type="file" class="form-control" id="foto" name="foto" required>
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
                                            <label for="est_civ" class="form-label">Estado Civil</label>
                                            <select id="est_civ" name="est_civ"class="form-select" aria-label="Default select example">
                                            <option selected>Seleccionar una opci&oacute;n</option>
                                            <option value="soltero">Soltero</option>
                                            <option value="casado">Casado</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-1">
                                            <label for="fec_ing" class="form-label">Fecha de Ingreso</label>
                                            <input type="date" class="form-control" id="fec_ing" name="fec_ing" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-1">
                                            <label for="fec_egre" class="form-label">Fecha de Egreso</label>
                                            <input type="date" class="form-control" id="fec_egre" name="fec_egre" required>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-1">
                                            <label for="cohorte" class="form-label">Programa de Vinculaci&oacute;n</label>
                                            <select id="cohorte" name="cohorte"class="form-select" aria-label="Default select example">
                                            <option selected>Seleccionar una opci&oacute;n</option>
                                            <?php 
                                                $consulta_pa = "SELECT c.*, if(pa.id_programa='1','MGTIC',if(pa.id_programa='2','MISC',pa.nombre)) AS programa
                                                from cohortes c
                                                JOIN programa_academico pa ON pa.id_programa=c.progra_vinc
                                                ORDER BY c.codigo";
                                                $rpa = $conexion->query($consulta_pa);
                                                if ($rpa->num_rows > 0) {
                                                    while ($fil = $rpa->fetch_assoc()) { ?>
                                                        <option value="<?php echo $fil['codigo'] ?>"><?php echo $fil['nombre'].' - '.$fil['programa']; ?></option>
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
    </div></div>
    <div class="row">
    <div class="col">
    <div class="container mt-5" id="resultado">
        <h2 align="center">Informaci&oacute;n de Estudiantes</h2>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $selected_option = $_POST['opciones'];
            }
            $consulta_sql = "SELECT e.*,c.nombre AS coho,if(pa.id_programa='1','MGTIC',if(pa.id_programa='2','MISC',pa.nombre)) AS programa
            FROM estudiantes e
            join cohortes c ON c.codigo=e.cohorte
            JOIN programa_academico pa ON pa.id_programa=c.progra_vinc";
            if ($selected_option!='') {
                $consulta_sql .=" WHERE e.cohorte='$selected_option'";    
            }
            $consulta_sql .=" ORDER BY e.apellido";
            //print_r($consulta_sql);exit;

            $resultado = $conexion->query($consulta_sql);
            if ($resultado->num_rows > 0) { ?>
                <table class="table">
                <thead class="mi-th">
                    <tr>
                        <th>C&oacute;digo</th>
                        <th>Nombre</th>
                        <th>Direcci&oacute;n</th>
                        <th>Telefono</th>
                        <th>Correo</th>
                        <th>Genero</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Semestre</th>
                        <th>Estado Civil</th>
                        <th>Fecha de Ingreso</th>
                        <th>Fecha de Egreso</th>
                        <th>Cohorte</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($fila = $resultado->fetch_assoc()) { ?>
                    <tr>
                        <td><?php print_r($fila['codigo_estudiantil'] ); ?></td>
                        <td><?php print_r($fila['apellido'].' '.$fila['nombre'] ); ?></td>
                        <td><?php print_r($fila['direccion_residencia'] ); ?></td>
                        <td><?php print_r($fila['telefono'] ); ?></td>
                        <td><?php print_r($fila['correo'] ); ?></td>
                        <td><?php print_r($fila['genero'] ); ?></td>
                        <td><?php print_r($fila['fecha_nacimiento'] ); ?></td>
                        <td><?php print_r($fila['semestre'] ); ?></td>
                        <td><?php print_r($fila['estado_civil'] ); ?></td>
                        <td><?php $fecha=$fila['fecha_ingreso'];print_r(date('F \d\e Y', strtotime($fecha))); ?></td>
                        <td><?php $fecha=$fila['fecha_egreso'];print_r(date('F \d\e Y', strtotime($fecha))); ?></td>
                        <td><?php print_r($fila['coho'].' - '.$fila['programa']); ?></td>
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
    </div> <!-- fin del segundo bloque contenedor -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoJtKh7z7lGz7fuP4F8nfdFvAOA6Gg/z6Y5J6XqqyGXYM2ntX88ujKNR/2NX8" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0v8FqFjcJ6pajs/rfdfs3SO+kD4Ck5BdPtF+to8xMp9MvcJ4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>