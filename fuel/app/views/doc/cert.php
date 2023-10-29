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
$pdf->MultiCell(0,8,utf8_decode('Cumple actualmente los parámetros de protección de datos establecidos en la Ley Orgánica 3/2018 de Protección de Datos de Carácter Personal y garantía de derechos digitales (LOPDGDD) y en el Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales, una vez implantadas todas las medidas de seguridad técnicas y jurídicas que garantizan su correcto cumplimiento.'),0,'J');
$pdf->Ln(5);
$pdf->MultiCell(0,8,utf8_decode('Para que así conste y surta los efectos oportunos, se expide el presente certificado Nº      , con vigencia de UN AÑO, en'),0,'J');
$pdf->Ln(5);
$pdf->MultiCell(0,8,utf8_decode('                    					Sevilla, a '.date('d',time()).' de '.getMes(date('m',time())).' de '.date('Y',time())),0,'J');
$pdf->Ln(5);
$pdf->SetFont('Futura','',16);
$pdf->MultiCell(0,8,utf8_decode('D. Juan Andrés Carretero García       '),0,'R');

$pdf->Output("CERTIFICADO-LOPD-$name.pdf",'I');
