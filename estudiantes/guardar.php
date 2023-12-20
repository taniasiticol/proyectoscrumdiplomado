<?php
// Conéctate a tu base de datos (ajusta las credenciales según tu configuración)
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

// Recibe los datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$codigo = $_POST['codigo'];
$foto = $_POST['foto'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$genero = $_POST['genero'];
$fec_nac = $_POST['fec_nac'];
$semestre = $_POST['semestre'];
$est_civ = $_POST['est_civ'];
$fec_ing = $_POST['fec_ing'];
$fec_egre = $_POST['fec_egre'];
$cohorte = $_POST['cohorte'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $directorio_destino = "archivos_subidos/"; // Cambia esto al directorio en tu servidor

  // Verifica si se ha subido un archivo
  if (!empty($_FILES["foto"]["name"])) {
      $archivo_destino = $directorio_destino . basename($_FILES["foto"]["name"]);
      //print_r('si paso');exit;
      $nom_arch=basename($_FILES["foto"]["name"]);

      // Mueve el archivo del directorio temporal al destino final
      if (move_uploaded_file($_FILES["foto"]["tmp_name"], $archivo_destino)) {
          echo "El archivo se ha subido correctamente.";
      } else {
          echo "Error al subir el archivo.";
      }
  } else {
      echo "Por favor, selecciona un archivo antes de intentar subirlo.";
  }
  //print_r('no paso');exit;
}

// Realiza la inserción en la base de datos (ajusta la consulta según tu esquema de base de datos)

$sql = "INSERT INTO `estudiantes` (`identificacion`, `codigo_estudiantil`, `nombre`, `apellido`, `fotografia`, `direccion_residencia`, `telefono`, `correo`, `genero`, `fecha_nacimiento`, `semestre`, `estado_civil`, `fecha_ingreso`, `fecha_egreso`, `cohorte`) 
VALUES 
('$codigo', '$codigo', '$nombre','$apellido','$foto', '$direccion', '$telefono', '$correo', '$genero', '$fec_nac', '$semestre', '$est_civ', '$fec_ing', '$fec_egre', '$cohorte')";

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
