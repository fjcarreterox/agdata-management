<?php
$name = html_entity_decode($name);
$pdf = new PDF_MC_Table('L');
$pdf->AddFont('Futura','','ufonts.com_futura-book.php');
$title = 'DOCUMENTOS LEGALES LOPD: CERTIFICADO';
$pdf->SetTitle($title);
$pdf->SetAuthor('Análisis y gestión de datos S.L.');
$pdf->SetMargins(20,15,20);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Image('http://gestion.agdata.es/assets/img/barras_cert1.png',20,13,250);
$pdf->Image('http://gestion.agdata.es/assets/img/logo_cert.png',120,25,70);
$pdf->Image('http://gestion.agdata.es/assets/img/banner_cert.png',20,170,130);
$pdf->Image('http://gestion.agdata.es/assets/img/barras_cert2.png',20,193,250);
$pdf->Ln(45);
$pdf->SetFont('Futura','',18);
$pdf->MultiCell(0,10,utf8_decode(mb_strtoupper('análisis y gestión de datos s.l. certifica que:')),0,'C');
$pdf->Ln(10);
$pdf->SetFont('Futura','',28);
$pos = strpos($name,"o-d");
if($pos !== false){
	$name = str_replace("o-d","O'd",strtolower($name));
}
$pdf->MultiCell(0,10,utf8_decode(mb_strtoupper($name)),0,'C');
$pdf->Ln(10);
$pdf->SetFont('Futura','',14);
$pdf->MultiCell(0,8,utf8_decode('Ha superado favorablemente la auditoría de adaptación a la Ley Orgánica 15/1999 de Protección de Datos de carácter personal realizada por Análisis y Gestión de Datos S.L., quedando a disposición de la Agencia Española de Protección de Datos.'),0,'J');
$pdf->Ln(5);
$pdf->MultiCell(0,8,utf8_decode('Asímismo certifica el continuo cumplimiento de las disposiciones legales vigentes en materia de protección de datos, como consecuencia de los servicios de mantenimiento LOPD que se han contratado con esta empresa.'),0,'J');
$pdf->Ln(5);
$pdf->MultiCell(0,8,utf8_decode('Para que así conste, y surta los efectos oportunos, se expide el presente certificado en'),0,'J');
$pdf->Ln(5);
$pdf->MultiCell(0,8,utf8_decode('                    Sevilla, a '.date('d',time()).' de '.getMes(date('m',time())).' de '.date('Y',time())),0,'J');
$pdf->Ln(10);
$pdf->SetFont('Futura','',18);
$pdf->MultiCell(0,8,utf8_decode('D. Miguel Ángel Chávez López       '),0,'R');

$pdf->Output("CERTIFICADO-$name.pdf",'I');
