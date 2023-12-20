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
      <td align="center" colspan="6"><strong>POSTGRADOS<br>FACULTAD DE INGENIERÍA<br>PROGRAMA DE INGENIERÍA DE SISTEMAS<br>DOCENTES REGISTRADOS</strong></td>
    </tr>
  </tbody>
</table>
<br>
<?php

$consulta_sql = "SELECT d.*,c.nombre AS coho,if(pa.id_programa='1','MGTIC',if(pa.id_programa='2','MISC',pa.nombre)) AS programa
            FROM docentes d
            join cohortes c ON c.codigo=d.cohorte
            JOIN programa_academico pa ON pa.id_programa=c.progra_vinc
            ORDER BY d.apellido"; // Reemplaza con tu consulta SQL
            $resultado = $conexion->query($consulta_sql);
            if ($resultado->num_rows > 0) { ?>
                <table width="100%" border="0.1" cellspacing="0" bordercolor="#000000" cellpadding="3" >
                <thead>
                    <tr style="font-weight: bold;">
                        <th>Identificaci&oacute;n</th>
                        <th>Nombre</th>
                        <th>Direcci&oacute;n</th>
                        <th>Telefono</th>
                        <th>Correo</th>
                        <th>Genero</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Formaci&oacute;n Academica</th>
                        <th>&Aacute;reas de Conocimiento</th>
                        <th>Programa de Vinculaci&oacute;n</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($fila = $resultado->fetch_assoc()) { ?>
                    <tr>
                        <td><?php print_r($fila['identificacion'] ); ?></td>
                        <td><?php print_r($fila['apellido'].' '.$fila['nombre'] ); ?></td>
                        <td><?php print_r($fila['direccion'] ); ?></td>
                        <td><?php print_r($fila['telefono'] ); ?></td>
                        <td><?php print_r($fila['correo'] ); ?></td>
                        <td><?php print_r($fila['genero'] ); ?></td>
                        <td><?php print_r($fila['fecha_nacimiento'] ); ?></td>
                        <td><?php print_r($fila['formacion_academica'] ); ?></td>
                        <td><?php print_r($fila['areas_conocimiento'] ); ?></td>
                        <td><?php print_r($fila['coho'].' - '.$fila['programa'] ); ?></td>
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
