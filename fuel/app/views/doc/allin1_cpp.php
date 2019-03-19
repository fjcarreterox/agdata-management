<?php

class PDFp extends PDF_MC_Table{
    var $customer = "";

    function __construct($orientation='P', $unit='mm', $size='A4',$customer="NO DEFINIDO"){
        parent::__construct($orientation, $unit, $size);
        $this->customer = $customer;
    }

    function Header(){
        $this->SetFont('Arial','B',18);
        $this->Cell(0,25,utf8_decode('                DOCUMENTACIÓN LOPD'),0,0,'C');
        $this->Ln(5);
        $this->SetFont('Arial','',13);
        $this->Cell(0,45,utf8_decode("                         C.PP. ".mb_strtoupper(html_entity_decode($this->customer))),0,0,'C');
        $this->Ln(10);
        $this->Ln(10);
        $this->Image('http://gestion.agdata.es/assets/img/logo2.png',20,13,40);
        $this->Ln(10);
    }

    function Footer(){
        if($this->PageNo()!='{nb}') {
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10, utf8_decode('Página ' . $this->PageNo() . ' de {nb}'), 0, 0, 'C');
        }
    }
}
//$cname = str_replace("o-d","o'd",strtolower($cname));
//$dir = str_replace("o-d","o'd",strtolower($dir));
$cname = html_entity_decode($cname);
$dir = html_entity_decode($dir);
$loc = html_entity_decode($loc);
$prov = html_entity_decode($prov);

$pdf = new PDFp('P','mm','A4',$cname);

$pdf->AddFont('Arial','','arial.php');
$title = 'DOCUMENTOS LEGALES LOPD: DOCUMENTO DE SEGURIDAD PARA CPP';
$pdf->SetTitle($title);
$pdf->SetAuthor('Análisis y gestión de datos S.L.');
$pdf->SetMargins(20,6,20);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Ln(5);

$pdf->SetDrawColor(0, 80, 185);
$pdf->SetFillColor(255, 255, 255);

/* Customer name */
//First page
$pdf->SetFont('Arial','B',26);
$pdf->SetFillColor(255, 255, 155);
$pdf->Rect(25, 80, 160, 50, 10.5, 'DF');
$pdf->Ln(40);
$pdf->SetFont('Arial','B',28);
$pdf->MultiCell(0,12,strtoupper("comunidad de propietarios"),0,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',20);
$pdf->MultiCell(0,12,utf8_decode(mb_strtoupper(html_entity_decode($cname))),0,'C');
$pdf->Ln(10);

$date = date("m-Y",time());
$date_array=explode('-',$date);
$m = getMes($date_array[0]);
$date = "$m de $date_array[1]";

$pdf->SetFont('Arial','I',11);
$pdf->MultiCell(0,12,strtoupper($date),0,'C');
$pdf->Ln(20);

$pdf->SetFont('Arial','BUI',9);
$pdf->MultiCell(0,12,utf8_decode("NORMATIVA VIGENTE DE PROTECCIÓN DE DATOS"),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','I',9);
$pdf->MultiCell(0,6,utf8_decode("- REGLAMENTO (UE) 2016/679 DEL PARLAMENTO EUROPEO Y DEL CONSEJO, de 27 de abril de 2016, relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre circulación de estos datos (RGPD)"),0,'J');
$pdf->Ln(4);
$pdf->MultiCell(0,6,utf8_decode("- LEY ORGÁNICA 3/2018, de 5 de diciembre, de Protección de Datos Personales y garantía de los derechos digitales (LOPDGDD)"),0,'J');

//Index
$pdf->AddPage();
$pdf->Ln(10);
$pdf->SetFont('Arial','U',12);
$pdf->MultiCell(0,10,strtoupper('indice de contenido'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(5,6,utf8_decode('1. RESPONSABLE DEL TRATAMIENTO. PERSONAL CON ACCESO'),0,1,'L');$pdf->Ln(2);
$pdf->Cell(5,6,utf8_decode('2. REGISTRO DE ACTIVIDADES DE TRATAMIENTO'),0,1,'L');$pdf->Ln(2);
$pdf->Cell(5,6,utf8_decode('3. EVALUACIÓN DE IMPACTO EN PROTECCIÓN DE DATOS (EIPD)'),0,1,'L');$pdf->Ln(2);
$pdf->Cell(5,6,utf8_decode('4. ANÁLISIS DE RIESGOS'),0,1,'L');$pdf->Ln(2);
$pdf->Cell(5,6,utf8_decode('5. MEDIDAS DE SEGURIDAD'),0,1,'L');$pdf->Ln(2);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,6,utf8_decode('    5.1. Medidas organizativas '),0,1,'L');
$pdf->Cell(5,6,utf8_decode('    5.2. Medidas técnicas'),0,1,'L');$pdf->Ln(2);
$pdf->SetFont('Arial','',11);
$pdf->Cell(5,6,utf8_decode('6. REVISIONES PERIÓDICAS'),0,1,'L');$pdf->Ln(2);
$pdf->Cell(5,6,utf8_decode('7. ANEXOS'),0,1,'L');$pdf->Ln(2);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,6,utf8_decode('    I. Contratos de Cesión con Encargados de Tratamiento'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('    II. Cláusulas de Confidencialidad para empleados'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('    III. Documentos para el ejercicio de derechos'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('    IV. Registro de Incidencias'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('    V. Informe EIPD / Informe Análisis de Riesgos'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('    VI. Cláusula informativa en recepción de CVs'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('    VII. Otras cláusulas legales obligatorias'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('    VIII. Solicitud de acceso a imágenes de videovigilancia'),0,1,'L');

//1
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,strtoupper('1. RESPONSABLE DEL TRATAMIENTO Y PERSONAL CON ACCESO'),0,'L');
$pdf->Ln(5);

$pdf->SetDrawColor(0, 0, 0);
$pdf->SetWidths(array(45,120));
$pdf->SetAligns(array('L','L'));
$pdf->SetFont('Arial','B',10);
$pdf->Row(array("Denominación social:","C.PP. ".$cname));
$pdf->Row(array("C.I.F.:",$cif));
$pdf->Row(array("Dirección completa:",$dir.', '.$cp.', '.$loc.', '.$prov));
$pdf->Row(array("Correo electrónico:",$email));
$pdf->Row(array("Actividad principal:",$act));
$pdf->Row(array("Página web:",$web));
$pdf->Ln(10);

$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Personas con competencias en materia de protección de datos:'),0,'J');$pdf->Ln(2.5);

$pdf->SetWidths(array(45,55,65));
$pdf->SetAligns(array('C','C','C'));
$pdf->SetFont('Arial','B',10);
$pdf->Row(array("","Nombre completo","Datos de contacto (email, teléfono)"));
$pdf->SetFont('Arial','',10);
$pdf->SetAligns(array('L','L','L'));

$resp="";
if($pres['nombre']){$resp=html_entity_decode($pres['nombre']);}

$pdf->Row(array("Responsable de Seguridad:\n\n",$resp,$pres['tlfno']."\n\n".$pres['email']));
$pdf->Row(array("Responsable informático:\n\n","",""));
$pdf->Row(array("Delegado de protección de datos:\n\n","Análisis y Gestión de Datos SL",""));
$pdf->Ln(10);

$pdf->SetFont('Arial','U',10);
$pdf->MultiCell(0,6,utf8_decode('ENCARGADOS DE TRATAMIENTO'),0,'J');
$pdf->Ln(2.5);

$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Todas las empresas o terceros que tengan acceso a datos de los ficheros, para la prestación de servicios al responsable del tratamiento, deben suscribir un contrato de cesión de datos conforme al Art. 28 del Reglamento Europeo de Protección de Datos y adjuntarse al presente Protocolo de Seguridad (Anexo I).'),0,'J');
$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('En la actualidad, son:'),0,'J');
$pdf->Ln(10);
$pdf->SetWidths(array(65,50,50));
$pdf->SetAligns(array('C','C','C'));
$pdf->SetFont('Arial','B',10);
$pdf->Row(array("Encargado Tratamiento","Servicio prestado","Fecha firma contrato"));
$pdf->SetFont('Arial','',10);
for($i=0;$i<4;$i++) {
    $pdf->Row(array("\n\n", "\n\n", "\n\n"));
}

$pdf->AddPage();
$pdf->Ln(10);
$pdf->SetFont('Arial','U',10);
$pdf->MultiCell(0,6,utf8_decode('PERSONAL CON ACCESO A DATOS (CONTRATADOS POR EL RESPONSABLE)'),0,'J');
$pdf->Ln(5);
$pdf->SetWidths(array(45,20,40,35,25));
$pdf->SetAligns(array('C','C','C','C','C'));
$pdf->SetFont('Arial','B',10);
$pdf->Row(array("NOMBRE COMPLETO","DNI","CARGO / FUNCIÓN","TIPO ACCESO","CLÁUSULA FIRMADA"));
$pdf->SetFont('Arial','',10);
for($i=0;$i<18;$i++) {
    $pdf->Row(array("\n\n", "\n\n", "\n\n", "\n\n", "\n\n"));
}
$pdf->Ln(5);

$pdf->MultiCell(0,6,utf8_decode('* Las cláusulas de confidencialidad serán archivadas, una vez firmadas, en el Anexo II.'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('* A cada empleado con acceso, se le hará entrega de la información contenida en el punto 5.1.'),0,'J');

//2
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode(mb_strtoupper('2. REGISTRO DE ACTIVIDADES DE TRATAMIENTO')),0,'L');

$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('El artículo 30 del Reglamento Europeo de Protección de Datos (RGPD), exige al Responsable del Tratamiento mantener un registro de actividades de tratamiento donde se describan las medidas técnicas y organizativas de seguridad necesarias para garantizar la protección, confidencialidad, integridad y disponibilidad de los datos.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Una vez analizada la información necesaria, se describen a continuación las distintas actividades de tratamiento que lleva a cabo '.$cname.':'),0,'J');$pdf->Ln(2.5);
$pdf->Ln(2.5);

$pdf->SetDrawColor(0, 0, 0);
$level_ops = array("Básico","Medio","Alto");
$type_ops = array("Datos de carácter identificativo","Datos de características personales","Datos de circunstancias sociales","Datos académicos y profesionales","Datos de detalles de empleo","Datos de información comercial","Datos económico-financieros y de seguros","Datos de transacciones","Datos especialmente protegidos");
$base_ops = array("consent"=>"Consentimiento del interesado","interes"=>"Interés legítimo","ejecucion"=>"Ejecución de un contrato");
$origen_ops = array("propio"=>"El propio interesado o su representante legal","fuentes"=>"Fuentes accesibles al público","entpriv"=>"Entidades privadas","entpub"=>"Entidades públicas");
$recogida_ops = array("personalmente"=>"Personalmente","forms"=>"Formularios","email"=>"E-mail","internet"=>"Internet");

foreach($files as $f){
    $pdf->SetWidths(array(65,100));
    $pdf->SetAligns(array('L','L'));
    $pdf->SetFont('Arial','B',10);
    $pdf->Row(array("ACTIVIDAD DE TRATAMIENTO:",mb_strtoupper($f["name"])));
    $pdf->SetFont('Arial','',10);
    if($f["base"]==""){$base="N/D";}
    else{$base=$base_ops[$f["base"]];}
    $pdf->Row(array("BASE DE LEGITIMACIÓN",mb_strtoupper($base)));
    $categorias="";
    $cat=array();
    $sdata = Model_Rel_Estructura::find('all',array('where'=>array('idfichero'=>$f['id'])));
    foreach($sdata as $sd){
        $datatype=Model_Tipo_Dato::find($sd["idtipodato"]);
        $cat[]=$type_ops[$datatype->tipo];
    }
    $categorias=implode("\n", array_unique($cat));
    $pdf->Row(array("CATEGORÍA DE DATOS",mb_strtoupper($categorias)));
    $pdf->Row(array("SISTEMA DE TRATAMIENTO",mb_strtoupper($f["supp"])));
    if($f["origen"]==""){$origen="N/D";}
    else{$origen=$origen_ops[$f["origen"]];}
    $pdf->Row(array("ORIGEN DE LOS DATOS",mb_strtoupper($origen)));
    if($f["recogida"]==""){$rec="N/D";}
    else{$rec=$recogida_ops[$f["recogida"]];}
    $pdf->Row(array("PROCEDIMIENTO DE RECOGIDA",mb_strtoupper($rec)));
    $pdf->Row(array("DURACIÓN DE OPERACIONES","HASTA FIN DE CONTRATO"));
    $pdf->Row(array("PLAZO PARA SUPRESIÓN DATOS","5 AÑOS SEGÚN NORMATIVA"));
    $pdf->Row(array("TRANSFERENCIA INTENACIONAL","NO SE CONTEMPLAN"));
    $ces_names="";
    foreach($ces as $c) {
        $ces_name="";
        if(strcmp($c->idfichero,$f['id'])==0) {
            if ($c->idcesionaria != 0) {
                $ces_name = Model_Cliente::find($c->idcesionaria)->get("nombre");
            }
        }
        if($ces_names==""){$ces_names=html_entity_decode($ces_name);}
        else{$ces_names.="\n".html_entity_decode($ces_name);}
    }
    $pdf->Row(array("ENCARGADOS DE TRATAMIENTO",mb_strtoupper($ces_names)));
    $pdf->Ln(10);
}

//3
$pdf->AddPage();
$pdf->Ln(10);
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode(strtoupper('3. EVALUACIÓN DE IMPACTO EN PROTECCIÓN DE DATOS')),0,'L');

$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('El Reglamento Europeo de Protección de Datos (RGPD) obliga al Responsable del Tratamiento a analizar y evaluar el impacto de sus actividades de tratamiento sobre los derechos y libertades de las personas cuyos datos trata.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('En los casos en los que dichos tratamientos supongan un riesgo significativo, el Responsable del Tratamiento deberá realizar una Evaluación de Impacto en Protección de Datos (EIPD).'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('En '.$cname.' no procede realizar una EIPD, puesto que no se cumple ninguna de las condiciones marcadas por la normativa vigente para su realización, como son:'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('  - Los tratamientos de datos a gran escala (de varias categorías de datos, extensión geográfica).'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('  - Los tratamientos de datos especialmente protegidos o de menores, discapacitados, ancianos,...'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('  - Los tratamientos de datos personales a través de tecnologías como Big Data, internet de las cosas, drones, geolocalización, radiofrecuencia o técnicas genéticas.'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('  - Finalidades de monitorización o evaluación sistemática de aspectos personales, para analizar hábitos, intereses... o para elaborar perfiles de usuarios o realizar segmentaciones de mercado.'),0,'J');$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('Asimismo, se respetan los principios recogidos en el Art. 5 del Reglamento Europeo de Protección de Datos relativos a la:'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('  - Licitud, lealtad y transparencia'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('  - Limitación de la finalidad'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('  - Minimización de datos'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('  - Exactitud de los datos'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('  - Limitación del plazo de conservación'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('  - Integridad y confidencialidad'),0,'J');
$pdf->Ln(5);


//4
$pdf->AddPage();
$pdf->Ln(10);
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode(strtoupper('4. ANÁLISIS DE RIESGOS')),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('En los casos en que los tratamientos de datos no supongan un riesgo significativo para los derechos y libertades de las personas, el Responsable del Tratamiento tan sólo deberá llevar a cabo una evaluación básica de riesgos.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Dicha evaluación consistirá en definir las medidas de seguridad necesarias para garantizar, por un lado, la integridad, disponibilidad y confidencialidad de los datos personales y, por otro lado, garantizar el ejercicio de derechos de los interesados y los principios legales relativos al tratamiento.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Una vez efectuado el análisis, se verifica la correcta implantación de las siguientes medidas de seguridad:'),0,'J');$pdf->Ln(2.5);

$pdf->Ln(5);
$pdf->SetFont('Arial','BU',10);
$pdf->MultiCell(0,6,utf8_decode('INTEGRIDAD'),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('- Segregación de funciones mediante perfiles de acceso'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('- Controles de monitorización de amenazas en red'),0,'J');$pdf->Ln(2.5);

$pdf->Ln(5);
$pdf->SetFont('Arial','BU',10);
$pdf->MultiCell(0,6,utf8_decode('DISPONIBILIDAD'),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('- Copias de seguridad'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('- Almacenamiento en dos ubicaciones diferentes'),0,'J');$pdf->Ln(2.5);

$pdf->Ln(5);
$pdf->SetFont('Arial','BU',10);
$pdf->MultiCell(0,6,utf8_decode('CONFIDENCIALIDAD'),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('- Mecanismos de control de acceso'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('- Segmentación de la red'),0,'J');$pdf->Ln(2.5);

$pdf->Ln(5);
$pdf->SetFont('Arial','BU',10);
$pdf->MultiCell(0,6,utf8_decode('MEDIDAS LEGALES'),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('- Procedimientos y canales para el ejercicio de derechos'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('- Cláusulas informativas y base de legitimación para el tratamiento'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('- Monitorización del uso de datos personales'),0,'J');$pdf->Ln(2.5);

$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('En el siguiente apartado se detallan las medidas de seguridad adicionales necesarias para reducir el nivel de exposición al riesgo.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Dichas medidas de seguridad deberán revisarse periódicamente para verificar su efectividad.'),0,'J');$pdf->Ln(2.5);


//5
$pdf->AddPage();
$pdf->Ln(10);
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode(mb_strtoupper('5. MEDIDAS DE SEGURIDAD')),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('El artículo 5.1.f) del Reglamento General de Protección de Datos (RGPD) determina la necesidad de establecer garantías de seguridad adecuadas contra el tratamiento no autorizado o ilícito, contra la pérdida de los datos personales, la destrucción o el daño accidental.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Esto implica el establecimiento de medidas técnicas y organizativas encaminadas a asegurar la integridad y confidencialidad de los datos personales y la posibilidad (artículo 5.2) de demostrar que estas medidas se han llevado a la práctica (responsabilidad proactiva).'),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('5.1. Medidas organizativas.'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Las personas con acceso a los datos de carácter personal y a los sistemas de información deben tener sus funciones y obligaciones claramente definidas, debiendo conocer y respetar las medidas de seguridad que afectan a las funciones que tiene encomendadas.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('El responsable del tratamiento adoptará las medidas necesarias para que el personal conozca las normas de seguridad que afecten al desarrollo de sus funciones, así como las consecuencias en que pudiera incurrir en caso de incumplimiento. Con este fin se distribuirá una copia del punto 5 de este documento para su conocimiento.'),0,'J');
$pdf->Ln(5);
$pdf->SetFont('Arial','U',10);
$pdf->MultiCell(0,6,utf8_decode('FUNCIONES Y OBLIGACIONES DEL PERSONAL CON ACCESO AUTORIZADO A DATOS'),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Todo el personal con acceso a los datos personales deberá tener conocimiento de las siguientes obligaciones con relación a los tratamientos de datos personales:'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - Se deberá evitar el acceso de personas no autorizadas a los datos personales, a tal fin se evitará: dejar los datos personales expuestos a terceros (pantallas electrónicas desatendidas, documentos en papel en zonas de acceso público, soportes con datos personales, etc.). Cuando se ausente del puesto de trabajo, se procederá al bloqueo de la pantalla o al cierre de la sesión.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - Los documentos en papel y soportes electrónicos se almacenarán en lugar seguro (armarios con llave o estancias de acceso restringido al personal autorizado).'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - No se desecharán documentos o soportes electrónicos (cd, pen drives, discos duros, etc.) con datos personales sin garantizar su destrucción, previo borrado de los datos.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - La realización de copias de documentos con datos personales únicamente podrá ser efectuadas bajo el control de personal con acceso autorizado.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - Se procederá a la destrucción de las copias desechadas o inútiles, para evitar en lo posible el acceso a la información en ellas contenida.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - En los casos de traslado físico de la documentación contenida en un fichero, el Responsable de Seguridad adoptarán las medidas dirigidas a impedir el acceso o manipulación de la información objeto de traslado.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - No se comunicarán datos personales o cualquier información confidencial a terceros sin la autorización escrita del titular del dato, y se prestará especial atención en no divulgar datos personales protegidos durante las llamadas telefónicas, correos electrónicos, etc.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - Si existiese alguna incidencia, el personal debe notificarla al responsable del fichero o al responsable de seguridad.'),0,'J');
$pdf->Ln(5);
$pdf->SetFont('Arial','U',10);
$pdf->MultiCell(0,6,utf8_decode('PROCEDIMIENTO PARA EL EJERCICIO DE LOS DERECHOS DE LOS INTERESADOS'),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('En cumplimiento de lo establecido en el artículo 12.1 del RGPD, el Responsable del Tratamiento debe adoptar las medidas oportunas para facilitar al interesado información sobre el tratamiento de sus datos, debiendo hacerlo de una forma inteligible, concisa, transparente y de fácil acceso.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Los Responsable del Tratamiento  pueden atender este derecho habilitando un acceso remoto a un sistema seguro que ofrezca al interesado un acceso directo a sus datos personales.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('La solicitud de ejercicio de derechos debe ser efectuada por el propio afectado, o representante legal, lo que se comprobará mediante la correspondiente acreditación.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('El Responsable del Tratamiento se encargará personalmente de la tramitación de las solicitudes de los interesados que reúnan los requisitos establecidos en este procedimiento, desde la recepción de la misma hasta la finalización de las gestiones correspondientes e información al interesado, y siempre dentro de los plazos establecidos.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('La carga de la prueba  recae sobre el responsable del tratamiento, que tendrá que justificar documentalmente que ha contestado a los derechos de acceso, rectificación, cancelación u oposición.'),0,'J');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(0,6,utf8_decode('Derecho de acceso'),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Es la facultad que tiene toda persona física de solicitar y obtener gratuitamente del responsable del tratamiento, información de sus datos personales sometidos a tratamiento, su finalidad, el origen de los datos, así como las comunicaciones o cesiones a terceros realizadas o previstas.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Ante la recepción de una solicitud de acceso del interesado a sus datos personales, el responsable del tratamiento deberá contestarle EN EL PLAZO DE UN MES desde la recepción de la solicitud, incluyendo toda la información que se mantenga concerniente al interesado.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Igualmente, se debe averiguar si estos datos han sido cedidos a algún tercero, indicándole al interesado, en caso afirmativo la empresa o entidad a la que han sido cedidos y los usos concretos del cesionario.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Se podrá denegar el acceso a los datos de carácter personal cuando el derecho se haya ejercitado de forma efectiva en un intervalo inferior a doce meses y no se acredite un interés legítimo al efecto, así como cuando la solicitud sea formulada por persona distinta del afectado que no le represente legalmente.'),0,'J');$pdf->Ln(2.5);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(0,6,utf8_decode('Derecho a la portabilidad de datos'),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Es un complemento al derecho de acceso y otorga al interesado el derecho a recibir su información en un formato estructurado, de uso habitual y lectura mecánica, para poder transmitirlo a otro responsable de tratamiento.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('El responsable del tratamiento deberá contestar EN EL PLAZO DE UN MES desde la recepción de la solicitud, incluyendo toda la información que se mantenga concerniente al interesado.'),0,'J');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(0,6,utf8_decode('Derecho de rectificación'),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Es el derecho del afectado a que se modifiquen los datos que le conciernen que sean inexactos o incompletos. El responsable del tratamiento deberá contestar EN EL PLAZO DE UN MES desde la recepción de la solicitud, salvo que sea imposible o exija un esfuerzo desproporcionado.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Si los datos rectificados hubieran sido comunicados a terceros, se deberá notificar la rectificación o cancelación a quien se hayan comunicado, para que procedan del mismo modo.'),0,'J');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(0,6,utf8_decode('Derecho de cancelación, supresión o derecho al olvido '),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('El derecho de cancelación da lugar a la supresión de los datos, una vez bloqueados durante los plazos legales previstos en la normativa, dejándolos a disposición de las Administraciones Públicas, Jueces y Tribunales, para la atención de las posibles responsabilidades nacidas del tratamiento.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Si los datos cancelados hubieran sido comunicados a terceros, se deberá notificar la cancelación a quien se hayan comunicado, para que procedan del mismo modo.'),0,'J');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(0,6,utf8_decode('Derecho al olvido'),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Es el traslado al mundo digital de los derechos de cancelación y oposición y podrá ser ejercido por el interesado cuando exista un motivo legítimo y fundado respecto a su concreta situación personal que justifique el derecho de oposición solicitado.'),0,'J');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(0,6,utf8_decode('Derechos de oposición a la cesión de datos personales'),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('El interesado podrá oponerse en cualquier momento al tratamiento de sus datos personales y sin coste alguno.'),0,'J');$pdf->Ln(2.5);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('Los modelos de solicitud para cada uno de los derechos de los interesados, así como los modelos de las posibles respuestas para cada uno de los derechos, se adjuntan en el Anexo III.'),0,'J');
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('5.2. Medidas técnicas de seguridad.'),0,'L');
$pdf->SetFont('Arial','U',10);
$pdf->MultiCell(0,6,utf8_decode('SALVAGUARDA DEL SISTEMA INFORMÁTICO'),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('El acceso a los locales u oficinas donde se encuentren los ficheros con datos personales, deberá estar restringido exclusivamente al personal autorizado para su tratamiento o aquél que deba realizar labores de mantenimiento para las que sea imprescindible el acceso físico.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('ACTUALIZACIÓN DE ORDENADORES Y DISPOSITIVOS: Los dispositivos y ordenadores utilizados para el almacenamiento y el tratamiento de los datos personales deberán mantenerse actualizados en la media posible.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('MALWARE: En los ordenadores y dispositivos donde se realice el tratamiento automatizado de los datos personales se dispondrá de un sistema de antivirus que evite en la medida posible el robo y/o destrucción de la información y datos personales. El sistema de antivirus deberá ser actualizado de forma periódica.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('CORTAFUEGOS O FIREWALL: Para evitar accesos remotos indebidos a los datos personales se velará para garantizar la existencia de un firewall activado en aquellos ordenadores y dispositivos en los que se realice el almacenamiento y/o tratamiento de datos personales.'),0,'J');
$pdf->Ln(5);
$pdf->SetFont('Arial','U',10);
$pdf->MultiCell(0,6,utf8_decode('IDENTIFICACIÓN Y AUTENTICACIÓN DE USUARIOS'),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Todos los usuarios autorizados para acceder a los ficheros deberán tener un código de usuario que será único y que estará asociado a la contraseña correspondiente, que sólo será conocida por el propio usuario.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Este sistema de seguridad informático permitirá la identificación inequívoca y personalizada de todo aquel usuario que intente acceder al sistema de información y la verificación de que está autorizado. De esta forma, se garantiza que personas no autorizadas puedan acceder a ficheros con datos de carácter personal.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Se recomienda disponer de perfiles con derechos de administración para la instalación y configuración del sistema, y usuarios sin privilegios o derechos de administración, para el acceso a los datos personales. Esta medida evitará que en caso de ataque de ciberseguridad puedan obtenerse privilegios de acceso o modificar el sistema operativo.'),0,'J');
$pdf->Ln(5);
$pdf->SetFont('Arial','U',10);
$pdf->MultiCell(0,6,utf8_decode('SOPORTES CON DATOS PERSONALES'),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Los soportes informáticos que contengan datos de carácter personal se almacenarán en un espacio cerrado bajo llave custodiado por personal con acceso.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('En caso de inutilización, el soporte deberá ser físicamente destruido de tal forma que no pueda volver a utilizarse con posterioridad.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Antes de desecharse cualquier documento con datos personales, debe procederse a su destrucción empleando destructora de papel o contratando la tarea de destrucción a una empresa especializada que garantice el proceso.'),0,'J');
$pdf->Ln(5);
$pdf->SetFont('Arial','U',10);
$pdf->MultiCell(0,6,utf8_decode('CONTRASEÑAS PERSONALES'),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Cada usuario será responsable de la confidencialidad de su contraseña y, en caso de que la misma sea conocida fortuita o fraudulentamente por personas no autorizadas, deberá ser inmediatamente comunicada al responsable correspondiente.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('En ningún caso se compartirán las contraseñas ni se dejarán anotadas en lugar común y el acceso de personas distintas del usuario.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('La contraseña tendrá al menos 8 caracteres, mezcla de números y letras. La periodicidad con la que tienen que ser cambiadas las contraseñas es de una vez al año.'),0,'J');
$pdf->Ln(5);
$pdf->SetFont('Arial','U',10);
$pdf->MultiCell(0,6,utf8_decode('COPIAS DE SEGURIDAD Y PROCEDIMIENTO DE RECUPERACIÓN'),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Las copias de respaldo se almacenarán en lugar seguro, distinto de aquél en que esté ubicado el equipo con los ficheros originales, con el fin de permitir la recuperación de los datos personales en caso de pérdida de la información.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Existirá una persona responsable de supervisar periódicamente la existencia de copias de seguridad actualizadas de cada fichero con datos de carácter personal.'),0,'J');
$pdf->Ln(5);
$pdf->SetFont('Arial','U',10);
$pdf->MultiCell(0,6,utf8_decode('CIFRADO DE DATOS'),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Cuando se precise sacar datos personales fuera de las oficinas donde se realiza su tratamiento, ya sea por medios físicos o por medios electrónicos, se deberá valorar la posibilidad de utilizar un método de encriptación para garantizar la confidencialidad de los datos personales en caso de acceso indebido a la información por parte de personas no autorizadas.'),0,'J');
$pdf->Ln(5);
$pdf->SetFont('Arial','U',10);
$pdf->MultiCell(0,6,utf8_decode('FICHEROS TEMPORALES O COPIAS DE TRABAJO'),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Todo fichero temporal o copia de trabajo, creado por tiempo determinado, deberá cumplir las mismas medidas de seguridad que los ficheros de datos originales, y serán borrados o destruidos una vez que hayan dejado de ser necesarios para los fines que motivaron su creación.'),0,'J');
$pdf->Ln(5);
$pdf->SetFont('Arial','U',10);
$pdf->MultiCell(0,6,utf8_decode('GESTIÓN DE INCIDENCIAS DE SEGURIDAD'),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Una incidencia es cualquier evento que pueda producirse esporádicamente y pueda suponer un peligro para la seguridad de los ficheros, como pueden ser:'),0,'J');$pdf->Ln(2.5);

$pdf->SetDrawColor(255, 255, 255);
$pdf->SetWidths(array(70,70));
$pdf->SetAligns(array('L','L'));
$pdf->SetFont('Arial','',10);
$pdf->Row(array("   - Accesos no autorizados","- Errores de software"));
$pdf->Row(array("   - Acceso autorizado imposible","- Incidencias con soportes"));
$pdf->Row(array("   - Distribución no autorizada de datos","- Incidencias de cifrado"));
$pdf->Row(array("   - Pérdida de datos","- Incidencia de recuperación"));
$pdf->Row(array("   - Fugas de información","- Caídas de servidores"));
$pdf->Row(array("   - Acceso físico a los datos","- Virus"));
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('Cualquier incidencia que se produzca en el tratamiento y gestión de los ficheros será comunicada, en un plazo máximo de veinticuatro horas desde su aparición, al Responsable correspondiente, quien dejará constancia de la misma en el Registro de Incidencias (Anexo IV).'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('El Responsable del Tratamiento adoptará las medidas pertinentes en cada caso e implantará las acciones necesarias para dar una respuesta adecuada a la incidencia.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('La notificación o registro de una incidencia deberá constar al menos de los siguientes datos: tipo de incidencia, fecha y hora en que se produjo, persona que realiza la notificación, persona a quien se comunica, efectos que puede producir y descripción detallada de la misma. Se mantendrán las incidencias registradas de los doce últimos meses.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('El Registro de Incidencias también se cumplimentará en los casos que se haga necesaria una recuperación de datos de las copias de seguridad.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Las violaciones de seguridad que impliquen riesgos significativos para los derechos de los interesados, deberán notificarse sin dilación a la Agencia Española de Protección de Datos, en las 72 horas posteriores a que haya tenido constancia de ella.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('En dicha notificación se incluirá toda la información necesaria para el esclarecimiento de los hechos que hubieran dado lugar al acceso indebido a los datos. La notificación se realizará por medios electrónicos a través de la sede electrónica de la Agencia Española de Protección de Datos en la dirección: https://sedeagpd.gob.es'),0,'J');$pdf->Ln(2.5);

//6
$pdf->AddPage();
$pdf->Ln(10);
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode(mb_strtoupper('6. REVISIONES PERIÓDICAS')),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Las medidas de seguridad implantadas deberán ser revisadas siempre que se produzcan cambios relevantes en el sistema de información, en el sistema de tratamiento empleado, en la organización o en el contenido de la información incluida en los ficheros o tratamientos.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('En concreto, se realizarán, mensualmente, las siguientes tareas:'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('- Verificar la existencia de copias de seguridad actualizadas y en lugar distinto a los ficheros'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('- Verificar si existen cambios en la lista de personal con acceso a ficheros (altas/bajas)'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('- Comprobar si existen nuevas comunicaciones o cesiones de datos personales a terceros'),0,'J');
$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Anualmente, se realizarán, además, las siguientes tareas:'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('- Verificar si existen cambios en los tratamientos registrados o existen nuevos tratamientos'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('- Realizar cambios de contraseñas en todos los equipos para el personal con acceso a datos'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('- Verificar el correcto cumplimiento de todas las medidas de seguridad implantadas'),0,'J');$pdf->Ln(2.5);

//7
$pdf->AddPage();
$pdf->Ln(10);
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,strtoupper(utf8_decode('7. ANEXOS')),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('I. Contratos de Cesión con Encargados de Tratamiento'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('II. Cláusulas de Confidencialidad para empleados'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('III. Documentos para el ejercicio de derechos'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('IV. Registro de Incidencias'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('V. Informe EIPD / Informe Análisis de Riesgos'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('VI. Cláusula informativa en recepción de CVs'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('VII. Otras cláusulas legales obligatorias'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('VIII. Solicitud de acceso a imágenes de videovigilancia'),0,'J');$pdf->Ln(2.5);

//Anexo I
$pdf->AddPage();
$pdf->SetFont('Arial','B',26);
$pdf->SetFillColor(255, 255, 155);
$pdf->SetDrawColor(0, 80, 185);
$pdf->Rect(25, 80, 160, 60, 10.5, 'DF');
$pdf->Ln(50);
$pdf->SetFont('Arial','B',28);
$pdf->MultiCell(0,12,strtoupper("ANEXO I"),0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',20);
$pdf->MultiCell(0,12,utf8_decode("CONTRATOS DE CESIÓN\nCON ENCARGADOS DE TRATAMIENTO"),0,'C');

//Anexo II
$pdf->AddPage();
$pdf->SetFont('Arial','B',26);
$pdf->Rect(25, 80, 160, 60, 10.5, 'DF');
$pdf->Ln(50);
$pdf->SetFont('Arial','B',28);
$pdf->MultiCell(0,12,strtoupper("ANEXO II"),0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',20);
$pdf->MultiCell(0,12,utf8_decode("CLÁUSULAS DE CONFIDENCIALIDAD\nPARA EMPLEADOS AUTORIZADOS"),0,'C');

//Anexo III
$pdf->AddPage();
$pdf->SetFont('Arial','B',26);
$pdf->Rect(25, 80, 160, 60, 10.5, 'DF');
$pdf->Ln(50);
$pdf->SetFont('Arial','B',28);
$pdf->MultiCell(0,12,strtoupper("ANEXO III"),0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',20);
$pdf->MultiCell(0,12,utf8_decode("MODELOS DE SOLICITUD Y RESPUESTA\nPARA EL EJERCICIO DE DERECHOS"),0,'C');

$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$pdf->Ln(10);
$pdf->MultiCell(0,6,utf8_decode('A continuación se relacionan los distintos modelos de cartas de solicitud que deberán facilitarse a aquéllos interesados que soliciten el ejercicio de alguno de sus derechos contemplados en la normativa de protección de datos.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('En concreto, son:'),0,'J');
$pdf->Ln(10);
$pdf->MultiCell(0,6,utf8_decode('   - SOLICITUD DE EJERCICIO DEL DERECHO DE ACCESO'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - SOLICITUD DE EJERCICIO DEL DERECHO DE PORTABILIDAD'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - MODELO DE RESPUESTA al ejercicio del derecho de acceso o de portabilidad'),0,'J');
$pdf->Ln(10);
$pdf->MultiCell(0,6,utf8_decode('   - SOLICITUD DE EJERCICIO DEL DERECHO DE RECTIFICACIÓN'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - MODELO DE RESPUESTA al ejercicio del derecho de rectificación'),0,'J');
$pdf->Ln(10);
$pdf->MultiCell(0,6,utf8_decode('   - SOLICITUD DE EJERCICIO DEL DERECHO DE OPOSICIÓN (CANCELACIÓN)'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - MODELO DE RESPUESTA al ejercicio del derecho de oposición (cancelación)'),0,'J');

//Anexo IV
$pdf->AddPage();
$pdf->SetFont('Arial','B',26);
$pdf->Rect(25, 80, 160, 50, 10.5, 'DF');
$pdf->Ln(50);
$pdf->SetFont('Arial','B',28);
$pdf->MultiCell(0,12,strtoupper("ANEXO IV"),0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',20);
$pdf->MultiCell(0,12,utf8_decode("REGISTROS DE INCIDENCIAS"),0,'C');

$pdf->AddPage();
$pdf->Ln(5);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetFont('Arial','',10);
$pdf->SetWidths(array(80,90));
$pdf->SetAligns(array('L','L'));
$pdf->Row(array("\nFecha de notificación:\n\n","\n* Incidencia nº:\n\n"));

$pdf->SetWidths(array(80,90));
$pdf->SetAligns(array('L','L'));
$pdf->Row(array("\nTipo de incidencia:\n\n","\nFecha y hora de la incidencia:\n\n"));

$pdf->SetWidths(array(170));
$pdf->SetAligns(array('L'));
$pdf->Row(array("Descripción detallada de la incidencia:\n\n\n\n"));

$pdf->SetWidths(array(170));
$pdf->SetAligns(array('L'));
$pdf->Row(array("Recursos afectados o posibles efectos:\n\n"));

$pdf->SetWidths(array(170));
$pdf->SetAligns(array('L'));
$pdf->Row(array("* Acciones correctoras:\n\n\n"));

$pdf->MultiCell(0,10,utf8_decode('* A rellenar por el Responsable de Seguridad.'),0,'L');
$pdf->Ln(10);

$pdf->SetFont('Arial','B',12);
$pdf->SetWidths(array(170));
$pdf->SetAligns(array('C'));
$pdf->Row(array("\nPROCEDIMIENTO DE RECUPERACIÓN DE DATOS **\n\n"));

$pdf->SetFont('Arial','',10);
$pdf->SetWidths(array(80,90));
$pdf->SetAligns(array('L','L'));
$pdf->Row(array("Fichero afectado:","Soporte empleado:"));

$pdf->SetWidths(array(80,90));
$pdf->SetAligns(array('L','L'));
$pdf->Row(array("Persona encargada del proceso:","Fecha y hora:"));

$pdf->SetWidths(array(170));
$pdf->SetAligns(array('L'));
$pdf->Row(array("Procedimiento realizado:\n\n\n\n"));

$pdf->SetWidths(array(170));
$pdf->SetAligns(array('L'));
$pdf->Row(array("Datos restaurados:\n\n"));

$pdf->SetWidths(array(170));
$pdf->SetAligns(array('L'));
$pdf->Row(array("Datos recuperados manualmente:\n\n\n"));

$pdf->SetWidths(array(170));
$pdf->SetAligns(array('L'));
$pdf->Row(array("Incidencias durante el proceso:\n\n\n"));

$pdf->SetWidths(array(80,90));
$pdf->SetAligns(array('L','L'));
$pdf->Row(array("Persona que realiza la comunicación:\n\n\nFirma:","Responsable de Seguridad:\n\n\nFirma:"));
$pdf->MultiCell(0,10,utf8_decode('** A rellenar sólo si la incidencia es de este tipo.'),0,'L');

//Anexo V
$pdf->AddPage();
$pdf->SetDrawColor(0, 80, 185);
$pdf->SetFont('Arial','B',26);
$pdf->Rect(25, 80, 160, 60, 10.5, 'DF');
$pdf->Ln(50);
$pdf->SetFont('Arial','B',28);
$pdf->MultiCell(0,12,strtoupper("ANEXO V"),0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',20);
$pdf->MultiCell(0,12,utf8_decode("INFORME EIPD\nINFORME ANÁLISIS DE RIESGOS"),0,'C');

//Anexo VI
$pdf->AddPage();
$pdf->SetFont('Arial','B',26);
$pdf->Rect(25, 80, 160, 60, 10.5, 'DF');
$pdf->Ln(50);
$pdf->SetFont('Arial','B',28);
$pdf->MultiCell(0,12,strtoupper("ANEXO VI"),0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',20);
$pdf->MultiCell(0,12,utf8_decode("CLÁUSULA INFORMATIVA\nEN LA RECEPCIÓN DE CVS"),0,'C');

//Anexo VII
$pdf->AddPage();
$pdf->SetFont('Arial','B',26);
$pdf->Rect(25, 80, 160, 60, 10.5, 'DF');
$pdf->Ln(50);
$pdf->SetFont('Arial','B',28);
$pdf->MultiCell(0,12,strtoupper("ANEXO VII"),0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',20);
$pdf->MultiCell(0,12,utf8_decode("OTRAS CLÁUSULAS\nLEGALES OBLIGATORIAS"),0,'C');

//Anexo VIII
$pdf->AddPage();
$pdf->SetFont('Arial','B',26);
$pdf->Rect(25, 80, 160, 60, 10.5, 'DF');
$pdf->Ln(50);
$pdf->SetFont('Arial','B',28);
$pdf->MultiCell(0,12,strtoupper("ANEXO VIII"),0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',20);
$pdf->MultiCell(0,12,utf8_decode("SOLICITUD DE ACCESO\nA IMÁGENES DE VIDEOVIGILANCIA"),0,'C');

// Write all to the output
$pdf->Output("DOC-SEGURIDAD-C.PP.-".$cname."-COMPLETO.pdf",'I');