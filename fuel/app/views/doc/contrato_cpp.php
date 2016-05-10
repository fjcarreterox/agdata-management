<?php

class PDF extends FPDF
{
    function Header(){
        $this->SetFont('Arial','B',15);
        $this->Ln(10);
        $this->Cell(0,10,utf8_decode('     CONTRATO DE PRESTACIÓN DE SERVICIOS     '),0,0,'C');
        $this->Ln(20);
    }

    function Footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

$contrato=$contract;
$tratamiento_ops = array("D.","Dª");
$h1=0;
$h2=0;

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
$pdf->MultiCell(0,6,utf8_decode('          De otra, D. Casimiro Galán Garrido, mayor de edad, con DNI nº 28.884.460-W, en nombre y representación de ANÁLISIS Y GESTIÓN DE DATOS, S.L. (AGDATA), con domicilio social en Tomares (Sevilla), Edificio RAMCAB en Avda. del Aljarafe, S/N Planta 2ª módulo 42, y CIF nº  B-91.341.297 (en adelante, EL PRESTATARIO).'),0);
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
$pdf->MultiCell(0,6,utf8_decode('Que EL PRESTATARIO es una empresa que desarrolla, entre otras, la actividad de prestación de servicios de Auditoría de Seguridad en la Protección de Datos de Carácter Personal en aras a la adecuación de todo tipo de entidades y profesionales sometidos al cumplimiento de la Ley Orgánica 15/1999 de Protección de Datos de Carácter Personal (LOPD).'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'SEGUNDA',0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0, 6, utf8_decode('Que EL BENEFICIARIO está constituido jurídicamente como una Comunidad de Propietarios.'), 0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'TERCERA',0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('Que conforme a los expositivos precedentes, ambas partes han convenido en el otorgamiento del presente contrato de PRESTACIÓN DE SERVICIOS DE AUDITORIA Y CONSULTORÍA DE SEGURIDAD EN LA PROTECCIÓN DE DATOS DE CARÁCTER PERSONAL, que se regirá por lo dispuesto en el Código de Comercio y el Código Civil, y de forma especial por las siguientes.'),0);
$pdf->Ln(5);

$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('CLAÚSULAS'),0,1,'C');
$pdf->Ln(3);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('1ª.- OBJETO'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('El objeto del presente contrato es la prestación al BENEFICIARIO de los servicios de asesoramiento y consultoría en materia de protección de datos que se detallan a continuación, conforme a las exigencias contenidas en la normativa vigente en materia de Protección de Datos de Carácter Personal respecto a los datos personales que el BENEFICIARIO tiene declarados.'),0);
$pdf->Ln(10);

$periodo_ops = array(12=>'mensualmente',4=>'trimestral',2=>'semestralmente',1=>'anualmente',0=>'Pago único');
foreach($services as $s):
    $nombre = Model_Servicio::find($s->idtipo_servicio)->get('nombre');
    $num_cuotas=1;
    if($s->periodicidad != 0){
        if($s->idtipo_servicio == 1){$num_cuotas=$s->periodicidad;}
        else{$num_cuotas=2*$s->periodicidad;}
    }
    $servicios_data[$s->idtipo_servicio] = array(
        "nombre"=> $nombre,
        "precio"=> $s->importe,
        "periodicidad"=> $periodo_ops[$s->periodicidad],
        "cuota"=> $s->cuota,
        "num_cuotas" => $num_cuotas,
        "pago"=> $s->forma_pago,
        "mes_factura"=>$s->mes_factura,
        "year"=>$s->year
    );
endforeach;

if(isset($servicios_data[1])) {
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(0, 6, utf8_decode('Servicios iniciales de adaptación / actualización:'), 0);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(5);
    $pdf->MultiCell(0, 6, utf8_decode('- Análisis previo pormenorizado del estado del cliente. Auditoría previa y estudio de su documentación, para identificar deficiencias actuales en materia de protección de datos.'), 0);
    $pdf->Ln(5);
    $pdf->MultiCell(0, 6, utf8_decode('- Actualización del Documento de Seguridad del Administrador de Fincas, si fuese necesario.'), 0);
    $pdf->Ln(5);
    $pdf->MultiCell(0, 6, utf8_decode('- Notificaciones a la Agencia Española de Protección de Datos, de las modificaciones, bajas o altas necesarias para la correcta adecuación de sus ficheros de datos personales.'), 0);
    $pdf->Ln(5);
    $pdf->MultiCell(0, 6, utf8_decode('- Redacción de documentos, contratos y cláusulas legales necesarios para asegurar el correcto cumplimiento de la Ley y su Reglamento de desarrollo.'), 0);
    $pdf->Ln(5);
    $pdf->MultiCell(0, 6, utf8_decode('    Una vez concluidos estos servicios de adaptación / actualización inicial, se concretará entre las partes el inicio de los servicios de mantenimiento durante un periodo anual, que será renovado automáticamente y con idéntica duración si ninguna de las partes con un mes de antelación a su finalización, advierte de forma fehaciente su voluntad de rescindir el presente contrato.'), 0);
    $pdf->Ln(10);
}
else{
    $h2=158; //to readjust the signature high
}

/* mantenimiento */
if(isset($servicios_data[2])) {
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(0, 6, utf8_decode('Servicios de mantenimiento:'), 0);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(5);
    $pdf->MultiCell(0, 6, utf8_decode('- Asesoramiento continuo y la resolución de todo tipo de consultas planteadas por el Administrador de Fincas en materia de protección de datos al PRESTATARIO.'), 0);
    $pdf->Ln(5);
    $pdf->MultiCell(0, 6, utf8_decode('- Modificaciones posteriores del Documento de Seguridad, que deban realizarse cuando se produzcan las situaciones contempladas en la normativa que impliquen su modificación.'), 0);
    $pdf->Ln(5);
    $pdf->MultiCell(0, 6, utf8_decode('- Notificaciones a la Agencia Española de Protección de Datos, de las modificaciones, bajas o altas que se produzcan en los ficheros de datos titularidad del BENEFICIARIO.'), 0);
    $pdf->Ln(5);
    $pdf->MultiCell(0, 6, utf8_decode('- Redacción de documentos, contratos y cláusulas legales que resulten necesarios para asegurar el correcto cumplimiento de la normativa vigente.'), 0);
    $pdf->Ln(5);
    $pdf->MultiCell(0, 6, utf8_decode('- La adaptación a posibles novedades que puedan producirse en la normativa española sobre protección de datos que se produzcan durante la vigencia del presente contrato.'), 0);
    $pdf->Ln(5);
    $pdf->MultiCell(0, 6, utf8_decode('- Realización de Auditoría Bienal obligatoria para los niveles de seguridad medio y alto, al final del segundo año.'), 0);
    $pdf->Ln(5);
}
else{
    $h1=135; //to readjust the signature high
}

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('2ª.- PRECIO'),0,1,'L');
$pdf->SetFont('Arial','',12);

//adaptacion
if(isset($servicios_data[1])) {
    $per="";$div="";
    if(strcmp($servicios_data[1]["periodicidad"],"Pago único")!==0 && strcmp($servicios_data[1]["periodicidad"],"anualmente")!==0){$per=$servicios_data[1]["periodicidad"].".";$div=' dividido en '.$servicios_data[1]["num_cuotas"].' importes de '.$servicios_data[1]["cuota"].' EUROS,';}
    $pdf->MultiCell(0, 6, utf8_decode('El precio fijado para los servicios de adaptación/actualización descritos, a ser percibido por ANÁLISIS Y GESTIÓN DE DATOS S.L., asciende a un total de '.$servicios_data[1]["precio"].' EUROS,'.$div.' impuestos no incluidos, que serán facturados por dicha entidad.'), 0);
    $pdf->Ln(5);
    if(strcmp($servicios_data[1]["pago"],"transferencia bancaria")==0){
        $pdf->MultiCell(0, 6, utf8_decode('El BENEFICIARIO abonará este importe mediante transferencia bancaria a la cuenta bancaria del PRESTATARIO con código IBAN ES56-0081-7424-5500-0122-9423 durante los diez primeros días del mes, comenzando en '.getMes($servicios_data[1]["mes_factura"]).' de '.$servicios_data[1]["year"].'.'), 0);
    }else{
        $pdf->MultiCell(0, 6, utf8_decode('La domiciliación de este importe será girada por el PRESTATARIO durante los diez primeros días del mes de '.getMes($servicios_data[1]["mes_factura"]).' de '.$servicios_data[1]["year"].', en la cuenta del BENEFICIARIO con código IBAN nº '.$customer["iban"].'.'), 0);
    }
    $pdf->Ln(5);
}
//mantenimiento
if(isset($servicios_data[2])) {
    $per="";$div="";
    if(strcmp($servicios_data[2]["periodicidad"],"Pago único")!==0){$per=$servicios_data[2]["periodicidad"].".";$div=' dividido en '.$servicios_data[2]["num_cuotas"].' importes de '.$servicios_data[2]["cuota"].' EUROS,';}
    $pdf->MultiCell(0, 6, utf8_decode('El precio fijado para los servicios de mantenimiento descritos, asciende a un total de '.$servicios_data[2]["precio"].' EUROS,'.$div.' impuestos no incluidos, que serán facturados por ANÁLISIS Y GESTIÓN DE DATOS S.L. '.$per), 0);
    $pdf->Ln(5);
    if(strcmp($servicios_data[2]["pago"],"transferencia bancaria")==0){
        $pdf->MultiCell(0, 6, utf8_decode('El BENEFICIARIO abonará este importe (o estos importes) mediante transferencia bancaria a la cuenta bancaria del PRESTATARIO con código IBAN ES56-0081-7424-5500-0122-9423 durante los diez primeros días del mes, comenzando en '.getMes($servicios_data[2]["mes_factura"]).' de '.$servicios_data[2]["year"].'.'), 0);
    }else{
        $pdf->MultiCell(0, 6, utf8_decode('La primera domiciliación será girada por el PRESTATARIO durante los diez primeros días del mes de '.getMes($servicios_data[2]["mes_factura"]).' de '.$servicios_data[2]["year"].', en la cuenta del BENEFICIARIO con código IBAN nº '.$customer["iban"].'.'), 0);
    }
    $pdf->Ln(5);
}
$pdf->MultiCell(0, 6, utf8_decode('Los precios antes señalados serán revisados en las sucesivas prórrogas que se produzcan en función de las variaciones del IPC anuales publicadas por el INE.'), 0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('3ª.- CONFIDENCIALIDAD'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('Ambas partes se comprometen y obligan a guardar la máxima confidencialidad en toda la información y/o documentación, relativa al BENEFICIARIO y/o a sus clientes que, sin ser de dominio público, se ponga a disposición del PRESTATARIO en el marco de la prestación de los servicios definidos en el presente contrato.'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('4ª.- CAUSAS DE RESOLUCIÓN DEL CONTRATO'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('1. Falta de cumplimiento de cualquiera de las obligaciones que figuran en el presente Contrato.'),0);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('2. De la misma manera, procederá en especial la resolución de este contrato cuando alguna de las partes hubiere sido declarada en quiebra, cuando haya sido admitida a trámite su solicitud de suspensión de pagos, o cuando estuviera en situación técnica de insolvencia provisional.'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('5ª.- NULIDAD PARCIAL'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('Toda claúsula o disposición del presente contrato que sea declarada nula, ilegal o inválida, no afectará ni invalidará ninguna de las demás cláusulas y disposiciones, las cuales permanecerán plenamente vigentes.'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('6ª.- ENTRADA EN VIGOR'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('El presente contrato, entrará en vigor a partir de la fecha de este contrato.'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('7ª.- CARÁCTER MERCANTIL'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('Este contrato tiene carácter mercantil, y se regirá por sus propias claúsulas y en lo no previsto en las mismas, se regirá por lo previsto en el Código Comercio español, leyes mercantiles españolas complementarias y aplicables al caso, y con carácter subsidiario por el Código Civil español.'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('8ª.- MODIFICACIONES'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('Cualquier modificación de lo previsto en este contrato deberá formalizarse por escrito suscrito por las partes y anexado al mismo.'),0);
$pdf->Ln(5);

//mantenimiento
if(isset($servicios_data[2])) {
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(0,10,utf8_decode('9ª.- DURACIÓN'),0,1,'L');
    $pdf->SetFont('Arial','',12);
    $pdf->MultiCell(0,6,utf8_decode('El presente contrato tendrá una vigencia de DOS AÑOS desde la fecha de la firma. Transcurrido dicho término, el contrato se prorrogará automáticamente por idéntico periodo si ninguna de las partes comunica su deseo de finalizar la relación contractual con al menos un mes de antelación del final del tiempo estipulado.'),0);
    $pdf->Ln(10);
}

/* firmas */
$pdf->MultiCell(0,6,utf8_decode('Fdo. por el beneficiario                                                Fdo. por el prestatario'),0,'C');
$pdf->Ln(30);
$pdf->MultiCell(0,6,utf8_decode('    '.html_entity_decode($rep["nombre"]).'                                      D. Casimiro Galán Garrido'),0,'C');
/* Imprimimos */
$pdf->Output('CONTRATO-PRESTACION-SERVICIOS-'.html_entity_decode($customer->nombre).'.pdf','I');
?>