<?php
//getting params
$c = Model_Cliente::find($idc);
$name=$c->nombre;
$cif=$c->cif_nif;
$dir=$c->direccion.", ".$c->cpostal.", ".$c->loc.", en la provincia de ".$c->prov;
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
$pdf->MultiCell(0,6,utf8_decode('Asimismo, y en cumplimiento de lo dispuesto en la Ley Orgánica 3/2018 de Protección de Datos de Carácter Personal y Garantía de Derechos Digitales (LOPDGDD) y en el Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo, relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre circulación de estos datos, '.$name.' le informa que los datos de carácter personal proporcionados formarán parte de un fichero automatizado del que es titular y único responsable '.$name.'.'),0,'J');$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('La finalidad de su creación, existencia y mantenimiento es el tratamiento de los datos con los exclusivos fines de reclutamiento y selección de personal para nuestra entidad y no serán cedidos a terceros sin su consentimiento. La base jurídica que legitima dicho tratamiento es el consentimiento prestado para poder llevar a cabo las finalidades descritas.'),0,'J');$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('En todo caso, el interesado podrá ejercitar en cualquier momento sus derechos de acceso, rectificación o supresión, o la limitación de su tratamiento, o a oponerse al mismo, dirigiéndose por escrito a nuestra sede situada en '.$dir.'.'),0,'J');$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('Finalmente, le recordamos, por imperativo legal, su derecho a presentar una reclamación ante la Agencia Española de Protección de Datos, si considerara que el tratamiento de sus datos no es acorde a la normativa vigente.'),0,'J');$pdf->Ln(5);
$pdf->Ln(45);
$pdf->MultiCell(0,6,utf8_decode('"SOLICITANTE"                            '.$name),0,'C');$pdf->Ln(5);
$pdf->Output("Cláusula-recepción-cvs-$name.pdf",'I');