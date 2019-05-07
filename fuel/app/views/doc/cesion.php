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
$pdf->Cell(0,8,utf8_decode($cname),0,1,'C');
$pdf->Cell(0,8,utf8_decode(' y '),0,1,'C');
$pdf->Cell(0,8,utf8_decode(html_entity_decode($ces["nombre"])),0,1,'C');

$pdf->SetFont('Arial','',12);
$fecha = explode("-",date("d-m-Y"));
$pdf->Ln(5);
$pdf->Cell(0,10,'En Sevilla, a '.$fecha[0].' de '.getMes($fecha[1]).' de '.$fecha[2],0,1,'C');
$pdf->Ln(5);
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

if(strcmp($rep_name,$cname)!=0) {
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
$pdf->MultiCell(0, 6, utf8_decode('Celebrar el presente contrato de acceso a datos por cuenta de terceros, que tiene por objeto garantizar la seguridad de datos de carácter personal y evitar su tratamiento o acceso no autorizado, o la pérdida de los mismos,conforme establece la Ley Orgánica 3/2018 de Protección de Datos de Carácter Personal y Garantía de Derechos Digitales (LOPDGDD) y al Art. 28 del Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo de 27 de abril de 2016, relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre circulación de estos datos.'), 0, 'J');
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
$pdf->MultiCell(0, 6, utf8_decode('Que por esta razón conforme a lo dispuesto en la normativa de protección de datos, ambas partes libremente y de común acuerdo, deciden regular este acceso y tratamiento de datos de carácter personal de conformidad con las siguientes: '),0,'J');

$pdf->AddPage();
/* clausulas */
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode(mb_strtoupper('claúsulas')),0,1,'C');
$pdf->SetFont('Arial','',9);

$ficheros_str="";
if(count($files)>1){
    foreach($files as $k => $f) {
        if($k!=0) {
            $ficheros_str .= ', "' . $f["type"].'"';
        }
        else{
            $ficheros_str .= '"'.$f["type"].'"';
        }
    }
    $str="de los ficheros denominados ".strtoupper($ficheros_str);
}
else{
    $str="del fichero denominado ".strtoupper($files[0]["type"]);
}

$pdf->MultiCell(0, 7, utf8_decode('PRIMERA. FICHEROS.'),0,'J');
$pdf->MultiCell(0, 7, utf8_decode('El Responsable del Fichero pone a disposición del Encargado del Tratamiento datos '.$str.'.'),0,'J');
$pdf->Ln(3);
$pdf->MultiCell(0, 7, utf8_decode('SEGUNDA. FINALIDAD.'),0,'J');
$pdf->MultiCell(0, 7, utf8_decode('2.1. El acceso por parte del Encargado del Tratamiento a los datos de carácter personal contenidos en estos ficheros, se realizará única y exclusivamente con la finalidad de prestar servicios de '.html_entity_decode($ces["actividad"]).' para el Responsable del Fichero. Para llevar a cabo cualquier otra actividad que implique el tratamiento o utilización de los ficheros, que exceda de lo previsto, será necesario el consentimiento previo y por escrito del Responsable de los Ficheros.'),0,'J');
$pdf->Ln(3);
$pdf->MultiCell(0, 7, utf8_decode('2.2. El Encargado del Tratamiento únicamente tratará los datos conforme a las instrucciones que en cada momento indique el Responsable del Fichero, así como lo dispuesto en la normativa legal aplicable.'),0,'J');
$pdf->Ln(3);
$pdf->MultiCell(0, 7, utf8_decode('2.3. El Encargado del Tratamiento se obliga a no realizar ningún otro tratamiento distinto del solicitado por el Responsable de los Ficheros, de los datos a los que tenga acceso, comprometiéndose, además, a no hacer uso de los ficheros en su propio beneficio o en el de un tercero.'),0,'J');
$pdf->Ln(3);
$pdf->MultiCell(0, 7, utf8_decode('TERCERA. MEDIDAS DE SEGURIDAD.'),0,'J');
$pdf->MultiCell(0, 7, utf8_decode('3.1. El Encargado del Tratamiento se compromete a adoptar las medidas de índole técnica y organizativas necesarias que garanticen la seguridad de los datos de carácter personal y eviten su tratamiento o acceso no autorizado, alteración o pérdida de los mismos, conforme a lo estipulado en la Ley Orgánica 3/2018 de Protección de Datos de Carácter Personal y Garantía de Derechos Digitales (LOPDGDD).'),0,'J');
$pdf->Ln(3);
$pdf->MultiCell(0, 7, utf8_decode('3.2. El Encargado del Tratamiento no registrará datos de carácter personal en ficheros que no reúnan las condiciones que establece la normativa vigente con respecto a su seguridad o integridad, y a las de los centros de tratamiento locales, equipos, sistemas y programas instalados.'),0,'J');
$pdf->Ln(3);
$pdf->MultiCell(0, 7, utf8_decode('3.3. El Encargado del Tratamiento se compromete a no copiar o reproducir los datos a los que tenga acceso, salvo cuando sea necesario para su tratamiento en los términos previstos en este contrato. Cada una de las copias o reproducciones estará sometida a los mismos compromisos y obligaciones que en este documento se establecen.'),0,'J');
$pdf->Ln(3);
$pdf->MultiCell(0, 7, utf8_decode('CUARTA. EJERCICIO DE DERECHOS.'),0,'J');
$pdf->MultiCell(0, 7, utf8_decode('Cuando los titulares de los datos ejerciten alguno de los derechos ARCO (acceso, rectificación, cancelación, oposición) directamente frente al Encargado del Tratamiento y soliciten el ejercicio frente al Responsable de los Ficheros, el Encargado del Tratamiento le trasladará dicha solicitud en el plazo de 3 días, a fin de que el Responsable de los Ficheros la resuelva en los plazos legales previstos en la normativa.'),0,'J');
$pdf->Ln(15);
$pdf->MultiCell(0, 7, utf8_decode('QUINTA. RESOLUCIÓN.'),0,'J');
$pdf->MultiCell(0, 7, utf8_decode('5.1. Una vez cumplida la prestación contractual, o bien en el supuesto de resolución, los datos de carácter personal que pudieran permanecer en poder del Encargado del Tratamiento deberán serán destruidos o devueltos al Responsable del Fichero, al igual que cualquier soporte o documento en los que conste algún dato de carácter personal objeto de tratamiento.'),0,'J');
$pdf->Ln(3);
$pdf->MultiCell(0, 7, utf8_decode('5.2. Con independencia de lo indicado anteriormente, el Encargado del Tratamiento deberá conservar, debidamente bloqueados, los datos de tanto pudieran derivarse responsabilidades de su relación con el Responsable de los Ficheros.'),0,'J');
$pdf->Ln(3);
$pdf->MultiCell(0, 7, utf8_decode('SEXTA. RESPONSABILIDADES.'),0,'J');
$pdf->MultiCell(0, 7, utf8_decode('6.1.  El Encargado del Tratamiento  será considerado responsable en el caso de que destine los datos a otra finalidad, los comunique o los utilice incumpliendo el presente contrato. En estos casos, responderá de las infracciones en que hubiera incurrido personalmente e indemnizará al Responsable de los Ficheros por los daños y perjuicios ocasionados.'),0,'J');
$pdf->Ln(3);
$pdf->MultiCell(0, 7, utf8_decode('6.2. Responsable del Fichero quedan eximido de responsabilidad alguna derivada del incumplimiento por parte del Encargado del Tratamiento, o del personal sujeto al mismo, de las estipulaciones acordadas en el presente contrato.'),0,'J');
$pdf->Ln(3);
$pdf->MultiCell(0, 7, utf8_decode('SÉPTIMA. SECRETO PROFESIONAL.'),0,'J');
$pdf->MultiCell(0, 7, utf8_decode('El Encargado del Tratamiento está obligado al secreto profesional respecto de los datos de carácter personal que, de conformidad con la normativa vigente, subsistirá aún después de finalizar sus relaciones con el Responsable de los Ficheros.'),0,'J');
$pdf->Ln(3);
$pdf->MultiCell(0, 7, utf8_decode('OCTAVA. CONTROLES Y AUDITORÍAS.'),0,'J');
$pdf->MultiCell(0, 7, utf8_decode('El Responsable de los Ficheros se reserva el derecho a efectuar en cualquier momento los controles y auditorías que estime oportunos para comprobar el correcto cumplimiento por parte del Encargado del Tratamiento del presente contrato. Por su parte, el Encargado del Tratamiento deberá facilitar al Responsable de los Ficheros cuantos datos o documentos le requiera para el adecuado cumplimiento de dichos controles y auditorías.'),0,'J');
$pdf->Ln(3);
$pdf->MultiCell(0, 7, utf8_decode('NOVENA. EMPLEADOS.'),0,'J');
$pdf->MultiCell(0, 7, utf8_decode('El Encargado del Tratamiento permitirá únicamente el acceso a los datos y ficheros al personal que tenga necesidad de acceder a éstos para llevar a cabo sus funciones laborales, y deberá advertirles del carácter confidencial de la información y de su responsabilidad en caso de divulgarla ilícitamente.'),0,'J');
$pdf->Ln(3);
$pdf->MultiCell(0, 7, utf8_decode('Las partes contratantes se someten expresamente al fuero de los Juzgados y Tribunales de la ciudad de Sevilla, para cuantas acciones o reclamaciones pudieran derivarse de este contrato.'),0,'J');
$pdf->Ln(3);
$pdf->MultiCell(0, 7, utf8_decode('Tanto el Responsable del Fichero como el Encargado del Tratamiento, aceptan el presente contrato en los términos y clausulas estipuladas en el mismo, y en prueba de ello, y para cumplimiento de lo convenido, lo firman por duplicado.'),0,'J');


/* signatures */
$pdf->SetLeftMargin(20);
$pdf->SetFont('Arial','',9);
$pdf->Ln(10);
//$pdf->MultiCell(0, 6, utf8_decode($cname.'                                                                            '. $rep_legal_ces_name), 0, 'C');
$pdf->MultiCell(0, 6, utf8_decode($cname.'                                                                            '.html_entity_decode($ces["nombre"])), 0, 'C');
$nombre_empresa="              ";
if($ces["tipo"] != 3){
    $nombre_empresa=$ces["nombre"];
}
$pdf->Ln(10);
//$pdf->MultiCell(0, 6, utf8_decode($cname . '                                                                    '.html_entity_decode($nombre_empresa)) , 0, 'C');

$pdf->Output("CONTRATO-CESION-".$cname."-".html_entity_decode($ces['nombre']).".pdf",'I');