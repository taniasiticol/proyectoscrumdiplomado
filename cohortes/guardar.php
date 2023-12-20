<?php
// Conéctate a tu base de datos (ajusta las credenciales según tu configuración)


$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

// Recibe los datos del formulario

$nombre = $_POST['nombre'];
$fec_ini = $_POST['fec_ini'];
$fec_fin = $_POST['fec_fin'];
$num_estu = $_POST['num_estu'];
$prog_vincu = $_POST['prog_vincu'];
//print_r($nombre);exit;

$sql = "INSERT INTO `cohortes` (`nombre`, `fecha_inicio`, `fecha_finalizacion`, `numero_estudiantes`,`progra_vinc`) VALUES ('$nombre', '$fec_ini', '$fec_fin', '$num_estu','$prog_vincu')";
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
