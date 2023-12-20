<?php
// Conéctate a tu base de datos (ajusta las credenciales según tu configuración)

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

// Recibe los datos del formulario
$codigo = $_POST['codigo'];
$nombre = $_POST['nombre'];
$descrip = $_POST['descrip'];
$durac = $_POST['durac'];
$modalidad = $_POST['modali'];
$val_insc = $_POST['val_insc'];
$cost_sem = $_POST['cost_sem'];
$correo = $_POST['correo'];
$linea = $_POST['linea'];
$fec_res = $_POST['fec_res'];
$num_res = $_POST['num_res'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $directorio_destino = "archivos_subidos/"; // Cambia esto al directorio en tu servidor
  $directorio_logo = "logos/";

  // Verifica si se ha subido un archivo
  if (!empty($_FILES["acuerdo"]["name"])) {
      $archivo_destino = $directorio_destino . basename($_FILES["acuerdo"]["name"]);
      //print_r('si paso');exit;
      $nom_arch=basename($_FILES["acuerdo"]["name"]);

      // Mueve el archivo del directorio temporal al destino final
      if (move_uploaded_file($_FILES["acuerdo"]["tmp_name"], $archivo_destino)) {
          echo "El archivo se ha subido correctamente.";
      } else {
          echo "Error al subir el archivo.";
      }
  } else {
      echo "Por favor, selecciona un archivo antes de intentar subirlo.";
  }
  if (!empty($_FILES["logo"]["name"])) {
    $archivo_destino = $directorio_logo . basename($_FILES["logo"]["name"]);
    //print_r('si paso');exit;
    $nom_arch_logo=basename($_FILES["logo"]["name"]);

    // Mueve el archivo del directorio temporal al destino final
    if (move_uploaded_file($_FILES["logo"]["tmp_name"], $archivo_destino)) {
        echo "El archivo se ha subido correctamente.";
    } else {
        echo "Error al subir el archivo.";
    }
  } else {
      echo "Por favor, selecciona un archivo antes de intentar subirlo.";
  }
  //print_r('no paso');exit;
}

$sql = "INSERT INTO programa_academico 
(`codigo`, `nombre`, `descripcion`, `duracion`, `modalidad`, `logo`, `valor_inscr`, `costo_matr_semes`, `correo`, `lineas_trabajo`, `fecha_resol_rc`, `num_resol_rc`, `arch_resol_rc`)
VALUES ('$codigo', '$nombre', '$descrip','$durac','$modalidad','$nom_arch_logo','$val_insc','$cost_sem','$correo','$linea','$fec_res','$num_res','$nom_arch')";
//print_r($sql);exit;
if ($conn->query($sql) === TRUE) {
  echo "Datos guardados en la base de datos";
} else {
  echo "Error al guardar los datos: " . $conn->error;
}

// Cierra la conexión
$conn->close();
header("Location: {$_SERVER['HTTP_REFERER']}");
exit();
?>
