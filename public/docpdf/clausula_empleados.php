<?php
require_once('./mc_table.php');

class PDFp extends PDF_MC_Table{
    // Cabecera de página
    function Header(){}
    // Pie de página
    function Footer(){}
}

global $data;
$data = base64_decode(substr($_SERVER['QUERY_STRING'],2,strlen($_SERVER['QUERY_STRING'])));
//$data = base64_decode($_GET['q']);
parse_str($data);
$cliente=json_decode(html_entity_decode(urldecode($cliente_data)),true);
$trab=json_decode(html_entity_decode(urldecode($trab_data)),true);

// Creación del objeto de la clase heredada
$pdf = new PDFp();
$pdf->AddFont('Arial','','arial.php');

$title = 'CLAUSULA LEGAL PARA EMPLEADOS';
$pdf->SetTitle($title);
$pdf->SetAuthor('Análisis y gestión de datos S.L.');
$pdf->SetMargins(20,6,20);
$pdf->AliasNbPages();

$cliente_name = mb_strtoupper(utf8_decode($cliente["nombre"]));

foreach($trab as $t) {
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',12);
    $pdf->MultiCell(0, 10, mb_strtoupper(utf8_decode('Cláusula legal para empleados')), 0, 'C');
    $pdf->Ln(5);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 10, utf8_decode('En Sevilla, a ......... de ................. de ........'), 0, 'C');
    $pdf->Ln(5);
    $pdf->MultiCell(0, 6, mb_strtoupper(utf8_decode($t["nombre"])).utf8_decode(', mayor de edad, con DNI nº '.$t["dni"].', en virtud de la relación de carácter laboral que le vincula a ').$cliente_nombre.utf8_decode(', se obliga a:'), 0, 'J');
    $pdf->Ln(5);
    $pdf->MultiCell(0, 6, utf8_decode('PRIMERO.- Guardar secreto profesional con respecto a los datos de carácter personal a los que tenga acceso por razón de su trabajo, así como guardarlos; obligaciones que se mantendrán aún después del cese de la relación laboral que le vincula a ').$cliente_name.'.', 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('SEGUNDO.- Comunicar a su superior inmediato cualquier incidencia que se produzca en el tratamiento de estos datos.'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('TERCERO.- Seguir las instrucciones de ').$cliente_name.utf8_decode(' en relación a las políticas de protección de datos descritas en el documento de seguridad.'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('CUARTO.- Trasladar al Responsable de Seguridad cualquier comunicación que llegue a ').$cliente_nombre.utf8_decode(', relativa al ejercicio de los derechos de acceso, rectificación, cancelación y oposición por parte de los afectados respecto a sus datos de carácter personal.'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('En caso de incumplimiento de alguna de estas cláusulas, el empleado podrá ser sancionado por incurrir en responsabilidad contractual derivada de la relación laboral que le vincula. Si además, como consecuencia del incumplimiento, la empresa es sancionada como responsable del fichero, ésta podrá pedir daños y perjuicios al empleado que dolosamente haya realizado actos prohibidos en estas cláusulas.'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('Asimismo, y en cumplimiento de lo dispuesto en el artículo 5 de la Ley Orgánica 15/1999, de 13 de diciembre de Protección de Datos de Carácter Personal (LOPD), ').$cliente_name.utf8_decode(', con CIF '.$cliente["cif_nif"].', le informa que sus datos de carácter personal, actualmente en posesión de ').$cliente_name.utf8_decode(', formarán parte de un fichero automatizado del que es titular y único responsable.'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('La finalidad de su creación, existencia y mantenimiento es el tratamiento de los datos con los exclusivos fines de gestionar las relaciones laborales (pago de nóminas, control de asistencia, seguros sociales) que mantiene con ').$cliente_name.'.', 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('Igualmente, queda informado que para alcanzar los fines arriba indicados, sus datos de carácter personal podrán ser cedidos a otras entidades para la prestación de servicios por cuenta de la empresa, cumpliendo en cualquier caso con lo estipulado en la LOPD.'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('El abajo firmante podrá ejercitar los derechos de acceso, rectificación, cancelación y oposición, en el ámbito reconocido por la normativa española en protección de datos, dirigiéndose por escrito a nuestra sede situada en '.$cliente["dir"].', '.$cliente["cp"].', '.$cliente["loc"].', provincia de '.$cliente["prov"].'.'), 0, 'J');
    $pdf->Ln(10);
    $blank = 118-strlen($t["nombre"])-strlen($cliente["nombre"]);
    $pdf->MultiCell(0, 10, utf8_decode($t["nombre"].str_repeat(" ", $blank).$cliente["nombre"]), 0, 'C');
}
// Write all to the output
$pdf->Output("CLAUSULA-EMPLEADOS-".$cliente["nombre"].".pdf",'I');