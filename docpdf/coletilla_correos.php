<?php
require_once('./mc_table.php');
/* Esta documentación sólo hay que generarla para las COMUNIDADES DE PROPIETARIOS */

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

$title = 'DOCUMENTOS LEGALES LOPD: COLETILLA E-MAIL';
$pdf->SetTitle($title);
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
$pdf->MultiCell(0,10,strtoupper('coletilla para e-mails'),0,'C');
$pdf->Ln(15);

$pdf->SetFont('Arial','',11);
$pdf->MultiCell(0,10,'***************************************************************************************************************',0,'J');
$pdf->MultiCell(0,6,utf8_decode('Este mensaje de correo  electrónico y sus documentos adjuntos están dirigidos exclusivamente a los destinatarios especificados. La información contenida puede ser confidencial y/o estar legalmente protegida. Si usted recibe este mensaje por error, por favor comuníqueselo inmediatamente al remitente y elimínelo ya que usted no está autorizado al uso, revelación, distribución, impresión o copia de toda o alguna parte de la información contenida. Gracias.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('This e-mail message and any attached files are intended solely for the address/es identified herein. It may contain confidential and/or legally privileged information. If you receive this message in error, please immediately notify the sender and delete it since you are not authorized to use, disclose, distribute, print or copy all or part of the contained information. Thank you.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Asimismo, le informamos de que los datos personales que puede incluir en este e-mail o sus documentos anexos pueden estar incluidos en un fichero automatizado, responsabilidad de '.$nombre),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Usted puede ejercitar los derechos de acceso, rectificación, cancelación y oposición en el ámbito reconocido por la normativa española en protección de datos, dirigiéndose por escrito a nuestra sede situada en '.$dir.'.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Si Ud. incluyese datos de carácter personal referentes a terceras personas deberá, con carácter previo a su inclusión, obtener el consentimiento de estos terceros, en su caso, e informarles de los extremos descritos anteriormente.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,10,'***************************************************************************************************************',0,'J');
$pdf->Ln(20);

$pdf->Output("Coletilla-emails-$nombre.pdf",'I');