<?php
require_once('./mc_table.php');

class PDFp extends FPDF
{
    // Cabecera de página
    function Header(){}

    // Pie de página
    function Footer(){
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,utf8_decode('Página '.$this->PageNo().' de {nb}'),0,0,'C');
    }
}

global $data;
//$data = base64_decode(substr($_SERVER['QUERY_STRING'],2,strlen($_SERVER['QUERY_STRING'])));
$data = urldecode(base64_decode($_GET['q']));
parse_str($data);

// Creación del objeto de la clase heredada
$pdf = new PDF_MC_Table();

$pdf->AddFont('Arial','','arial.php');

$title = 'DOCUMENTOS LEGALES LOPD: CLÁUSULA DE RECOGIDA DE DATOS DE PROVEEDORES';
$pdf->SetTitle(utf8_decode($title));
$pdf->SetAuthor('Análisis y gestión de datos S.L.');
$pdf->SetMargins(20,15,20);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Ln(5);

$pdf->SetDrawColor(0, 80, 185);
$pdf->SetFillColor(255, 255, 255);
//$pdf->RoundedRect(25, 12, 160, 50, 0.5, 'DF');

$pdf->SetFont('Arial','BU',15);
//$pdf->SetTextColor(0, 80, 185);
$pdf->MultiCell(0,10,mb_strtoupper(utf8_decode('cláusula para la recogida de datos de proveedores')),0,'C');
$pdf->Ln(10);

$pdf->SetFont('Arial','',14);
$pdf->MultiCell(0,6,utf8_decode('En cumplimiento de lo dispuesto en el artículo 5 de la Ley Orgánica 15/1999, de 13 de diciembre de Protección de Datos de Carácter Personal, ').mb_strtoupper(utf8_decode($nombre)).utf8_decode(', con CIF '.$cif.', le informa que los datos de carácter personal proporcionados formarán parte de un fichero automatizado del que es titular y único responsable.'),0,'J');$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('La finalidad de su creación, existencia y mantenimiento es el tratamiento de los datos con los exclusivos fines de gestionar las relaciones comerciales que mantienen con nuestra empresa.'),0,'J');$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('En todo caso, Ud. podrá ejercitar los derechos de acceso, rectificación, cancelación y oposición, en el ámbito reconocido por la normativa española en protección de datos, dirigiéndose por escrito a nuestra sede situada en '.$dir.'.'),0,'J');$pdf->Ln(5);
$pdf->Ln(20);

$pdf->Output("Cláusula-proveedores-$nombre.pdf",'I');