<?php

class PDFp extends PDF_MC_Table{
    var $customer = "";

    function __construct($orientation='P', $unit='mm', $size='A4',$customer="NO DEFINIDO"){
        parent::__construct($orientation, $unit, $size);
        $this->customer = $customer;
    }

    function Header(){
        $this->SetFont('Arial','B',18);
        $this->Cell(0,25,utf8_decode('                DOCUMENTO DE SEGURIDAD'),0,0,'C');
        $this->Ln(5);
        $this->SetFont('Arial','I',13);
        $this->Cell(0,35,utf8_decode("                         Comunidad de propietarios"),0,0,'C');
        $this->Ln(3);
        $this->Cell(0,45,utf8_decode("                         ".html_entity_decode($this->customer)),0,0,'C');
        $this->Ln(10);
        $this->Ln(10);
        //$this->Image('http://localhost/public/assets/img/logo2.png',20,13,40);
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
$pdf->Rect(25, 75, 160, 70, 10.5, 'DF');
$pdf->Ln(30);
$pdf->Cell(0,10,utf8_decode('DOCUMENTO DE SEGURIDAD'),0,0,'C');
$pdf->Ln(15);
$pdf->SetFont('Arial','',16);
$pdf->MultiCell(0,12,strtoupper('responsable de los ficheros'),0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',20);
$pdf->MultiCell(0,12,strtoupper("comunidad de propietarios"),0,'C');
$pdf->MultiCell(0,12,utf8_decode(mb_strtoupper(html_entity_decode($cname))),0,'C');
$pdf->Ln(10);

$date = date("m-Y",time());
$date_array=explode('-',$date);
$m = getMes($date_array[0]);
$date = "$m de $date_array[1]";

$pdf->SetFont('Arial','I',11);
$pdf->MultiCell(0,12,strtoupper($date),0,'C');

//Index
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
$pdf->MultiCell(0,10,strtoupper('indice'),0,'L');

$pdf->SetFont('Arial','',11);
$pdf->Cell(5,6,'1. OBJETO',0,1,'L');$pdf->Ln(2);
$pdf->Cell(5,6,utf8_decode(mb_strtoupper('2. ámbito de aplicación')),0,1,'L');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,6,utf8_decode('   2.1. Ámbito legal'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('   2.2. Ámbito personal'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('   2.3. Ámbito material'),0,1,'L');$pdf->Ln(2);
$pdf->SetFont('Arial','',11);
$pdf->Cell(5,6,'3. FUNCIONES Y OBLIGACIONES DEL PERSONAL',0,1,'L');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,6,utf8_decode('   3.1. Normas generales'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('   3.2. Funciones y obligaciones'),0,1,'L');$pdf->Ln(2);
$pdf->SetFont('Arial','',11);
$pdf->Cell(5,6,'4. PROCEDIMIENTOS Y NORMAS DE SEGURIDAD',0,1,'L');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,6,utf8_decode('   4.1. Centros de tratamiento y locales'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('   4.2. Puestos de trabajo'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('   4.3. Sistema de información'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('   4.4. Aplicaciones de acceso a los ficheros'),0,1,'L');$pdf->Ln(2);
$pdf->SetFont('Arial','',11);
$pdf->Cell(5,6,utf8_decode('5. GESTIÓN DE INCIDENCIAS'),0,1,'L');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,6,utf8_decode('   5.1. Notificación y gestión de incidencias'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('   5.2. Registro de incidencias'),0,1,'L');$pdf->Ln(2);
$pdf->SetFont('Arial','',11);
$pdf->Cell(5,6,utf8_decode('6. GESTIÓN DE SOPORTES'),0,1,'L');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,6,utf8_decode('   6.1. Identificación, inventario, reutilización y destrucción de soportes'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('   6.2. Entrada y salida de soportes'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('   6.3. Distribución de soportes'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('   6.4. Soportes en papel de ficheros no automatizados'),0,1,'L');$pdf->Ln(2);
$pdf->SetFont('Arial','',11);
$pdf->Cell(5,6,utf8_decode('7. COPIAS DE RESPALDO Y RECUPERACIÓN'),0,1,'L');$pdf->Ln(2);
$pdf->Cell(5,6,'8. EJERCICIO DE LOS DERECHOS DE LOS INTERESADOS',0,1,'L');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,6,utf8_decode('   8.1. Recepción de solicitudes'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('   8.2. Derecho de acceso'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('   8.3. Derechos de rectificación y cancelación'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('   8.4. Derecho de oposición a facilitar datos personales'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('   8.5. Derecho de oposición a la cesión de datos personales'),0,1,'L');$pdf->Ln(2);
$pdf->SetFont('Arial','',11);
$pdf->Cell(5,6,utf8_decode('9. COPIAS DE RESPALDO Y RECUPERACIÓN'),0,1,'L');$pdf->Ln(2);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,6,utf8_decode('   9.1. Recepción de solicitudes'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('   9.2. Derecho de acceso'),0,1,'L');
$pdf->SetFont('Arial','',11);
$pdf->Cell(5,6,'10. EJERCICIO DE LOS DERECHOS DE LOS INTERESADOS',0,1,'L');
$pdf->SetFont('Arial','',11);
$pdf->Cell(5,6,'11. ANEXOS',0,1,'L');

//Pag 1
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,strtoupper('1. objeto'),0,'L');

$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('El presente documento responde a la obligación establecida en el artículo 88 del Capítulo II, del Real Decreto 1720/2007, de 21 de diciembre, por el que se aprueba el Reglamento de desarrollo de la Ley Orgánica 15/1999, de 13 de diciembre, de Protección de Datos de Carácter Personal.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('En este Documento de Seguridad se recogerán todas aquellas medidas de índole técnica y organizativa que deben reunir los ficheros con datos de carácter personal pertenecientes a la CDAD.PROP. '.$cname.' situada en '.$dir.' con C.P. '.$cp.' en '.$loc.', provincia de '.$prov.'.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Los procedimientos y normas de seguridad recogidas en el Documento de Seguridad serán de obligado cumplimiento para todos aquéllos que tengan acceso a los ficheros con datos de carácter personal, automatizados o en papel, según lo dispuesto en el Reglamento de desarrollo de la LOPD anteriormente mencionado.'),0,'J');

$pdf->Ln(5);

//2.1
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode(mb_strtoupper('2. Ámbito de aplicación')),0,'L');
$pdf->MultiCell(0,10,utf8_decode('2.1. Ámbito legal'),0,'L');

$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Este documento ha sido elaborado bajo la responsabilidad del presidente de dicha Comunidad de Propietarios quien, como representante de la comunidad y, por lo tanto, Responsable de los Ficheros, se compromete a implantar los procedimientos recogidos en el presente documento y mantenerlos actualizados dentro del ámbito de aplicación de la normativa vigente en protección de datos.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('El Documento de Seguridad deberá ser revisado periódicamente por el Responsable de los Ficheros, con el fin de identificar cambios relevantes en el mismo. '),0,'J');$pdf->Ln(2.5);

//2.2
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('2.2. Ámbito personal'),0,'L');

$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Todas las personas físicas que tengan acceso a los ficheros objeto del Documento de Seguridad y a los datos en ellos contenidos, se encuentran obligadas por ley a cumplir lo establecido en este documento, y quedan sujetas a las consecuencias que pudieran incurrir en caso de incumplimiento.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('La relación de personas físicas con acceso autorizado a los ficheros protegidos, se detalla en el Anexo II: "Listado de usuarios con acceso a los ficheros." del presente Documento de Seguridad.'),0,'J');$pdf->Ln(2.5);

//2.3
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('2.3. Ámbito material'),0,'L');

$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Los recursos que quedarán bajo el ámbito de aplicación del Documento de Seguridad son:'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('     - Locales o dependencias donde se encuentren ubicados los ficheros o se almacenen los soportes que los contengan.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('       - Puestos de trabajo y sistemas informáticos desde los que se acceda a los ficheros. '),0,'J');$pdf->Ln(2.5);
$pdf->Ln(5);

$str="mantiene un fichero con datos de carácter personal, el cual ha sido convenientemente notificado";
if(count($files>1)){$str="mantienen ".count($files)." ficheros con datos de carácter personal, los cuales han sido convenientemente notificados";}
$pdf->MultiCell(0,6,utf8_decode('La Comunidad de Propietarios '.$str.' a la Agencia Española de Protección de Datos para su inscripción en el Registro General de Protección de Datos.'),0,'J');$pdf->Ln(2.5);

$pdf->Ln(5);
$pdf->SetDrawColor(0, 0, 0);

$pdf->SetWidths(array(60,55,55));
$pdf->SetAligns(array('C','C','C'));
$pdf->SetFont('Arial','B',10);
$pdf->Row(array("NOMBRE FICHERO","SOPORTE","NIVEL DE SEGURIDAD"));
$pdf->SetFont('Arial','',10);
foreach($files as $f){
    $pdf->SetWidths(array(60,55,55));
    $pdf->SetAligns(array('C','C','C'));
    $pdf->Row(array($f["name"],$f["supp"],html_entity_decode($f["level_name"])));

}
$pdf->Ln(5);

$str="del fichero declarado";
if(count($files>1)){$str="de los ficheros declarados";}
$pdf->MultiCell(0,6,utf8_decode('La descripción y tipología '.$str.' por la Comunidad de Propietarios viene especificada en el Anexo I: "Ficheros de datos declarados y resoluciones de la AEPD" del presente documento.'),0,'J');$pdf->Ln(2.5);
$levels = array("N/D","BÁSICO","MEDIO","ALTO");
$pdf->MultiCell(0,6,utf8_decode('Una vez analizada la tipología de los ficheros a proteger, se recogerán en el Documento de Seguridad, con carácter general, los procedimientos y normas de seguridad establecidas como de nivel '.$levels[$max_level].'.'),0,'J');$pdf->Ln(2.5);

$str1="del fichero identificado";
$str2="del fichero";
if(count($files>1)){$str1="de los ficheros identificados";$str2="de los ficheros";}
$pdf->MultiCell(0,6,utf8_decode('El Responsable de los Ficheros ha procedido a notificar al Registro General de Protección de Datos (RGPD) la creación '.$str1.'. Dichas notificaciones así como las correspondientes resoluciones de inscripción '.$str2.' se adjuntan en el Anexo I: "Ficheros de datos declarados y resoluciones de la AEPD". del Documento de Seguridad.'),0,'J');$pdf->Ln(2.5);

$pdf->Ln(5);

//3.1
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode(strtoupper('3. Funciones y obligaciones del personal')),0,'L');
$pdf->MultiCell(0,10,utf8_decode('3.1. Normas generales'),0,'L');

$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('La Comunidad de Propietarios '.$cname.', designa como Responsable de Seguridad al Presidente vigente de la Comunidad, quien desempeñará las funciones propias de coordinación y control de las medidas de seguridad implantadas en materia de protección de datos.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('En ningún caso, la designación del Responsable de Seguridad supone la delegación de la responsabilidad que corresponde al Responsable de los Ficheros, quién conservará todas aquellas funciones que le corresponden, según lo establecido en la LOPD.'),0,'J');$pdf->Ln(2.5);

//3.2
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('3.2. Funciones y obligaciones'),0,'L');

$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Las personas con acceso autorizado a los ficheros, detalladas en el Anexo II de este documento, guardará absoluta confidencialidad sobre los datos accedidos y, en ningún caso, dará a los mismos un tratamiento distinto al previsto, actuando de acuerdo con las normas y medidas de seguridad que en este Documento de Seguridad se describen.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Asimismo, dicho personal comunicará al Responsable de Seguridad, cualquier incidencia que surja durante el proceso de tratamiento de los ficheros.'),0,'J');$pdf->Ln(2.5);

$pdf->Ln(5);

//4.1
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode(strtoupper('4. Procedimientos y normas de seguridad')),0,'L');
$pdf->MultiCell(0,10,utf8_decode('4.1. Centros de tratamiento'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('El acceso a los locales u oficinas donde se encuentren los ficheros, deberá estar restringido exclusivamente al personal autorizado para su tratamiento o aquél que deba realizar labores de mantenimiento para las que sea imprescindible el acceso físico.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0, 6, utf8_decode('La administración y gestión de los ficheros de la Comunidad de Propietarios se lleva a cabo tanto en ' . html_entity_decode($dir) . ' con C.P. ' . $cp . ' en ' . $loc . ', provincia de ' . $prov . ', como en las instalaciones de su Administrador de Fincas, ' . $reps[0]["nombre_aaff"] . ', situadas en ' . html_entity_decode($reps[0]["dir"]) . ' con C.P. ' . $reps[0]["cp"] . ' en ' . $reps[0]["loc"] . ', provincia de ' . $reps[0]["prov"] . '.'), 0, 'J');
$pdf->Ln(2.5);


if($num_reps > 1) {
    $i=1;
    while($i<$num_reps) {
        $pdf->MultiCell(0, 6, utf8_decode('También en las instalaciones de su otra Administradora de Fincas, ' . $reps[$i]["nombre_aaff"] . ', situadas en ' . html_entity_decode($reps[$i]["dir"]) . ' con C.P. ' . $reps[$i]["cp"] . ' en ' . $reps[$i]["loc"] . ', provincia de ' . $reps[$i]["prov"] . '.'), 0, 'J');
        $pdf->Ln(2.5);
        $i++;
    }
}

//4.2
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('4.2. Puestos de trabajo'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Son todos aquellos dispositivos desde los cuales se puede acceder a los datos contenidos en los ficheros, como pueden ser terminales u ordenadores personales.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Cada puesto de trabajo estará bajo la responsabilidad de una persona de las autorizadas en el Anexo II, quién garantizará que la información que muestra su equipo no pueda ser vista por personas no autorizadas. Esto implica que tanto las pantallas como las impresoras u otro tipo de dispositivos conectados al puesto de trabajo deberán estar físicamente ubicados en lugares que garanticen esa confidencialidad.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Cuando el responsable de un puesto de trabajo lo abandone, bien temporalmente o bien al finalizar su turno de trabajo, deberá dejarlo en un estado que impida la visualización de los datos protegidos. Esto podrá realizarse a través de un protector de pantalla que impida la visualización de los datos.'),0,'J');$pdf->Ln(2.5);

//4.3
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('4.3. Sistema de información'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Todos los usuarios autorizados para acceder a los ficheros deberán tener un código de usuario que será único y que estará asociado a la contraseña correspondiente, que sólo será conocida por el propio usuario.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Este sistema de seguridad informático permitirá la identificación inequívoca y personalizada de todo aquel usuario que intente acceder al sistema de información y la verificación de que está autorizado. De esta forma, se garantiza que personas no autorizadas puedan acceder a ficheros con datos de carácter personal.'),0,'J');$pdf->Ln(2.5);

//4.4
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('4.4. Salvaguarda y protección de las contraseñas personales'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Las contraseñas personales constituyen uno de los componentes básicos de la seguridad de los datos y deben por tanto estar especialmente protegidas.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Las contraseñas deberán ser estrictamente confidenciales y personales, y cualquier incidencia que comprometa su confidencialidad deberá ser inmediatamente comunicada al Responsable de Seguridad, se cumplimentará el oportuno Registro de Incidencias y será subsanada en el menor plazo de tiempo posible.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('El Responsable del Seguridad, o la persona por él autorizada, asignarán las claves a cada usuario y cuidará de que se cambien al menos con una periodicidad semestral. Ambas claves quedarán registradas de forma cifrada e ininteligible.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Cada usuario será responsable de la confidencialidad de su contraseña y, en caso de que la misma sea conocida fortuita o fraudulentamente por personas no autorizadas, deberá registrarlo como incidencia y proceder inmediatamente a su cambio.'),0,'J');$pdf->Ln(2.5);

$pdf->Ln(5);

//5.1
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode(mb_strtoupper('5. Gestión de incidencias')),0,'L');
$pdf->MultiCell(0,10,utf8_decode('5.1. Notificación y gestión de incidencias'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Una incidencia es cualquier evento que pueda producirse esporádicamente y pueda suponer un peligro para la seguridad de los ficheros, como pueden ser: accesos no autorizados, cambios de contraseña, fugas de información, fallos en los procesos de copias de respaldo o recuperación de datos, caídas de servidores, etc.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Cualquier incidencia que se produzca en el tratamiento y gestión de los ficheros será comunicada, en un plazo máximo de veinticuatro horas desde su aparición, al Responsable de los Ficheros, dejando constancia de ella en el registro correspondiente.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('El Responsable de los Ficheros adoptará las medidas pertinentes en cada caso e implantará las acciones necesarias para dar una respuesta adecuada a la incidencia, pudiendo plantear incluso la modificación del Documento de Seguridad si fuese necesario.'),0,'J');$pdf->Ln(2.5);

//5.2
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('5.2. Registro de Incidencias'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Los Responsables de Seguridad habilitará un Registro de Incidencias a disposición de todas las personas con acceso a los ficheros, con el fin de que se detalle en él cualquier incidencia que pueda suponer un peligro para la seguridad de los mismos.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('La notificación o registro de una incidencia deberá constar al menos de los siguientes datos: tipo de incidencia, fecha y hora en que se produjo, persona que realiza la notificación, persona a quien se comunica, efectos que puede producir y descripción detallada de la misma. Se mantendrán las incidencias registradas de los doce últimos meses.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('En el Anexo V: "Registro de Incidencias" de este documento, se recoge el modelo para el registro de las incidencias.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('El Registro de Incidencias también recogerá los procedimientos de recuperación de datos realizados, tal y como se describe en el punto 7 del presente documento "COPIAS DE RESPALDO Y RECUPERACIÓN".'),0,'J');$pdf->Ln(2.5);

//6.1
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode(mb_strtoupper('6. Gestión de soportes')),0,'L');
$pdf->MultiCell(0,10,utf8_decode('6.1. Identificación, inventario, reutilización y destrucción de soportes'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Los soportes informáticos que contengan datos de carácter personal serán identificados mediante una inscripción en una etiqueta adhesiva, con el tipo de información que contengan, y se almacenarán en un espacio cerrado bajo llave custodiado por el Responsable de Seguridad. Su acceso para la recepción y manipulación de estos soportes quedará reservado al personal autorizado en el Anexo II.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Cuando el soporte deba reutilizarse en un procedimiento de recuperación de datos, el Responsable de Seguridad establecerá las medidas encaminadas a garantizar que la información sustituida y obsoleta no pueda ser recuperada. '),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('En caso de inutilización, el soporte deberá ser físicamente destruido de tal forma que no pueda volver a utilizarse con posterioridad.'),0,'J');$pdf->Ln(2.5);

//6.2
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('6.2. Distribución de soportes'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Cuando se haga necesaria la distribución o transporte de un soporte con datos de carácter personal, el Responsable de Seguridad procurará el cifrado de dicha información o establecerá un procedimiento técnico similar que impida la inteligibilidad o manipulación de los datos durante su transporte.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Deberá evitarse, en lo posible, el tratamiento de datos de carácter personal en dispositivos portátiles que no permitan su cifrado.'),0,'J');$pdf->Ln(2.5);

//6.3
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('6.3. Soportes en papel de ficheros no automatizados'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('El acceso a la documentación del fichero que la Comunidad mantiene en soporte papel, como es "COMUNIDAD DE PROPIETARIOS", quedará limitado al personal expresamente autorizado por el Responsable de Seguridad en el Anexo II: "Listado de usuarios con acceso a los ficheros".'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Los armarios, archivadores y otros elementos empleados para almacenar estos ficheros deberán encontrarse en áreas cuyo acceso esté protegido con puertas de acceso restringido mediante llave o dispositivo equivalente.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('La realización de copias o la reproducción de estos documentos únicamente podrán ser efectuadas bajo el control del personal autorizado por el Responsable de Seguridad.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Se procederá a la destrucción de las copias desechadas o inútiles, para evitar en lo posible el acceso a la información en ellas contenida.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('En los casos de traslado físico de la documentación contenida en un fichero, el Responsable de Seguridad adoptarán las medidas dirigidas a impedir el acceso o manipulación de la información objeto de traslado.'),0,'J');$pdf->Ln(2.5);

$pdf->Ln(5);
//7
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,strtoupper(utf8_decode('7. copias de respaldo y recuperación')),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('El Responsable de Seguridad se encargará de autorizar la ejecución de los procedimientos de respaldo y recuperación de datos, así como de verificar la definición y correcta aplicación de estos procedimientos de realización de copias que, en caso de fallo del sistema informático, permitan recuperar y en su caso reconstruir los datos de los ficheros.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Existirá una persona, bien sea el Responsable de Seguridad o bien otro usuario expresamente designado, que será responsable de supervisar periódicamente las copia de seguridad de cada fichero con datos de carácter personal, a efectos de respaldo y posible recuperación en caso de fallo.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Los soportes empleados para efectuar las copias deberán garantizar la reconstrucción de los datos de carácter personal al estado en que se encontraba dicha información antes de su pérdida o destrucción.'),0,'J');$pdf->Ln(2.5);

//8
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,strtoupper(utf8_decode('8. ejercicio de los derechos de los interesados')),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('En cumplimiento de lo establecido en los artículos 15 y 16 de la LOPD, la Comunidad definirá las tareas necesarias y establecerá los criterios aplicables a seguir ante una solicitud de un interesado, relativa a sus datos personales. El ejercicio de estos derechos será  totalmente gratuito para los interesados.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Estas solicitudes pueden ser:'),0,'J');$pdf->Ln(2.5);
$pdf->SetLeftMargin(25);
$pdf->MultiCell(0,6,utf8_decode('- Acceso a los ficheros informatizados'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('- Rectificación o cancelación de datos personales'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('- Oposición en la recogida de datos de carácter personal'),0,'L');
$pdf->SetLeftMargin(20);
$pdf->MultiCell(0,6,utf8_decode('- Oposición a la comunicación de datos de carácter personal'),0,'L');
$pdf->Ln(3);

//8.1
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('8.1. Recepción de solicitudes'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('El Responsable del Seguridad se encargará personalmente de la tramitación de las solicitudes de los interesados que reúnan los requisitos establecidos en este procedimiento, desde la recepción de la misma hasta la finalización de las gestiones correspondientes e información al interesado, y siempre dentro de los plazos establecidos.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Los interesados deberán dirigirse, siempre por escrito, a la siguiente dirección:'),0,'J');$pdf->Ln(2.5);
$pdf->Ln(3);

$pdf->SetFont('Arial', 'B', 12);
$pdf->MultiCell(0, 6, utf8_decode(mb_strtoupper('     A/A:  Comunidad de Propietarios ' . $cname)), 0, 'L');
$pdf->SetFont('Arial', '', 11);
$pdf->MultiCell(0, 6, utf8_decode(mb_strtoupper('                ' . $dir)), 0, 'L');
$pdf->MultiCell(0, 6, utf8_decode(mb_strtoupper('                C.P.' . $cp . ', ' . $loc . ', ' . $prov)), 0, 'L');
$pdf->Ln(5);

$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Cualquier solicitud de ejercicio de derechos debe ser efectuada por el propio afectado, o representante legal, lo que se comprobará mediante la correspondiente acreditación.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Si el interesado solicita información de cómo ejercer sus derechos, se le informará de que la documentación que debe presentar es la siguiente:'),0,'J');$pdf->Ln(2.5);

$pdf->SetLeftMargin(25);
$pdf->MultiCell(0,6,utf8_decode('- Nombre y apellidos y fotocopia del DNI del interesado o de la persona que lo represente, así como el documento acreditativo de tal representación. La fotocopia del DNI podrá ser sustituida siempre que se acredite la identidad por cualquier otro medio válido.'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('- Petición en la que se concreta la solicitud'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('- Domicilio a efectos de notificaciones'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('- Fecha y firma del solicitante'),0,'J');
$pdf->SetLeftMargin(20);
$pdf->MultiCell(0,6,utf8_decode('- Documentos acreditativos de la petición que formula, en su caso.'),0,'J');


//8.2
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('8.2. Derecho de acceso'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Ante la recepción de una solicitud de acceso del interesado a sus datos personales, el Responsable de Seguridad deberá resolver si procede o no y, en cualquier caso, contestar al interesado sobre la resolución EN EL PLAZO DE UN MES desde la recepción de la solicitud.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('En caso afirmativo, se debe incluir toda la información que se mantenga en los ficheros, concerniente al interesado.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Igualmente, se debe averiguar si estos datos han sido cedidos a algún tercero, indicándole al interesado, en caso afirmativo la empresa o entidad a la que han sido cedidos y los usos concretos del cesionario.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('El Responsable del Seguridad decidirá si la información solicitada es facilitada mediante visualización, escrito, copia, telecopia o fotocopia, según los casos.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Se podrá denegar el acceso a los datos de carácter personal cuando el derecho se haya ejercitado de forma efectiva en un intervalo inferior a doce meses y no se acredite un interés legítimo al efecto, así como cuando la solicitud sea formulada por persona distinta del afectado que no le represente legalmente.'),0,'J');$pdf->Ln(2.5);

//8.3
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('8.3. Derechos de rectificación y cancelación'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Cuando la Comunidad de Propietarios tenga conocimiento de que alguno/s de los datos contenidos en un fichero son inexactos o incompletos, o se reciba una solicitud de rectificación de datos, lo pondrá en conocimiento del Responsable de Seguridad, quien procederá a la rectificación de los mismos EN EL PLAZO DE DIEZ DÍAS desde la recepción de la solicitud.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Cuando los datos tratados no se ajusten a lo dispuesto en la Ley Orgánica de Protección de Datos, el Responsable de los Ficheros procederá al bloqueo efectivo de los mismos, conservándose únicamente a disposición de las Administraciones Públicas, Jueces y Tribunales, para la atención de las posibles responsabilidades nacidas del tratamiento.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Una vez cumplido el plazo de prescripción correspondiente, se procederá a su supresión definitiva.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Si los datos rectificados o cancelados hubieran sido comunicados previamente, se deberá notificar la rectificación o cancelación a quien se hayan comunicado, en el caso de que se mantenga el tratamiento por este último, para que proceda del mismo modo.'),0,'J');$pdf->Ln(2.5);

//8.4
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('8.4. Derecho de oposición a facilitar datos personales'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Durante el proceso de recogida de datos, se debe informar al interesado de su derecho a no facilitar sus datos personales, y las consecuencias de dicha oposición, es decir, la ausencia de tratamiento de sus datos.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Una vez incluidos los datos en el fichero con la aceptación del interesado, podrá revocar este consentimiento, solicitándolo por escrito a la dirección indicada al principio.'),0,'J');$pdf->Ln(2.5);

//8.5
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('8.5. Derechos de oposición a la cesión de datos personales'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('El interesado podrá solicitar el ejercicio de este derecho en cualquier momento mediante escrito dirigido a la dirección indicada, disponiendo el Responsable de Seguridad de UN MES NATURAL para responderle afirmativamente.'),0,'J');$pdf->Ln(2.5);

//9
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('9. CESIONES DE DATOS Y COMUNICACIONES A TERCEROS'),0,'L');
//9.1
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('9.1. Encargados de tratamiento'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Se entiende por Encargado del Tratamiento toda persona física o jurídica, autoridad pública, servicio o cualquier otro organismo que, sólo o conjuntamente con otros, trate datos personales por cuenta del Responsable de los Ficheros.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Cuando el COLEGIO PROFESIONAL DE PROCURADORES DE SEVILLA facilite el acceso a los datos, a los soportes que los contengan o a los recursos de los sistemas de información que los traten, a un Encargado de Tratamiento que le preste sus servicios en las instalaciones del Colegio, se exigirá al personal del Encargado el cumplimiento de las medidas de seguridad previstas en el presente Documento.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('En el momento en que el COLEGIO PROFESIONAL DE PROCURADORES DE SEVILLA preste a otras empresas determinados servicios que impliquen el acceso o tratamiento de datos de carácter personal, ostentará la condición de Encargado del Tratamiento respecto de los datos de aquéllas y deberá garantizar la seguridad de los datos de cuyo tratamiento se encargue.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('En este sentido, el COLEGIO PROFESIONAL DE PROCURADORES DE SEVILLA deberá aplicar a los ficheros con datos de carácter personal de cuyo tratamiento se encargue en calidad de Encargado del Tratamiento, las medidas de seguridad establecidas en el presente Documento de Seguridad, en función del nivel de seguridad que corresponda a los datos tratados.'),0,'J');$pdf->Ln(2.5);

//9.2
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('9.2. Comunicaciones de datos a terceros'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Según lo establecido en el Art. 11 de la LOPD, los datos de carácter personal sólo podrán ser comunicados a terceros para el cumplimiento de fines directamente relacionados con las funciones legítimas del cedente y del cesionario con el previo consentimiento del interesado.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Para ello, deberá informarse a los interesados de la comunicación de sus datos a terceros y obtener su consentimiento para ello, salvo que la cesión esté autorizada por una Ley o cuando los datos comunicados se hayan recabado de fuentes accesibles al público.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('En cualquier caso, el Responsable del Fichero deberá firmar un contrato de cesión de datos con el tercero al que se le comunican los datos, que garantizará su tratamiento conforme a la normativa vigente en materia de protección de datos'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Por el sólo hecho de la comunicación, el cesionario de los datos se compromete al cumplimiento de las disposiciones recogidas en la Ley Orgánica 15/1999 de Protección de Datos de Carácter Personal.'),0,'J');$pdf->Ln(2.5);

//10
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('10. VIDEOVIGILANCIA'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('En virtud de la Instrucción 1/2006 de la Agencia Española de Protección de Datos, se establecen una serie de obligaciones para aquellas entidades que lleven a cabo cualquier actividad de grabación, captación, transmisión y almacenamiento de imágenes, incluida su reproducción o emisión en tiempo real, así como el tratamiento que resulte de los datos relacionados con aquéllas.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Para ello, se deberán cumplir los siguientes requisitos:'),0,'J');$pdf->Ln(2.5);

$pdf->SetLeftMargin(25);
$pdf->MultiCell(0,6,utf8_decode('- Colocar un distintivo informativo en un lugar suficientemente visible en todas las zonas vigiladas por cámaras de seguridad, tanto en espacios abiertos como cerrados. El modelo deberá personalizarse para incluir la razón social y su dirección completa.'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('- Poner a disposición de los interesados unos impresos en los que se detallen, de modo expreso, preciso e inequívoco, las cláusulas informativas pertinentes en toda recogida de datos.'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('- Notificar el fichero de videovigilancia, en caso de que se graben las imágenes, a la Agencia Española de Protección de Datos para su correspondiente inscripción.'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('- En caso de existir seguridad externa contratada con acceso al fichero de videovigilancia, se deberá firmar un contrato de Encargado de Tratamiento con la empresa de seguridad.'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('- Controlar el acceso físico al sistema de videovigilancia, protegiendo tanto los sistemas de almacenamiento de imágenes y procurando que los monitores de visualización de imágenes no estén a la vista de personas no autorizadas para ello.'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('- Controlar el acceso físico al sistema de videovigilancia, protegiendo tanto los sistemas de almacenamiento de imágenes y procurando que los monitores de visualización de imágenes no estén a la vista de personas no autorizadas para ello.'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('- El uso de dispositivos de videovigilancia debe ser el adecuado, pertinente y no excesivo, de modo que sólo se considera admisible la instalación de cámaras de seguridad cuando la finalidad de vigilancia no pueda obtenerse mediante otros medios que resulten menos intrusivos para la intimidad de las personas. Además las imágenes recabadas no podrán utilizarse para finalidades diferentes a los que motivaron su grabación.'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('- Las cámaras ubicadas en espacios privados no podrán grabar espacios públicos, salvo en los casos recogidos en el Real Decreto 596/1999 que desarrolla la Ley Orgánica 4/1997 que regula la utilización de videocámaras por las Fuerzas y Cuerpos de Seguridad en espacios públicos.'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('- Las imágenes grabadas por dispositivos de videovigilancia deben ser canceladas en el plazo máximo de un mes desde su captación.'),0,'L');

$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,strtoupper(utf8_decode('11. anexos')),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Anexo I.        Ficheros de datos declarados y resoluciones de la AEPD.'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('Anexo II.       Listado de usuarios con acceso a los ficheros.'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('Anexo III.      Cláusula legal para empleados.'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('Anexo IV.      Impreso de rectificación de datos.'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('Anexo V.       Registro de incidencias.'),0,'J');
$pdf->Ln(5);

//ANEXO I
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('Anexo I. Ficheros de datos declarados y resoluciones de la AEPD'),0,'L');

$pdf->Ln(5);
$pdf->SetDrawColor(0, 0, 0);

$level_ops = array("Básico","Medio","Alto");
$type_ops = array("Datos de carácter identificativo","Datos de características personales","Datos de circunstancias sociales","Datos académicos y profesionales","Datos de detalles de empleo","Datos de información comercial","Datos económico-financieros y de seguros","Datos de transacciones","Datos especialmente protegidos");

$origin="EL PROPIO INTERESADO O SU REPRESENTANTE LEGAL"; //cvs,prov,alum,padres,prof,video,cpp
$recollect="ENCUESTAS / ENTREVISTAS"; //cvs,prov,prof,cpp
$recollect="FORMULARIOS / CUPONES"; //alum,padres,video

foreach($files as $f){
    $pdf->SetWidths(array(50,50,65));
    $pdf->SetAligns(array('L','L','L'));
    $pdf->SetFont('Arial','B',10);
    $pdf->Row(array("Fichero:",$f["name"],"Nº Inscripción R.G.P.D:"));
    $pdf->SetFont('Arial','',10);
    $pdf->Row(array("Responsable Fichero:","CDAD. PROP. ".$cname,"Soporte papel / digital: ".strtoupper($f["supp"])));
    $pdf->Row(array("Responsable Seguridad:","PRESIDENTE DE LA COMUNIDAD","Nivel de seguridad: ".mb_strtoupper(html_entity_decode($f["level_name"]))));
    $pdf->SetWidths(array(165));
    $pdf->SetAligns(array('L'));
    $pdf->Row(array(""));
    $pdf->SetWidths(array(50,115));
    $pdf->SetAligns(array('L','L'));
    $pdf->Row(array("Finalidad:",html_entity_decode($f["target"])));
    $pdf->Row(array("Procedencia de los datos:",$origin));
    $pdf->Row(array("Procedimiento de recogida:",$recollect));
    $pdf->Ln(5);
    //structure table
    $pdf->SetWidths(array(165));
    $pdf->SetAligns(array('C'));
    $pdf->SetFont('Arial','B',13);
    $pdf->Row(array("\nESTRUCTURA\n\n"));
    $pdf->SetWidths(array(50,65,50));
    $pdf->SetAligns(array('C','C','C'));
    $pdf->SetFont('Arial','B',12);
    $pdf->Row(array("CAMPOS DE DATOS","TIPO DE DATOS","NIVEL DE SEGURIDAD"));
    $pdf->SetFont('Arial','',10);
    //getting all the structured data for the current registered file
    $sdata = Model_Rel_Estructura::find('all',array('where'=>array('idfichero'=>$f['id'])));
    foreach($sdata as $sd){
        $datatype=Model_Tipo_Dato::find($sd["idtipodato"]);
        $pdf->Row(array($datatype->nombre,$type_ops[$datatype->tipo],$level_ops[$datatype->nivel]));
    }
    $pdf->Ln(20);
}

//ANEXO II
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('Anexo II. Listado de usuarios con acceso a los ficheros'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(0,6,utf8_decode('RESPONSABLE DE LOS FICHEROS'),0,'J');
$pdf->Ln(5);
$pdf->SetWidths(array(100,35,35));
$pdf->SetAligns(array('C','C','C'));
$pdf->Row(array("COMUNIDAD DE PROPIETARIOS","Fecha alta","Fecha baja"));
$pdf->Row(array($cname,"",""));
$pdf->Ln(10);

$pdf->MultiCell(0,6,utf8_decode('RESPONSABLE DE SEGURIDAD'),0,'J');
$pdf->Ln(5);
$pdf->SetWidths(array(80,30,30,30));
$pdf->SetAligns(array('C','C','C','C'));
$pdf->Row(array("Nombre y Apellidos","Cargo","Fecha alta","Fecha baja"));
if(count($pres)>0){
    $pdf->Row(array(html_entity_decode($pres["nombre"]),"PRESIDENTE",$pres["falta"],$pres["fbaja"]));
}
else{
    $pdf->Row(array("","","",""));
}
$pdf->Row(array("","","",""));
$pdf->Row(array("","","",""));
$pdf->Ln(10);

$pdf->MultiCell(0,6,utf8_decode('PERSONAS DE LA COMUNIDAD CON ACCESO A LOS FICHEROS'),0,'J');
$pdf->Ln(5);
$pdf->SetWidths(array(50,35,25,30,30));
$pdf->SetAligns(array('C','C','C','C','C'));
$pdf->Row(array("Nombre y Apellidos","Cargo","Fecha alta","Fecha baja"));
if(count($trab)>0){
    foreach($trab as $t) {
        $pdf->Row(array(html_entity_decode($t["nombre"]), $t["cargofuncion"], $t["falta"], $t["fbaja"]));
    }
}
else{
    $pdf->Row(array("","","",""));
}
$pdf->Row(array("","","",""));
$pdf->Row(array("","","",""));
$pdf->Ln(10);

$pdf->MultiCell(0,6,utf8_decode('PERSONAS AJENAS A LA COMUNIDAD CON ACCESO A LOS FICHEROS'),0,'J');
$pdf->Ln(5);
$pdf->SetWidths(array(75,25,35,35));
$pdf->SetAligns(array('C','C','C','C'));
$pdf->Row(array("Nombre y Apellidos","CIF/NIF","Fecha alta","Fecha baja"));
$i=0;
while($i<$num_reps){
    $pdf->Row(array(html_entity_decode($reps[$i]["nombre"]),$reps[$i]["dni"],"",""));
    $i++;
}
foreach($ces as $c){
    $ces_name="N/D";
    if($c->idcesionaria!=0){
        $ces_name= Model_Cliente::find($c->idcesionaria)->get("nombre");
    }
    $ces_cif=Model_Cliente::find($c->idcesionaria)->get("cif_nif");
    $pdf->Row(array(html_entity_decode($ces_name),$ces_cif,"",""));
}
$pdf->Row(array("","","",""));
$pdf->Row(array("","","",""));
$pdf->Ln(5);

//ANEXO III
foreach($trab as $t) {
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->MultiCell(0, 10, utf8_decode('Anexo III. Cláusula legal para empleados'), 0, 'L');
    $pdf->SetFont('Arial', '', 8.5);
    $pdf->MultiCell(0, 10, utf8_decode('En Sevilla, a ......... de ................. de ........'), 0, 'R');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode(mb_strtoupper(html_entity_decode($t["nombre"])).', mayor de edad, con DNI nº '.$t["dni"].', en virtud de la relación de carácter laboral que le vincula a la Comunidad de Propietarios '.mb_strtoupper($cname).', se obliga a:'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('PRIMERO.- Guardar secreto profesional con respecto a los datos de carácter personal a los que tenga acceso por razón de su trabajo, así como guardarlos; obligaciones que se mantendrán aún después del cese de la relación laboral que le vincula a la Comunidad de Propietarios '.mb_strtoupper($cname)).'.', 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('SEGUNDO.- Comunicar a su superior inmediato cualquier incidencia que se produzca en el tratamiento de estos datos.'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('TERCERO.- Seguir las instrucciones de la Comunidad de Propietarios '.mb_strtoupper($cname).' en relación a las políticas de protección de datos descritas en el documento de seguridad.'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('CUARTO.- Trasladar al Responsable de Seguridad cualquier comunicación que llegue a la Comunidad de Propietarios '.mb_strtoupper($cname).', relativa al ejercicio de los derechos de acceso, rectificación, cancelación y oposición por parte de los afectados respecto a sus datos de carácter personal.'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('En caso de incumplimiento de alguna de estas cláusulas, el empleado podrá ser sancionado por incurrir en responsabilidad contractual derivada de la relación laboral que le vincula. Si además, como consecuencia del incumplimiento, la empresa es sancionada como responsable del fichero, ésta podrá pedir daños y perjuicios al empleado que dolosamente haya realizado actos prohibidos en estas cláusulas.'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('Asimismo, y en cumplimiento de lo dispuesto en el artículo 5 de la Ley Orgánica 15/1999, de 13 de diciembre de Protección de Datos de Carácter Personal (LOPD), la Comunidad de Propietarios '.mb_strtoupper($cname).', con CIF '.$cif.', le informa que sus datos de carácter personal, actualmente en posesión de la Comunidad de Propietarios '.mb_strtoupper($cname).', formarán parte de un fichero automatizado del que es titular y único responsable.'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('La finalidad de su creación, existencia y mantenimiento es el tratamiento de los datos con los exclusivos fines de gestionar las relaciones laborales (pago de nóminas, control de asistencia, seguros sociales) que mantiene con la Comunidad de Propietarios '.mb_strtoupper($cname).'.'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('Igualmente, queda informado que para alcanzar los fines arriba indicados, sus datos de carácter personal podrán ser cedidos a otras entidades para la prestación de servicios por cuenta de la empresa, cumpliendo en cualquier caso con lo estipulado en la LOPD.'), 0, 'J');
    $pdf->Ln(2);
    $pdf->MultiCell(0, 6, utf8_decode('El abajo firmante podrá ejercitar los derechos de acceso, rectificación, cancelación y oposición, en el ámbito reconocido por la normativa española en protección de datos, dirigiéndose por escrito a nuestra sede situada en '.$dir.", ".$cp.', en '.$loc.', provincia de '.$prov.'.'), 0, 'J');
    $pdf->Ln(10);
    $pdf->MultiCell(0, 10, utf8_decode(html_entity_decode($t["nombre"]).'                                                                    '.$cname), 0, 'C');
}
//ANEXO IV
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('Anexo IV. Impreso de rectificación de datos'),0,'L');
$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,6,utf8_decode('A/A:        C.PP. '.$cname),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('                 '.html_entity_decode(urldecode($dir))),0,'L');
$pdf->MultiCell(0,6,utf8_decode('                 '.$cp.', '.$loc.', '.$prov),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,6,utf8_decode('DATOS DEL SOLICITANTE'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('D/Dª ............................................................... mayor de edad, con D.N.I.......................... (del que acompaña fotocopia), con domicilio en la calle ............................................................... nº.........., Localidad ............................................, Provincia .............................................C.P. ................, por medio del presente escrito manifiesta su deseo de ejercer su derecho de rectificación, de conformidad con el artículo 16 de la Ley Orgánica 15/1999, y los artículos 15 y 16 del Real Decreto 1332/94.'),0,'J');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,6,utf8_decode('SOLICITA.-'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('1.- Que se proceda gratuitamente a la efectiva corrección en el plazo de diez días desde la recepción de esta solicitud, de los datos inexactos relativos a mi persona que se encuentren en sus ficheros.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('2.- Los datos que hay que rectificar se enumeran en la hoja anexa, haciendo referencia a los documentos que se acompañan a esta solicitud y que acreditan, en caso de ser necesario, la veracidad de los nuevos datos.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('3.- Que me comuniquen de forma escrita a la dirección arriba indicada, la rectificación de los datos una vez realizada.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('4.- Que, en el caso de que el responsable del fichero considere que la rectificación o la cancelación no procede, lo comunique igualmente, de forma motivada y dentro del plazo de diez días señalado, a fin de poder interponer la reclamación prevista en el artículo 18 de la Ley.'),0,'J');$pdf->Ln(5);
$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,6,utf8_decode('DATOS QUE DEBEN RECTIFICARSE.-'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Dato erróneo                       Dato correcto                          Documento acreditativo'),0,'C');
$pdf->Ln(40);
$pdf->MultiCell(0,6,utf8_decode('En ............................, a ......... de ........................... de ...........'),0,'C');

//ANEXO V
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('Anexo V. Registro de incidencias'),0,'L');
$pdf->Ln(5);

$pdf->SetFont('Arial','',10);
$pdf->SetWidths(array(80,90));
$pdf->SetAligns(array('L','L'));
$pdf->Row(array("Fecha de notificación:","* Incidencia nº:"));

$pdf->SetWidths(array(80,90));
$pdf->SetAligns(array('L','L'));
$pdf->Row(array("Tipo de incidencia:","Fecha y hora de la incidencia:"));

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

// Write all to the output
$pdf->Output("DOC-SEGURIDAD-C.PP.-".$cname.".pdf",'I');