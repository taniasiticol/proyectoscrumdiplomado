<?php
require_once('../lib/tcpdf/tcpdf.php');

class MYPDF extends TCPDF {
    // Add any custom methods or properties here

    public function Header() {
        // Header content goes here
    }

    public function Footer() {
        // Footer content goes here
    }
}

// Create a new instance of your custom class
$pdf = new MYPDF();
$pdf->setPageOrientation('L');
// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('times', 'N', 12);
ob_start();
// Add content to the PDF
?>
<table width="100%" border="0.1" cellspacing="0" bordercolor="#000000" cellpadding="3"  >
  <tbody>
    <tr>
      <td align="center" colspan="6"><strong>POSTGRADOS<br>FACULTAD DE INGENIERÍA<br>PROGRAMA DE INGENIERÍA DE SISTEMAS<br>ESTUDIANTES REGISTRADOS</strong></td>
    </tr>
  </tbody>
</table>
<br>
<?php

$consulta_sql = "SELECT e.*,c.nombre AS coho,if(pa.id_programa='1','MGTIC',if(pa.id_programa='2','MISC',pa.nombre)) AS programa
FROM estudiantes e
join cohortes c ON c.codigo=e.cohorte
JOIN programa_academico pa ON pa.id_programa=c.progra_vinc";
$consulta_sql .=" ORDER BY e.apellido";

$resultado = $conexion->query($consulta_sql);
if ($resultado->num_rows > 0) { ?>
  <table width="100%" border="0.1" cellspacing="0" bordercolor="#000000" cellpadding="3">
  <thead>
      <tr style="font-weight: bold;">
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
  </theadclass=>
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

<?php
$html=ob_get_clean();
//$pdf->Cell(0, 10, 'Hello, World!', 0, 1, 'C');
$pdf->writeHTML($html, true, false,false,false);
// Output the PDF as a file (optional)
$pdf->Output('../tmp/example.pdf', 'D');
?>
