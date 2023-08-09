<?php

class PDFp extends PDF_MC_Table{
    var $customer = "";

    function __construct($orientation='P', $unit='mm', $size='A4',$customer="NO DEFINIDO"){
        parent::__construct($orientation, $unit, $size);
        $this->customer = $customer;
    }

    function Header(){
        if($this->PageNo()!=1) {
            $this->SetFont('Arial', 'B', 14);
            $this->SetTextColor(0, 0, 0);
            $this->Cell(0, 25, utf8_decode('             INFORME DE EVALUACIÓN DE RIESGOS     '), 0, 0, 'R');
            $this->Ln(5);
            $this->SetFont('Arial', 'I', 13);
            $this->Cell(0, 45, utf8_decode("        Comunidad Propietarios " . html_entity_decode($this->customer) . "     "), 0, 0, 'R');
            $this->Ln(20);
        }
        $this->Image('http://gestion.agdata.es/assets/img/logo2.png',20,13,40);
        $this->Ln(15);
        $this->SetTextColor(0,0,0);
    }

    function Footer(){

        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(0,80,185);
        if($this->PageNo()!='{nb}' && $this->PageNo()!=1) {
            $this->SetY(-25);
            $this->Cell(0, 10, utf8_decode('Página ' . $this->PageNo() . ' de {nb}'), 0, 2, 'C');
            $this->Cell(0,10,utf8_decode('INFORME DE EVALUACIÓN DE RIESGOS'),0,2,'L');
            //$this->Cell(0,20,utf8_decode("Comunidad Propietarios ".html_entity_decode($this->customer)),0,0,'R');
            $this->SetTextColor(0,0,0);
        }
        else{
            $this->SetY(-30);
            $this->SetFont('Arial', '', 14);
            $this->Cell(0, 10, utf8_decode('_____________________________________________________________'),0,0,'C');
            $this->Ln(10);
            $this->Cell(0, 10, utf8_decode('COORDINACIÓN DE ACTIVIDADES EMPRESARIALES (C.A.E.) '), 0, 2, 'C');
        }
    }
}
if(strpos($cname,"O'd")!==false) {
    $cname = str_replace("o-d", "o'd", strtolower($cname));
}
if(strpos($direccion,"O'd")!==false) {
    $dir = str_replace("o-d", "o'd", strtolower($direccion));
}
$cname = html_entity_decode($cname);
$adminfincas = html_entity_decode($adminfincas);
$dir = html_entity_decode($direccion);
$loc = html_entity_decode($loc);
$prov = html_entity_decode($prov);

$pdf = new PDFp('P','mm','A4',$cname);

$pdf->AddFont('Arial','','arial.php');
$title = 'INFORME DE EVALUACION DE RIESGOS';
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
$pdf->SetFont('Helvetica','I',42);
$pdf->SetTextColor(0,80,185);
$pdf->Ln(40);
$pdf->Cell(0,10,utf8_decode('INFORME'),0,0,'C');
$pdf->Ln(40);
$pdf->Cell(0,10,utf8_decode('DE EVALUACIÓN'),0,0,'C');
$pdf->Ln(40);
$pdf->Cell(0,10,utf8_decode('DE RIESGOS'),0,0,'C');
$pdf->Ln(45);
$pdf->SetFont('Arial','B',20);
$pdf->MultiCell(0,12,utf8_decode("Comunidad de Propietarios"),0,'C');
$pdf->MultiCell(0,12,utf8_decode(mb_strtoupper(html_entity_decode($cname))),0,'C');
$pdf->Ln(10);

//Index
$pdf->AddPage();
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',14);
$pdf->MultiCell(0,10,strtoupper('indice'),0,'L');

$pdf->SetFont('Arial','B',11);
$pdf->Cell(5,6,utf8_decode('1. INTRODUCCIÓN'),0,1,'L');$pdf->Ln(2);
$pdf->SetFont('Arial','',10);
$pdf->Cell(5,6,utf8_decode('    1.1. Objeto del informe'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('    1.2. Datos de la Comunidad de Propietarios'),0,1,'L');
$pdf->Ln(2);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(5,6,utf8_decode(mb_strtoupper('2. METODOLOGÍA')),0,1,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(5,6,utf8_decode('    2.1. Procedimiento de Evaluación de Riesgos'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('    2.2. Criterios de Evaluación de Riesgos'),0,1,'L');$pdf->Ln(2);
$pdf->Cell(5,6,utf8_decode('        2.2.1 Evaluación de Riesgos impuesta por legislación específica'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('            a) Legislación industrial y de edificación'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('            b) Legislación de Prevención de Riesgos Laborales'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('            c) Otra normativa'),0,1,'L');$pdf->Ln(2);
$pdf->Cell(5,6,utf8_decode('        2.2.2 Evaluación de riesgos para los que no existe legislación específica'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('            a) Lista de identificación Inicial de Riesgos'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('            b) Métodos de evaluación'),0,1,'L');$pdf->Ln(2);
$pdf->Cell(5,6,utf8_decode('        2.2.3 Evaluación general de riesgos'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('            a) Probabilidad y Naturaleza del Riesgo'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('            b) Calificación del riesgo'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('            c) Codificación de riesgos'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('            d) Información recabada para la Evaluación de Riesgos'),0,1,'L');$pdf->Ln(2);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(5,6,utf8_decode('3. DESCRIPCIÓN TÉCNICO PREVENTIVA DEL CENTRO EVALUADO'),0,1,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(5,6,utf8_decode('    3.1. Descripción organizativa del centro de trabajo'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('    3.2. Descripción física del centro de trabajo'),0,1,'L');$pdf->Ln(2);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(5,6,utf8_decode('4. IDENTIFICACIÓN, VALORACIÓN, EVALUACIÓN Y CONTROL DE RIESGOS'),0,1,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(5,6,utf8_decode('    4.1. Identificación y valoración de riesgos'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('    4.2. Control de riesgos. Medidas preventivas'),0,1,'L');$pdf->Ln(2);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(5,6,utf8_decode('5. INFORMACIÓN A ENTREGAR A LAS CONTRATAS'),0,1,'L');$pdf->Ln(2);
$pdf->Cell(5,6,utf8_decode('6. CONCLUSIONES'),0,1,'L');

//seccion 1
$pdf->AddPage();
$pdf->SetFont('Arial','BU',12);
$pdf->MultiCell(0,10,strtoupper(utf8_decode('I. Introducción')),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('En el marco de la Ley de Prevención de Riesgos Laborales, y como establece la exposición de motivos de la misma, la protección del trabajador frente a los riesgos laborales exige una actuación en la empresa que desborda el mero cumplimiento formal de un conjunto predeterminado, más o menos amplio, de deberes y obligaciones empresariales y, más aún, la simple corrección a posteriori de situaciones de riesgo ya manifestadas. La planificación de la prevención desde el momento mismo del diseño del proyecto empresarial, la evaluación inicial de los riesgos inherentes al trabajo y su actualización periódica a medida que se alteren las circunstancias, la ordenación de un conjunto coherente y globalizador de medidas de acción preventiva adecuadas a la naturaleza de los riesgos detectados y el control de la efectividad de dichas medidas constituyen los elementos básicos del nuevo enfoque en la prevención de riesgos laborales que la Ley plantea. Y, junto a ello, claro está, la información y la formación de los trabajadores dirigidas a un mejor conocimiento tanto del alcance real de los riesgos derivados del trabajo como de la forma de prevenirlos y evitarlos, de manera adaptada a las peculiaridades de cada centro de trabajo, a las características de las personas que en él desarrollan su prestación laboral y a la actividad concreta que realizan.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('En cumplimiento de lo anterior, Comunidad Propietarios '.$cname.' deberá realizar una evaluación de los riesgos para la seguridad y salud de los trabajadores de aquellas empresas que desarrollen trabajos en las instalaciones de la comunidad, teniendo en cuenta, con carácter general, la naturaleza de la actividad, las características de los trabajos y de los lugares en los que se desarrollan.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Si los resultados de la evaluación pusieran de manifiesto situaciones de riesgo, la Comunidad Propietarios '.$cname.' realizarán aquellas actividades preventivas necesarias para eliminar o para reducir y controlar tales riesgos. Dichas actividades serán objeto de planificación, incluyendo para cada actividad preventiva el plazo para llevarla a cabo, la designación de responsables y los recursos humanos y materiales necesarios para su ejecución.'),0,'J');
$pdf->Ln(5);

//1.1 y 1.2
$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,10,utf8_decode('1.1. Objeto del informe'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('El objeto del presente informe es realizar la Evaluación Inicial de Riesgos de la Comunidad de Propietarios '.$cname.', en cumplimiento del artículo 16.2 de la Ley 31/1995 de Prevención de Riesgos Laborales.'),0,'J');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,10,utf8_decode('1.2. Datos de la comunidad'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetWidths(array(45,120));
$pdf->SetAligns(array('L','L'));
$pdf->Row(array("Razón Social",utf8_decode($cname)));
$pdf->Row(array("C.I.F.",$cif));
$pdf->Row(array("Dirección",html_entity_decode($direccion).'. '.$cpostal.'. '.html_entity_decode($loc).'. '.html_entity_decode($prov)));
$pdf->Row(array("Administrador de Fincas",$adminfincas));
$pdf->Ln(10);

//2
$pdf->AddPage();
$pdf->SetFont('Arial','BU',12);
$pdf->MultiCell(0,10,utf8_decode('2. METODOLOGÍA'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('La evaluación inicial de riesgos se realiza para todos y cada uno de los posibles riesgos que se puedan dar en el desarrollo de los diferentes trabajos que en la Comunidad de Propietarios '.$cname.' se desarrollan por parte de empresas, teniendo en cuenta las condiciones de trabajo existentes o previstas.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('En la realización de la evaluación se han observado las disposiciones relativas a la consulta y participación de los trabajadores (art. 33, y 35 LPRL), y sus derechos de representación (art. 34 y 35 LPRL) así como los criterios sobre el procedimiento establecido (art. 5 RSP).'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Para la presente evaluación de riesgos se han seguido los siguientes pasos:'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('a) Identificación de los peligros detectados. Identificación y determinación de los riesgos que pueden evitarse, no evaluables y corregibles de inmediato.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('b) Evaluación de aquellos riesgos que no pueden evitarse, tanto del centro de trabajo como de los puestos de trabajo.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - Estimación del riesgo valorando conjuntamente la probabilidad y la consecuencia de que se materialice el peligro'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - Valoración del riesgo, emisión de un juicio en función de su tolerabilidad y del valor obtenido en la estimación.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('c) Control del Riesgo y Planificación Preventiva'),0,'J');$pdf->Ln(2.5);

//2.1
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('2.1. Procedimiento de Evaluación de Riesgos'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('La elaboración del informe permite, en caso de daño para la salud, la fácil identificación del riesgo y su segregación para facilitar a la Autoridad Laboral la evaluación y a la Comunidad de Propietarios '.$cname.' la realización de la investigación pertinente.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Para la obtención de datos se solicita a la Comunidad de Propietarios '.$cname.', una serie de información respecto a la tipología de instalaciones de la comunidad para el estudio y revisión de las condiciones de seguridad de las mismas.'),0,'J');$pdf->Ln(2.5);
$pdf->Ln(5);

//2.2
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('2.2. Criterios de Evaluación de Riesgos'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('A partir de la información obtenida sobre la Comunidad de Propietarios '.$cname.', características y complejidad de las instalaciones donde las diferentes empresas desarrollarán los diferentes trabajos, se procederá a la determinación de los elementos peligrosos y a la identificación de las empresas expuestos a los mismos, valorando a continuación el riesgo existente en función de criterios objetivos, según los conocimientos técnicos existentes, o consensuados con los trabajadores, de manera que pueda llegarse a una conclusión sobre la necesidad de evitar o de controlar y reducir el riesgo.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Se exponen a continuación los procedimientos de evaluación seguidos en la metodología propuesta, definidos en el artículo 5 del Real Decreto 39/1997, por el que se aprueba el Reglamento de los Servicios de Prevención.'),0,'J');$pdf->Ln(2.5);
$pdf->Ln(5);

//2.2.1
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('2.2.1 Evaluación de Riesgos impuesta por Legislación Específica'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Se comprueba el cumplimiento de la legislación, obteniendo como resultado situaciones de cumplimiento o incumplimiento de dicha normativa, calificando la situación de incumplimiento como el riesgo no aceptable.'),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(0,6,utf8_decode('a) Legislación Industrial y de edificación'),0,'J');$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Con relación a los riesgos que se presentan en los diferentes trabajos llevado a cabo por empresas en las instalaciones y equipos, para los cuales existe una legislación nacional, autonómica y/o local de seguridad industrial y/o de edificación, el cumplimiento de dichas legislaciones supondrá que los riesgos derivados de estas instalaciones y equipos están controlados.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('La evaluación estará enfocada a verificar que se cumplen los requisitos administrativos establecidos en la legislación que le sea de aplicación y en los términos que en ella se señalan.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   * Real Decreto 314/2006, de 17 de marzo, por el que se aprueba el Código Técnico de la Edificación (B.O.E. nº 54 28/03/2006). En adelante CTE.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Si bien, a nivel arquitectónico y estructural son aplicables los requisitos de la normativa en edificación que estuviera vigente en el momento de la construcción del centro, tanto para reformas posteriores a la entrada en vigor del CTE, como para los aspectos relacionados con la seguridad y salud en los que el RD 486/97 remite a la normativa sectorial correspondiente, se toma como referencia la normativa vigente en el momento de la elaboración del informe y no la previa, por estar derogada.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   * Real Decreto 842/2002, de 2 de agosto, por el que se aprueba el Reglamento electrotécnico para baja tensión (B.O.E. nº 224 del 18/9/2002). En adelante REBT.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   * Real Decreto 393/2007, de 23 de marzo, por el que se aprueba la Norma Básica de Autoprotección de los centros, establecimientos y dependencias dedicados a actividades que puedan dar origen a situaciones de emergencia (B.O.E. nº 72 de 24/03/2007). En adelante RD 393/2007.'),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(0,6,utf8_decode('b) Legislación de Prevención de Riesgos Laborales'),0,'J');$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('En cuanto a las condiciones peligrosas contempladas en la normativa específica de prevención de riesgos laborales, algunas normas establecen procedimientos de evaluación de riesgos, mientras que otras se limitan a contemplar especificaciones de mínimos que debe cumplir la condición peligrosa.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('La evaluación asegurará el cumplimiento de los requisitos técnicos que exige la legislación específica correspondiente.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   * Ley 31/1995, de 8 de noviembre, de Prevención de Riesgos Laborales (B.O.E. nº 269 de 10/11/1995). En adelante LPRL.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   * Real Decreto 39/1997, de 17 de enero, por el que se aprueba el reglamento de los servicios de prevención. (B.O.E. nº 27 de 31/01/1997). En adelante RD 39/1997.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   * Real Decreto 486/1997, de 14 de abril, por el que se establecen las disposiciones mínimas de seguridad y salud en los lugares de trabajo. (B.O.E. nº 97 de 23/04/1997). En adelante RD 486/97.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   * Real Decreto 485/1997, de 14 de abril sobre disposiciones mínimas en materia de señalización de seguridad y salud en el trabajo (B.O.E. nº 97 de 23/04/1997). En adelante RD 485/97.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   * Real Decreto 488/1997, de 14 de abril, sobre disposiciones mínimas de seguridad y salud relativas al trabajo con equipos que incluyen pantallas de visualización. (BOE nº 97 23/04/1997)'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   * Real Decreto 1215/1997, de 18 de Julio, por el que se establecen las disposiciones mínimas de seguridad y salud para la utilización por los trabajadores de los equipos de trabajo (B.O.E. nº 188 de 07/08/1997). En adelante RD 1215/1997.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   * Real Decreto 773/1997, de 30 de mayo, sobre disposiciones mínimas de seguridad y salud relativas a la utilización por los trabajadores de equipos de protección individual (B.O.E. nº140 de 12/06/1997). En adelante RD 773/97'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   * Real Decreto 171/2004, por el que se desarrolla el artículo 24 de la Ley 31/1995 de 8 de noviembre de Prevención de Riesgos Laborales, en materia de coordinación de actividades empresariales (B.O.E. nº 27 de 31/1/2004). En adelante RD 171/2004.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   * Real Decreto 614/2001, de 8 de junio, sobre disposiciones mínimas para la protección de la salud y seguridad de los trabajadores frente al riesgo eléctrico (B.O.E. nº 148 de 21/6/2001). En adelante RD 614/2001.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   * Real Decreto 664/1997, de 12 de mayo, sobre la protección de los trabajadores contra los riesgos relacionados con la exposición a agentes biológicos durante el trabajo (B.O.E. nº 124 de 24 de mayo de 1997).'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   * Real Decreto 1942/1993 de 5 de noviembre en el que se aprueba el "Reglamento de instalaciones de protección contra incendios", y en la Orden de 16 de abril de 1998. En adelante RIPCI.'),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(0,6,utf8_decode('c) Otras normativas'),0,'J');$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('   * Real Decreto 1428/2003, de 21 de noviembre, por el que se aprueba el Reglamento General de Circulación para la aplicación y desarrollo del texto articulado de la Ley sobre tráfico, circulación de vehículos a motor y seguridad vial, aprobado por el Real Decreto Legislativo 339/1990, de 2 de marzo.'),0,'J');$pdf->Ln(2.5);

//2.2.2
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('2.2.2 Evaluación de riesgos para los que no existe legislación específica'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Conforme a lo dispuesto en el Reglamento de los Servicios de Prevención, cuando la evaluación de riesgos exija realizar mediciones, análisis o ensayos y la normativa específica no indique el procedimiento o determine claramente criterios de evaluación, se podrán utilizar criterios técnicos recogidos en normas o guías técnicas que sí establecen el procedimiento e incluso, en algunos casos, los niveles máximos de exposición recomendados; en estos casos, la evaluación se desarrollará a partir de las consideraciones que indique la norma o guía técnica de referencia.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('A continuación, se relacionan guías técnicas de referencia:'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   * Guía para la realización de la evaluación de riesgos del Instituto Nacional de Seguridad e Higiene en el Trabajo, en adelante Guía ER INSHT.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   * Guía técnica del INSHT que desarrolla el RD 485/1997 sobre disposiciones mínimas en materia de señalización de seguridad y salud en el trabajo. En adelante Guía INSHT del RD 485/97.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   * Guía técnica del INSHT que desarrolla el RD 486/1997 sobre las condiciones mínimas de seguridad y salud laboral en los lugares de trabajo. En adelante Guía INSHT del RD 486/97'),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(0,6,utf8_decode('a) Lista de identificación Inicial de Riesgos'),0,'J');$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Destinada a la detección inicial de riesgos, la lista de identificación inicial de riesgos sirve para conocer si existe exposición a riesgos relacionados con los siguientes apartados:'),0,'J');$pdf->Ln(2.5);

$pdf->SetDrawColor(0, 0, 0);
$pdf->SetWidths(array(120));
$pdf->SetAligns(array('C'));
$pdf->Row(array("Condiciones térmicas"));
$pdf->Row(array("Manipulación de cargas"));
$pdf->Row(array("Ruido"));
$pdf->Row(array("Posturas / Repetitividad"));
$pdf->Row(array("Iluminación"));
$pdf->Row(array("Fuerzas"));
$pdf->Row(array("Calidad del ambiente interior"));
$pdf->Ln(5);

$pdf->MultiCell(0,6,utf8_decode('Respecto a la calificación de los riesgos, de forma general, un ítem detectado significa "posible situación de riesgo no tolerable", lo que no implica necesariamente que se esté en situación de riesgo y el nivel de riesgo será tanto mayor cuanto mayor sea el número de ítems señalados.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('En este punto se puede cerrar la evaluación, dando unas indicaciones que formarán parte de la planificación de la actividad preventiva, o se puede pasar a otro nivel de evaluación, utilizando para ello el método de evaluación para cada ítem marcado.'),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(0,6,utf8_decode('b) Métodos de evaluación'),0,'J');$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Identificado uno o varios ítems en la lista inicial y en función de la exposición, puede considerarse necesario utilizar un método de evaluación que proporcione información suficiente para cerrar la evaluación.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Se puede necesitar profundizar más, a través de la aplicación de otro/s métodos recomendados por normas UNE, guías del Instituto Nacional de Seguridad e Higiene en el Trabajo (INSHT), normas internacionales, guías de entidades de reconocido prestigio.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Finalmente se adoptarán las medidas preventivas, que resulten necesarias.'),0,'J');$pdf->Ln(2.5);

//2.2.3
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('2.2.3 Evaluación general de riesgos'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Cualquier riesgo que no se encuentre contemplado en los apartados anteriores, se evaluará mediante el Método General de Evaluación del Instituto Nacional de Seguridad e Higiene en el Trabajo (INSHT). En este método, una vez identificado el riesgo, se procede a su estimación teniendo en cuenta la potencial severidad del daño y la probabilidad de que éste ocurra.'),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(0,6,utf8_decode('a) Probabilidad y naturaleza del riesgo'),0,'J');$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('La probabilidad de que ocurra el daño se puede graduar desde baja hasta alta, con el siguiente criterio:'),0,'J');$pdf->Ln(5);

$pdf->SetWidths(array(40,80));
$pdf->SetAligns(array('C','L'));
$pdf->SetFont('Arial','B',10);
$pdf->Row(array("PROBABILIDAD",""));
$pdf->SetFont('Arial','',10);
$pdf->Row(array("BAJA","El daño ocurrirá siempre o casi siempre"));
$pdf->Row(array("MEDIA","El daño ocurrirá en algunas ocasiones"));
$pdf->Row(array("ALTA","El daño ocurrirá raras veces"));
$pdf->Ln(10);

$pdf->MultiCell(0,6,utf8_decode('La naturaleza del daño, se puede graduar desde ligeramente dañino a extremadamente dañino, teniendo en cuenta el siguiente criterio:'),0,'J');$pdf->Ln(5);

$pdf->SetWidths(array(60,60,60));
$pdf->SetAligns(array('C','L','L'));
$pdf->SetFont('Arial','B',10);
$pdf->Row(array("NATURALEZA DEL DAÑO","",""));
$pdf->SetFont('Arial','',10);
$pdf->Row(array("\nLIGERAMENTE DAÑINA","Daños superficiales: cortes y magulladuras pequeñas, irritación de los ojos por polvo","Molestias e irritación, por ejemplo: dolor de cabeza, disconfort"));
$pdf->Row(array("\nDAÑINA","Laceraciones, quemaduras, conmociones, torceduras importantes, fracturas menores","Sordera, dermatitis, asma, trastornos músculo-esqueléticos, enfermedad que conduce a una incapacidad menor"));
$pdf->Row(array("\nEXTREMADAMENTE DAÑINA","Amputaciones, fracturas mayores, intoxicaciones, lesiones múltiples, lesiones fatales","Cáncer y otras enfermedades crónicas que acorten severamente la vida"));
$pdf->Ln(10);

$pdf->MultiCell(0,6,utf8_decode('A los distintos niveles de riesgo a los que hemos aparejado una serie de medidas preventivas a implantar, hemos de asignarles un tipo de prioridad que incidirá directamente sobre los plazos de ejecución correspondientes.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('La estimación de los riesgos se efectúa a partir de la siguiente tabla:'),0,'J');$pdf->Ln(2.5);

$pdf->SetWidths(array(40,120));
$pdf->SetAligns(array('C','C'));
$pdf->SetFont('Arial','B',10);
$pdf->Row(array("PROBABILIDAD","NATURALEZA DEL DAÑO"));
$pdf->SetWidths(array(40,40,40,40));
$pdf->SetAligns(array('C','C','C','C'));
$pdf->Row(array("","LIGERAMENTE DAÑINA","DAÑINA","EXTREMADAMENTE DAÑINA"));
$pdf->SetFont('Arial','',10);
$pdf->Row(array("BAJA","TRIVIAL","TOLERABLE","MODERADO"));
$pdf->Row(array("MEDIA","TOLERABLE","MODERADO","IMPORTANTE"));
$pdf->Row(array("ALTA","MODERADO","IMPORTANTE","INTOLERABLE"));
$pdf->Ln(5);

$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(0,6,utf8_decode('b) Calificación del riesgo'),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Los niveles de riesgos indicados en el cuadro anterior, forman la base para decidir si se requiere mejorar los controles existentes o implantar unos nuevos, así como la temporización de las acciones. Se tomará como criterios de punto de partida para la toma de decisión los marcados en la siguiente tabla. La tabla también indica que los esfuerzos precisos para el control de los riesgos y la urgencia con la que deben adoptarse las medidas de control que deben ser proporcionales al riesgo.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Con objeto de contribuir a una mejor planificación de las medidas propuestas, se procederá a calificar la magnitud de los riesgos contemplados en cada factor de riesgo identificado. La calificación se efectuará como resultado de la comparación del criterio de evaluación empleado según los criterios, siendo sólo de aplicación para evaluaciones generales de riesgos.'),0,'J');$pdf->Ln(2.5);

$pdf->SetWidths(array(50,120));
$pdf->SetAligns(array('C','L'));
$pdf->SetFont('Arial','B',10);
$pdf->Row(array("RIESGO","ACCIÓN Y TEMPORIZACIÓN"));
$pdf->SetFont('Arial','',10);
$pdf->Row(array("RIESGO TRIVIAL (T)","No se requiere acción específica"));
$pdf->Row(array("\n\nRIESGO TOLERABLE (TO)","No se necesita mejorar la acción preventiva. Sin embargo: \n\nSe deben considerar soluciones más rentables o mejoras que no supongan una carga económica importante. \n\nSe requieren comprobaciones periódicas para asegurar que se mantiene la eficacia de las medidas de control."));
$pdf->Row(array("\n\nRIESGO MODERADO (MO)","Se deben hacer esfuerzos para reducir el riesgo, determinando las inversiones precisas. Las medidas para reducir el riesgo deben implantarse en un período determinado. \n\nCuando el riesgo moderado esta asociado con consecuencias extremadamente dañinas, se precisará una acción posterior para establecer, con más precisión, la probabilidad de daño como base para determinar la necesidad de mejora de las medidas de control."));
$pdf->Row(array("\n\nRIESGO IMPORTANTE (I)","No debe comenzarse el trabajo hasta que se haya reducido el riesgo. \n\nPuede que se precisen recursos considerables para controlar el riesgo. \n\nCuando el riesgo corresponda a un trabajo que se está realizando, debe remediarse el problema en un tiempo inferior al de los riesgos moderados."));
$pdf->Row(array("\n\nRIESGO INTOLERABLE (IN)","No debe comenzar ni continuar el trabajo hasta que se reduzca el riesgo. \n\nSi no es posible reducir el riesgo, incluso con recursos ilimitados, debe prohibirse el trabajo."));
$pdf->Row(array("\n\nPENDIENTE DE EVALUAR (PE)","En aquellos casos donde no se disponga de información suficiente o se requiera efectuar un estudio especifico de la condición evaluada, se indicará esta calificación y programará como medida propuesta la actuación a desarrollar. \n\nEl nivel de prioridad dependerá del tipo de estudio a efectuar"));
$pdf->Ln(5);

$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(0,6,utf8_decode('c) Codificación de riesgos'),0,'J');$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Los riesgos a valorar son los establecidos en la siguiente relación. En caso de ser necesario se añadirán en el riesgo 25 "Otros" los que sean precisos para una mejor determinación de las condiciones evaluadas.'),0,'J');$pdf->Ln(5);

$pdf->SetWidths(array(30,150));
$pdf->SetAligns(array('C','C'));
$pdf->SetFont('Arial','B',10);
$pdf->Row(array("CÓDIGO","RIESGO IDENTIFICADO"));
$pdf->SetFont('Arial','',10);
$pdf->SetAligns(array('C','L'));
$pdf->Row(array("1","Caída de personal a distinto nivel"));
$pdf->Row(array("2","Caída de personas al mismo nivel"));
$pdf->Row(array("3","Caída de objetos por desplome o derrumbamiento"));
$pdf->Row(array("4","Caída de objetos en manipulación"));
$pdf->Row(array("5","Caída de objetos desprendidos"));
$pdf->Row(array("6","Pisadas sobre objetos"));
$pdf->Row(array("7","Golpes o choques contra objetos inmóviles"));
$pdf->Row(array("8","Golpes o choques contra objetos móviles"));
$pdf->Row(array("9","Contacto con sustancias cáusticas y/o corrosivas"));
$pdf->Row(array("10","Exposición a agentes químicos"));
$pdf->Row(array("11","Exposición a sustancias nocivas o tóxicas"));
$pdf->Row(array("12","Incendios"));
$pdf->Row(array("13","Contactos térmicos"));
$pdf->Row(array("14","Atrapamiento por o entre objetos"));
$pdf->Row(array("15","Explosiones"));
$pdf->Row(array("16","Sobreesfuerzos"));
$pdf->Row(array("17","Ruido"));
$pdf->Row(array("18","Exposición a agentes biológicos"));
$pdf->Row(array("19","Golpes y cortes con objetos o herramientas"));
$pdf->Row(array("20","Contactos eléctricos"));
$pdf->Row(array("21","Atropellos o golpes y choques con o contra vehículos. Accidentes de tránsito (In itinere)"));
$pdf->Row(array("22","Proyección de fragmentos o partículas"));
$pdf->Row(array("23","Estrés térmico"));
$pdf->Row(array("24","Carga física"));
$pdf->Row(array("25","Otros"));
$pdf->Ln(15);

$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(0,6,utf8_decode('d) Información recabada para la Evaluación de Riesgos'),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('La información recabada de la Comunidad de Propietarios '.$cname.' consiste en:'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - Listado de instalaciones con las que cuenta la comunidad.'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('   - En su caso, relación de empleados contratados por la comunidad.'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('   - Relación de contratas y subcontratas con las que se mantienen contratos de prestación de obras o servicios y la actividad que desarrollan.'),0,'J');
$pdf->Ln(2.5);

//3 and 3.1
$pdf->AddPage();
$pdf->SetFont('Arial','BU',12);
$pdf->MultiCell(0,10,utf8_decode('3. DESCRIPCIÓN TÉCNICO PREVENTIVA DEL CENTRO EVALUADO'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('3.1 Descripción organizativa del centro de trabajo'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Al ser la '.$cname.' una comunidad de propietarios, no procede la identificación de integrantes para el desarrollo y cumplimiento de las obligaciones en materia de PRL.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Por otro lado, se incluye a continuación la relación de contratas/subcontratas que prestan sus servicios en el centro de trabajo.'),0,'J');$pdf->Ln(2.5);

$pdf->SetWidths(array(60,30,80));
$pdf->SetAligns(array('C','C','C'));
$pdf->SetFont('Arial','B',10);
$pdf->Row(array("EMPRESA","CIF","SERVICIO CONTRATADO"));
$pdf->SetFont('Arial','',10);
$pdf->SetAligns(array('L','C','L'));
$pdf->Row(array("TBC","TBC","TBC"));
$pdf->Row(array("TBC","TBC","TBC"));
$pdf->Row(array("TBC","TBC","TBC"));
$pdf->Ln(5);

//3.2
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('3.2 Descripción física del centro de trabajo'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Las dependencias ocupadas por la Comunidad Propietarios '.$cname.' cuenta con las siguientes instalaciones y/o edificaciones propias, en las que se realizan trabajos por parte de terceros.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - TBC'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - TBC'),0,'J');$pdf->Ln(2.5);

$pdf->MultiCell(0,6,utf8_decode(''),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode(''),0,'J');$pdf->Ln(2.5);


//4
//3 and 3.1
$pdf->AddPage();
$pdf->SetFont('Arial','BU',12);
$pdf->MultiCell(0,10,utf8_decode('4. IDENTIFICACIÓN, VALORACIÓN, EVALUACIÓN DE RIESGOS'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('4.1 Identificación y valoración de riesgos'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('TBC - Según cuadro Excel. En función de las instalaciones que tengan informadas en cuestionario CAE'),0,'J');$pdf->Ln(2.5);

//4.2
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('4.2 Control de riesgos. Medidas preventivas'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(0,10,utf8_decode('Cód. 1. Caída de personal a distinto nivel'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->Ln(5);
//TBC
$pdf->MultiCell(0,6,utf8_decode('Según lo establecido en el Real Decreto 486/1997, de 14 de abril, sobre disposiciones mínimas de seguridad y salud en espacios y lugares de trabajo y el Real Decreto 314/2006, de 17 de marzo, por el que se aprueba el Código Técnico de la Edificación y la NTP 404:'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Las escaleras fijas deben cumplir como mínimo:'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode(''),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode(''),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode(''),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode(''),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode(''),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode(''),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode(''),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode(''),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode(''),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode(''),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode(''),0,'J');$pdf->Ln(2.5);




//5
$pdf->AddPage();
$pdf->SetFont('Arial','BU',12);
$pdf->MultiCell(0,10,utf8_decode('5. INFORMACIÓN A ENTREGAR A LAS EMPRESAS'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('De acuerdo con  Ley de Prevención de Riesgos Laborales, se deberá informar a las empresas que desarrollen trabajos en la Comunidad de Propietarios '.$cname.' sobre:'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - Los riesgos para la seguridad y la salud existentes en la Comunidad, tanto aquellos que afecten en su conjunto como a cada tipo de puesto de trabajo o función.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - Las medidas y actividades de protección y prevención aplicables a los riesgos señalados en el apartado anterior.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - Las medidas adoptadas en relación a las medidas frente a emergencias.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Esta información, contenida en el presente informe, debe facilitarse a las empresas y mantener al día el registro de entrega de la misma, estableciendo un acuse de recibo que permita al responsable de la Comunidad acreditar el cumplimiento de su obligación de informar.'),0,'J');$pdf->Ln(2.5);

$pdf->Ln(5);

//6
$pdf->SetFont('Arial','BU',12);
$pdf->MultiCell(0,10,utf8_decode('6. CONCLUSIONES'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('El resultado de la Evaluación de Riesgos pone de manifiesto la existencia de situaciones de riesgo y/o incumplimientos reglamentarios que deben ser evitados o minimizados, para ello se proponen una serie de medidas preventivas que deberán formar parte de la planificación de la actividad preventiva, que deberá ser aprobada e implantada por parte de los responsables pertinentes de conformidad con la Ley de Prevención de Riesgos Laborales.'),0,'J');$pdf->Ln(2.5);
$pdf->Ln(50);
$pdf->MultiCell(0,6,utf8_decode('Informe elaborado por: D. Patricio García Alonso'),0,'R');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Técnico Superior en Prevención de Riesgos Laborales'),0,'R');$pdf->Ln(2.5);

// Write all to the output
$pdf->Output("Informe CAE - ".$cname.".pdf",'I');