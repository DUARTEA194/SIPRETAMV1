<?php
//$id_venta = (empty($_GET['sale'])) ? null : $_GET['sale'];    
//if ($id_venta != null) {
require_once '../../config.php';
require_once '../../models/reporte.php';
$ventas = new Reporte();
//$datos = $ventas->getConfiguracion();
//$result = $ventas->getSale($id_venta);
//$products = $ventas->getProductsVenta($id_venta);
$Usuarios = $ventas->ObtenerUsuarios();

require('../fpdf/fpdf.php');
/*
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(60, 10, $datos['nombre'], 0, 1, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(60, 5, utf8_decode('Telefono: ' . $datos['telefono']), 0, 1, 'C');
$pdf->Cell(60, 5, 'Correo: ' . $datos['email'], 0, 1, 'C');
$pdf->Cell(60, 5, utf8_decode('Dirección: ' . $datos['direccion']), 0, 1, 'C');

$pdf->Cell(60, 5, '===============================', 0, 1, 'C');
//########## Datos del cliente
$pdf->Cell(60, 5, utf8_decode('Nombre: ' . $result['nombre']), 0, 1, 'C');
$pdf->Cell(60, 5, utf8_decode('Telefono: ' . $result['telefono']), 0, 1, 'C');
$pdf->Cell(60, 5, utf8_decode('Dirección: ' . $result['direccion']), 0, 1, 'C');


$pdf->Cell(60, 5, '===============================', 0, 1, 'C');
foreach ($Usuarios as $atributo => $valor) {
    $pdf->Cell(40,7,$atributo,1);
}
foreach ($Usuarios as $Usuario) {
    $pdf->Cell(40, 7, $Usuario['nombre'] . $Usuario['ApellidoPaterno'] . $Usuario['ApellidoMaterno'], 1, 'C');

}



$pdf->Output();
//} else {
  //  echo 'PAGINA NO ENCONTRADA';
//}*/
// Obtén los registros de la base de datos y almacénalos en una variable, por ejemplo, $registros


class CustomPDF extends FPDF {
  // Define el encabezado de la página
  function Header() {
    // Implementa el encabezado si es necesario
  }

  // Define el pie de página de la página
  function Footer() {
    // Implementa el pie de página si es necesario
  }

  // Crea la función para generar la tabla
  function GenerateTable($header, $data) {
    // Establece la fuente y el tamaño del texto
    $this->SetFont('Arial', 'B', 12);

    // Crea la fila de encabezado de la tabla
    foreach ($header as $column) {
      $this->Cell(40, 10, $column, 1);
    }
    $this->Ln();

    // Establece la fuente y el tamaño del texto para los datos
    $this->SetFont('Arial', '', 12);

    // Crea las filas de datos de la tabla
    foreach ($data as $row) {
      foreach ($row as $column) {
        $this->Cell(40, 10, $column, 1);
      }
      $this->Ln();
    }
  }
}

// Crea una instancia de CustomPDF
$pdf = new CustomPDF();

// Define los encabezados de la tabla
$header = array('id', 'nombre', 'correo', 'status', 'ApellidoPaterno', 'ApellidoMAterno', 'NoCuenta', 'Semestre', 'Licenciatura','Dependencia','RolUsuario');

// Genera la tabla con los registros de la base de datos
$pdf->GenerateTable($header, $Usuarios);

// Genera el archivo PDF
$pdf->Output();
