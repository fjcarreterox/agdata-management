<?php
$pdf = new PDF_MC_Table();
$pdf->AddFont('Arial','','arial.php');
$title = 'CLAÚSULA LEGAL PARA EMPLEADOS';
$pdf->SetTitle(utf8_decode($title));
$pdf->SetAuthor('Análisis y gestión de datos S.L.');
$pdf->SetMargins(20,6,20);
$pdf->AliasNbPages();
//getting customer data
$c = Model_Cliente::find($idc);
$cname=$c->nombre;
$cif=$c->cif_nif;
$dir=$c->direccion.", ".$c->cpostal.", ".$c->loc.", en la provincia de ".$c->prov;

foreach($rep as $r) {
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',12);
    $pdf->MultiCell(0, 10, utf8_decode(mb_strtoupper('Cláusula legal para empleados')), 0, 'C');
    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 9);
    $pdf->MultiCell(0, 10, utf8_decode('En Sevilla, a ......... de ................. de ........'), 0, 'C');
    $pdf->Ln(5);
    $pdf->MultiCell(0, 6, utf8_decode(mb_strtoupper(html_entity_decode($r["nombre"]))).utf8_decode(', mayor de edad, con DNI nº '.$r["dni"].', en virtud de la relación de carácter laboral que le vincula a '.$cname.', se obliga a:'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('PRIMERO.- Guardar secreto profesional con respecto a los datos de carácter personal a los que tenga acceso por razón de su trabajo, así como guardarlos; obligaciones que se mantendrán aún después del cese de la relación laboral que le vincula a '.$cname.'.'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('SEGUNDO.- Comunicar a su superior inmediato cualquier incidencia que se produzca en el tratamiento de estos datos.'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('TERCERO.- Seguir las instrucciones de '.$cname.' en relación a las políticas de protección de datos descritas en el documento de seguridad.'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('CUARTO.- Trasladar al Responsable de Seguridad cualquier comunicación que llegue a '.$cname.', relativa al ejercicio de los derechos de acceso, rectificación, cancelación y oposición por parte de los afectados respecto a sus datos de carácter personal.'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('En caso de incumplimiento de alguna de estas cláusulas, el empleado podrá ser sancionado por incurrir en responsabilidad contractual derivada de la relación laboral que le vincula. Si además, como consecuencia del incumplimiento, la empresa es sancionada como responsable del fichero, ésta podrá pedir daños y perjuicios al empleado que dolosamente haya realizado actos prohibidos en estas cláusulas.'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('Asimismo, en cumplimiento de lo dispuesto en la Ley Orgánica 3/2018 de Protección de Datos de Carácter Personal y Garantía de Derechos Digitales (LOPDGDD) y en el Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo, relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre circulación de estos datos, '.$cname.', con CIF '.$cif.', le informa que los datos de carácter personal que nos ha facilitado formarán parte de un fichero automatizado del que es titular y único responsable '.$cname.'.'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('La finalidad de su creación, existencia y mantenimiento es el tratamiento de los datos con los exclusivos fines de gestionar las relaciones laborales (pago de nóminas, control de asistencia, seguros sociales) que mantiene con '.$cname.'. La base jurídica que legitima dicho tratamiento es el contrato de carácter laboral que le vincula a nuestra entidad.'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('Igualmente, queda informado que para alcanzar los fines arriba indicados, sus datos de carácter personal podrán ser cedidos a otras entidades para la prestación de servicios por cuenta de la empresa, cumpliendo en cualquier caso con lo estipulado en la normativa vigente de protección de datos..'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('En todo caso, Ud. podrá ejercitar en cualquier momento sus derechos de acceso, rectificación o supresión, o la limitación de su tratamiento, o a oponerse al mismo, dirigiéndose por escrito a nuestra sede situada en  '.$dir.'.'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('Finalmente, le recordamos, por imperativo legal, su derecho a presentar una reclamación ante la Agencia Española de Protección de Datos, si considerara que el tratamiento de sus datos no es acorde a la normativa vigente.'), 0, 'J');
    $pdf->Ln(5);
    $blank = 118-strlen($r["nombre"])-strlen($cname);
    $pdf->MultiCell(0, 5, utf8_decode(html_entity_decode($r["nombre"]).str_repeat(" ", $blank).$cname), 0, 'C');
}

foreach($trab as $t) {
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',12);
    $pdf->MultiCell(0, 10, utf8_decode(mb_strtoupper('Cláusula legal para empleados')), 0, 'C');
    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 9);
    $pdf->MultiCell(0, 10, utf8_decode('En Sevilla, a ......... de ................. de ........'), 0, 'C');
    $pdf->Ln(5);
    $pdf->MultiCell(0, 6, utf8_decode(mb_strtoupper(html_entity_decode($t["nombre"]))).utf8_decode(', mayor de edad, con DNI nº '.$t["dni"].', en virtud de la relación de carácter laboral que le vincula a '.$cname.', se obliga a:'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('PRIMERO.- Guardar secreto profesional con respecto a los datos de carácter personal a los que tenga acceso por razón de su trabajo, así como guardarlos; obligaciones que se mantendrán aún después del cese de la relación laboral que le vincula a '.$cname.'.'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('SEGUNDO.- Comunicar a su superior inmediato cualquier incidencia que se produzca en el tratamiento de estos datos.'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('TERCERO.- Seguir las instrucciones de '.$cname.' en relación a las políticas de protección de datos descritas en el documento de seguridad.'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('CUARTO.- Trasladar al Responsable de Seguridad cualquier comunicación que llegue a '.$cname.', relativa al ejercicio de los derechos de acceso, rectificación, cancelación y oposición por parte de los afectados respecto a sus datos de carácter personal.'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('En caso de incumplimiento de alguna de estas cláusulas, el empleado podrá ser sancionado por incurrir en responsabilidad contractual derivada de la relación laboral que le vincula. Si además, como consecuencia del incumplimiento, la empresa es sancionada como responsable del fichero, ésta podrá pedir daños y perjuicios al empleado que dolosamente haya realizado actos prohibidos en estas cláusulas.'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('Asimismo, en cumplimiento de lo dispuesto en la Ley Orgánica 3/2018 de Protección de Datos de Carácter Personal y Garantía de Derechos Digitales (LOPDGDD) y en el Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo, relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre circulación de estos datos, '.$cname.', con CIF '.$cif.', le informa que los datos de carácter personal que nos ha facilitado formarán parte de un fichero automatizado del que es titular y único responsable '.$cname.'.'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('La finalidad de su creación, existencia y mantenimiento es el tratamiento de los datos con los exclusivos fines de gestionar las relaciones laborales (pago de nóminas, control de asistencia, seguros sociales) que mantiene con '.$cname.'. La base jurídica que legitima dicho tratamiento es el contrato de carácter laboral que le vincula a nuestra entidad.'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('Igualmente, queda informado que para alcanzar los fines arriba indicados, sus datos de carácter personal podrán ser cedidos a otras entidades para la prestación de servicios por cuenta de la empresa, cumpliendo en cualquier caso con lo estipulado en la normativa vigente de protección de datos..'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('En todo caso, Ud. podrá ejercitar en cualquier momento sus derechos de acceso, rectificación o supresión, o la limitación de su tratamiento, o a oponerse al mismo, dirigiéndose por escrito a nuestra sede situada en  '.$dir.'.'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('Finalmente, le recordamos, por imperativo legal, su derecho a presentar una reclamación ante la Agencia Española de Protección de Datos, si considerara que el tratamiento de sus datos no es acorde a la normativa vigente.'), 0, 'J');
    $pdf->Ln(15);
    $blank = 118-strlen($t["nombre"])-strlen($cname);
    $pdf->MultiCell(0, 6, utf8_decode(html_entity_decode($t["nombre"]).str_repeat(" ", $blank).$cname), 0, 'C');
}
// Write all to the output
$pdf->Output("CLAUSULA-EMPLEADOS-".$cname.".pdf",'I');