<?php
// Conéctate a tu base de datos (ajusta las credenciales según tu configuración)

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

// Recibe los datos del formulario
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$direccion = $_POST['direccion'];
$fecha_v = $_POST['fec_vincu'];
$acuerdo = $_POST['acuerdo'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$genero = $_POST['genero'];
$fec_nac = $_POST['fec_nac'];
$prog_vincu = $_POST['prog_vincu'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $directorio_destino = "archivos_subidos/"; // Cambia esto al directorio en tu servidor

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
  //print_r('no paso');exit;
}

// Realiza la inserción en la base de datos (ajusta la consulta según tu esquema de base de datos)
/*INSERT INTO `coordinadores` (`id_cordi`, `nombre`, `apellido`, `direccion`, `telefono`, `correo`, `genero`, `fecha_nac`, `fecha_vin`, `id_programa`, `acuerdo`, `est_usu`, `tip_usu`) 
VALUES ('1085947', 'Oscar', 'Revelo', 'Pasto', '3189999999', 'orevelo@udenar.edu.co', 'm', '1997-12-12', '2012-12-12', 1, 'Prueba tb 1602.pdf', 'a', 2);
*/
$sql = "INSERT INTO coordinadores VALUES ('$id', '$nombre', '$apellido','$direccion','$telefono','$correo','$genero','$fec_nac','$fecha_v','$prog_vincu','$nom_arch','a','2')";

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
