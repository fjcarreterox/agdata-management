<?php
//getting params
$c = Model_Cliente::find($idc);
$name=$c->nombre;
$cif=$c->cif_nif;
$dir=$c->direccion.", ".$c->cpostal.", ".$c->loc.", en la provincia de ".$c->prov;
$tratamiento_ops = array("D.","Dª");
if($rep_legal!=null){
    $rep = $tratamiento_ops[$rep_legal->tratamiento].' '.$rep_legal->nombre;
}else {
    $rep = ".............................................................................................";
}
//render the document
$pdf = new PDF_MC_Table();
$pdf->AddFont('Arial','','arial.php');
$title = 'DOCUMENTOS LEGALES LOPD: CLAÚSULA INFORMATIVA EN LA RECEPCIÓN DE CURRICULUMS';
$pdf->SetTitle(utf8_decode($title));
$pdf->SetAuthor('Análisis y gestión de datos S.L.');
$pdf->SetMargins(20,15,20);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Ln(10);
$pdf->SetFont('Arial','BU',15);
$pdf->MultiCell(0,10,utf8_decode(mb_strtoupper('CLAÚSULA INFORMATIVA EN LA RECEPCIÓN DE CURRICULUMS')),0,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','',14);
$pdf->MultiCell(0,6,utf8_decode('[Acusamos recibo de la recepción de su currículum vitae, el cual será tenido en cuenta en futuros procesos de selección de nuestra entidad].'),0,'J');$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('Asimismo, y en cumplimiento de lo dispuesto en la Ley Orgánica 15/1999, de 13 de diciembre de Protección de Datos de Carácter Personal, '.$name.' le informa que los datos de carácter personal proporcionados formarán parte de un fichero automatizado del que es titular y único responsable '.$rep.'.'),0,'J');$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('La finalidad de su creación, existencia y mantenimiento es el tratamiento de los datos con los exclusivos fines de reclutamiento y selección de personal para nuestra consulta.'),0,'J');$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('En todo caso, Ud. (o el abajo firmante) podrá ejercitar los derechos de acceso, rectificación, cancelación y oposición, en el ámbito reconocido por la normativa española en protección de datos, dirigiéndose por escrito a nuestra sede situada en '.$dir.'.'),0,'J');$pdf->Ln(5);
$pdf->Ln(45);
$pdf->MultiCell(0,6,utf8_decode('"SOLICITANTE"                            '.$rep),0,'C');$pdf->Ln(5);
$pdf->Output("Cláusula-recepción-cvs-$name.pdf",'I');