<?php
//global $cname;
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
        $this->Cell(0,45,utf8_decode("                         ".$this->customer),0,0,'C');
        $this->Ln(10);
        $this->Ln(10);
        $this->Image('http://gestion.agdata.es/assets/img/logo2.png',20,13,40);
        $this->Ln(20);
    }

    function Footer(){
        if($this->PageNo()!='{nb}') {
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            //page number
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
$title = 'DOCUMENTOS LEGALES LOPD: DOCUMENTO DE SEGURIDAD';
$pdf->SetTitle($title);
$pdf->SetAuthor('Análisis y gestión de datos S.L.');
$pdf->SetMargins(20,6,20);
$pdf->AliasNbPages();

$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Ln(5);

$pdf->SetDrawColor(0, 80, 185);
$pdf->SetFillColor(255, 255, 255);

//First page
$pdf->SetFont('Arial','B',26);
$pdf->SetFillColor(255, 255, 155);

$h=60;
if(strlen($cname)>40){$h=70;}

$pdf->Rect(25, 70, 160, $h, 10.5, 'DF');
$pdf->Ln(25);
$pdf->Cell(0,10,utf8_decode('DOCUMENTO DE SEGURIDAD'),0,0,'C');
$pdf->Ln(15);
$pdf->SetFont('Arial','',16);
$pdf->MultiCell(0,12,strtoupper('responsable de los ficheros'),0,'C');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',15);
$pdf->MultiCell(0,12,utf8_decode(mb_strtoupper($cname)),0,'C');
$pdf->Ln(15);

//Print out the current readable date
$fecha = date("m-Y",time());
$fecha_array=explode('-',$fecha);
$mes = getMes($fecha_array[0]);
$fecha = "$mes de $fecha_array[1]";
$pdf->SetFont('Arial','I',11);
$pdf->MultiCell(0,12,strtoupper($fecha),0,'C');

//Document index
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
$pdf->MultiCell(0,10,strtoupper('indice'),0,'L');

$pdf->SetFont('Arial','',11);
$pdf->Cell(5,6,'1. OBJETO',0,1,'L');$pdf->Ln(2);
$pdf->Cell(5,6,utf8_decode('2. ÁMBITO DE APLICACIÓN'),0,1,'L');
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
$pdf->Cell(5,6,utf8_decode('5. ENTRADA Y SALIDA DE DATOS POR RED'),0,1,'L');
$pdf->SetFont('Arial','',11);
$pdf->Cell(5,6,utf8_decode('6. GESTIÓN DE INCIDENCIAS'),0,1,'L');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,6,utf8_decode('   6.1. Notificación y gestión de incidencias'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('   6.2. Registro de incidencias'),0,1,'L');$pdf->Ln(2);
$pdf->SetFont('Arial','',11);
$pdf->Cell(5,6,utf8_decode('7. GESTIÓN DE SOPORTES'),0,1,'L');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,6,utf8_decode('   7.1. Identificación, inventario, reutilización y destrucción de soportes'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('   7.2. Entrada y salida de soportes'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('   7.3. Distribución de soportes'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('   7.4. Soportes en papel de ficheros no automatizados'),0,1,'L');$pdf->Ln(2);
$pdf->SetFont('Arial','',11);
$pdf->Cell(5,6,utf8_decode('8. COPIAS DE RESPALDO Y RECUPERACIÓN'),0,1,'L');$pdf->Ln(2);
$pdf->Cell(5,6,utf8_decode('9. CONTROLES PERIÓDICOS DE VERIFICACIÓN'),0,1,'L');$pdf->Ln(2);
$pdf->Cell(5,6,'10. EJERCICIO DE LOS DERECHOS DE LOS INTERESADOS',0,1,'L');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,6,utf8_decode('   10.1. Recepción de solicitudes'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('   10.2. Derecho de acceso'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('   10.3. Derechos de rectificación y cancelación'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('   10.4. Derecho de oposición a facilitar datos personales'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('   10.5. Derecho de oposición a la cesión de datos personales'),0,1,'L');$pdf->Ln(2);
$pdf->SetFont('Arial','',11);
$pdf->Cell(5,6,'11. ANEXOS',0,1,'L');

//Pag 1
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,strtoupper('1. objeto'),0,'L');

$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('El presente documento responde a la obligación establecida en el artículo 88 del Capítulo II, del Real Decreto 1720/2007, de 21 de diciembre, por el que se aprueba el Reglamento de desarrollo de la Ley Orgánica 15/1999, de 13 de diciembre, de Protección de Datos de Carácter Personal.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('En este Documento de Seguridad se recogerán todas aquellas medidas de índole técnica y organizativa que deben reunir los ficheros, locales, equipos informáticos y el personal de '.$cname.' situado en '.$dir.' con C.P. '.$cp.' en '.$loc.', provincia de '.$prov.'.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Los procedimientos y normas de seguridad recogidas en el Documento de Seguridad serán de obligado cumplimiento para todos aquéllos que tengan acceso a los ficheros con datos de carácter personal, automatizados o en papel, según lo dispuesto en el Reglamento de desarrollo de la LOPD anteriormente mencionado.'),0,'J');

$pdf->Ln(5);

//2.1
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode(mb_strtoupper('2. Ámbito de aplicación')),0,'L');
$pdf->MultiCell(0,10,utf8_decode('2.1. Ámbito legal'),0,'L');

$pdf->SetFont('Arial','',10);
//$pdf->MultiCell(0,6,utf8_decode('Este documento ha sido elaborado bajo la responsabilidad de '.html_entity_decode($reps["nombre"]).' quien, como representante de '.$cname.' y, por lo tanto, Responsable de los Ficheros, se compromete a implantar los procedimientos recogidos en el presente documento y mantenerlos actualizados dentro del ámbito de aplicación de la normativa vigente en protección de datos.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Este documento ha sido elaborado bajo la responsabilidad de '.html_entity_decode($reps["nombre"]).' que, como Responsable de los Ficheros, se compromete a implantar los procedimientos recogidos en el presente documento y mantenerlos actualizados dentro del ámbito de aplicación de la normativa vigente en protección de datos.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('El Documento de Seguridad deberá ser revisado periódicamente por el Responsable de los Ficheros, con el fin de identificar cambios relevantes en el mismo. '),0,'J');$pdf->Ln(2.5);

//2.2
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('2.2. Ámbito personal'),0,'L');

$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Todas las personas físicas que tengan acceso a los ficheros objeto del Documento de Seguridad y a los datos en ellos contenidos, se encuentran obligadas por ley a cumplir lo establecido en este documento, y quedan sujetas a las consecuencias que pudieran incurrir en caso de incumplimiento.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('La relación de personas físicas con acceso autorizado a los ficheros protegidos, se detalla en el Anexo III: "Personas con acceso autorizado" del presente Documento de Seguridad.'),0,'J');$pdf->Ln(2.5);

//2.3
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('2.3. Ámbito material'),0,'L');

$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Los recursos que quedarán bajo el ámbito de aplicación del Documento de Seguridad son:'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('       - Locales o dependencias donde se encuentren ubicados los ficheros o se almacenen los soportes que los contengan.'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('       - Puestos de trabajo y sistemas informáticos desde los que se acceda a los ficheros. '),0,'J');$pdf->Ln(2.5);
$pdf->Ln(5);

$str="un fichero con datos de carácter personal, el cual ha sido convenientemente notificado";
if(count($files>1)){$str=count($files)." ficheros con datos de carácter personal, los cuales han sido convenientemente notificados";}
$pdf->MultiCell(0,6,utf8_decode($cname.' mantiene '.$str.' a la Agencia Española de Protección de Datos para su inscripción en el Registro General de Protección de Datos.'),0,'J');$pdf->Ln(2.5);

$pdf->Ln(5);
$pdf->SetDrawColor(0, 0, 0);

$pdf->SetWidths(array(60,55,55));
$pdf->SetAligns(array('C','C','C'));
$pdf->SetFont('Arial','B',10);
$pdf->Row(array("NOMBRE FICHERO","SOPORTE","NIVEL DE SEGURIDAD"));
foreach($files as $f){
    //structure table
    $pdf->SetFont('Arial','',10);
    $pdf->SetWidths(array(60,55,55));
    $pdf->SetAligns(array('C','C','C'));
    $pdf->Row(array(html_entity_decode($f["name"]),$f["supp"],html_entity_decode($f["level_name"])));
}
$pdf->Ln(5);

$str="del fichero declarado";
if(count($files>1)){$str="de los ficheros declarados";}
$pdf->MultiCell(0,6,utf8_decode('La descripción y tipología '.$str.' por '.$cname.' viene especificada en el Anexo I: "Descripción de los ficheros" del presente documento.'),0,'J');$pdf->Ln(2.5);
$levels = array("N/D","BÁSICO","MEDIO","ALTO");
$pdf->MultiCell(0,6,utf8_decode('Una vez analizada la tipología de los ficheros a proteger, se recogerán en el Documento de Seguridad, con carácter general, los procedimientos y normas de seguridad establecidas como de nivel '.$levels[$max_level].'.'),0,'J');$pdf->Ln(2.5);

$str1="del fichero identificado";
$str2="del fichero";
if(count($files>1)){$str1="de los ficheros identificados";$str2="de los ficheros";}
$pdf->MultiCell(0,6,utf8_decode('El Responsable de los Ficheros ha procedido a notificar al Registro General de Protección de Datos (RGPD) la creación '.$str1.'. Dichas notificaciones así como las correspondientes resoluciones de inscripción '.$str2.' se adjuntan en el Anexo II: "Notificación e inscripción de ficheros" del Documento de Seguridad.'),0,'J');$pdf->Ln(2.5);

$pdf->Ln(5);

//3.1
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode(strtoupper('3. Funciones y obligaciones del personal')),0,'L');
$pdf->MultiCell(0,10,utf8_decode('3.1. Normas generales'),0,'L');

$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode($cname.', ha designado como Responsable de Seguridad a '.html_entity_decode($rep_seg["nombre"]).', quien desempeñará las funciones propias de coordinación y control de las medidas de seguridad implantadas en materia de protección de datos.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('En ningún caso, la designación del Responsable de Seguridad supone la delegación de la responsabilidad que corresponde al Responsable de los Ficheros, quién conservará todas aquellas funciones que le corresponden, según lo establecido en la LOPD.'),0,'J');$pdf->Ln(2.5);

//3.2
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('3.2. Funciones y obligaciones'),0,'L');

$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Las personas con acceso autorizado a los ficheros, detalladas en el Anexo III de este documento, guardará absoluta confidencialidad sobre los datos accedidos y, en ningún caso, dará a los mismos un tratamiento distinto al previsto, actuando de acuerdo con las normas y medidas de seguridad que en este Documento de Seguridad se describen.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Asimismo, dicho personal comunicará al Responsable de Seguridad, cualquier incidencia que surja durante el proceso de tratamiento de los ficheros.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Las funciones y obligaciones del personal con acceso autorizado a los locales, recursos y ficheros protegidos se recogen detalladamente en el Anexo IV: "Funciones y obligaciones del personal" de este documento.'),0,'J');$pdf->Ln(2.5);

$pdf->Ln(5);

//4.1
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode(strtoupper('4. Procedimientos y normas de seguridad')),0,'L');
$pdf->MultiCell(0,10,utf8_decode('4.1. Centros de tratamiento'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('El acceso a los locales u oficinas donde se encuentren los ficheros, deberá estar restringido exclusivamente al personal autorizado para su tratamiento o aquél que deba realizar labores de mantenimiento para las que sea imprescindible el acceso físico.'),0,'J');$pdf->Ln(2.5);

$pdf->MultiCell(0, 6, utf8_decode('La administración y gestión de los ficheros de '.$cname.' está localizada en ' . $dir . ' con C.P. ' . $cp . ' en ' . $loc . ', provincia de ' . $prov . ', donde se encuentran ubicadas sus oficinas e instalaciones.'), 0, 'J');
$pdf->Ln(2.5);

//4.2
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('4.2. Puestos de trabajo'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Son todos aquellos dispositivos desde los cuales se puede acceder a los datos contenidos en los ficheros, como pueden ser terminales u ordenadores personales.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Cada puesto de trabajo estará bajo la responsabilidad de una persona de las autorizadas en el Anexo III, quién garantizará que la información que muestra su equipo no pueda ser vista por personas no autorizadas. Esto implica que tanto las pantallas como las impresoras u otro tipo de dispositivos conectados al puesto de trabajo deberán estar físicamente ubicados en lugares que garanticen esa confidencialidad.'),0,'J');$pdf->Ln(2.5);
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
$pdf->MultiCell(0,6,utf8_decode('Las contraseñas deberán ser estrictamente confidenciales y personales, y cualquier incidencia que comprometa su confidencialidad deberá ser inmediatamente comunicada al Responsable de Seguridad, se cumplimentará el oportuno Registro de Incidencias (Anexo IX: "Registro de Incidencias") y será subsanada en el menor plazo de tiempo posible.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('El Responsable del Seguridad, o la persona por él autorizada, asignarán las claves a cada usuario y cuidará de que se cambien al menos con una periodicidad semestral. Ambas claves quedarán registradas de forma cifrada e ininteligible.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Cada usuario será responsable de la confidencialidad de su contraseña y, en caso de que la misma sea conocida fortuita o fraudulentamente por personas no autorizadas, deberá registrarlo como incidencia y proceder inmediatamente a su cambio.'),0,'J');$pdf->Ln(2.5);

$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,mb_strtoupper(utf8_decode('5. Entrada y salida de datos por red')),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Todas las entradas y salidas de datos de los ficheros que se efectúen mediante correo electrónico, se realizarán en lo posible desde una única cuenta o dirección de correo electrónico controlada por un usuario especialmente autorizado por el Responsable de los Ficheros en el Anexo III.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Igualmente si se realiza la entrada o salida de datos mediante sistemas de transferencia de ficheros por red, únicamente un usuario estará autorizado para realizar esas operaciones.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Se guardarán copias de todos los correos electrónicos que involucren entradas o salidas de datos de los ficheros, en directorios específicamente creados para estos supuestos y bajo el control directo del Responsable de Seguridad.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Se mantendrán copias de esos correos durante al menos dos años. También se guardará durante un mínimo de dos años, en directorios protegidos, una copia de los ficheros recibidos o transmitidos por sistemas de transferencia de ficheros por red.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Cuando los datos de los ficheros vayan a ser enviados por correo electrónico o por sistemas de transferencia de ficheros, a través de redes públicas o no protegidas, se recomienda que sean encriptados, de forma que solo puedan ser leídos e interpretados por el destinatario.'),0,'J');
$pdf->Ln(5);

//6.1
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode(mb_strtoupper('6. Gestión de incidencias')),0,'L');
$pdf->MultiCell(0,10,utf8_decode('6.1. Notificación y gestión de incidencias'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Una incidencia es cualquier evento que pueda producirse esporádicamente y pueda suponer un peligro para la seguridad de los ficheros, como pueden ser: accesos no autorizados, cambios de contraseña, fugas de información, fallos en los procesos de copias de respaldo o recuperación de datos, caídas de servidores, etc.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Cualquier incidencia que se produzca en el tratamiento y gestión de los ficheros será comunicada, en un plazo máximo de veinticuatro horas desde su aparición, al Responsable de los Ficheros, dejando constancia de ella en el registro correspondiente (Anexo IX: "Registro de Incidencias").'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('El Responsable de los Ficheros adoptará las medidas pertinentes en cada caso e implantará las acciones necesarias para dar una respuesta adecuada a la incidencia, pudiendo plantear incluso la modificación del Documento de Seguridad si fuese necesario.'),0,'J');$pdf->Ln(2.5);

//6.2
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('6.2. Registro de Incidencias'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Los Responsables de Seguridad habilitará un Registro de Incidencias a disposición de todas las personas con acceso a los ficheros, con el fin de que se detalle en él cualquier incidencia que pueda suponer un peligro para la seguridad de los mismos.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('La notificación o registro de una incidencia deberá constar al menos de los siguientes datos: tipo de incidencia, fecha y hora en que se produjo, persona que realiza la notificación, persona a quien se comunica, efectos que puede producir y descripción detallada de la misma. Se mantendrán las incidencias registradas de los doce últimos meses.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('En el Anexo IX: "Registro de Incidencias" de este documento, se recoge el modelo para el registro de las incidencias.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('El Registro de Incidencias también recogerá los procedimientos de recuperación de datos realizados, tal y como se describe en el punto 8 del presente documento "COPIAS DE RESPALDO Y RECUPERACIÓN".'),0,'J');$pdf->Ln(2.5);

//7.1
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode(mb_strtoupper('7. Gestión de soportes')),0,'L');
$pdf->MultiCell(0,10,utf8_decode('7.1. Identificación, inventario, reutilización y destrucción de soportes'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Los soportes informáticos que contengan datos de carácter personal serán identificados mediante una inscripción en una etiqueta adhesiva, con el tipo de información que contengan, y se almacenarán en un espacio cerrado bajo llave custodiado por el Responsable de Seguridad. Su acceso para la recepción y manipulación de estos soportes quedará reservado al personal autorizado en el Anexo III.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Para un efectivo control de los soportes, se creará un inventario (ver Anexo VI: "Inventario de soportes"), donde quede reflejado el tipo de soporte empleado, su ubicación y las fechas de creación, reutilización y destrucción de cada uno. '),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Cuando el soporte deba reutilizarse en un procedimiento de recuperación de datos, el Responsable de Seguridad establecerá las medidas encaminadas a garantizar que la información sustituida y obsoleta no pueda ser recuperada. '),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('En caso de inutilización, el soporte deberá ser físicamente destruido de tal forma que no pueda volver a utilizarse con posterioridad.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('El procedimiento de gestión de soportes viene descrito en el Anexo V: "Procedimientos de control y seguridad" de este Documento.'),0,'J');$pdf->Ln(2.5);

//7.2
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('7.2. Entrada y salida de soportes'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Cuando sea necesaria la entrada o transmisión externa de datos en soportes informáticos, dentro de los locales donde se encuentran ubicados los sistemas de información y/o ficheros protegidos, se procederá a:'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('     - Crear un registro de entrada de soportes (Anexo VII: "Registro de entrada de soportes"), en el que se especificará: fecha y hora de recepción, tipo de soporte y tipo de información que contiene, forma de envío, emisor o remitente y la persona que lo recibe.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('     - Crear un registro de salida de soportes (Anexo VIII: "Registro de salida de soportes"), en el que se especificará: fecha y hora de envío, tipo de soporte, tipo de información que contiene, remitente, destinatario, y la forma de envío.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('El envío de soportes deberá estar en todo momento autorizado por el Responsable de Seguridad, dejando constancia de ello mediante firma en el Registro de salida de soportes.'),0,'J');$pdf->Ln(2.5);

//7.3
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('7.3. Distribución de soportes'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Cuando se haga necesaria la distribución o transporte de un soporte con datos de carácter personal, el Responsable de Seguridad procurará el cifrado de dicha información o establecerá un procedimiento técnico similar que impida la inteligibilidad o manipulación de los datos durante su transporte.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Deberá evitarse, en lo posible, el tratamiento de datos de carácter personal en dispositivos portátiles que no permitan su cifrado.'),0,'J');$pdf->Ln(2.5);

//7.4
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('7.4. Soportes en papel de ficheros no automatizados'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('El acceso a la documentación del fichero que '.$cname.' mantiene en soporte papel, quedará limitado al personal expresamente autorizado por el Responsable de Seguridad en el Anexo III: "Personal con acceso autorizado".'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Los armarios, archivadores y otros elementos empleados para almacenar estos ficheros deberán encontrarse en áreas cuyo acceso esté protegido con puertas de acceso restringido mediante llave o dispositivo equivalente.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('La realización de copias o la reproducción de estos documentos únicamente podrán ser efectuadas bajo el control del personal autorizado por el Responsable de Seguridad.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Se procederá a la destrucción de las copias desechadas o inútiles, para evitar en lo posible el acceso a la información en ellas contenida.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('En los casos de traslado físico de la documentación contenida en un fichero, el Responsable de Seguridad adoptarán las medidas dirigidas a impedir el acceso o manipulación de la información objeto de traslado.'),0,'J');$pdf->Ln(2.5);
$pdf->Ln(5);

//8
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,strtoupper(utf8_decode('8. copias de respaldo y recuperación')),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('El Responsable de Seguridad se encargará de autorizar la ejecución de los procedimientos de respaldo y recuperación de datos, así como de verificar la definición y correcta aplicación de estos procedimientos de realización de copias que, en caso de fallo del sistema informático, permitan recuperar y en su caso reconstruir los datos de los ficheros.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Existirá una persona, bien sea el Responsable de Seguridad o bien otro usuario expresamente designado, que será responsable de supervisar periódicamente las copia de seguridad de cada fichero con datos de carácter personal, a efectos de respaldo y posible recuperación en caso de fallo.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Los soportes empleados para efectuar las copias deberán garantizar la reconstrucción de los datos de carácter personal al estado en que se encontraba dicha información antes de su pérdida o destrucción.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Para la ejecución de los procedimientos de recuperación de los datos, será necesaria la autorización por escrito del Responsable de Seguridad, dejando constancia de ello en el Registro de Incidencias correspondiente.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('En este Registro de Incidencias (Anexo IX) se indicará para cada caso: '),0,'J');$pdf->Ln(2.5);

$pdf->SetLeftMargin(25);
$pdf->MultiCell(0,6,utf8_decode('- los ficheros afectados y los soportes empleados en el proceso,'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('- los procedimientos realizados de recuperación de datos,'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('- la persona que lo ejecuta,'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('- los datos restaurados,'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('- los tipos de datos recuperados,'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('- la fecha en que tiene lugar,'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('- posibles incidencias que pudieran producirse durante el proceso de recuperación,'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('- los datos que han sido necesarios grabar manualmente, y'),0,'L');
$pdf->SetLeftMargin(20);
$pdf->MultiCell(0,6,utf8_decode('- la autorización mediante firma del Responsable de los Ficheros.'),0,'L');

//9
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,strtoupper(utf8_decode('9. Controles periódicos de verificación')),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('La veracidad de los datos contenidos en los anexos de este documento, así como el cumplimiento de las normas y procedimientos que contiene, deberán ser periódicamente comprobados, de forma que puedan detectarse y subsanarse anomalías.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('El Responsable de Seguridad de '.$cname.' comprobará, con una periodicidad al menos trimestral, que la lista de personal con acceso autorizado del Anexo III se corresponde con la lista de los usuarios realmente autorizados en la aplicación de acceso a los ficheros.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Se comprobará también al menos con periodicidad trimestral, la existencia de copias de respaldo que permitan la recuperación de los ficheros según lo estipulado en el apartado 8.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('A su vez, y también con periodicidad al menos trimestral, el Responsable de Seguridad procederá a la actualización de los anexos cuando se produzca cualquier cambio en los datos técnicos de los mismos, como cambios en el software o hardware, base de datos o aplicaciones de acceso a los ficheros.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('El Responsable de Seguridad verificará, con periodicidad al menos trimestral, el cumplimiento de lo previsto en losapartados 5 y 7 de este documento, en relación con las entradas y salidas de datos, sean por red o en soporte magnético.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('El Responsable de los Ficheros junto con el Responsable de Seguridad, analizaran con periodicidad al menos trimestral las incidencias registradas durante el período, para independientemente de las medidas particulares que se hayan adoptado en el momento que se produjeron, adoptar las medidas correctoras que limiten esas incidencias en el futuro.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Al menos cada dos años, se realizará una auditoría que dictamine el correcto cumplimiento y la adecuación de las medidas del presente Documento de Seguridad a las exigencias del Reglamento de seguridad, identificando las deficiencias y proponiendo las medidas correctoras necesarias. Además se recabarán en el informe todos aquellos datos, hechos y observaciones en que se basen las conclusiones alcanzadas y las recomendaciones propuestas una vez realizada la auditoria.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Los informes de auditoría serán analizados por el Responsable de Seguridad, quién elevará las conclusiones pertinentes al Responsable de los Ficheros, proponiéndole las medidas correctoras adecuadas. Los resultados de todos estos controles periódicos, así como de las auditorías, serán adjuntados a este documento de seguridad en el Anexo X. "Controles periódicos e informes de auditoría".'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Estos informes de auditoría se conservarán y quedarán a disposición de la Agencia Española de Protección de Datos.'),0,'J');$pdf->Ln(2.5);

//10
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,strtoupper(utf8_decode('10. ejercicio de los derechos de los interesados')),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('En cumplimiento de lo establecido en los artículos 15 y 16 de la LOPD, '.$cname.' definirá las tareas necesarias y establecerá los criterios aplicables a seguir ante una solicitud de un interesado, relativa a sus datos personales. El ejercicio de estos derechos será  totalmente gratuito para los interesados.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Estas solicitudes pueden ser:'),0,'J');$pdf->Ln(2.5);
$pdf->SetLeftMargin(25);
$pdf->MultiCell(0,6,utf8_decode('- Acceso a los ficheros informatizados'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('- Rectificación o cancelación de datos personales'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('- Oposición en la recogida de datos de carácter personal'),0,'L');
$pdf->SetLeftMargin(20);
$pdf->MultiCell(0,6,utf8_decode('- Oposición a la comunicación de datos de carácter personal'),0,'L');
$pdf->Ln(3);
$pdf->MultiCell(0,6,utf8_decode('Los modelos de solicitud para cada uno de los derechos de los interesados, se adjuntan en el Anexo X: "Documentos para el ejercicio de derechos" del Documento de Seguridad.'),0,'J');$pdf->Ln(2.5);

//10.1
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('10.1. Recepción de solicitudes'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('El Responsable del Seguridad se encargará personalmente de la tramitación de las solicitudes de los interesados que reúnan los requisitos establecidos en este procedimiento, desde la recepción de la misma hasta la finalización de las gestiones correspondientes e información al interesado, y siempre dentro de los plazos establecidos.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Los interesados deberán dirigirse, siempre por escrito, a la siguiente dirección:'),0,'J');$pdf->Ln(2.5);
$pdf->Ln(3);

$pdf->SetFont('Arial', 'B', 12);
$pdf->MultiCell(0, 6, utf8_decode(mb_strtoupper('     A/A:  ' . $cname)), 0, 'L');
$pdf->SetFont('Arial', '', 11);
$pdf->MultiCell(0, 6, utf8_decode(mb_strtoupper('                ' . $dir)), 0, 'L');
$pdf->MultiCell(0, 6, utf8_decode(mb_strtoupper('                C.P.' . $cp . ', ' . $loc . ', ' . $prov)), 0, 'L');
$pdf->Ln(5);

$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(0,6,utf8_decode('Cualquier solicitud de ejercicio de derechos debe ser efectuada por el propio afectado, o representante legal, lo que se comprobará mediante la correspondiente acreditación.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('En el Anexo X se relacionan modelos de posibles respuestas tipo para cada uno de los derechos que los interesados ejerciten ante '.$cname.'.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Si el interesado solicita información de cómo ejercer sus derechos, se le informará de que la documentación que debe presentar es la siguiente:'),0,'J');$pdf->Ln(2.5);

$pdf->SetLeftMargin(25);
$pdf->MultiCell(0,6,utf8_decode('- Nombre y apellidos y fotocopia del DNI del interesado o de la persona que lo represente, así como el documento acreditativo de tal representación. La fotocopia del DNI podrá ser sustituida siempre que se acredite la identidad por cualquier otro medio válido.'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('- Petición en la que se concreta la solicitud'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('- Domicilio a efectos de notificaciones'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('- Fecha y firma del solicitante'),0,'J');
$pdf->SetLeftMargin(20);
$pdf->MultiCell(0,6,utf8_decode('- Documentos acreditativos de la petición que formula, en su caso.'),0,'J');

//10.2
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('10.2. Derecho de acceso'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Ante la recepción de una solicitud de acceso del interesado a sus datos personales, el Responsable de Seguridad deberá resolver si procede o no y, en cualquier caso, contestar al interesado sobre la resolución EN EL PLAZO DE UN MES desde la recepción de la solicitud.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('En caso afirmativo, se debe incluir toda la información que se mantenga en los ficheros, concerniente al interesado.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Igualmente, se debe averiguar si estos datos han sido cedidos a algún tercero, indicándole al interesado, en caso afirmativo la empresa o entidad a la que han sido cedidos y los usos concretos del cesionario.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('El Responsable del Seguridad decidirá si la información solicitada es facilitada mediante visualización, escrito, copia, telecopia o fotocopia, según los casos.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Se podrá denegar el acceso a los datos de carácter personal cuando el derecho se haya ejercitado de forma efectiva en un intervalo inferior a doce meses y no se acredite un interés legítimo al efecto, así como cuando la solicitud sea formulada por persona distinta del afectado que no le represente legalmente.'),0,'J');$pdf->Ln(2.5);

//10.3
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('10.3. Derechos de rectificación y cancelación'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Cuando '.$cname.' tenga conocimiento de que alguno/s de los datos contenidos en un fichero son inexactos o incompletos, o se reciba una solicitud de rectificación de datos, lo pondrá en conocimiento del Responsable de Seguridad, quien procederá a la rectificación de los mismos EN EL PLAZO DE DIEZ DÍAS desde la recepción de la solicitud.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Cuando los datos tratados no se ajusten a lo dispuesto en la Ley Orgánica de Protección de Datos, el Responsable de los Ficheros procederá al bloqueo efectivo de los mismos, conservándose únicamente a disposición de las Administraciones Públicas, Jueces y Tribunales, para la atención de las posibles responsabilidades nacidas del tratamiento.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Una vez cumplido el plazo de prescripción correspondiente, se procederá a su supresión definitiva.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Si los datos rectificados o cancelados hubieran sido comunicados previamente, se deberá notificar la rectificación o cancelación a quien se hayan comunicado, en el caso de que se mantenga el tratamiento por este último, para que proceda del mismo modo.'),0,'J');$pdf->Ln(2.5);

//10.4
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('10.4. Derecho de oposición a facilitar datos personales'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('El interesado podrá ejercitar el derecho de oposición en los siguientes supuestos:'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('- Cuando no sea necesario su consentimiento'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('- Cuando la finalidad del tratamiento sean actividades de publicidad o prospección comercial'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('- Cuando la finalidad del tratamiento automatizado sea adoptar una decisión referida al afectado'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Una vez recibida la solicitud, '.$cname.' deberá contestar en un plazo máximo de DIEZ DÍAS NATURALES a contar desde la recepción de la solicitud.'),0,'J');$pdf->Ln(2.5);

//10.5
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('10.5. Derechos de oposición a la cesión de datos personales'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('El interesado podrá solicitar el ejercicio de este derecho en cualquier momento mediante escrito dirigido a la dirección indicada, disponiendo el Responsable de Seguridad de UN MES NATURAL para responderle afirmativamente.'),0,'J');$pdf->Ln(2.5);

//11
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,strtoupper(utf8_decode('11. anexos')),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Anexo I.        Descripción de los ficheros.'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('Anexo II.       Notificación e inscripción de ficheros.'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('Anexo III.      Personal con acceso autorizado.'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('Anexo IV.      Funciones y obligaciones del personal.'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('Anexo V.       Procedimientos de control y seguridad.'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('Anexo VI.      Inventario de soportes.'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('Anexo VII.     Registro de entrada de soportes.'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('Anexo VIII.    Registro de salida de soportes.'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('Anexo IX.      Registro de Incidencias.'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('Anexo X.       Documentos para el ejercicio de derechos.'),0,'J');

$pdf->Ln(5);

//ANEXO I
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('Anexo I. Descripción de los ficheros'),0,'L');

$pdf->Ln(5);
$pdf->SetDrawColor(0, 0, 0);

$level_ops = array("Básico","Medio","Alto");
$type_ops = array("Datos de carácter identificativo","Datos de características personales","Datos de circunstancias sociales","Datos académicos y profesionales","Datos de detalles de empleo","Datos de información comercial","Datos económico-financieros y de seguros","Datos de transacciones","Datos especialmente protegidos");

$origin="EL PROPIO INTERESADO O SU REPRESENTANTE LEGAL"; //cvs,prov,alum,padres,prof
$recollect="ENCUESTAS / ENTREVISTAS"; //cvs,prov,prof
$recollect="FORMULARIOS / CUPONES"; //alum,padres

foreach($files as $f){
    $pdf->SetWidths(array(50,50,65));
    $pdf->SetAligns(array('L','L','L'));
    $pdf->SetFont('Arial','B',10);
    $pdf->Row(array("Fichero:",html_entity_decode($f["name"]),"Nº Inscripción R.G.P.D:"));
    $pdf->SetFont('Arial','',10);
    $pdf->Row(array("Responsable Fichero:",$cname,"Soporte papel / digital: ".strtoupper($f["supp"])));
    $pdf->Row(array("Responsable Seguridad:",html_entity_decode($rep_seg["nombre"]),"Nivel de seguridad: ".mb_strtoupper(html_entity_decode($f["level_name"]))));
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
$pdf->MultiCell(0,10,utf8_decode('Anexo II. Notificación e inscripción de ficheros'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Documentos de NOTIFICACIÓN a la Agencia Española de Protección de Datos para su inscripción en el Registro General de Protección de Datos (R.G.P.D.), de cada fichero de nueva creación, así como modificación o supresión de los ficheros existentes.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('En este mismo anexo se recogerán las RESOLUCIONES, de inscripción, modificación o supresión de los ficheros notificados, remitidas a '.$cname.' por parte de la Agencia Española de Protección de Datos.'),0,'J');
$pdf->Ln(5);

//ANEXO III
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('Anexo III. Personal con acceso autorizado'),0,'L');
$pdf->Ln(5);

$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(0,6,utf8_decode('RESPONSABLE DE LOS FICHEROS'),0,'J');
$pdf->Ln(5);
$pdf->SetWidths(array(80,25,65));
$pdf->SetAligns(array('C','C','C'));
$pdf->Row(array("Nombre","CIF/NIF","Representante legal"));
$pdf->Row(array($cname,$cif,html_entity_decode($reps["nombre"])));
$pdf->Ln(10);

$pdf->MultiCell(0,6,utf8_decode('RESPONSABLE DE SEGURIDAD'),0,'J');
$pdf->Ln(5);
$pdf->SetWidths(array(70,40,30,30));
$pdf->SetAligns(array('C','C','C','C'));
$pdf->Row(array("Nombre y Apellidos","Cargo","Fecha alta","Fecha baja"));
$falta="";
if(strcmp($rep_seg["fecha_alta"],"0000-00-00")!=0){$falta=date_conv($rep_seg["fecha_alta"]);}
$fbaja="";
if(strcmp($rep_seg["fecha_baja"],"0000-00-00")!=0){$fbaja=date_conv($rep_seg["fecha_baja"]);}
$pdf->Row(array(html_entity_decode($rep_seg["nombre"]),html_entity_decode($rep_seg["cargofuncion"]),$falta,$fbaja));
$pdf->Row(array("","","",""));
$pdf->Row(array("","","",""));
$pdf->Ln(10);

$pdf->MultiCell(0,6,utf8_decode('PERSONAL CON ACCESO A LOS FICHEROS'),0,'J');
$pdf->Ln(5);
$pdf->SetWidths(array(60,43,23,22,22));
$pdf->SetAligns(array('C','C','C','C','C'));
$pdf->Row(array("Nombre y Apellidos","Cargo","NIF","Fecha alta","Fecha baja"));
foreach($trab as $t){
    $falta="";
    if(strcmp($t["fecha_alta"],"0000-00-00")!=0){$falta=date_conv($t["fecha_alta"]);}
    $fbaja="";
    if(strcmp($t["fecha_baja"],"0000-00-00")!=0){$fbaja=date_conv($t["fecha_baja"]);}
    $pdf->Row(array(html_entity_decode($t["nombre"]),html_entity_decode($t["cargofuncion"]),$t["dni"],$falta,$fbaja));
}
$pdf->Row(array("","","","",""));
$pdf->Row(array("","","","",""));
$pdf->Ln(10);

$pdf->MultiCell(0,6,utf8_decode('ENTIDADES Y PERSONAS AJENAS, CON ACCESO A LOS FICHEROS'),0,'J');
$pdf->Ln(5);
$pdf->SetWidths(array(60,25,55,30));
$pdf->SetAligns(array('C','C','C','C'));
$pdf->Row(array("Cesionario","CIF","Actividad","Fecha firma"));
$ces_table = array();
foreach($ces as $c){
    if(!in_array($c["idcesionaria"],$ces_table)) {
        $nombre_ces = Model_Cliente::find($c["idcesionaria"])->get("nombre");
        $act_ces = Model_Cliente::find($c["idcesionaria"])->get("actividad");
        $cif_ces = Model_Cliente::find($c["idcesionaria"])->get("cif_nif");
        $fecha_cont="";
        if(strcmp($c["fecha_contrato"],"0000-00-00")!=0){$fecha_cont=date_conv($c["fecha_contrato"]);}
        $pdf->Row(array($nombre_ces, $cif_ces,$act_ces,$fecha_cont));
        $ces_table[] = $c["idcesionaria"];
    }
}
$pdf->Row(array("","","",""));
$pdf->Ln(5);

//ANEXO IV
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('Anexo IV. Funciones y obligaciones del personal'),0,'L');

$pdf->SetFont('Arial','U',9);
$pdf->MultiCell(0,6,utf8_decode('RESPONSABLE DE LOS FICHEROS'),0,'L');
$pdf->Ln(5);

$pdf->SetFont('Arial','',9);
$pdf->MultiCell(0,6,utf8_decode('A) FUNCIONES.'),0,'L');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - El Responsable de los Ficheros es el encargado jurídicamente de la seguridad de los ficheros y de las medidas establecidas en el presente documento.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - Será el encargado de implantar las medidas de seguridad establecidas en él y adoptará las medidas necesarias para que el personal afectado por este documento conozca las normas que afecten al desarrollo de sus funciones.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - Designará al Responsable de Seguridad que figura en el Anexo III.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('B) OBLIGACIONES.'),0,'L');$pdf->Ln(2.5);
$pdf->Ln(3);
$pdf->MultiCell(0,6,utf8_decode('   1. Generales'),0,'L');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('        - Implantar las medidas de seguridad establecidas en este documento.'),0,'L');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('        - Garantizar la difusión de este Documento entre todo el personal con acceso a los ficheros.'),0,'L');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('        - Deberá mantenerlo actualizado siempre que se produzcan cambios relevantes en el sistema de información o en la organización del mismo.'),0,'L');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('        - Deberá adecuar en todo momento el contenido del mismo a las disposiciones vigentes en materia de seguridad de datos,'),0,'L');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('        - Deberá designar uno o varios Responsables de Seguridad.'),0,'L');$pdf->Ln(2.5);
$pdf->Ln(3);
$pdf->MultiCell(0,6,utf8_decode('   2. Sistema Informático o aplicaciones de acceso al Fichero'),0,'L');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('        - El Responsable de los Ficheros se encargará de que los sistemas informáticos de acceso a los ficheros tengan su acceso restringido mediante un código de usuario y una contraseña.'),0,'L');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('        - Asimismo cuidará que todos los usuarios autorizados para acceder a los ficheros, relacionados en el Anexo III, tengan un código de usuario que será único, y que estará asociado a la contraseña correspondiente, que sólo será conocida por el propio usuario.'),0,'L');$pdf->Ln(2.5);
$pdf->Ln(3);
$pdf->MultiCell(0,6,utf8_decode('   3. Gestión de soportes'),0,'L');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('        - La salida de soportes informáticos, que contengan datos de carácter personal, fuera de los locales de '.$cname.', deberá ser expresamente autorizada por el Responsable de los Ficheros.'),0,'L');$pdf->Ln(2.5);
$pdf->Ln(3);
$pdf->MultiCell(0,6,utf8_decode('   4. Procedimientos de respaldo y recuperación'),0,'L');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('        - El Responsable de los Ficheros se encargará de verificar la definición y correcta aplicación de las copias de respaldo y recuperación de los datos.'),0,'L');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('        - Será necesaria la autorización por escrito de éste para la ejecución de los procedimientos de recuperación de los datos.'),0,'L');$pdf->Ln(2.5);

$pdf->Ln(5);

$pdf->SetFont('Arial','U',9);
$pdf->MultiCell(0,6,utf8_decode('RESPONSABLE DE SEGURIDAD'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(0,6,utf8_decode('A) FUNCIONES.'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('   - Es el encargado de coordinar y controlar las medidas definidas en el presente Documento de Seguridad.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('B) OBLIGACIONES.'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('   - El Responsable de Seguridad coordinará la puesta en marcha de las medidas de seguridad, colaborará con el Responsable de los Ficheros en la difusión del Documento de Seguridad y cooperará con el Responsable de los Ficheros controlando el cumplimiento de las mismas.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('1. Gestión de incidencias'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - El Responsable De Seguridad habilitará un Registro de Incidencias a disposición de todos los usuarios con el fin de que se registren en él cualquier incidencia que pueda suponer un peligro para la seguridad de los ficheros con datos de carácter personal.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - Analizará las incidencias registradas, tomando las medidas oportunas en colaboración con el Responsable de los Ficheros.'),0,'J');$pdf->Ln(2.5);
$pdf->Ln(5);

$pdf->SetFont('Arial','U',9);
$pdf->MultiCell(0,6,utf8_decode('OBLIGACIONES PARA TODAS LAS PERSONAS CON ACCESO A LOS FICHEROS'),0,'L');
$pdf->SetFont('Arial','',9);

$pdf->MultiCell(0,6,utf8_decode('1. Puestos de trabajo'),0,'L');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - Los puestos de trabajo estarán bajo la responsabilidad de algún usuario autorizado que garantizará que la información que muestran no pueda ser visible por personas no autorizadas.'),0,'L');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - Esto implica que tanto las pantallas como las impresoras u otro tipo de dispositivos conectados al puesto de trabajo deberán estar físicamente ubicados en lugares que garanticen esa confidencialidad.'),0,'L');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - Cuando el responsable de un puesto de trabajo lo abandone, bien temporalmente o bien al finalizar su turno de trabajo, deberá dejarlo en un estado que impida la visualización de los datos protegidos. Esto podrá realizarse a través de un protector de pantalla que impida la visualización de los datos. La reanudación del trabajo implicará la desactivación de la pantalla protectora con la introducción de la contraseña correspondiente.'),0,'L');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - En el caso de las impresoras deberá asegurarse de que no quedan documentos impresos en la bandeja de salida que contengan datos protegidos. Si las impresoras son compartidas con otros usuarios no autorizados para acceder a los datos de fichero, los responsables de cada puesto deberán retirar los documentos conforme vayan siendo impresos.'),0,'L');$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('2. Salvaguarda y protección de las contraseñas personales'),0,'L');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - Cada usuario será responsable de la confidencialidad de su contraseña y, en caso de que la misma sea conocida fortuita o fraudulentamente por personas no autorizadas, deberá registrarlo como incidencia y proceder a su cambio.'),0,'L');$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('3. Gestión de incidencias'),0,'L');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - Cualquier usuario que tenga conocimiento de una incidencia es responsable de la comunicación de la misma al Responsable de Seguridad, o de su anotación en el Registro de incidencias correspondiente.'),0,'L');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - El conocimiento y la no notificación de una incidencia por parte de un usuario será considerado como una falta contra la seguridad del fichero por parte de ese usuario.'),0,'L');$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('4. Gestión de soportes'),0,'L');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - Los soportes que contengan datos de carácter personal deberán estar claramente identificados con una etiqueta externa que indique de qué fichero se trata y que tipo de datos contiene. Deberán además registrarse en el Inventario de Soportes correspondiente.'),0,'L');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Aquellos medios y soportes que sean reutilizables, y que hayan contenido copias de datos de los ficheros, deberán ser borrados físicamente antes de su reutilización, de forma que los datos que contenían no sean recuperables.'),0,'L');$pdf->Ln(5);

$pdf->Ln(5);

//ANEXO V
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('Anexo V. Procedimientos de control y seguridad'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','U',10);
$pdf->MultiCell(0,6,utf8_decode('ASIGNACIÓN'),0,'L');
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(0,6,utf8_decode('Las contraseñas, asignadas a cada usuario por el Responsable de Seguridad, deberán reunir una serie de requisitos para ser válidas:'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('   - Se evitará en lo posible colocar palabras convencionales, números de teléfono, direcciones o fechas de nacimiento.'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('   - Se recomienda utilizar claves de al menos seis caracteres, intercalando mayúsculas con minúsculas y números con signos.'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('   - Se  evitarán las secuencias de números (123456), alfabeto (cdefgh) o teclado (qwerty).'),0,'J');
$pdf->Ln(5);
$pdf->SetFont('Arial','U',10);
$pdf->MultiCell(0,6,utf8_decode('DISTRIBUCIÓN'),0,'L');
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(0,6,utf8_decode('   - El Responsable de Seguridad distribuirá las claves de modo que cada usuario solamente tome conocimiento de su propia clave, con lo que no se consideran medios válidos, el correo electrónico o comunicarlo verbalmente delante de terceras personas.'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('   - Los usuarios se abstendrán de anotar las sus claves, a fin de evitar posibles vulneraciones o descubrimientos de éstas.'),0,'J');
$pdf->Ln(5);
$pdf->SetFont('Arial','U',10);
$pdf->MultiCell(0,6,utf8_decode('ALMACENAMIENTO'),0,'L');
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(0,6,utf8_decode('   - Para asegurar la confidencialidad de las contraseñas vigentes, el Responsable de Seguridad las conservará en lugares de acceso restringido (cajones con llave o cajas de seguridad) ya sea en soporte informático o en sobre cerrado y lacrado.'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('   - Cualquier anomalía que pudiera comprometer la confidencialidad de las contraseñas, deberá ser reflejada como incidencia en el registro correspondiente, procediendo de inmediato al cambio de contraseñas.'),0,'J');
$pdf->Ln(5);
$pdf->SetFont('Arial','BU',10);
$pdf->MultiCell(0,6,utf8_decode('PROCEDIMIENTO DE GESTIÓN DE SOPORTES'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(0,6,utf8_decode('Todo soporte que contenga datos de carácter personal, deberá permitir identificar el tipo de información que contiene, ser inventariado y almacenado en un lugar seguro con acceso restringido al personal autorizado para ello en el Documento de Seguridad.'),0,'J');
$pdf->Ln(5);
$pdf->SetFont('Arial','U',10);
$pdf->MultiCell(0,6,utf8_decode('IDENTIFICACIÓN'),0,'L');
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(0,6,utf8_decode('   - Los soportes utilizados en '.$cname.' deberán estar claramente identificados mediante una etiqueta que permita conocer el tipo de información contenido en cada unidad. En caso de los CD´s, en los que adosar una etiqueta dañaría la unidad láser lectora, se empleará un marcador indeleble.'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('   - No es válida la identificación externa (cajas, fundas,..) de los soportes, puesto que en muchos casos no se vuelven a insertar en su lugar, y por lo tanto, no se alcanzaría la finalidad perseguida de control sobre los mismos.'),0,'J');
$pdf->Ln(5);
$pdf->SetFont('Arial','U',10);
$pdf->MultiCell(0,6,utf8_decode('INVENTARIO'),0,'L');
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(0,6,utf8_decode('   - El Reglamento tan sólo exige que los soportes sean inventariados, dejando libertad al Responsable de Seguridad para emplear los medios que estime más oportunos.'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('   - Almacenamiento.'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('   - Los soportes deben ser almacenados en un lugar restringido al personal autorizado por el Responsable de Seguridad. Para ello, se mantendrán en cajones, armarios o cajas resguardados bajo llave, quedando ésta bajo custodia del Responsable de Seguridad.'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('   - Al mismo tiempo, se evitará la exposición de los soportes a la luz solar por tiempo prolongado, a temperaturas extremas, el polvo, la suciedad, los campos magnéticos y la humedad.'),0,'J');

//ANEXO VI
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('Anexo VI. Inventario de soportes'),0,'L');
$pdf->Ln(5);

$pdf->SetWidths(array(30,30,20,80));
$pdf->SetAligns(array('L','L','C','C'));
$pdf->Row(array("","","ALTAS","BAJAS"));

$pdf->SetFont('Arial','',11);
$pdf->SetWidths(array(30,30,20,10,10,40,20));
$pdf->SetAligns(array('C','C','C','C','C','C','C'));
$pdf->Row(array("SOPORTE","UBICACIÓN","FECHA","R*","D**","MÉTODO","FECHA"));
for($i=0;$i<35;$i++) {
    $pdf->Row(array("", "", "", "", "", "", ""));
}
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,8,utf8_decode('* = Reutilización'),0,'L');
$pdf->MultiCell(0,8,utf8_decode('** = Destrucción'),0,'L');

//ANEXO VII
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('Anexo VII. Registro de entrada de soportes'),0,'L');
$pdf->Ln(5);

for($i=0;$i<3;$i++){
    $pdf->SetFont('Arial','B',11);
    $pdf->SetWidths(array(180));
    $pdf->SetAligns(array('C'));
    $pdf->Row(array("SOPORTE"));

    $pdf->SetFont('Arial','',10);
    $pdf->SetWidths(array(50,70,60));
    $pdf->SetAligns(array('L','L','L'));
    $pdf->Row(array("TIPO DE SOPORTE:","","Fecha y hora de entrada:"));

    $pdf->SetWidths(array(50,130));
    $pdf->SetAligns(array('L','L'));
    $pdf->Row(array("CONTENIDO:",""));

    $pdf->SetWidths(array(50,70,60));
    $pdf->SetAligns(array('L','L','L'));
    $pdf->Row(array("REMITENTE:","","MEDIO DE ENVÍO:"));

    $pdf->SetWidths(array(50,130));
    $pdf->SetAligns(array('L','L'));
    $pdf->Row(array("FINALIDAD:",""));

    $pdf->SetWidths(array(50,70,60));
    $pdf->SetAligns(array('L','L','L'));
    $pdf->Row(array("PERSONA RESP. RECEPCIÓN:","","CARGO:"));

    $pdf->SetWidths(array(50,130));
    $pdf->SetAligns(array('L','L'));
    $pdf->Row(array("\n\nFIRMA","\n\nOBSERVACIONES:"));
    $pdf->Ln(15);
}

//ANEXO VIII
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('Anexo VIII. Registro de salida de soportes'),0,'L');
$pdf->Ln(5);

for($i=0;$i<3;$i++){
    $pdf->SetFont('Arial','B',12);
    $pdf->SetWidths(array(180));
    $pdf->SetAligns(array('C'));
    $pdf->Row(array("SOPORTE"));

    $pdf->SetFont('Arial','',10);
    $pdf->SetWidths(array(50,70,60));
    $pdf->SetAligns(array('L','L','L'));
    $pdf->Row(array("TIPO DE SOPORTE:","","Fecha y hora de entrada:"));

    $pdf->SetWidths(array(50,130));
    $pdf->SetAligns(array('L','L'));
    $pdf->Row(array("CONTENIDO:",""));

    $pdf->SetWidths(array(50,70,60));
    $pdf->SetAligns(array('L','L','L'));
    $pdf->Row(array("REMITENTE:","","MEDIO DE ENVÍO:"));

    $pdf->SetWidths(array(50,130));
    $pdf->SetAligns(array('L','L'));
    $pdf->Row(array("FINALIDAD:",""));

    $pdf->SetWidths(array(50,70,60));
    $pdf->SetAligns(array('L','L','L'));
    $pdf->Row(array("PERSONA RESP. RECEPCIÓN:","","CARGO:"));

    $pdf->SetWidths(array(50,130));
    $pdf->SetAligns(array('L','L'));
    $pdf->Row(array("\n\nFIRMA","\n\nOBSERVACIONES:"));
    $pdf->Ln(15);
}

//ANEXO IX
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('Anexo IX. Registro de incidencias'),0,'L');
$pdf->Ln(5);

$pdf->SetFont('Arial','',10);
$pdf->SetWidths(array(80,100));
$pdf->SetAligns(array('L','L'));
$pdf->Row(array("Fecha de notificación:","* Incidencia nº:"));

$pdf->SetWidths(array(80,100));
$pdf->SetAligns(array('L','L'));
$pdf->Row(array("Tipo de incidencia:","Fecha y hora de la incidencia:"));

$pdf->SetWidths(array(180));
$pdf->SetAligns(array('L'));
$pdf->Row(array("Descripción detallada de la incidencia:\n\n\n\n"));

$pdf->SetWidths(array(180));
$pdf->SetAligns(array('L'));
$pdf->Row(array("Recursos afectados o posibles efectos:\n\n"));

$pdf->SetWidths(array(180));
$pdf->SetAligns(array('L'));
$pdf->Row(array("* Acciones correctoras:\n\n\n"));

$pdf->MultiCell(0,10,utf8_decode('* A rellenar por el Responsable de Seguridad.'),0,'L');

$pdf->Ln(10);

$pdf->SetFont('Arial','B',12);
$pdf->SetWidths(array(180));
$pdf->SetAligns(array('C'));
$pdf->Row(array("\nPROCEDIMIENTO DE RECUPERACIÓN DE DATOS **\n\n"));

$pdf->SetFont('Arial','',10);
$pdf->SetWidths(array(80,100));
$pdf->SetAligns(array('L','L'));
$pdf->Row(array("Fichero afectado:","Soporte empleado:"));

$pdf->SetWidths(array(80,100));
$pdf->SetAligns(array('L','L'));
$pdf->Row(array("Persona encargada del proceso:","Fecha y hora:"));

$pdf->SetWidths(array(180));
$pdf->SetAligns(array('L'));
$pdf->Row(array("Procedimiento realizado:\n\n\n\n"));

$pdf->SetWidths(array(180));
$pdf->SetAligns(array('L'));
$pdf->Row(array("Datos restaurados:\n\n"));

$pdf->SetWidths(array(180));
$pdf->SetAligns(array('L'));
$pdf->Row(array("Datos recuperados manualmente:\n\n\n"));

$pdf->SetWidths(array(180));
$pdf->SetAligns(array('L'));
$pdf->Row(array("Incidencias durante el proceso:\n\n\n"));

$pdf->SetWidths(array(80,100));
$pdf->SetAligns(array('L','L'));
$pdf->Row(array("Persona que realiza la comunicación:\n\n\nFirma:","Responsable de Seguridad:\n\n\nFirma:"));

$pdf->MultiCell(0,10,utf8_decode('** A rellenar sólo si la incidencia es de este tipo.'),0,'L');

//ANEXO X
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('Anexo X. Documentos para el ejercicio de derechos'),0,'L');
$pdf->Ln(5);

$pdf->SetFont('Arial','',9);
$pdf->MultiCell(0,6,utf8_decode('Seguidamente le facilitamos distintos modelos de cartas que habrán de facilitarse a aquéllos interesados que soliciten el ejercicio de alguno de sus derechos ARCO contemplados en la Ley Orgánica de Protección de Datos de Carácter Personal.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Los modelos relacionados son:'),0,'J');
$pdf->Ln(3);
$pdf->MultiCell(0,5,utf8_decode('   - SOLICITUD DE EJERCICIO DEL DERECHO DE ACCESO'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('     (Para la petición de información sobre sus datos personales incluidos en los ficheros)'),0,'J');
$pdf->MultiCell(0,5,utf8_decode('   - SOLICITUD DE EJERCICIO DEL DERECHO DE RECTIFICACIÓN'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('     (Para la petición de corrección de datos personales por ser inexactos o incorrectos)'),0,'J');
$pdf->MultiCell(0,5,utf8_decode('   - SOLICITUD DE EJERCICIO DEL DERECHO DE CANCELACIÓN'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('     (Para la petición de la cancelación de sus datos personales incluidos en algún fichero)'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('   - RESPUESTA FAVORABLE al ejercicio del derecho de acceso'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('   - RESPUESTA NEGATIVA al ejercicio del derecho de acceso'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('   - RESPUESTA FAVORABLE al ejercicio del derecho de cancelación parcial de datos'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('   - RESPUESTA FAVORABLE al ejercicio del derecho de cancelación total de datos'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('   - RESPUESTA NEGATIVA al ejercicio del derecho de cancelación de datos'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('   - RESPUESTA FAVORABLE al ejercicio del derecho de rectificación de datos'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('   - RESPUESTA NEGATIVA al ejercicio del derecho de rectificación de datos'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('   - RESPUESTA NEGATIVA al ejercicio del derecho de impugnación de valoraciones'),0,'J');

//Letter 1
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->MultiCell(0,6,utf8_decode('SOLICITUD DE EJERCICIO DEL DERECHO DE ACCESO'),0,'C');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Petición de información sobre los datos personales incluidos en fichero'),0,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,6,utf8_decode('Solicitud a:'),0,'L');
$pdf->Ln(3);
$pdf->MultiCell(0,6,utf8_decode('A/A:        '.$cname),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('                 '.html_entity_decode(urldecode($dir))),0,'L');
$pdf->MultiCell(0,6,utf8_decode('                 '.$cp.', '.$loc.', '.$prov),0,'L');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,6,utf8_decode('DATOS DEL SOLICITANTE'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('D./ Dª ............................................................................, mayor de edad, con D.N.I....................... (del que acompaña fotocopia), con domicilio en la C/........................................................... nº........, Localidad ........................................... Provincia .......................................... C.P. ............... por medio del presente escrito manifiesta su deseo de ejercer su derecho de acceso, de conformidad con el artículo 15 de la Ley Orgánica 15/1999, y los artículos 12 y 13 del Real Decreto 1332/94.'),0,'J');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,6,utf8_decode('SOLICITA.-'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('1.- Que se le facilite gratuitamente el acceso a sus ficheros en el plazo máximo de un mes a contar desde la recepción de esta solicitud, entendiendo que si transcurre este plazo sin que de forma expresa se conteste a la mencionada petición de acceso se entenderá denegada. En este caso se interpondrá la oportuna reclamación ante la Agencia de Protección de Datos para iniciar el procedimiento de tutela de derechos, en virtud del artículo 18 de la Ley Orgánica y 17 del Real Decreto.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('2.- Que si la solicitud del derecho de acceso fuese estimada, se remita por correo la información a la dirección arriba indicada en el plazo de diez días desde la resolución estimatoria de la solicitud de acceso.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('3.- Que esta información comprenda de modo legible e inteligible los datos de base que sobre mi persona están incluidos en sus ficheros, y los resultantes de cualquier elaboración, proceso o tratamiento, así como el origen de los datos, los cesionarios y la especificación de los concretos usos y finalidades para los que se almacenaron.'),0,'J');$pdf->Ln(2.5);
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('En ............................, a ......... de ........................... de ...........'),0,'C');

//Letter 2
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->MultiCell(0,6,utf8_decode('SOLICITUD DE EJERCICIO DEL DERECHO DE RECTIFICACIÓN'),0,'C');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Petición de corrección de datos personales incluidos en fichero por ser inexactos o incorrectos'),0,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,6,utf8_decode('Solicitud a:'),0,'L');
$pdf->Ln(3);
$pdf->MultiCell(0,6,utf8_decode('A/A:        '.$cname),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('                 '.html_entity_decode(urldecode($dir))),0,'L');
$pdf->MultiCell(0,6,utf8_decode('                 '.$cp.', '.$loc.', '.$prov),0,'L');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,6,utf8_decode('DATOS DEL SOLICITANTE'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('D/Dª ............................................................... mayor de edad, con D.N.I.......................... (del que acompaña fotocopia), con domicilio en la calle ............................................................... nº.........., Localidad ............................................, Provincia .............................................C.P. ................, por medio del presente escrito manifiesta su deseo de ejercer su derecho de rectificación, de conformidad con el artículo 16 de la Ley Orgánica 15/1999, y los artículos 15 y 16 del Real Decreto 1332/94.'),0,'J');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,6,utf8_decode('SOLICITA.-'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('1.- Que se proceda gratuitamente a la efectiva corrección en el plazo de diez días desde la recepción de esta solicitud, de los datos inexactos relativos a mi persona que se encuentren en sus ficheros.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('2.- Los datos que hay que rectificar se enumeran en la hoja anexa, haciendo referencia a los documentos que se acompañan a esta solicitud y que acreditan, en caso de ser necesario, la veracidad de los nuevos datos.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('3.- Que me comuniquen de forma escrita a la dirección arriba indicada, la rectificación de los datos una vez realizada.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('4.- Que, en el caso de que el responsable del fichero considere que la rectificación o la cancelación no procede, lo comunique igualmente, de forma motivada y dentro del plazo de diez días señalado, a fin de poder interponer la reclamación prevista en el artículo 18 de la Ley.'),0,'J');$pdf->Ln(2.5);
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('En ............................, a ......... de ........................... de ...........'),0,'C');

//Anexo Letter 2
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->MultiCell(0,6,utf8_decode('ANEXO - DATOS QUE DEBEN RECTIFICARSE'),0,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','',11);
$pdf->MultiCell(0,6,utf8_decode('Dato erróneo           Dato correcto           Documento acreditativo'),0,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,10,utf8_decode('1.- ....................................................................................................................................'),0,'L');
$pdf->MultiCell(0,10,utf8_decode('2.- ....................................................................................................................................'),0,'L');
$pdf->MultiCell(0,10,utf8_decode('3.- ....................................................................................................................................'),0,'L');
$pdf->MultiCell(0,10,utf8_decode('4.- ....................................................................................................................................'),0,'L');
$pdf->MultiCell(0,10,utf8_decode('5.- ....................................................................................................................................'),0,'L');
$pdf->MultiCell(0,10,utf8_decode('6.- ....................................................................................................................................'),0,'L');
$pdf->MultiCell(0,10,utf8_decode('7.- ....................................................................................................................................'),0,'L');
$pdf->MultiCell(0,10,utf8_decode('8.- ....................................................................................................................................'),0,'L');
$pdf->MultiCell(0,10,utf8_decode('9.- ....................................................................................................................................'),0,'L');
$pdf->MultiCell(0,10,utf8_decode('10.- ....................................................................................................................................'),0,'L');

//Letter 3
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->MultiCell(0,6,utf8_decode('SOLICITUD DE EJERCICIO DEL DERECHO DE CANCELACIÓN'),0,'C');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Petición de cancelación de datos personales objeto de tratamiento incluido en fichero'),0,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,6,utf8_decode('Solicitud a:'),0,'L');
$pdf->Ln(3);
$pdf->MultiCell(0,6,utf8_decode('A/A:        '.$cname),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('                 '.html_entity_decode(urldecode($dir))),0,'L');
$pdf->MultiCell(0,6,utf8_decode('                 '.$cp.', '.$loc.', '.$prov),0,'L');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,6,utf8_decode('DATOS DEL SOLICITANTE'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('D/Dª .......................................................................................... mayor de edad, con D.N.I............................ (del que acompaña fotocopia), con domicilio en la calle ............................................................................... nº ........., Localidad ......................................... Provincia .........................................C.P. ............ por medio del presente escrito manifiesta su deseo de ejercer su derecho de cancelación, de conformidad con el artículo 16 de la Ley Orgánica 15/1999, y los artículos 15 y 16 del Real Decreto 1332/94.'),0,'J');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,6,utf8_decode('SOLICITA.-'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('1.- Que en el plazo de diez días desde la recepción de esta solicitud, se proceda a la efectiva cancelación de cualesquiera datos relativos a mi persona que se encuentren en sus ficheros, en los términos previstos en la Ley Orgánica 15/1999 de Protección de Datos de Carácter Personal y me lo comuniquen de forma escrita a la dirección arriba indicada.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('2.- Que, en el caso de que el responsable del fichero considere que dicha cancelación no procede, lo comunique igualmente, de forma motivada y dentro del plazo de diez días señalado, a fin de poder interponer la reclamación prevista en el artículo 18 de la Ley.'),0,'J');$pdf->Ln(2.5);
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('En ............................, a ......... de ........................... de ...........'),0,'C');

//Letter 4
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->MultiCell(0,6,utf8_decode('SOLICITUD DE EJERCICIO DEL DERECHO DE OPOSICIÓN'),0,'C');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Para la petición de la oposición al tratamiento de sus datos personales'),0,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,6,utf8_decode('Solicitud a:'),0,'L');
$pdf->Ln(3);
$pdf->MultiCell(0,6,utf8_decode('A/A:        '.$cname),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('                 '.html_entity_decode(urldecode($dir))),0,'L');
$pdf->MultiCell(0,6,utf8_decode('                 '.$cp.', '.$loc.', '.$prov),0,'L');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,6,utf8_decode('DATOS DEL SOLICITANTE'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('D/Dª .......................................................................................... mayor de edad, con D.N.I............................ (del que acompaña fotocopia), con domicilio en la calle ............................................................................... nº ........., Localidad ......................................... Provincia .........................................C.P. ............ por medio del presente escrito manifiesta su deseo de ejercer su derecho de oposición, de conformidad con los artículos 6.4, 17 y 30.4 de la Ley Orgánica 15/1999, y los artículos 34 a 36 del Real Decreto 1720/2007.'),0,'J');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,6,utf8_decode('EXPONGO'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('...........................................................................................................'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('...........................................................................................................'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('...........................................................................................................'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('Para acreditar la situación descrita, acompaño copia de los siguientes documentos:'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('...........................................................................................................'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('...........................................................................................................'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('...........................................................................................................'),0,'L');
$pdf->Ln(10);
$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,6,utf8_decode('SOLICITO.-'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Que sea atendido mi ejercicio del derecho de oposición en los términos anteriormente expuestos.'),0,'J');$pdf->Ln(2.5);
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('En ............................, a ......... de ........................... de ...........'),0,'C');

//$fecha=explode("-",date('d-m-Y'));

//Reply 1
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Ln(25);
$pdf->SetLeftMargin(105);
$pdf->MultiCell(0,6,utf8_decode('A/A: '),0,'L');
$pdf->Ln(25);
$pdf->SetFont('Arial','',10);
$pdf->SetLeftMargin(20);
$pdf->MultiCell(0,6,"...... de ................ de ........",0,'R');
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('Estimado ............................. :'),0,'L');
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('En cumplimiento de los derechos que la Ley Orgánica 15/1999, de 13 de Diciembre, confiere a los ciudadanos, como respuesta a su solicitud, me complace facilitarle la consulta de los datos personales, de los cuales es usted titular, y que figuran en nuestros sistemas.'),0,'L');
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('Atentamente :                                                           '),0,'R');
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('Fdo  ........................................................'),0,'R');

//Reply 2
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Ln(25);
$pdf->SetLeftMargin(105);
$pdf->MultiCell(0,6,utf8_decode('A/A: '),0,'L');
$pdf->Ln(25);
$pdf->SetFont('Arial','',10);
$pdf->SetLeftMargin(20);
$pdf->MultiCell(0,6,"...... de ................ de ........",0,'R');
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('Estimado ............................. :'),0,'L');
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('En cumplimiento de los derechos que la Ley Orgánica 15/1999, de 13 de Diciembre, confiere a los ciudadanos, como respuesta a su solicitud, me complace comunicarle que la petición de cancelación parcial de sus datos ha sido atendida.'),0,'L');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('La cancelación dará lugar a la supresión o, en su caso, al bloqueo de los datos, conservándose únicamente aquellos que por obligación legal deban mantenerse a disposición de las Administraciones Públicas, Jueces y Tribunales, para la atención de las posibles responsabilidades nacidas del tratamiento, durante el plazo de prescripción de éstas.'),0,'L');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Cumplido el citado plazo procederemos  a la supresión definitiva de los datos.'),0,'L');
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('Atentamente :                                                           '),0,'R');
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('Fdo  ........................................................'),0,'R');

//Reply 3
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Ln(25);
$pdf->SetLeftMargin(105);
$pdf->MultiCell(0,6,utf8_decode('A/A: '),0,'L');
$pdf->Ln(25);
$pdf->SetFont('Arial','',10);
$pdf->SetLeftMargin(20);
$pdf->MultiCell(0,6,"...... de ................ de ........",0,'R');
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('Estimado ............................. :'),0,'L');
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('En cumplimiento de los derechos que la Ley Orgánica 15/1999, de 13 de Diciembre, confiere a los ciudadanos, como respuesta a su solicitud, me complace comunicarle que la petición de cancelación total de sus datos ha sido atendida.'),0,'L');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('La cancelación dará lugar a la supresión o, en su caso, al bloqueo de los datos, conservándose únicamente aquellos que por obligación legal deban mantenerse a disposición de las Administraciones Públicas, Jueces y Tribunales, para la atención de las posibles responsabilidades nacidas del tratamiento, durante el plazo de prescripción de éstas.'),0,'L');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Cumplido el citado plazo procederemos  a la supresión definitiva de los datos.'),0,'L');
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('Atentamente :                                                           '),0,'R');
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('Fdo  ........................................................'),0,'R');

//Reply 4
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Ln(25);
$pdf->SetLeftMargin(105);
$pdf->MultiCell(0,6,utf8_decode('A/A:'),0,'L');
$pdf->Ln(25);
$pdf->SetFont('Arial','',10);
$pdf->SetLeftMargin(20);
$pdf->MultiCell(0,6,"...... de ................ de ........",0,'R');
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('Estimado ............................. :'),0,'L');
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('En cumplimiento de los derechos que la Ley Orgánica 15/1999, de 13 de Diciembre, confiere a los ciudadanos, como respuesta a su solicitud, me complace comunicarle que la solicitud de rectificación de sus datos ha sido atendida de acuerdo con sus indicaciones.'),0,'L');$pdf->Ln(2.5);
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('Atentamente :                                                           '),0,'R');
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('Fdo  ........................................................'),0,'R');

//Reply 5
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Ln(25);
$pdf->SetLeftMargin(105);
$pdf->MultiCell(0,6,utf8_decode('A/A:'),0,'L');
$pdf->Ln(25);
$pdf->SetFont('Arial','',10);
$pdf->SetLeftMargin(20);
$pdf->MultiCell(0,6,"...... de ................ de ........",0,'R');
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('Estimado ............................. :'),0,'L');
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('En cumplimiento de los derechos que la Ley Orgánica 15/1999, de 13 de Diciembre, confiere a los ciudadanos, como respuesta a su solicitud, ponemos es su conocimiento que en nuestros sistemas no disponemos de datos personales de los cuales usted es titular.'),0,'L');$pdf->Ln(2.5);
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('Atentamente :                                                           '),0,'R');
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('Fdo  ........................................................'),0,'R');

//Reply 6
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Ln(25);
$pdf->SetLeftMargin(105);
$pdf->MultiCell(0,6,utf8_decode('A/A:'),0,'L');
$pdf->Ln(25);
$pdf->SetFont('Arial','',10);
$pdf->SetLeftMargin(20);
$pdf->MultiCell(0,6,"...... de ................ de ........",0,'R');
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('Estimado ............................. :'),0,'L');
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('En cumplimiento de los derechos que la Ley Orgánica 15/1999, de 13 de Diciembre, confiere a los ciudadanos, como respuesta a su solicitud, lamento comunicarle que no es posible cancelar sus datos en nuestros ficheros por formar parte de un contrato (negocial, laboral o administrativo), y ser necesarios para el cumplimiento de éste.'),0,'L');$pdf->Ln(2.5);
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('Atentamente :                                                           '),0,'R');
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('Fdo  ........................................................'),0,'R');

//Reply 7
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Ln(25);
$pdf->SetLeftMargin(105);
$pdf->MultiCell(0,6,utf8_decode('A/A:'),0,'L');
$pdf->Ln(25);
$pdf->SetFont('Arial','',10);
$pdf->SetLeftMargin(20);
$pdf->MultiCell(0,6,"...... de ................ de ........",0,'R');
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('Estimado ............................. :'),0,'L');
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('En cumplimiento de los derechos que la Ley Orgánica 15/1999, de 13 de Diciembre, confiere a los ciudadanos, como respuesta a su solicitud, ponemos en su conocimiento que sus datos no son utilizados para la realización de valoraciones, y por lo tanto, no disponemos de la información que nos solicita.'),0,'L');$pdf->Ln(2.5);
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('Atentamente :                                                           '),0,'R');
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('Fdo  ........................................................'),0,'R');

//Reply 8
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Ln(25);
$pdf->SetLeftMargin(105);
$pdf->MultiCell(0,6,utf8_decode('A/A:'),0,'L');
$pdf->Ln(25);
$pdf->SetFont('Arial','',10);
$pdf->SetLeftMargin(20);
$pdf->MultiCell(0,6,"...... de ................ de ........",0,'R');
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('Estimado ............................. :'),0,'L');
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('En cumplimiento de los derechos que la Ley Orgánica 15/1999, de 13 de Diciembre, confiere a los ciudadanos, como respuesta a su solicitud, ponemos en su conocimiento que nuestros sistemas no contienen los datos que desea rectificar.'),0,'L');$pdf->Ln(2.5);
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('Atentamente :                                                           '),0,'R');
$pdf->Ln(15);
$pdf->MultiCell(0,6,utf8_decode('Fdo  ........................................................'),0,'R');

// Write all to the output
$pdf->Output("DOC-SEGURIDAD-".$cname.".pdf",'I');