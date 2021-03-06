<?php
$pdf = new PDF_MC_Table();
$pdf->AddFont('Arial','','arial.php');
$title = 'FUNCIONES Y OBLIGACIONES DEL PERSONAL EN MATERIA DE SEGURIDAD DE DATOS PERSONALES';
$pdf->SetTitle(utf8_decode($title));
$pdf->SetAuthor('Análisis y gestión de datos S.L.');
$pdf->SetMargins(20,6,20);
$pdf->AliasNbPages();
$rep_name="XXXXXXXXXXXX";
if($rep["nombre"]!="") {
    $rep_name = html_entity_decode($rep["nombre"]);
}
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0, 10, utf8_decode(mb_strtoupper('FUNCIONES Y OBLIGACIONES DEL PERSONAL')), 0, 'C');
$pdf->MultiCell(0, 10, utf8_decode(mb_strtoupper('EN MATERIA DE SEGURIDAD DE DATOS PERSONALES')), 0, 'C');
$pdf->Ln(5);
$pdf->SetFont('Arial', '', 9);
$pdf->MultiCell(0, 6, utf8_decode('En este documento se recogen las obligaciones que tienen los empleados de '.html_entity_decode($cname).' y las funciones que tienen que desempeñar en relación a su puesto de trabajo y la utilización adecuada de todas las instalaciones y bienes de la empresa.'), 0, 'J');
$pdf->Ln(2);
$pdf->MultiCell(0, 6, utf8_decode('El cumplimiento de la normativa vigente en materia de protección de datos tiene como objetivo primordial, entre otros, implementar las medidas de índole técnicas y organizativas necesarias para garantizar la seguridad que deben reunir tanto los ficheros automatizados como en papel, los centros de tratamiento, locales, equipos, sistemas, programas y personas que intervengan en el tratamiento de los datos de carácter personal.'), 0, 'J');
$pdf->Ln(3);
$pdf->MultiCell(0, 6, utf8_decode('Estas medidas de seguridad son de obligado cumplimiento por todo el personal de la empresa con acceso a datos de carácter personal.'), 0, 'J');
$pdf->Ln(3);
$pdf->MultiCell(0, 6, utf8_decode('A continuación se nombran aquellas medidas que afectan directamente a los empleados de la empresa:'), 0, 'J');
$pdf->Ln(2);
$pdf->MultiCell(0, 6, utf8_decode('- Recursos del sistema de información: Queda terminantemente prohibido utilizar los recursos a los que se tenga acceso para uso privado o para cualquier otra finalidad diferente de la del desempeño de sus funciones. Bajo ningún concepto puede revelarse información a persona alguna ajena a la empresa, sin la debida autorización.'), 0, 'J');
$pdf->Ln(2);
$pdf->MultiCell(0, 6, utf8_decode('- Los sistemas informáticos que dan acceso a los ficheros que contienen datos de carácter personal tendrán siempre este acceso restringido mediante un código de usuario y una contraseña, sin cuya introducción resulte imposible acceder a los datos protegidos.'), 0, 'J');
$pdf->Ln(2);
$pdf->MultiCell(0, 6, utf8_decode('- El código de usuario y la contraseña son absolutamente personales e intransferibles; por ello, los registros que se efectúen sobre operaciones realizadas bajo un código y contraseña se atribuirán, salvo prueba en contrario, al titular de los mismos y quedarán bajo su responsabilidad personal.'), 0, 'J');
$pdf->Ln(2);
$pdf->MultiCell(0, 6, utf8_decode('- Cada usuario es responsable de la confidencialidad de su contraseña, por lo que si advierte o sospecha que la misma ha podido ser conocida fortuita o fraudulentamente por personas no autorizadas, deberá registrarlo como incidencia y notificárselo de inmediato al Responsable de Seguridad, el cual asignará una nueva contraseña al usuario.'), 0, 'J');
$pdf->Ln(2);
$pdf->MultiCell(0, 6, utf8_decode('- Salidas de soportes: Toda salida de cualquier soporte y/o ordenador personal fuera de la organización deberá ser expresamente autorizada por el Responsable de Seguridad de la empresa.'), 0, 'J');
$pdf->Ln(2);
$pdf->MultiCell(0, 6, utf8_decode('- Incidencias en materia de seguridad: El usuario que tenga conocimiento de la incidencia se responsabiliza directa y personalmente de comunicarla al Responsable de Seguridad de la empresa.'), 0, 'J');
$pdf->Ln(2);
$pdf->MultiCell(0, 6, utf8_decode('- Compromiso: Todos los compromisos anteriores deben mantenerse, incluso después de extinguida por cualquier causa la relación laboral con la empresa'), 0, 'J');
$pdf->Ln(2);
$pdf->MultiCell(0, 6, utf8_decode('- Responsabilidad: El incumplimiento por el obligado, de cualquiera de las normas contenidas en el presente documento podrá considerarse como un quebranto de la buena fe contractual. Si el incumplimiento tuviera carácter doloso, se emprenderán las acciones legales correspondientes para la debida depuración de responsabilidades.'), 0, 'J');
$pdf->Ln(2);
$pdf->MultiCell(0, 6, utf8_decode('Cualquier duda o comentario que pudiese suscitar el presente documento puede ser consultada o atendida por la Responsable de Seguridad, '.$rep_name.'.'), 0, 'J');
$pdf->Ln(4);
$pdf->MultiCell(0, 5, utf8_decode('Firma:                                                                                            En ......................, a ........ de .......................... de 20....'), 0, 'C');
$pdf->Ln(7);
$pdf->MultiCell(0, 5, utf8_decode('                       (Trabajador/a)'), 0, 'J');
// Write all to the output
$pdf->Output("FUNCIONES-OBLIGACIONES-".$cname.".pdf",'I');