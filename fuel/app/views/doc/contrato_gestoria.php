<?php

class PDF extends FPDF
{
    function Header(){
        $this->SetFont('Arial','B',15);
        $this->Ln(10);
        $this->Cell(0,10,utf8_decode('     CONTRATO DE PRESTACIÓN DE SERVICIOS PROFESIONALES     '),0,0,'C');
        $this->Ln(8);
        $this->Cell(0,10,utf8_decode('     DE ASESORAMIENTO FISCAL Y CONTABLE     '),0,0,'C');
        $this->Ln(20);
    }

    function Footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','I',10);
        $this->Cell(0,10,utf8_decode('Página '.$this->PageNo().' de {nb}'),0,0,'R');
    }
}

$contrato=$contract;
$tratamiento_ops = array("D.","Dª");

$pdf = new PDF();

$pdf->SetTitle(utf8_decode('Contrato de prestación de servicios'));
$pdf->SetAuthor('Análisis y gestión de datos S.L.');

$pdf->SetMargins(12,10,12);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Arial','',12);
$fecha = $contrato->fecha_firma;
$fecha_array=explode('-',$fecha);
$mes = getMes($fecha_array[1]);
$fecha = "$fecha_array[2]-$mes-$fecha_array[0]";
$pdf->Cell(0,10,'En Sevilla, a '.str_replace("-"," de ",$fecha),0,0,'C');
$pdf->Ln(15);

/* reunidos */
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'REUNIDOS',0,1,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('          De una parte, '.$tratamiento_ops[$rep->tratamiento] .' '. html_entity_decode($rep->nombre).', mayor de edad, con DNI nº '.$rep->dni.', como representante legal de '.html_entity_decode($customer->nombre).', con domicilio en '.html_entity_decode($customer->direccion).', C.P '.$customer->cpostal.', en '.html_entity_decode($customer->loc).', provincia de '.html_entity_decode($customer->prov).' y con CIF nº '.$customer->cif_nif.' (en adelante, EL BENEFICIARIO).'),0);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('          De otra, D. Casimiro Galán Garrido, mayor de edad, con DNI nº 28.884.460-W, en nombre y representación de ANÁLISIS Y GESTIÓN DE DATOS, S.L. (AGDATA), con domicilio social en Tomares (Sevilla), Edificio RAMCAB en Avda. del Aljarafe, S/N Planta 2ª módulo 42, y CIF nº  B-91.341.297 (en adelante, EL ASESOR).'),0);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('        Ambas partes (en adelante "las partes") se reconocen mutua y recíprocamente, la capacidad legal necesaria y suficiente para el otorgamiento del presente contrato mercantil y'),0);
$pdf->Ln(5);

/* manifiestan */
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'MANIFIESTAN',0,1,'C');
$pdf->Ln(3);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'PRIMERA',0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('Que EL ASESOR es una empresa que desarrolla, entre otras, la actividad de prestación de servicios de asesoramiento fiscal y contable, y servicios complementarios.'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'SEGUNDA',0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0, 6, utf8_decode('Que el BENEFICIARIO desarrolla la siguiente actividad principal: '.html_entity_decode($customer->actividad).'.'), 0);
$pdf->Ln(5);
$pdf->MultiCell(0, 6, utf8_decode('Que está interesado en recibir del ASESOR, la prestación del servicio de asesoría FISCAL Y CONTABLE, tal y como se define en el presente documento.'), 0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'TERCERA',0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('Que conforme a los expositivos precedentes, ambas partes han convenido en el otorgamiento del presente contrato de PRESTACIÓN DE SERVICIOS DE ASESORIA FISCAL Y CONTABLE, que se regirá por lo dispuesto en el Código de Comercio y el Código Civil, y de forma especial por las siguientes.'),0);
$pdf->Ln(5);

$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('CLAÚSULAS'),0,1,'C');
$pdf->Ln(3);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('1ª.- OBJETO'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('El objeto del presente contrato es la prestación al BENEFICIARIO de los servicios de ASESORIA FISCAL Y CONTABLE que se detallan a continuación, conforme a las exigencias contenidas en la normativa vigente.'),0);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,6,utf8_decode('a) Obligaciones del ASESOR.-'),0);
$pdf->Ln(3);
$pdf->MultiCell(0,6,utf8_decode('ASESORAMIENTO FISCAL'),0);
$pdf->SetFont('Arial','',12);
$pdf->Ln(3);
$pdf->MultiCell(0,6,utf8_decode('1.- Elaboración y presentación de las declaraciones tributarias y/o autoliquidaciones mensuales o trimestrales que correspondan en función del tipo de actividad económica y tipo de empresa.'),0);$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('2.- Elaboración y presentación de las declaraciones tributarias anuales de resumen que correspondan en función del tipo de actividad económica y tipo de empresa.'),0);$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('3.- Representación del cliente ante comprobaciones o inspecciones de cualquier Autoridad Tributaria, estatal, autonómica o local.'),0);$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('4.- Elaboración de recursos administrativos ante cualquier acto de comprobación, sancionador, o de recaudación de cualquier Autoridad Tributaria, estatal, autonómica o local.'),0);$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('5.- Elaboración y presentación de Altas, Bajas o Variaciones censales.'),0);$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('6.- Solicitud de certificaciones tributarias.'),0);$pdf->Ln(2.5);
$pdf->Ln(3);

$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,6,utf8_decode('ASESORAMIENTO CONTABLE'),0);
$pdf->SetFont('Arial','',12);
$pdf->Ln(3);
$pdf->MultiCell(0,6,utf8_decode('1.- Llevanza de la contabilidad del cliente conforme a la legislación vigente en cada momento, en función del tipo de entidad.'),0);$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('2.- Elaboración y legalización de los libros contables ante el Registro correspondiente'),0);$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('3.- Elaboración y depósito de las cuentas anuales ante el Registro correspondiente'),0);$pdf->Ln(2.5);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,6,utf8_decode('b) Obligaciones del BENEFICIARIO.-'),0);
$pdf->SetFont('Arial','',12);
$pdf->Ln(3);
$pdf->MultiCell(0,6,utf8_decode('1. Facilitar al ASESOR toda la documentación necesaria para la adecuada prestación de los servicios.'),0);$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('2. Formular las consultas o visitas en las horas establecidas al efecto, y mediante medios tanto telefónicos, como telemáticos o presenciales.'),0);$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('3. Efectuar en plazo el pago de los honorarios, mediante domiciliación bancaria y pago mensual.'),0);$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('4. No efectuar gestiones ante los organismos correspondientes en materia laboral, fiscal o contable, sin previo conocimiento del ASESOR. En especial, ante el requerimiento para una inspección de trabajo o tributaria, se abstendrá de hacer gestión alguna hasta tanto haya contactado con el ASESOR.'),0);$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('5. El BENEFICIARIO no podrá solicitar al ASESOR ni asesoramiento ni colaboración en la realización de acciones u omisiones fraudulentas o tendentes a eludir la declaración y/o pago de los tributos, tasas o cotizaciones que sean legalmente obligatorios.'),0);$pdf->Ln(2.5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('2ª.- DURACIÓN DEL CONTRATO'),0,1,'L');
$pdf->SetFont('Arial','',12);

$pdf->MultiCell(0,6,utf8_decode('Los servicios y funciones descritos en el pacto anterior se prestarán por parte del ASESOR por un plazo inicial de 12 meses (desde la firma), que se renovará tácitamente por periodos anuales, de no mediar preaviso, al menos, con un mes de antelación a su término por cualquiera de las partes.'),0);
$pdf->Ln(3);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('3ª.- CONFIDENCIALIDAD DE LOS DATOS'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('El ASESOR se obliga a tramitar confidencialmente todos aquellos datos, documentación y demás información que hayan sido suministrados por el BENEFICIARIO durante la vigencia del presente contrato. Asimismo se compromete a no comunicar esta información a ninguna otra persona o entidad, exceptuando sus propios empleados y sólo en la medida necesaria para la correcta ejecución del contrato.'),0);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('El acuerdo de confidencialidad establecido en el presente pacto tendrá validez durante la vigencia del contrato y seguirá en vigor, durante 5 años más después de la extinción, por cualquier causa,del mismo.'),0);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('Lo contenido en este contrato no obligará a confidencialidad en lo referente a:'),0);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('a) Cualquier información o conocimiento revelado legítimamente por terceros que hayan autorizado su difusión.'),0);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('b) Cuando la información sea requerida por imperativo legal.'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('4ª.- PROTECCIÓN DE DATOS PERSONALES'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('El ASESOR informa al BENEFICIARIO de que los datos personales contenidos en el presente contrato y los generados durante la vigencia de esta relación contractual, todos ellos relativos al BENEFICIARIO, serán incorporados a un fichero cuyo responsable es el Asesor, con la finalidad de gestionar dicha relación contractual y de prestar al BENEFICIARIO aquellos servicios de asesoramiento que se especifiquen en el presente contrato.'),0);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('El BENEFICIARIO tiene la posibilidad de ejercitar los derechos de acceso, rectificación, cancelación y oposición, en relación a sus datos personales, dirigiendo un escrito a la dirección del ASESOR indicada en el encabezamiento del presente contrato.'),0);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('Respecto de los datos personales a los que el ASESOR tenga acceso de acuerdo con su condición de "Encargado de Tratamiento"(*), se entenderán facilitados de forma voluntaria por el BENEFICIARIO, siguiendo en todo momento el ASESOR sus instrucciones, comprometiéndose a no aplicarlos ni utilizarlos para finalidad distinta de la pactada y a no comunicarlos a otras personas, así como a destruir los soportes y/o documentos donde se contengan dichos datos al finalizar el presente contrato, salvaguardando en todo caso las pruebas necesarias respecto a las actuaciones realizadas. En todo caso, los documentos de trabajo y el diseño o sistema de análisis serán propiedad del ASESOR.'),0);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('Asimismo, ambas partes se comprometen a adoptar las necesarias medidas de seguridad para la protección de dichos datos en el nivel que les corresponda, de acuerdo a la regulación legal.'),0);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('Igualmente le informa de que, en ocasiones, el cumplimiento del presente contrato podrá implicar la cesión de datos personales a la Hacienda Pública para la consecución de la prestación del servicio arriba indicado, de acuerdo en todo caso con lo dispuesto en la normativa legal, y de forma específica en la LOPD y en la Ley General Tributaria.'),0);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('Si tal cesión se produjera previo requerimiento de la Administración Tributaria, el ASESOR lo comunicará de forma inmediata al BENEFICIARIO.'),0);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('(*) Cuando el ASESOR actúa por cuenta del BENEFICIARIO, pero quedando en poder de éste la decisión sobre la finalidad, el contenido y el tratamiento de los datos. Ejemplo: declaraciones fiscales, auditoria, etc.'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('5ª.- HONORARIOS'),0,1,'L');
$pdf->SetFont('Arial','',12);

$per="";$div="";
if(strcmp($services->periodicidad,"Pago único")!==0 && strcmp($services->periodicidad,"anualmente")!==0){
    $per=$services->periodicidad.".";
    $div=' dividido en '.$services->periodicidad.' importes de '.$services->cuota.' EUROS,';
}
$pdf->MultiCell(0,6,utf8_decode('El precio fijado para los servicios de asesoría descritos, a ser percibido por ANÁLISIS Y GESTIÓN DE DATOS S.L., asciende a un total de '.$services->importe.' EUROS,'.$div.' impuestos no incluidos, que serán facturados por dicha entidad.'),0);
$pdf->Ln(5);

$iban=".....................................................................";
if($customer->iban != ""){
    $iban=$customer->iban;
}
$pdf->MultiCell(0,6,utf8_decode('La primera domiciliación será girada por el ASESOR durante los diez primeros días del mes de '.getMes($services->mes_factura).' de '.$services->year.', en la cuenta del BENEFICIARIO con código IBAN nº '.$iban.'.'),0);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('Los precios antes señalados serán revisados en las sucesivas prórrogas que se produzcan en función de las variaciones del IPC anuales publicadas por el INE.'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('6ª.- INCUMPLIMIENTO DE PAGOS'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('La falta de pago de cualquiera de las mensualidades, dará derecho al ASESOR a resolver el contrato y, si lo estimara oportuno, a proceder a su reclamación judicial, aplicándose desde la fecha del incumplimiento el interés de demora establecido en la Ley.'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('7ª.- DEFICIENCIAS EN LOS SERVICIOS CONTRATADOS'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('Si el BENEFICIARIO encontrara defectos en los servicios contratados con el ASESOR, se lo hará saber por escrito o verbalmente, debiendo resolverse dichas deficiencias en el plazo de 30 días, o en un plazo inferior si así lo exige la especialidad del servicio prestado. Si no se solucionasen los problemas derivados de las prestaciones deficientes en el plazo establecido, el BENEFICIARIO podrá resolver el contrato.'),0);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('El ASESOR no será responsable de las consecuencias derivadas de la omisión o falseamiento de los datos facilitados por el BENEFICIARIO, ni estará obligado a verificar la suficiencia o autenticidad de los mismos. Tampoco responderá de las actuaciones que el BENEFICIARIO efectúe sin su asesoramiento previo o en contra de sus indicaciones. Quedará también eximido de responsabilidad por las actuaciones realizadas fuera de plazo en nombre del BENEFICIARIO cuando los datos, documentos o notificaciones no le hayan sido facilitados por éste con, al menos, quince días naturales de antelación.'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('8ª.- RESCISIÓN DEL CONTRATO'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('Además de las causas generales de rescisión de los contratos, el presente se considerará cancelado por las siguientes causas:'),0);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('a) Por la insolvencia definitiva o provisional, quiebra o suspensión de pagos de cualquiera de las partes contratantes.'),0);
$pdf->Ln(3);
$pdf->MultiCell(0,6,utf8_decode('b) Por el acuerdo de liquidación de cualquiera de los contratantes.'),0);
$pdf->Ln(3);
$pdf->MultiCell(0,6,utf8_decode('c) Por cualquier causa legamente establecida.'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('9ª.- MODIFICACIÓN DEL CONTENIDO DEL CONTRATO'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('Cualquier modificación del presente contrato deberá realizarse por escrito e incorporarse al mismo como Anexo, con excepción de las variaciones en las cuotas que pudieran acordarse y que se entenderán aceptadas desde el momento en que se realicen las transferencias con las nuevas cantidades.'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('10ª.- SOMETIMIENTO AL FUERO'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('Las partes, con renuncia al fuero propio si lo tuvieran, se someten a los Juzgados y Tribunales españoles de la plaza de Sevilla.'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('11ª.- RÉGIMEN DEL CONTRATO'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('Este contrato tiene carácter mercantil y se regirá por sus propias cláusulas o, en lo que en ellas no estuviera contemplado, por lo previsto en las disposiciones españolas contenidas en el Código de Comercio, Leyes especiales y usos mercantiles.'),0);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('En la fecha y lugar al principio reseñados, se firma este contrato, en todas sus hojas, por duplicado y a un solo efecto.'),0);
$pdf->Ln(5);

/* firmas */
$pdf->MultiCell(0,6,utf8_decode('Fdo. el beneficiario                                                         Fdo. el asesor'),0,'C');
$pdf->Ln(30);
$pdf->MultiCell(0,6,utf8_decode('    '.html_entity_decode($rep["nombre"]).'                                         D. Casimiro Galán Garrido'),0,'C');
/* Imprimimos */
$pdf->Output('CONTRATO-SERVICIOS-GESTORIA-'.html_entity_decode($customer->nombre).'.pdf','I');
?>