<?php

class PDF extends FPDF
{
    function Header(){
        $this->SetFont('Arial','B',15);
        $this->Ln(10);
        $this->Cell(0,10,utf8_decode('     CONTRATO DE PRESTACIÓN DE SERVICIOS     '),0,0,'C');
        $this->Ln(15);
    }

    function Footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().' de {nb}',0,0,'C');
    }
}

$contrato=$contract;
$tratamiento_ops = array("D.","Dª");
$pdf = new PDF();

$pdf->SetTitle(utf8_decode('Contrato de prestación de servicios'));
$pdf->SetAuthor('Análisis y gestión de datos S.L.');

$pdf->SetMargins(20,10,20);
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
$pdf->Ln(10);
$coinc="";
if(strcmp($rep->nombre,$aaff['nombre'])!=0){
    $coinc= ', en nombre y representación de '.html_entity_decode($aaff['nombre']);
}
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('   De una parte, D. Juan Andrés Carretero García, mayor de edad, con DNI nº 28.770.539-T, en nombre y representación de ANÁLISIS Y GESTIÓN DE DATOS, S.L. (AGDATA), con domicilio social en Calle Matrona María Jesús Corchero Delgado, nº 60, C.P. 41111, Almensilla, y CIF nº  B-91341297 (en adelante, EL PRESTATARIO).'),0);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('   De otra, '.$tratamiento_ops[$rep->tratamiento] .' '. html_entity_decode($rep->nombre).', mayor de edad, con DNI nº '.$rep->dni.$coinc.' con CIF '.$aaff["cif_nif"].', con domicilio social en '.html_entity_decode($aaff["direccion"]).', C.P. '.$aaff["cpostal"].' de '.html_entity_decode($aaff["loc"]).' ('.html_entity_decode($aaff["prov"]).'), sociedad que ejerce su actividad de administración de fincas, y actúa como mandataria de la Comunidad de Propietarios '.html_entity_decode($customer->nombre).', con CIF nº '.$customer->cif_nif.' (en adelante, EL BENEFICIARIO).'),0);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('   Ambas partes (en adelante "las partes") se reconocen mutua y recíprocamente, la capacidad legal necesaria y suficiente para el otorgamiento del presente contrato mercantil y'),0);
$pdf->Ln(5);

/* manifiestan */
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'MANIFIESTAN',0,1,'C');
$pdf->Ln(10);

$periodo_ops = array(12=>'mensualmente',4=>'trimestral',2=>'semestralmente',1=>'anualmente',0=>'Pago único');
foreach($services as $s):
    $nombre = Model_Servicio::find($s->idtipo_servicio)->get('nombre');
    $num_cuotas=1;
    if($s->periodicidad != 0){
        if($s->idtipo_servicio == 1){$num_cuotas=$s->periodicidad;}
        else{$num_cuotas=2*$s->periodicidad;}
    }
    $servicios_data = array(
        "nombre"=> $nombre,
        "tipo"=>$s->idtipo_servicio,
        "precio"=> $s->importe,
        "periodicidad"=> $periodo_ops[$s->periodicidad],
        "cuota"=> $s->cuota,
        "num_cuotas" => $num_cuotas,
        "pago"=> $s->forma_pago,
        "mes_factura"=>$s->mes_factura,
        "year"=>$s->year
    );
endforeach;

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'PRIMERA',0,1,'L');
$pdf->SetFont('Arial','',11);

$s=array();
$s["LOPD"]='EL PRESTATARIO desarrolla, como asesoría jurídica, la prestación de servicios de consultoría en materia de Protección de Datos de Carácter Personal en aras a la adecuación de todo tipo de entidades y profesionales a la Ley Orgánica 3/2018 de Protección de Datos de Carácter Personal y Garantía de derechos digitales (LOPDGDD) y al Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales (Reglamento Europeo de Protección de Datos).';
$s["CAE"]='EL PRESTATARIO desarrolla, entre otras, la prestación de servicios de consultoría en materia de Coordinación de Actividades Empresariales (CAE), en aras al cumplimiento por parte de sus clientes de la Ley 31/1995, de 8 de noviembre, de Prevención de Riesgos Laborales (LPRL) y del Real Decreto 171/2004, de 30 de enero, en materia de coordinación de actividades empresariales. Todo ello, de conformidad con el Real Decreto 39/1997, de 17 de enero, por el que se aprueba el Reglamento de los Servicios de Prevención.';
$s["NEOS"]='EL PRESTATARIO desarrolla, entre otras, la actividad de gestión de notificaciones electrónicas y certificados digitales, en aras al cumplimiento por parte de todo tipo de entidades y profesionales de la Ley 39/2015, de 1 de octubre, del Procedimiento Administrativo Común de las Administraciones Públicas, y de la Ley 40/2015, de 1 de octubre, de Régimen Jurídico del Sector Público, en lo referente a las comunicaciones emitidas por los organismos públicos mediante notificaciones electrónicas.';

$tercera="";
$more="";
switch ($nombre):
    case "LOPD+CAE+NEOS":
        $pdf->MultiCell(0,6,utf8_decode('Que '.$s["LOPD"]),0);
        $pdf->Ln(5);
        $pdf->MultiCell(0,6,utf8_decode('Que, asimismo, '.$s["CAE"]),0);
        $pdf->Ln(5);
        $pdf->MultiCell(0,6,utf8_decode('Que, igualmente, '.$s["NEOS"]),0);
        $more=", por un lado,";
        $tercera="ASESORAMIENTO EN MATERIA DE PROTECCIÓN DE DATOS, así como de ASESORAMIENTO EN MATERIA DE COORDINACIÓN DE ACTIVIDADES EMPRESARIALES, y la prestación de servicios de NOTIFICACIONES ELECTRÓNICAS Y CERTIFICADOS DIGITALES";
        $objeto="asesoramiento y consultoría en materia de Coordinación de Actividades Empresariales, por otro, la prestación de servicios de gestión de notificaciones electrónicas y certificados digitales, así como, la prestación de los servicios de adaptación y mantenimiento en materia de protección de datos";
        break;
    case "LOPD+CAE":
        $pdf->MultiCell(0,6,utf8_decode('Que '.$s["LOPD"]),0);
        $pdf->Ln(5);
        $pdf->MultiCell(0,6,utf8_decode('Que, asimismo, '.$s["CAE"]),0);
        $pdf->Ln(5);
        $more=", por un lado,";
        $tercera="ASESORAMIENTO EN MATERIA DE PROTECCIÓN DE DATOS, así como de ASESORAMIENTO EN MATERIA DE COORDINACIÓN DE ACTIVIDADES EMPRESARIALES";
        $objeto="asesoramiento y consultoría en materia de Coordinación de Actividades Empresariales, y por otro, la prestación de los servicios de adaptación y mantenimiento en materia de protección de datos";
        break;
    case "LOPD+NEOS":
    $pdf->MultiCell(0,6,utf8_decode('Que '.$s["LOPD"]),0);
    $pdf->Ln(5);
    $pdf->MultiCell(0,6,utf8_decode('Que, asimismo, '.$s["NEOS"]),0);
    $pdf->Ln(5);
    $more=", por un lado,";
    $tercera="ASESORAMIENTO EN MATERIA DE PROTECCIÓN DE DATOS, así como de prestación de servicios de GESTIÓN DE NOTIFICACIONES ELECTRÓNICAS Y CERTIFICADOS DIGITALES";
    $objeto="gestión de notificaciones electrónicas y certificados digitales, y por otro, la prestación de los servicios de adaptación y mantenimiento en materia de protección de datos";
    break;
    case "CAE+NEOS":
        $pdf->MultiCell(0,6,utf8_decode('Que '.$s["NEOS"]),0);
        $pdf->Ln(5);
        $pdf->MultiCell(0,6,utf8_decode('Que, asimismo, '.$s["CAE"]),0);
        $pdf->Ln(5);
        $more=", por un lado,";
        $tercera="ASESORAMIENTO EN MATERIA DE COORDINACIÓN DE ACTIVIDADES EMPRESARIALES, así como de prestación de servicios de GESTIÓN DE NOTIFICACIONES ELECTRÓNICAS Y CERTIFICADOS DIGITALES";
        $objeto="gestión de notificaciones electrónicas y certificados digitales, y por otro, de los servicios de asesoramiento y consultoría en materia de Coordinación de Actividades Empresariales";
        break;
    case "LOPD":
        $pdf->MultiCell(0,6,utf8_decode('Que '.$s["LOPD"]),0);
        $pdf->Ln(5);
        $tercera="ASESORAMIENTO EN MATERIA DE PROTECCIÓN DE DATOS";
        $objeto="adaptación y mantenimiento en materia de protección de datos";
        break;
    case "CAE":
        $pdf->MultiCell(0,6,utf8_decode('Que '.$s["CAE"]),0);
        $pdf->Ln(5);
        $tercera="ASESORAMIENTO EN MATERIA DE COORDINACIÓN DE ACTIVIDADES EMPRESARIALES";
        $objeto="asesoramiento y consultoría en materia de Coordinación de Actividades Empresariales";
        break;
    case "NEOS":
        $pdf->MultiCell(0,6,utf8_decode('Que '.$s["NEOS"]),0);
        $pdf->Ln(5);
        $tercera="GESTIÓN DE NOTIFICACIONES ELECTRÓNICAS Y CERTIFICADOS DIGITALES";
        $objeto="gestión de notificaciones electrónicas y certificados digitales";
        break;
endswitch;

$pdf->Ln(10);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'SEGUNDA',0,1,'L');
$pdf->SetFont('Arial','',11);
$pdf->MultiCell(0, 6, utf8_decode('Que el BENEFICIARIO está constituido como Comunidad de Propietarios, cuya administración está gestionada por el Administrador de Fincas indicado en la cabecera.'), 0);
$pdf->Ln(10);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'TERCERA',0,1,'L');
$pdf->SetFont('Arial','',11);
$pdf->MultiCell(0,6,utf8_decode('Que, conforme a los expositivos precedentes, ambas partes han convenido en el otorgamiento del presente contrato de '.$tercera.', que se regirán por lo dispuesto en el Código de Comercio y el Código Civil, y de forma especial por las siguientes:'),0);
$pdf->Ln(10);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,6,utf8_decode('CLÁUSULAS'),0,1,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,6,utf8_decode('1ª.- OBJETO Y DESCRIPCIÓN DEL SERVICIO'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('El objeto del presente contrato es'.$more.' la prestación al BENEFICIARIO de los servicios de '.$objeto.' descritos a continuación.'),0);
$pdf->Ln(5);
if(strpos($nombre,"NEOS")>=0 && strpos($nombre,"NEOS")!==false) {
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(0, 6, utf8_decode('Servicio de solicitud y obtención de certificado digital:'), 0);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(5);
    $pdf->MultiCell(0, 6, utf8_decode('- D. Juan Andrés Carretero García, representante legal del PRESTATARIO, como gestor administrativo colegiado, dispone de un convenio de colaboración firmado con la Autoridad de Certificación UANATACA SA, entidad emisora de certificados digitales reconocidos y homologados, lo que le habilita como operador de registro para gestionar la solicitud y obtención de cualquier tipo de certificado digital (persona física, jurídica o entidad sin personalidad jurídica).'), 0);
    $pdf->Ln(5);
    $pdf->MultiCell(0, 6, utf8_decode('- El certificado digital del BENEFICIARIO, necesario para la prestación del servicio de gestión de notificaciones electrónicas obligatorias, será generado con una validez de 2 años, renovable. Todos los certificados digitales generados serán remitidos al administrador de fincas.'), 0);
    $pdf->Ln(5);
    $pdf->MultiCell(0, 6, utf8_decode('- Para la generación del certificado digital, el administrador de fincas facilitará al PRESTATARIO la siguiente documentación relativa a la comunidad de propietarios: CIF de la Comunidad de Propietarios, Acta de Constitución o Legalización del Libro de Actas diligenciado, y Acta de Nombramiento del Administrador de Fincas o último acta con la renovación de su cargo.'), 0);
    $pdf->Ln(5);
    $pdf->MultiCell(0, 6, utf8_decode('- En caso de prorrogarse el presente contrato y llegue el plazo de validez del certificado durante su vigencia, el PRESTATARIO procederá a renovarlo automáticamente por igual período de dos años, para lo cual solicitará al administrador de fincas el último Acta aprobada con la renovación de su cargo como secretario/administrador.'), 0);
    $pdf->Ln(5);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(0, 6, utf8_decode('Servicios de notificaciones electrónicas obligatorias (NEOS):'), 0);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(5);
    $pdf->MultiCell(0, 6, utf8_decode('- El PRESTATARIO realizará la gestión, vigilancia y el envío de notificaciones electrónicas a través la plataforma INTERNEOS, licenciada por la entidad EDOR-TEAM ANDALUCIA SL.'), 0);
    $pdf->Ln(5);
    $pdf->MultiCell(0, 6, utf8_decode('- Para la correcta configuración del servicio, el PRESTATARIO dará de alta al BENEFICIARIO con su certificado digital, en los buzones correspondientes de la Agencia Tributaria (DEH) y de la Seguridad Social. El acceso a dichos buzones se realizará de forma diaria, de lunes a viernes.'), 0);
    $pdf->Ln(5);
    $pdf->MultiCell(0, 6, utf8_decode('- Descarga automática: los envíos de las notificaciones electrónicas se realizarán de forma automática, mediante archivo adjunto y en formato pdf, directamente a la dirección de correo electrónico facilitada por el administrador de fincas, siendo éste el responsable de notificar al PRESTATARIO su deseo de modificar la dirección de correo electrónico para notificaciones electrónicas de la Comunidad de Propietarios.'), 0);
    $pdf->Ln(5);
    $pdf->MultiCell(0, 6, utf8_decode('- El PRESTATARIO, en todo caso, mantendrá en sus servidores una copia de seguridad de las notificaciones descargadas en plazo, con el objetivo de que las mismas puedan ser recuperadas fácilmente en caso de ser necesario.'), 0);
    $pdf->Ln(5);
}
if(strpos($nombre,"CAE")>=0 && strpos($nombre,"CAE")!==false) {
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(0, 6, utf8_decode('Servicio de asesoramiento en CAE (Coordinación de Actividades Empresariales):'), 0);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(5);
    $pdf->MultiCell(0, 6, utf8_decode('- A.G.DATA, a través de un cuestionario de evaluación de riesgos, recabará toda la información de la Comunidad de Propietarios, necesaria para realizar una completa Evaluación de Riesgos.'), 0);
    $pdf->Ln(5);
    $pdf->MultiCell(0, 6, utf8_decode('- Dicha Evaluación de Riesgos, realizada por un Técnico Superior en Prevención de Riesgos Laborales, generará un Informe de Riesgos en el que se definirán las medidas preventivas y de emergencia que debe facilitar la comunidad, a las empresas que contraten con ella cualquier servicio contemplado en el Informe.'), 0);
    $pdf->Ln(5);
    $pdf->MultiCell(0, 6, utf8_decode('- Periódicamente, A.G.DATA revisará el cumplimiento del deber de información para con estas empresas y realizará, de forma anual, una nueva Evaluación de Riesgos, siempre que varíen sustancialmente las condiciones iniciales de la Comunidad de Propietarios recogidas en el cuestionario de evaluación inicial.'), 0);
    $pdf->Ln(5);
}
if(strpos($nombre,"LOPD")>=0 && strpos($nombre,"LOPD")!==false) {
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(0, 6, utf8_decode('Servicios de adaptación y mantenimiento LOPD (Protección de Datos):'), 0);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(5);
    $pdf->MultiCell(0, 6, utf8_decode('- Elaboración de toda la Documentación necesaria para asegurar el correcto cumplimiento de la normativa vigente en materia de protección de datos: Registro de Actividades de Tratamiento, contratos de cesión de datos, cláusulas legales para mails, cláusulas de confidencialidad para empleados, etc.'), 0);
    $pdf->Ln(5);
    $pdf->MultiCell(0, 6, utf8_decode('- Recordatorio mensual mediante correo electrónico de los controles periódicos y tareas de revisión que deberá realizar el administrador de fincas para detectar posibles cambios.'), 0);
    $pdf->Ln(5);
    $pdf->MultiCell(0, 6, utf8_decode('- Modificaciones posteriores en la Documentación LOPD del BENEFICIARIO, que deban realizarse cuando se produzcan las situaciones contempladas en la normativa que impliquen su modificación.'), 0);
    $pdf->Ln(5);
    $pdf->MultiCell(0, 6, utf8_decode('-  Redacción de documentos, contratos y cláusulas legales que resulten necesarios para asegurar el correcto cumplimiento de la normativa vigente en protección de datos.'), 0);
    $pdf->Ln(5);
    $pdf->MultiCell(0, 6, utf8_decode('-  Asesoramiento continuo y resolución de cualquier tipo de consulta planteada por el BENEFICIARIO en materia de protección de datos.'), 0);
    $pdf->Ln(5);
}
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('2ª.- PRECIO'),0,1,'L');
$pdf->SetFont('Arial','',12);
$meses=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$pdf->MultiCell(0, 6, utf8_decode('El precio fijado para los servicios descritos, a ser percibido por ANÁLISIS Y GESTIÓN DE DATOS S.L., asciende a un total de '.$servicios_data["precio"].' EUROS, impuestos no incluidos, que serán facturados anualmente por el PRESTATARIO a la Comunidad de Propietarios.'), 0);
$pdf->Ln(5);
$pdf->MultiCell(0, 6, utf8_decode('La primera domiciliación será girada por el PRESTATARIO durante los cinco primeros días del mes de '.$meses[$servicios_data["mes_factura"]-1].' de '.$servicios_data["year"].', en la cuenta del BENEFICIARIO con código IBAN nº '.$customer->iban.'.'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('3ª.- CONFIDENCIALIDAD Y PROTECCIÓN DE DATOS'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('Ambas partes se comprometen y obligan a guardar la máxima confidencialidad en toda la información y/o documentación, relativa al BENEFICIARIO y/o a sus clientes que, sin ser de dominio público, se ponga a disposición del PRESTATARIO en el marco de la prestación de los servicios definidos en el presente contrato.'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('4ª.- CAUSAS DE RESOLUCIÓN DEL CONTRATO'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('1. Falta de cumplimiento de cualquiera de las obligaciones que figuran en el presente Contrato.'),0);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('2. De la misma manera, procederá en especial la resolución de este contrato cuando alguna de las partes hubiere sido declarada en concurso de acreedores o cuando estuviera en situación técnica de insolvencia provisional.'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('5ª.- ENTRADA EN VIGOR'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('El presente contrato, entrará en vigor a partir de la fecha de la firma de este contrato.'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('6ª.- DURACIÓN'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('El presente contrato tendrá una vigencia de DOS AÑOS desde la fecha de la firma. Transcurrido dicho término, el contrato se prorrogará automáticamente por idéntico periodo si ninguna de las partes comunica su deseo de finalizar la relación contractual con al menos un mes de antelación respecto al final del tiempo estipulado.'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('7ª.- CARÁCTER MERCANTIL'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('Este contrato tiene carácter mercantil, y se regirá por sus propias cláusulas y en lo no previsto en las mismas, se regirá por lo previsto en el Código Comercio español, leyes mercantiles españolas complementarias y aplicables al caso, y con carácter subsidiario por el Código Civil español.'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('8ª.- MODIFICACIONES'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('Cualquier modificación de lo previsto en este contrato deberá formalizarse por escrito suscrito por las partes y anexado al mismo.'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('9ª.- NULIDAD PARCIAL'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('Toda cláusula o disposición del presente contrato que sea declarada nula, ilegal o inválida, no afectará ni invalidará ninguna de las demás cláusulas y disposiciones, las cuales permanecerán plenamente vigentes.'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('10ª.- FUERO'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('Las partes, con expresa renuncia al fuero que pudiere corresponderles, acuerdan que todo litigio, discrepancia, cuestión o reclamación resultantes de la interpretación, cumplimiento, ejecución o resolución del presente contrato o relacionado con este, directa o indirectamente, se resolverá ante los Juzgados y Tribunales de Sevilla capital.'),0);
$pdf->Ln(20);

/* firmas */
$tratamiento_ops = array("D.","Dª");
$pdf->MultiCell(0,6,utf8_decode('Fdo. por el BENEFICIARIO                       Fdo. por el PRESTATARIO'),0,'C');
$pdf->Ln(30);
$pdf->MultiCell(0,6,utf8_decode('    '.html_entity_decode($tratamiento_ops[$rep["tratamiento"]]).' '.html_entity_decode($rep["nombre"]).'                                   D. Juan Andrés Carretero García'),0,'C');
/* Imprimimos */
$pdf->Output('CONTRATO '.$nombre.' - CPP. '.html_entity_decode($customer->nombre).'.pdf','I');
?>