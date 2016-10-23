<?php
$name = html_entity_decode($name);
$pdf = new PDF_MC_Table();
$pdf->AddFont('Arial','','arial.php');
$title = 'DOCUMENTOS LEGALES LOPD: PORTADA';
$pdf->SetTitle($title);
$pdf->SetAuthor('Análisis y gestión de datos S.L.');
$pdf->SetMargins(20,15,20);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Ln(5);

$pdf->SetDrawColor(0, 80, 185);
$pdf->SetFillColor(255, 255, 255);

$pdf->SetFont('Arial','B',38);
$pdf->SetTextColor(0, 80, 185);
$pdf->MultiCell(0,10,strtoupper('documentos'),0,'C');
$pdf->Ln(15);
$pdf->MultiCell(0,10,strtoupper('legales lopd'),0,'C');
$pdf->Ln(20);

/* Customer name */
$pdf->SetFont('Arial','B',24);
$pdf->SetFillColor(255, 255, 255);
$h=30;
if(strlen($name)>25){$h=40;}
$pdf->RoundedRect(25, 70, 160, $h, 0.5, 'DF');
$pdf->MultiCell(0,10,strtoupper('COMUNIDAD DE PROPIETARIOS'),0,'C');
$name = str_replace("o-d","o'd",strtolower($name));
$pdf->MultiCell(0,10,utf8_decode(mb_strtoupper($name)),0,'C');
$pdf->Ln(20);

/* list of contents */
$pdf->SetFont('Arial','',12);
$pdf->SetLeftMargin(20);
$pdf->MultiCell(0,10,utf8_decode('- Contrato de Encargado de Tratamiento con el Administrador de Fincas.'),0,'L');
$pdf->MultiCell(0,10,utf8_decode('- Listado de usuarios con acceso a Ficheros de Datos de la Comunidad.'),0,'L');
$pdf->MultiCell(0,10,utf8_decode('- Cláusula legal para los empleados contratados por la Comunidad.'),0,'L');
$pdf->MultiCell(0,10,utf8_decode('- Ficheros de Datos declarados y resoluciones recibidas de la A.E.P.D.'),0,'L');
$pdf->MultiCell(0,10,utf8_decode('- Impreso de rectificación de Datos de un Propietario / Comunero.'),0,'L');
$pdf->Ln(15);

/* table settings */
$pdf->SetTextColor(0, 0, 0);
$pdf->SetDrawColor(0, 0, 0);

$pdf->SetFont('Arial','B',9);
$pdf->SetWidths(array(62,62,62));
$pdf->SetAligns(array('C','C','C'));
$pdf->SetLeftMargin(15);
$pdf->SetDrawColor(255, 255, 255);
$pdf->Row(array("","",""));
$pdf->SetDrawColor(0, 0, 0);
$pdf->Row(array("SITUACIONES QUE AFECTAN A LA LOPD","DOCUMENTACIÓN AFECTADA","PROCEDIMIENTO A SEGUIR"));
$pdf->SetFont('Arial','',8);
$pdf->Row(array("CAMBIO DE PRESIDENTE DE LA COMUNIDAD","Listado de usuarios con acceso a datos de la Comunidad","Adjuntar acta de cambio de presidente a la documentación LOPD"));
$pdf->Row(array("CONTRATACIÓN DE NUEVO TRABAJADOR","Cláusula legal para empleados de la Comunidad","Debe firmar cláusula legal para empleados. Adjuntar a la documentación LOPD"));
$pdf->Row(array("COLOCACIÓN DE CAMARAS DE SEGURIDAD","Ficheros de datos y resoluciones de la Agencia Española de protección de Datos","Notificar a AGDATA para inscripción del nuevo fichero de Videovigilancia en la AGPD"));
$pdf->Row(array("RECTIFICACIÓN / CAMBIO DE DATOS DE UN PROPIETARIO (p.ej. Cuenta Bancaria)","Impreso de rectificación de datos","Debe rellenar impreso de rectificación de datos. Se archivará en la documentación LOPD"));

$pdf->Output("PORTADA-C.PP-$name.pdf",'I');