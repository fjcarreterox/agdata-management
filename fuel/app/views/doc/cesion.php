<?php
define('EURO', chr(128) );
$pdf = new \Fuel\Core\FPDF();

$cname = html_entity_decode($cname);
$rep_legal_ces_name = html_entity_decode($rep_legal_ces['nombre']);

$pdf->AddFont('Arial','','arial.php');
$title = 'CONTRATO DE ACCESO A DATOS POR CUENTA DE TERCEROS';
$pdf->SetTitle($title);
$pdf->SetAuthor('Análisis y gestión de datos S.L.');
$pdf->SetMargins(20,15,20);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,strtoupper($title),0,1,'C');
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,'Suscrito entre',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode($cname.' y '.html_entity_decode($ces["nombre"])),0,1,'C');

$pdf->SetFont('Arial','',12);
$fecha = explode("-",date("d-m-Y"));
$pdf->Cell(0,10,'En Sevilla, a '.$fecha[0].' de '.getMes($fecha[1]).' de '.$fecha[2],0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,strtoupper('reunidos'),0,1,'C');

$pdf->SetFont('Arial','',9);
$rep_name=".....................................................................................";
if(strcmp($rep_legal['nombre'],'')!=0){
    $rep_name = html_entity_decode($rep_legal['nombre']);
}
$rep_dni = "..................................";
if(strcmp($rep_legal['dni'],'')!=0){
    $rep_dni = $rep_legal['dni'];
}

if(strcmp($rep_name,$cname)==0) {
    $pdf->MultiCell(0, 6, utf8_decode('De una parte, ' . $rep_name . ', mayor de edad, con  DNI ' . $rep_dni . ', en nombre y representación de ' . $cname . ', con domicilio en ' . html_entity_decode($dir) . ', C.P. ' . $cp . ' de ' . html_entity_decode($loc) . ', provincia de ' . html_entity_decode($prov) . ' y CIF nº ' . $cif_nif . ' (En adelante RESPONSABLE DEL FICHERO)'), 0, 'J');
}else{
    $pdf->MultiCell(0, 6, utf8_decode('De una parte, ' . $rep_name . ', mayor de edad, con  DNI ' . $rep_dni . ', en su propio nombre y representación, con domicilio en ' . html_entity_decode($dir) . ', C.P. ' . $cp . ' de ' . html_entity_decode($loc) . ', provincia de ' . html_entity_decode($prov) . ' (En adelante RESPONSABLE DEL FICHERO)'), 0, 'J');
}
    $pdf->Ln(5);

$ces_dir = html_entity_decode($ces["direccion"]);

$rep_ces_dni = "..................................";
if(strcmp($rep_legal_ces->dni,'')!=0){
    $rep_ces_dni = $rep_legal_ces->dni;
}
//the second one is included in the first one
if(strcmp(html_entity_decode($rep_legal_ces_name),html_entity_decode($ces["nombre"]))==0){
    $pdf->MultiCell(0, 6, utf8_decode('De otra, ' . $rep_legal_ces_name . ', mayor de edad, con  DNI ' . $rep_ces_dni . ', en su propio nombre y representación, con domicilio en ' . $ces_dir . ', C.P. ' . $ces["cpostal"] . ' de ' . $ces["loc"] . ', provincia de ' . $ces["prov"] . ' (En adelante ENCARGADO DEL TRATAMIENTO)'), 0, 'J');
}
else {
    $rep_ces_name=".....................................................................................";
    if(strcmp($rep_legal_ces_name,'')!=0){
        $rep_ces_name = html_entity_decode($rep_legal_ces_name);
    }
    $pdf->MultiCell(0, 6, utf8_decode('De otra, ' . $rep_ces_name . ', mayor de edad, con  DNI ' . $rep_ces_dni . ', en nombre y representación de ' . html_entity_decode($ces["nombre"]) . ', con domicilio en ' . $ces_dir . ', C.P. ' . $ces["cpostal"] . ' de ' . $ces["loc"] . ', provincia de ' . $ces["prov"] . ' y CIF nº ' . $ces["cif_nif"] . ' (En adelante ENCARGADO DEL TRATAMIENTO)'), 0, 'J');
}

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,strtoupper('acuerdan'),0,1,'C');
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(0, 6, utf8_decode('Celebrar el presente contrato de acceso a datos por cuenta de terceros, que tiene por objeto garantizar la seguridad de datos de carácter personal y evitar su tratamiento o acceso no autorizado, o la pérdida de los mismos, conforme establece la Ley Orgánica 15/1999 de Protección de Datos de Carácter Personal.'), 0, 'J');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,strtoupper('estipulaciones'),0,1,'C');

/* estipulaciones */
$pdf->SetFont('Arial','B',9);
$pdf->Cell(0,10,strtoupper('primera'),0,1,'L');
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(0, 6, utf8_decode('Ambas partes se encuentran vinculadas por una relación contractual de prestación de servicios de '.html_entity_decode($ces["actividad"]).' para '.$cname.'.'),0,'J');
$pdf->Ln(3);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(0,10,strtoupper('segunda'),0,1,'L');
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(0, 6, utf8_decode('En orden a la prestación de dichos servicios es necesario que el Encargado del Tratamiento tenga acceso a los datos de carácter personal contenidos en los ficheros bajo la titularidad del Responsable del Fichero.'),0,'J');
$pdf->Ln(3);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(0,10,strtoupper('tercera'),0,1,'L');
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(0, 6, utf8_decode('Que por esta razón conforme a lo dispuesto en el Art. 12 de la LOPD, ambas partes libremente y de común acuerdo, deciden regular este acceso y tratamiento de datos de carácter personal de conformidad con las siguientes: '),0,'J');

$pdf->AddPage();
/* clausulas */
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode(mb_strtoupper('claúsulas')),0,1,'C');
$pdf->SetFont('Arial','',9);

$ficheros_str="";
$str="el fichero denominado ".strtoupper($files[0]["type"]);
if(count($files)>1){
    foreach($files as $k => $f) {
        if($k!=0) {
            $ficheros_str .= ', "' . $f["type"].'"';
        }
        else{
            $ficheros_str .= '"'.$f["type"].'"';
        }
    }
    $str="los ficheros denominados ".strtoupper($ficheros_str);
}

$pdf->MultiCell(0, 7, utf8_decode('1ª.- El Responsable del Fichero pone a disposición del Encargado del Tratamiento '.$str.'.'),0,'J');
$pdf->Ln(3);
$pdf->MultiCell(0, 7, utf8_decode('2ª.-  El acceso por parte del Encargado del Tratamiento a los datos de carácter personal contenidos en estos ficheros, se realizará única y exclusivamente con la finalidad de prestar servicios de '.html_entity_decode($ces["actividad"]).' para el Responsable del Fichero.'),0,'J');
$pdf->Ln(3);
$pdf->MultiCell(0, 7, utf8_decode('3ª.- El Encargado del Tratamiento únicamente tratará los datos conforme a las instrucciones dadas por el Responsable del Fichero y nos los utilizará con fines distintos al de este contrato, ni los comunicará a terceros sin su consentimiento.'),0,'J');
$pdf->Ln(3);
$pdf->MultiCell(0, 7, utf8_decode('4ª.- El Encargado del Tratamiento está obligado al secreto profesional respecto de los datos de carácter personal y al deber guardarlos incluso después de finalizar sus relaciones con el Responsable del Fichero.'),0,'J');
$pdf->Ln(3);
$pdf->MultiCell(0, 7, utf8_decode('5ª.- El Encargado del Tratamiento se compromete a adoptar las medidas de índole técnica y organizativas necesarias que garanticen la seguridad de los datos de carácter personal y eviten su tratamiento o acceso no autorizado, alteración o pérdida de los mismos, conforme a lo estipulado en la Ley Orgánica 15/1999 de Protección de Datos de Carácter Personal.'),0,'J');
$pdf->Ln(3);
$pdf->MultiCell(0, 7, utf8_decode('6ª.- El Encargado del Tratamiento no registrará datos de carácter personal en ficheros que no reúnan las condiciones que establece el Reglamento de desarrollo de la Ley Orgánica 15/1999, de 13 de diciembre, de Protección de Datos de Carácter Personal, con respecto a su seguridad o integridad, y a las de los centros de tratamiento locales, equipos, sistemas y programas instalados. '),0,'J');
$pdf->Ln(3);
$pdf->MultiCell(0, 7, utf8_decode('7ª.- Una vez cumplida la prestación contractual, los datos de carácter personal serán destruidos o devueltos al Responsable del Fichero, al igual que cualquier soporte o documento en los que conste algún dato de carácter personal objeto de tratamiento.'),0,'J');
$pdf->Ln(3);
$pdf->MultiCell(0, 7, utf8_decode('8ª.- El Responsable del Fichero quedan eximido de responsabilidad alguna derivada del incumplimiento por parte del Encargado del Tratamiento, o del personal sujeto al mismo, de las estipulaciones acordadas en el presente contrato.'),0,'J');
$pdf->Ln(3);
$pdf->MultiCell(0, 7, utf8_decode('9ª.- Las partes contratantes se someten expresamente al fuero de los Juzgados y Tribunales de la ciudad de Sevilla, para cuantas acciones o reclamaciones pudieran derivarse de este contrato.'),0,'J');
$pdf->Ln(5);
$pdf->MultiCell(0, 7, utf8_decode('Tanto el Responsable del Fichero como el Encargado del Tratamiento, aceptan el presente contrato en los términos y condiciones estipuladas en el mismo, y en prueba de ello, y para cumplimiento de lo convenido, lo firman por duplicado.'),0,'J');

/* signatures */
$pdf->SetLeftMargin(20);
$pdf->SetFont('Arial','',9);
$pdf->Ln(10);
$pdf->MultiCell(0, 6, utf8_decode($cname.'                                                                            '. $rep_legal_ces_name), 0, 'C');
$nombre_empresa="              ";
if($ces["tipo"] != 3){
    $nombre_empresa=$ces["nombre"];
}
$pdf->Ln(10);
//$pdf->MultiCell(0, 6, utf8_decode($cname . '                                                                    '.html_entity_decode($nombre_empresa)) , 0, 'C');

$pdf->Output("CONTRATO-CESION-".$cname."-".html_entity_decode($ces['nombre']).".pdf",'I');