<?php
//getting params
$c = Model_Cliente::find($idc);
$name=$c->nombre;
$cif=$c->cif_nif;
$dir=$c->direccion.", ".$c->cpostal.", ".$c->loc.", en la provincia de ".$c->prov;
$pdf = new PDF_MC_Table();
$pdf->AddFont('Arial','','arial.php');
$title = 'DOCUMENTOS LEGALES LOPD: CLÁUSULA DE RECOGIDA DE DATOS DE CLIENTES';
$pdf->SetTitle(utf8_decode($title));
$pdf->SetAuthor('Análisis y gestión de datos S.L.');
$pdf->SetMargins(20,15,20);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Ln(10);
$pdf->SetFont('Arial','BU',15);
$pdf->MultiCell(0,10,utf8_decode(mb_strtoupper('cláusula legal en la recogida de datos de clientes')),0,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','',14);
$pdf->MultiCell(0,6,utf8_decode('En cumplimiento de lo dispuesto en el artículo 5 de la Ley Orgánica 15/1999, de 13 de diciembre de Protección de Datos de Carácter Personal, y en el Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo, relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre circulación de estos datos, '.mb_strtoupper($name).', con NIF '.$cif.', le informa que los datos de carácter personal proporcionados formarán parte de un fichero automatizado de la que es titular y único responsable.'),0,'J');$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('La finalidad de su creación, existencia y mantenimiento es el tratamiento de los datos con los exclusivos fines de gestionar los servicios de '.$c->actividad.'. La base jurídica que legitima dicho tratamiento es el consentimiento prestado para poder llevar a cabo la adecuada prestación de los servicios solicitados.'),0,'J');$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('Igualmente, queda informado de que sus datos de carácter personal no serán cedidos a terceros sin su previo consentimiento. Una vez que Ud. cause baja como cliente, mantendremos sus datos durante los plazos legalmente previstos en la normativa.'),0,'J');$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('En todo caso, Ud. podrá ejercitar en cualquier momento sus derechos de acceso, rectificación o supresión, o la limitación de su tratamiento, o a oponerse al mismo, dirigiéndose por escrito a nuestra sede situada en '.$dir.'.'),0,'J');$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('Finalmente, le recordamos, por imperativo legal, su derecho a presentar una reclamación ante la Agencia Española de Protección de Datos, si considerara que el tratamiento de sus datos no es acorde a la normativa vigente.'),0,'J');$pdf->Ln(5);
$pdf->Ln(20);
$pdf->Output("Cláusula-clientes-$name.pdf",'I');