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
      <td align="center" colspan="6"><strong>POSTGRADOS<br>FACULTAD DE INGENIERÍA<br>PROGRAMA DE INGENIERÍA DE SISTEMAS<br>COORDINADORES REGISTRADOS</strong></td>
    </tr>
  </tbody>
</table>
<br>
<?php

$consulta_sql = "SELECT c.*,pa.nombre AS programa
                FROM coordinadores c
                JOIN programa_academico pa ON pa.id_programa=c.id_programa"; // Reemplaza con tu consulta SQL
            $resultado = $conexion->query($consulta_sql);
            if ($resultado->num_rows > 0) { ?>
                <table width="100%" border="0.1" cellspacing="0" bordercolor="#000000" cellpadding="3">
                <thead>
                    <tr style="font-weight: bold;">
                        <th width="10%">Identificaci&oacute;n</th>
                        <th width="15%">Nombre</th>
                        <th width="10%">Direcci&oacute;n</th>
                        <th width="10%">Telefono</th>
                        <th width="10%">Correo</th>
                        <th width="10%">Genero</th>
                        <th width="10%">Fecha de Nacimiento</th>
                        <th width="10%">Fecha de Vinculaci&oacute;n</th>
                        <th width="15%">Programa</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php while ($fila = $resultado->fetch_assoc()) { ?>
                    <tr>
                        <td width="10%"><?php print_r($fila['id_cordi'] ); ?></td>
                        <td width="15%"><?php print_r($fila['nombre'].' '.$fila['apellido'] ); ?></td>
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
