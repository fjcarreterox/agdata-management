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
            $this->Cell(0, 25, utf8_decode('             INFORME DE EVALUACIÓN DE RIESGOS     '), 0, 0, 'C');
            $this->Ln(5);
            $this->SetFont('Arial', 'I', 13);
            $this->Cell(0, 45, utf8_decode("             Comunidad Propietarios " . html_entity_decode($this->customer) . "     "), 0, 0, 'C');
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
            $this->SetY(-20);
            $this->Cell(0, 10, utf8_decode('Página ' . $this->PageNo() . ' de {nb}'), 0, 2, 'C');
            $this->Cell(0,10,utf8_decode('INFORME DE EVALUACIÓN DE RIESGOS'),0,2,'L');
            $this->Cell(0,-10,utf8_decode("C.PP. ".html_entity_decode($this->customer)),0,0,'R');
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
$pdf->Ln(5);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',14);
$pdf->MultiCell(0,10,strtoupper(utf8_decode('índice')),0,'L');

$pdf->SetFont('Arial','B',11);
$pdf->Cell(5,6,utf8_decode('I. INTRODUCCIÓN'),0,1,'L');$pdf->Ln(2);
$pdf->SetFont('Arial','',10);
$pdf->Cell(5,6,utf8_decode('    1.1. Objeto del informe'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('    1.2. Datos de la Comunidad de Propietarios'),0,1,'L');
$pdf->Ln(2);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(5,6,utf8_decode(mb_strtoupper('II. METODOLOGÍA')),0,1,'L');
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
$pdf->Cell(5,6,utf8_decode('III. DESCRIPCIÓN TÉCNICO PREVENTIVA DEL CENTRO EVALUADO'),0,1,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(5,6,utf8_decode('    3.1. Descripción organizativa del centro de trabajo'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('    3.2. Descripción física del centro de trabajo'),0,1,'L');$pdf->Ln(2);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(5,6,utf8_decode('IV. IDENTIFICACIÓN, VALORACIÓN, EVALUACIÓN Y CONTROL DE RIESGOS'),0,1,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(5,6,utf8_decode('    4.1. Identificación y valoración de riesgos'),0,1,'L');
$pdf->Cell(5,6,utf8_decode('    4.2. Control de riesgos. Medidas preventivas'),0,1,'L');$pdf->Ln(2);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(5,6,utf8_decode('V. INFORMACIÓN A ENTREGAR A LAS CONTRATAS'),0,1,'L');$pdf->Ln(2);
$pdf->Cell(5,6,utf8_decode('VI. CONCLUSIONES'),0,1,'L');$pdf->Ln(2);
$pdf->Cell(5,6,utf8_decode('VII. FOTOGRAFÍAS GEOLOCALIZADAS DE LA C.PP.'),0,1,'L');

//seccion 1
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,strtoupper(utf8_decode('1. Introducción')),0,'L');
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
$pdf->Row(array("Razón Social",html_entity_decode($cname)));
$pdf->Row(array("C.I.F.",$cif));
$pdf->Row(array("Dirección",html_entity_decode($direccion).'. '.$cpostal.'. '.html_entity_decode($loc).'. '.html_entity_decode($prov)));
$pdf->Row(array("Administrador de Fincas",$adminfincas));
$pdf->Ln(10);

//2
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('2. METODOLOGÍA'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('La evaluación inicial de riesgos se realiza para todos y cada uno de los posibles riesgos que se puedan dar en el desarrollo de los diferentes trabajos que en la Comunidad de Propietarios '.$cname.' se desarrollan por parte de empresas, teniendo en cuenta las condiciones de trabajo existentes o previstas.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('En la realización de la evaluación se han observado las disposiciones relativas a la consulta y participación de los trabajadores (art. 33, y 35 LPRL), y sus derechos de representación (art. 34 y 35 LPRL) así como los criterios sobre el procedimiento establecido (art. 5 RSP).'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Para la presente evaluación de riesgos se han seguido los siguientes pasos:'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('a) Identificación de los peligros detectados. Identificación y determinación de los riesgos que pueden evitarse, no evaluables y corregibles de inmediato.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('b) Evaluación de aquellos riesgos que no pueden evitarse, tanto del centro de trabajo como de los puestos de trabajo.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   - Estimación del riesgo valorando conjuntamente la probabilidad y la consecuencia de que se materialice.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('  - Valoración del riesgo, emisión de un juicio en función de su tolerabilidad y del valor obtenido en la estimación.'),0,'J');$pdf->Ln(2.5);
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

$pdf->Ln(5);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetWidths(array(80));
$pdf->SetAligns(array('C'));
$pdf->Row(array("Condiciones térmicas"));
$pdf->Row(array("Manipulación de cargas"));
$pdf->Row(array("Ruido"));
$pdf->Row(array("Posturas / Repetitividad"));
$pdf->Row(array("Iluminación"));
$pdf->Row(array("Fuerzas"));
$pdf->Row(array("Calidad del ambiente interior"));
$pdf->Ln(10);

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
$pdf->Row(array("ALTA","El daño ocurrirá siempre o casi siempre"));
$pdf->Row(array("MEDIA","El daño ocurrirá en algunas ocasiones"));
$pdf->Row(array("BAJA","El daño ocurrirá raras veces"));
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

$pdf->AddPage();
$pdf->SetWidths(array(50,120));
$pdf->SetAligns(array('C','C'));
$pdf->SetFont('Arial','B',10);
$pdf->Row(array("RIESGO","ACCIÓN Y TEMPORIZACIÓN"));
$pdf->SetFont('Arial','',10);
$pdf->Row(array("RIESGO TRIVIAL (T)","No se requiere acción específica"));
$pdf->Row(array("\n\nRIESGO TOLERABLE (TO)","\nNo se necesita mejorar la acción preventiva. Sin embargo: \n\nSe deben considerar soluciones más rentables o mejoras que no supongan una carga económica importante. \n\nSe requieren comprobaciones periódicas para asegurar que se mantiene la eficacia de las medidas de control.\n\n"));
$pdf->Row(array("\n\nRIESGO MODERADO (MO)","\nSe deben hacer esfuerzos para reducir el riesgo, determinando las inversiones precisas. Las medidas para reducir el riesgo deben implantarse en un período determinado. \n\nCuando el riesgo moderado esta asociado con consecuencias extremadamente dañinas, se precisará una acción posterior para establecer, con más precisión, la probabilidad de daño como base para determinar la necesidad de mejora de las medidas de control.\n\n"));
$pdf->Row(array("\n\nRIESGO IMPORTANTE (I)","\nNo debe comenzarse el trabajo hasta que se haya reducido el riesgo. \n\nPuede que se precisen recursos considerables para controlar el riesgo. \n\nCuando el riesgo corresponda a un trabajo que se está realizando, debe remediarse el problema en un tiempo inferior al de los riesgos moderados.\n\n"));
$pdf->Row(array("\n\nRIESGO INTOLERABLE (IN)","\nNo debe comenzar ni continuar el trabajo hasta que se reduzca el riesgo. \n\nSi no es posible reducir el riesgo, incluso con recursos ilimitados, debe prohibirse el trabajo.\n\n"));
$pdf->Row(array("\n\nPENDIENTE DE EVALUAR (PE)","\nEn aquellos casos donde no se disponga de información suficiente o se requiera efectuar un estudio especifico de la condición evaluada, se indicará esta calificación y programará como medida propuesta la actuación a desarrollar. \n\nEl nivel de prioridad dependerá del tipo de estudio a efectuar\n\n"));
$pdf->Ln(5);

$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(0,6,utf8_decode('c) Codificación de riesgos'),0,'J');$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Los riesgos a valorar son los establecidos en la siguiente relación.'),0,'J');$pdf->Ln(5);

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
$pdf->Row(array("9","Exposición a sustancias nocivas o tóxicas"));
$pdf->Row(array("10","Incendios"));
$pdf->Row(array("11","Contacto térmico"));
$pdf->Row(array("12","Atrapamientos por o entre objetos"));
$pdf->Row(array("13","Explosiones"));
$pdf->Row(array("14","Sobreesfuerzos"));
$pdf->Row(array("15","Ruido"));
$pdf->Row(array("16","Golpes y cortes con objetos o herramientas"));
$pdf->Row(array("17","Contactos eléctricos"));
$pdf->Row(array("18","Atropellos o golpes y choques con o contra vehículos. Accidentes de tránsito (In itinere)"));
$pdf->Row(array("19","Proyección de fragmentos o partículas"));
$pdf->Row(array("20","Estrés térmico"));
$pdf->Row(array("21","Señalización"));
$pdf->Row(array("21","Condiciones Ambientales"));
$pdf->Row(array("21","Servicios Higiénicos"));
$pdf->Row(array("21","Ascensores"));
$pdf->Row(array("21","Formación e Información"));
$pdf->Row(array("21","Orden y limpieza"));
$pdf->Row(array("21","Humedades"));
$pdf->Row(array("21","Evacuaciones"));
$pdf->Row(array("21","Vigilancia de la salud"));
$pdf->Row(array("21","Botiquín"));
$pdf->Row(array("21","Piscina"));
$pdf->Row(array("21","Cuarto de Calderas"));
$pdf->Ln(15);

$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(0,6,utf8_decode('d) Información recabada para la Evaluación de Riesgos'),0,'J');$pdf->Ln(2.5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('La información recabada de la Comunidad de Propietarios '.$cname.' consiste en:'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('   * Listado de instalaciones con las que cuenta la comunidad.'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('   * Fotografías geolocalizadas de las instalaciones de la comunidad.'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('   * En su caso, relación de empleados contratados por la comunidad.'),0,'J');
$pdf->MultiCell(0,6,utf8_decode('  * Relación de contratas y subcontratas con las que se mantienen contratos de prestación de obras o servicios y la actividad que desarrollan.'),0,'J');
$pdf->Ln(2.5);

//3 and 3.1
$pdf->AddPage();
$pdf->SetFont('Arial','BU',12);
$pdf->MultiCell(0,10,utf8_decode('3. DESCRIPCIÓN TÉCNICO PREVENTIVA DEL CENTRO EVALUADO'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('3.1 Descripción organizativa del centro de trabajo'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Al ser '.$cname.' una comunidad de propietarios, no procede la identificación de integrantes para el desarrollo y cumplimiento de las obligaciones en materia de PRL.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Por otro lado, se incluye a continuación la relación de contratas/subcontratas que prestan sus servicios en el centro de trabajo.'),0,'J');$pdf->Ln(2.5);

$pdf->SetWidths(array(60,30,80));
$pdf->SetAligns(array('C','C','C'));
$pdf->SetFont('Arial','B',10);
$pdf->Row(array("EMPRESA","CIF","SERVICIO CONTRATADO"));
$pdf->SetFont('Arial','',10);
$pdf->SetAligns(array('L','C','L'));
$servicios = array("Conserjería","Limpieza","Vigilancia","Socorrista","Seguros","Mantenimientos","Otros");
foreach($contratas as $c => $item){
    $pdf->Row(array($item["nombre"],$item["cif"],$servicios[$item["servicio"]]));
}
$pdf->Row(array("","",""));
$pdf->Ln(5);

//3.2
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('3.2 Descripción física del centro de trabajo'),0,'L');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Las dependencias ocupadas por la Comunidad Propietarios '.$cname.' cuenta con las siguientes instalaciones y/o edificaciones propias, que pueden identificarse como posibles espacios de trabajo por parte de terceros.'),0,'J') ;$pdf->Ln(2.5);
$pdf->SetFont('Arial','B',10);
$general=false;
foreach($infocae as $i => $v):
    if($v==1 and $i!='id' and $i!='idcliente'){
        if($i=='portal' || $i=='azotea' || $i=='escaleras' || $i=='sotano' || $i=='contadoresluz' || $i=='bajatension' || $i=='contadoresagua' || $i=='jardines'){
            $general=true;
        }
        switch($i){
            case "contadoresluz": $i="Contadores de luz.";break;
            case "bajatensión": $i="Baja tensiÓn.";break;
            case "equipospresion": $i="Equipos de presiÓn.";break;
            case "contadoresagua": $i="Contadores de agua.";break;
            case "aseopiscina": $i="Aseo en la piscina.";break;
        }
        $pdf->MultiCell(0,6,utf8_decode(strtoupper('   - '.$i)),0,'J');$pdf->Ln(2.5);

    }
endforeach;
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode(''),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode(''),0,'J');$pdf->Ln(2.5);


//4
//4 and 4.1
$pdf->AddPage();
$pdf->SetFont('Arial','BU',12);
$pdf->MultiCell(0,10,utf8_decode('4. IDENTIFICACIÓN, VALORACIÓN, EVALUACIÓN DE RIESGOS'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('4.1 Identificación y valoración de riesgos'),0,'L');
$pdf->SetFont('Arial','',10);

$pdf->SetWidths(array(20,60,80));
$pdf->SetAligns(array('C','C','C'));
$pdf->SetFont('Arial','B',10);
$pdf->Row(array("Cod.","Riesgo Identificado","Valoración del riesgo"));
$pdf->SetFont('Arial','',10);
$pdf->SetAligns(array('C','C','C'));
$pdf->Row(array("1","Caída de personal a distinto nivel","TOLERABLE"));
$pdf->Row(array("2","Caída de personas al mismo nivel","TRIVIAL"));
$pdf->Row(array("3","Caída de objetos por desplome o derrumbamiento","TRIVIAL"));
$pdf->Row(array("4","Caída de objetos en manipulación","TRIVIAL"));
$pdf->Row(array("5","Caída de objetos desprendidos","TRIVIAL"));
$pdf->Row(array("6","Pisadas sobre objetos","TRIVIAL"));
$pdf->Row(array("7","Golpes o choques contra objetos inmóviles","TRIVIAL"));
$pdf->Row(array("8","Golpes o choques contra objetos móviles","TRIVIAL"));
$pdf->Row(array("9","Exposición a sustancias nocivas o tóxicas","TRIVIAL"));
$pdf->Row(array("10","Incendios","Según lo establecido en la Norma Básica de la Edificación NBE/CPI-96 sobre condiciones de protección contra incendios en los edificios."));
$pdf->Row(array("11","Contacto térmico","TOLERABLE"));
$pdf->Row(array("12","Atrapamientos por o entre objetos","TOLERABLE"));
$pdf->Row(array("13","Explosiones","TRIVIAL"));
$pdf->Row(array("14","Sobreesfuerzos","TRIVIAL"));
$pdf->Row(array("15","Ruido","Real Decreto 286/2006, de 10 de marzo, sobre la protección de la salud y la seguridad de los trabajadores contra los riesgos relacionados con la exposición al ruido."));
$pdf->Row(array("16","Golpes y cortes con objetos o herramientas","TOLERABLE"));
$pdf->Row(array("17","Contactos eléctricos","TOLERABLE"));
$pdf->Row(array("18","Atropellos o golpes y choques con o contra vehículos. Accidentes de tránsito (In itinere)","TRIVIAL"));
$pdf->Row(array("19","Proyección de fragmentos o partículas","TRIVIAL"));
$pdf->Row(array("20","Estrés térmico","Real Decreto 486/1997, de 14 de abril, por el que se establecen las disposiciones mínimas de seguridad y salud en los lugares de trabajo."));
$pdf->Row(array("21","Señalización","Real Decreto 486/1997, de 14 de abril, por el que se establecen las disposiciones mínimas de seguridad y salud en los lugares de trabajo."));
$pdf->Row(array("21","Condiciones Ambientales","Real Decreto 486/1997, de 14 de abril, por el que se establecen las disposiciones mínimas de seguridad y salud en los lugares de trabajo."));
$pdf->Row(array("21","Servicios Higiénicos, Formación e información, Orden y limpieza, Evacuaciones, Vigilancia de la Salud","Real Decreto 486/1997, de 14 de abril, por el que se establecen las disposiciones mínimas de seguridad y salud en los lugares de trabajo."));
$pdf->Row(array("21","Ascensores","Real Decreto 203/2016, de 20 de mayo, por el que se establecen los requisitos esenciales de seguridad para la comercialización de ascensores y componentes de seguridad para ascensores."));
$pdf->Row(array("21","Formación e información","Real Decreto 486/1997, de 14 de abril, por el que se establecen las disposiciones mínimas de seguridad y salud en los lugares de trabajo."));
$pdf->Row(array("21","Orden y limpieza","Real Decreto 486/1997, de 14 de abril, por el que se establecen las disposiciones mínimas de seguridad y salud en los lugares de trabajo."));
$pdf->Row(array("21","Humedades","Real Decreto 486/1997, de 14 de abril, por el que se establecen las disposiciones mínimas de seguridad y salud en los lugares de trabajo."));
$pdf->Row(array("21","Evacuaciones","Art. 20 de la Ley 31/1995, de 8 de noviembre, de Prevención de Riesgos Laborales."));
$pdf->Row(array("21","Vigilancia de la salud","Art. 20 de la Ley 31/1995, de 8 de noviembre, de Prevención de Riesgos Laborales."));
$pdf->Row(array("21","Botiquín","Real Decreto 486/1997, de 14 de abril, por el que se establecen las disposiciones mínimas de seguridad y salud en los lugares de trabajo."));
$pdf->Row(array("21","Piscina"," Decreto 485/2019, de 4 de junio, por el que se aprueba el Reglamento Técnico-Sanitario de las Piscinas en Andalucía."));
$pdf->Row(array("21","Cuarto de calderas","Real Decreto 486/1997, de 14 de abril, por el que se establecen las disposiciones mínimas de seguridad y salud en los lugares de trabajo."));
$pdf->Ln(10);

//4.2
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('4.2 Control de riesgos. Medidas preventivas'),0,'L');
$pdf->Ln(5);

if($general) {
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 10, utf8_decode('Código. 1. Caída de personal a distinto nivel'), 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Ln(5);

    $pdf->MultiCell(0, 6, utf8_decode('Según lo establecido en el Real Decreto 486/1997, de 14 de abril, sobre disposiciones mínimas de seguridad y salud en espacios y lugares de trabajo y el Real Decreto 314/2006, de 17 de marzo, por el que se aprueba el Código Técnico de la Edificación y la NTP 404.\n\nLas escaleras fijas deben cumplir como mínimo: en el uso de escaleras fijas se debe considerar los siguientes puntos:'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('Las escaleras fijas deben cumplir como mínimo:'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 6, utf8_decode('Normas de utilización.'), 0, 'J');
    $pdf->Ln(3);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('Todo trabajador que acuda a la comunidad que deba usar escaleras fijas debería seguir las siguientes normas de utilización:'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Subir o bajar tranquilamente sin prisas evitando hacerlo corriendo o empujando a la o las personas que le precedan.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Al bajar en grupo debería existir una persona responsable de conducir al mismo en el recorrido a fin de evitar una velocidad excesiva, e incluso el diálogo.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Utilizar siempre que sea posible las barandillas o pasamanos.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Utilizar calzado plano y con plantilla antideslizante.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Si la escalera no está suficientemente iluminada por tener alguno o todos los puntos de alumbrados fundidos, se haya derramado alguna sustancia que la haga especialmente peligrosa (barro, grasa, aceite, hielo, etc), las barandillas o pasamanos están deteriorados, presenta algún defecto constructivo o cualquier otra circunstancia peligrosa abstenerse de utilizarla avisando al servicio de mantenimiento de la circunstancia observada para que este proceda a su subsanación.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- No subir o bajar de dos en dos peldaños.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Algunas de estas recomendaciones podrían figurar en carteles de advertencia situados en los extremos de las escaleras.'), 0, 'J');
    $pdf->Ln(5);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 6, utf8_decode('Inspección y mantenimiento.'), 0, 'J');
    $pdf->Ln(3);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('Todas las escaleras deben inspeccionarse periódicamente en función de su uso y las condiciones a las que estén sometidas siendo recomendable hacerlo cada tres meses.'), 0, 'J');
    $pdf->Ln(5);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 6, utf8_decode('Se realizará las siguientes medidas correctoras:'), 0, 'J');
    $pdf->Ln(3);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('Todas las escaleras fijas del edificio se revisarán periódicamente.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('Las bandas antideslizantes deberán revisarse periódicamente para ser reparadas cuando estas presenten algún desperfecto.'), 0, 'J');
    $pdf->Ln(2.5);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 10, utf8_decode('Cód. 2. Caída de personal al mismo nivel'), 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Ln(5);

    $pdf->MultiCell(0, 6, utf8_decode('El riesgo de caídas al mismo nivel se puede presentar principalmente por:'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Caídas por resbalón o tropiezo en desplazamientos por la totalidad del centro de trabajo, y entorno de piscina, si bien el riesgo es más significativo en áreas exteriores y entradas/salidas en días lluviosos y/o durante la realización de las operaciones de mantenimiento y reparación de instalaciones de piscina.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Posibilidad de presencia de suelos húmedos (en labores de limpieza, pequeños derrames, fugas...) especialmente en el recinto de la piscina y alrededores.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Por tropiezos con obstáculos (mobiliario, cableado...) principalmente en áreas o lugares con gran densidad de equipos de trabajo.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Por irregularidades en el suelo (baldosas levantadas, juntas mal acabadas, tapas de alcantarillado o desagües rotos, discontinuidades del firme, desniveles...).'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('Siguiendo el Real Decreto 486/1997, de 14 de abril, se recomienda:'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 6, utf8_decode('Orden, limpieza y mantenimiento'), 0, 'J');
    $pdf->Ln(3);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('1. Las zonas de paso, salidas y vías de circulación de los lugares de trabajo y, en especial, las salidas y vías de circulación previstas para la evacuación en casos de emergencia, deberán permanecer libres de obstáculos de forma que sea posible utilizarlas sin dificultades en todo momento.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('2. Los lugares de trabajo, incluidos los locales de servicio, y sus respectivos equipos e instalaciones, se limpiarán periódicamente y siempre que sea necesario para mantenerlos en todo momento en condiciones higiénicas adecuadas. A tal fin, las características de los suelos, techos y paredes serán tales que permitan dicha limpieza y mantenimiento. Se eliminarán con rapidez los desperdicios, las manchas de grasa, los residuos de sustancias peligrosas y demás productos residuales que puedan originar accidentes o contaminar el ambiente de trabajo.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('3. Las operaciones de limpieza no deberán constituir por si mismas una fuente de riesgo para los trabajadores que las efectúen o para terceros, realizándose a tal fin en los momentos, de la forma y con los medios más adecuados.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('4. Los lugares de trabajo y, en particular, sus instalaciones, deberán ser objeto de un mantenimiento periódico, de forma que sus condiciones de funcionamiento satisfagan siempre las especificaciones del proyecto, subsanándose con rapidez las deficiencias que puedan afectar a la seguridad y salud de los trabajadores.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('Si se utiliza una instalación de ventilación, deberá mantenerse en buen estado de funcionamiento y un sistema de control deberá indicar toda avería siempre que sea necesario para la salud de los trabajadores.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('En el caso de las instalaciones de protección, el mantenimiento deberá incluir el control de su funcionamiento.'), 0, 'J');
    $pdf->Ln(5);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 6, utf8_decode('Se implementarán las siguientes medidas correctoras'), 0, 'J');
    $pdf->Ln(3);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('En general las instalaciones del edificio deberán permanecer libres de obstáculos en las zonas de paso y vías de evacuación, para que no se produzcan tropiezos por parte del personal del centro, al igual que pueda impedir una evacuación correcta del edificio en caso de emergencia.'), 0, 'J');
    $pdf->Ln(5);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 10, utf8_decode('Cód. 3. Caída de objetos por desplome o derrumbamiento.'), 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Ln(5);

    $pdf->MultiCell(0, 6, utf8_decode('El riesgo de caídas de objetos por desplome o derrumbamiento se puede produce cuando el sistema de estanterías (limpieza y productos de mantenimiento de piscina) no es lo suficientemente sólido o no están ancladas a la pared o entre si (dependiendo del modelo) para garantizar su estabilidad.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('Se recomienda que:'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Todas las estanterías deben incorporar una placa en la que se indique la carga máxima que pueden soportar.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Las estanterías deben disponer de la rigidez suficiente, ya sea mediante anclaje entre varias estanterías o por medio de anclaje de elementos estructurales, tanto frente a la sobrecarga vertical cómo horizontal.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Las partes altas de las estanterías, se sujetarán firmemente a las paredes y las intermedias se sujetarán entre sí mediante barras de resistencia adecuadas.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 6, utf8_decode('Se implementarán las siguientes medidas correctoras:'), 0, 'J');
    $pdf->Ln(3);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('Todas las estanterías del centro deberán anclarse, cada una de ellas, en función de sus características técnicas.'), 0, 'J');
    $pdf->Ln(5);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 10, utf8_decode('Cód. 4. Caída de objetos en manipulación.'), 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Ln(5);

    $pdf->MultiCell(0, 6, utf8_decode('Si bien el peso de la carga es uno de los principales factores de las lesiones, la forma del objeto, la posición de la carga y la postura que adoptemos constituyen otros factores de riesgo a tener en cuenta.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 6, utf8_decode('Medidas recomendables'), 0, 'J');
    $pdf->Ln(3);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('- Para levantar cajas o materiales, primero evaluar su peso. Si es demasiado pesado o tiene una forma poco práctica, pida ayuda o en su defecto utilizar medios auxiliares (carros). Evite moverse por suelos resbaladizos.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Antes de levantar la carga seleccione el camino más conveniente. Asegúrese de que el recorrido esté libre de obstáculos u objetos.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Inspeccione que la carga que va a mover no tenga clavos o terminaciones cortantes.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Colóquese frente al objeto con los pies levemente separados.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Doble las rodillas y póngase en cuclillas.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Realice un correcto agarre tomando la carga con la palma de la mano y la base de los dedos.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Mantenga la espalda erguida.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Levántese con suavidad utilizando la fuerza de sus piernas.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Busque el equilibrio: los pies enmarcando la carga, ligeramente separados y adelantados uno respecto al otro para aumentar el polígono de sustentación.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Alinee su centro de gravedad con el de la carga.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Transporte el peso cerca del cuerpo para poder ver el recorrido.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Si es necesario empuje la carga con los dos brazos, no tire de ella.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Nunca doble la cintura, con el peso la columna puede lesionarse. Si torsionamos el tronco mientras levantamos una carga podemos producirnos lesiones.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Para un trabajo seguro debemos dividir el movimiento en dos pasos: primero levantar la carga levemente y luego girar el cuerpo entero con pequeños pasos hasta efectuar la rotación.'), 0, 'J');
    $pdf->Ln(2.5);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 10, utf8_decode('Cód. 5. Caída de objetos desprendidos.'), 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Ln(5);

    $pdf->MultiCell(0, 6, utf8_decode('El riesgo de caídas de armario, estanterías, etc. puede darse por una estabilidad insuficiente en la instalación de los mismos o por un incorrecto almacenamiento de material en los mismos.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('Recomendaciones:'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Las mercancías se deben apilar o colocar correctamente, de manera que no haya caídas accidentales cuando se están almacenando o cuando se están recuperando.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Los objetos no deben sobresalir de los estantes y deben estar bien alineados y distribuidos de manera, que los objetos pesados se dispongan en la parte inferior y los ligeros en partes más elevadas.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- No se deben colocar objetos encima de los armarios, ni de objetos sin estadidad, pudiendo producirse caídas accidentales.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('En todo caso, se procederá a realizar un programa de revisión, mantenimiento y seguimiento de las estanterías del centro, detectando el almacenamiento de los materiales que se encuentran en ellas, evitando almacenar objetos en la parte alta y la sobrecarga de las mismas.'), 0, 'J');
    $pdf->Ln(2.5);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 10, utf8_decode('Cód. 6. Pisadas sobre objetos.'), 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Ln(5);

    $pdf->MultiCell(0, 6, utf8_decode('Este riesgo puede presentarse principalmente por la presencia en el suelo de obstáculos como cables eléctricos, cajas, etc., es decir, la falta de orden y limpieza en general Según el Real Decreto 486/97 sobre disposiciones mínimas de seguridad y salud de los lugares de trabajo.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('Recomendaciones:'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Todo personal de trabajo evitará colocar objetos que obstruyan las zonas de paso, salidas y vías de circulación y en especial las salidas y vías de circulación previstas para la evacuación en caso de emergencia. Deberán permanecer libres de obstáculos de forma que sea posible utilizarlas sin dificultades en todo momento.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- El espacio de trabajo debe de tener el equipamiento necesario, bien ordenado, bien distribuido y libre de objetos innecesarios o sobrantes, con unos procedimientos y hábitos de limpieza y orden establecidos, tanto para el personal que los realiza como para el usuario del puesto.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Se colocarán las estanterías necesarias para mejorar la disposición de materiales, objetos y productos y evitar que se acumulen en el suelo.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Eliminación de cajas y objetos que puedan originar accidentes por su localización dentro del lugar de trabajo.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Establecer lugares específicos para el almacenamiento de objetos y documentos, y se señalizarán aquellos objetos que por su ubicación y características puedan originar accidentes.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Deben disponerse contenedores específicos para la recogida de papel desechable.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('En todo caso, se realizará un programa de mantenimiento de instalaciones en general y se procederá a eliminar todos los objetos que no sean necesarios y los que lo sean, se instalarán en lugares apropiados para ello.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 6, utf8_decode('a) Cableado:'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('Es recomendable recoger los cables, así como, evitar el uso de cableado de largo alcance que puede ocasionar tropiezos.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 6, utf8_decode('b) Canaletas: '), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('Los cables se deben colocar de forma que queden fuera de las zonas de paso. Si esto no es posible, es recomendable colocar protección de los cables que están en el suelo mediante canaletas en las diferentes zonas. Las canaletas que ya existen en el centro cubriendo cables deben ser arregladas, las que están en malas condiciones, se intentaran rebajarlas debido a la gran altura que presentan de forma que no sea posible tropezar con ellas y producir una caída de forma accidental.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('Asimismo, se extremarán las condiciones generales de orden limpieza de los distintos departamentos, zonas comunes, almacenes y archivos del edificio.'), 0, 'J');
    $pdf->Ln(2.5);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 10, utf8_decode('Cód. 7. Golpes o choques contra objetos inmóviles.'), 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Ln(5);

    $pdf->MultiCell(0, 6, utf8_decode('El riesgo de golpes con objetos puede darse por golpes con muebles de aristas agudas y la falta de espacio.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('Recomendaciones:'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Que el mobiliario y sus acabados tales como bordes y esquinas sean redondeados por cuestiones de seguridad.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Los cajones deben tener topes de abertura, de manera que el cajón no salga del todo al abrirlo.'), 0, 'J');
    $pdf->Ln(2.5);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 10, utf8_decode('Cód. 8. Golpes o choques contra objetos móviles.'), 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Ln(5);

    $pdf->MultiCell(0, 6, utf8_decode('Ante el riesgo de golpes con objetos móviles, como pueden ser, los carritos de la limpieza, los carros para el transporte de cargas, etc., se recomienda disponer de cajones con dispositivos de bloqueo que impidan salirse de sus guías.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('Cuando se utilice algún tipo de transporte mecánico para las cargas, se deberá desplazar lentamente las cargas, evitando cualquier movimiento brusco, y de forma vertical para que no haya balanceo.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('No se deberá cargar cualquier equipo con pesos superiores a la máxima carga útil. La carga deberá estar bien equilibrada y bien sujeta.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('Los trabajadores que realicen su actividad cerca de donde se está haciendo el transporte, deberán prestar atención a la trayectoria y dimensiones de la carga, para no chocar contra ella.'), 0, 'J');
    $pdf->Ln(2.5);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 10, utf8_decode('Cód. 9. Exposición a sustancias nocivas o tóxicas.'), 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Ln(5);

    $pdf->MultiCell(0, 6, utf8_decode('En los trabajos de limpieza del centro de trabajo se utilizan una gran variedad de productos químicos peligrosos para la salud: productos tóxicos en mayor o menor grado, corrosivos, irritantes o inflamables.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('Los riesgos más frecuentes asociados a la utilización de estos productos químicos son:'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Contacto con productos agresivos'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Exposición a productos tóxicos o nocivos'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Incendio y explosión'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 6, utf8_decode('Medidas preventivas recomendadas'), 0, 'J');
    $pdf->Ln(3);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('a) Información sobre los riesgos y medidas de seguridad del producto.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('Los trabajadores han de disponer de la información y formación necesarias sobre los riesgos que supone la utilización de dichos productos, las medidas de seguridad a adoptar y la manera de actuar ante situaciones como derrames, incendios o intoxicaciones.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('b) Utilización'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('Cuando exista mala ventilación y la peligrosidad del producto así lo requiera, ante el riesgo de inhalación de vapores durante tareas de limpieza se recomienda usar mascarillas con filtros químicos y gafas protectoras que eviten la irritación de los ojos homologadas con marcado CE. Intentar sustituir los productos tóxicos o muy agresivos por otros productos menos peligrosos que consigan la misma eficacia. Todos los trabajadores deben seguir estrictamente las normas y procedimientos de trabajo establecidos para la utilización de estos productos.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('A modo de genérico se especifica:'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- La lectura obligatoria de la etiqueta o instrucciones antes de usar el producto.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- No mezclar los productos limpiadores.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Prohibición de comer, beber o fumar durante la manipulación del producto químico usado.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Los productos inflamables deben mantenerse alejados de cualquier foco de ignición (llamas, chispas, puntos muy calientes).'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Cuando sea necesario efectuar trasvases, se debe evitar el vertido libre desde recipientes. Emplear bidones provistos de dosificadores.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('Es obligatorio que todos los productos químicos peligrosos (tóxicos, nocivos, corrosivos, irritantes, inflamables, etc.) estén correctamente etiquetados. En las etiquetas, además de otros datos (nombre del producto, nombre y dirección del fabricante, etc.) se encuentra información resumida relativa al riesgo que puede conllevar el uso del producto y al uso seguro, mediante pictogramas de peligro.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('c) Almacenamiento'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Los productos se almacenarán en lugares apropiados, preferiblemente en armarios. Si es posible, señalizándolos.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Se limitarán las cantidades almacenadas, en las zonas de trabajo, a las estrictamente necesarias.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Se seguirán las normas indicadas en sus fichas de seguridad y normativa legal sobre almacenamiento de productos químicos.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Los envases de productos se dispondrán en estanterías que estarán sujetas a la pared.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Se dotará a las zonas de almacenamiento de buena ventilación, sobre todo si se almacenan productos tóxicos o inflamables.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Se clasificarán y agruparán los productos según sus riesgos.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Se evitará la proximidad de sustancias incompatibles o muy reactivas (lejía y ácidos o amoníaco, disolventes y agua fuerte, etc.)'), 0, 'J');
    $pdf->Ln(2.5);
}

if($infocae->incendios) {
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 10, utf8_decode('Cód. 10. Incendios'), 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Ln(5);

    $pdf->MultiCell(0, 6, utf8_decode('Siguiendo las recomendaciones del Real Decreto 513/2017, de 22 de mayo, por el que se aprueba el Reglamento de instalaciones de protección contra incendios, Código Técnico de la Edificación, Norma Básica de Autoprotección, NTPs 368-1995 y NTP 680 y Norma UNE-EN 3-7, UNE-EN 1866-1 y UNE-EN 3-10, se recomienda:'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- El uso de unas fichas de datos sobre los medios materiales disponibles en las que consten la referencia del plano de ubicación, la zona, el código de la instalación o elemento controlado, sus características, la empresa responsable del mantenimiento, periodicidad mínima de revisión, fecha de la última revisión, fecha de caducidad (si procede) y observaciones.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- La planificación del mantenimiento de los medios materiales de lucha contra incendios. El mantenimiento mínimo de las instalaciones de protección contra incendios regulado en el Anexo II del Real Decreto 513/2017, de 22 de mayo, serán efectuadas por personal de un mantenedor habilitado.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 6, utf8_decode('Recomendaciones para prevención de incendios en el lugar de trabajo:'), 0, 'J');
    $pdf->Ln(3);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('- Siempre que sea posible, mantener una zona de seguridad (sin combustibles ni material inflamable) alrededor de cualquier aparato eléctrico.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- No sobrecargar los enchufes. En caso de utilizar regletas, o alargaderas para conectar varios aparatos eléctricos, consultar siempre a personal cualificado o experto en electricidad.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Si se detecta cualquier defecto en la instalación eléctrica o protección contra incendios, comunicarlo al responsable de área. No aproximar ningún foco de calor a combustible.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- En el caso de realizar trabajos eléctricos en caliente (operaciones de mantenimiento mecánico, soldadura por arco eléctrico, ...), consultar antes al responsable. Puede ser una zona de alto riesgo de incendio y explosión.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Los equipos de incendios (extintores, bocas de incendios, salidas de emergencia, cuadros eléctricos, pulsadores de alarmas antiincendios, etc.) deben estar siempre accesibles para su rápida utilización en caso de emergencia o evacuación.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- No obstaculizar los recorridos y salidas de emergencia o evacuación'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- No utilice agua para apagar fuegos, donde puedan existir elementos con tensión eléctrica'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Mantener el orden y la limpieza en el lugar de trabajo, evitando suciedad, acumulación de papel y cartón, derrame de líquidos, u otro material susceptible de originar llamas.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- En caso de olor a gas o producto inflamable, avisar al personal de mantenimiento o seguir las indicaciones del plan de emergencia. Respetar las señales de prohibición de fumar.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 6, utf8_decode('Medios de extinción de incendios.'), 0, 'J');
    $pdf->Ln(3);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('El centro de trabajo contará con medios de extinción de incendios, con carácter general:'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('a) Altura de extintores'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('El emplazamiento y ubicación de los extintores harán que sean fácilmente visibles y accesibles, situados próximos a los puntos donde exista mayor riesgo de iniciarse un incendio, próximos a las salidas de evacuación y en soportes fijados a paramentos verticales, de modo que la altura de los extintores sea entre 80 cm y 120 cm sobre el suelo, tomando como referencia la parte superior del extintor.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('b) Instalación de extintores'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('El recorrido máximo horizontal de evacuación y en la misma planta hasta el extintor, no debe superar los 15 metros.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('c) Señalización de extintores'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('Los extintores de incendio estarán señalizados conforme indica el Anexo I, sección 2ª del Real Decreto 513/2017, de 22 de mayo'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('d) Instalación'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('Deberán ser instaladas por empresas instaladoras de sistemas de protección contra incendios, por empresas mantenedoras de extintores portátiles o por el fabricante de los extintores. Cuando la superficie del establecimiento no sea mayor a 100 m2 podrán ser instalados por el usuario.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('e) Certificación del mantenimiento'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('En el caso de extintores portátiles, la entidad de certificación acreditada deberá tener en cuenta los requisitos adicionales recogidos en la norma UNE 23120 sobre «Mantenimiento de extintores portátiles contra incendios»'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('f) Etiqueta de mantenimiento anual'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('En el caso de extintores de incendio, la empresa mantenedora colocará en todo extintor que haya mantenido, fuera de la etiqueta del fabricante del mismo, una etiqueta con su número de identificación, nombre, dirección, fecha en la que se ha realizado la operación, fecha en que debe realizarse la próxima revisión. Asimismo, las empresas mantenedoras de extintores de incendio llevarán un registro en el que figurarán los extintores y las operaciones realizadas a los mismos.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('g) Tabla de mantenimiento'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('Según Real Decreto 513/2017, de 22 de mayo, por el que se aprueba el Reglamento de instalaciones de protección contra incendios. Sección 1.ª Protección activa contra incendios.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('Tabla I. Programa de mantenimiento trimestral y semestral de los sistemas de protección activa contra incendios.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('Tabla II. Programa de mantenimiento anual y quinquenal de los sistemas de protección activa contra incendios.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 6, utf8_decode('Pasos a seguir en la utilización de un extintor en caso de incendio:'), 0, 'J');
    $pdf->Ln(3);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('a) No hay que olvidar que el agente extintor presenta cierta toxicidad, el riego de quemaduras y las reacciones químicas que pueden darse.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('b) Asegurarse que el agente extintor es adecuado para la naturaleza del incendio, para ello debemos tener en cuenta la siguiente tabla de eficacia entre agente extintor y naturaleza del fuego:'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('Se considerarán adecuados, para cada una de las clases de fuego (según norma UNEEN 2 y Anexo I.4.5 Real Decreto 513/2017, de 22 de mayo):'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('   Clase A: Fuegos de materiales sólidos, generalmente de naturaleza orgánica, cuya combinación se realiza normalmente con la formación de brasas.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('     Clase B: Fuegos de líquidos o de sólidos licuables.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('     Clase C: Fuegos de gases.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('     Clase D: Fuegos de metales.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('     Clase E: Fuegos derivados de la utilización de ingredientes para cocinar (aceites y grasas vegetales o animales) en los aparatos de cocina.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('c) Una vez sepamos la clase de incendio a que nos enfrentamos y seleccionado el extintor más adecuado, actuaremos siguiendo los pasos siguientes:'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Quitar el precinto y la traba.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Colocar a la distancia indicada según el tipo de extintor.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Accionar la palanca dirigiendo el chorro a la base del fuego, en forma intermitente, con movimiento de zigzag o barrido.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 6, utf8_decode('Normas de actuación en caso de incendio y/o evacuación.'), 0, 'J');
    $pdf->Ln(3);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('1. Si descubres un incendio:'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Avisa a los responsables preparados para actuar.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- En caso de existir activa un pulsador de alarma.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('2. Al oír la señal de alarma:'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Dejar lo que estés haciendo y seguir las instrucciones del personal del centro responsable.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Dejar el puesto de trabajo en las mejores condiciones de seguridad (instalaciones de gases cerradas, máquinas desconectadas, llaves de paso cerradas)'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('3. Salir de manera ordenada y rápida, pero sin correr.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('4. El último cerrará las puertas que se vayan atravesando.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('5. Seguir los rótulos de señalización, vías de evacuación y salidas de emergencia que existen hacia el exterior.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('6. No usar el ascensor como salida.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('7. En caso de que el responsable solicite ayuda obedecer en la medida de lo posible.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('8. Bajar las escaleras en fila y pegados a la pared, dejando espacio libre para que los equipos de salvamento tengan acceso al origen del siniestro.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('9. No volver a entrar hasta recibir autorización.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('10. Una vez fuera dirigirse al punto de reunión que te haya indicado el personal encargado. '), 0, 'J');
    $pdf->Ln(2.5);
}

if($infocae->equipospresion) {
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 10, utf8_decode('Cód. 11. Contacto térmico.'), 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('El riesgo térmico se puede producir en la utilización y/o acercamiento a equipos que operan y funcionan a altas temperaturas (motores de equipos de presión, calderas...).'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('Generalmente es debido a instalaciones mal protegidas o no aisladas.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('Riesgo de contactos térmicos con elementos a alta y/o baja temperatura en equipos correspondientes a la centralización de instalaciones (calderas, refrigeradoras, acumuladores, placas térmicas, centrales de gases a presión...) así como en equipos propios de determinados Servicios (estufas, congeladores, equipos de calefacción...).'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('Alrededor de todo foco radiante de calor (hornos , calderas, etc...) se deberá dejar un espacio libre no menor de 1.50 m., prohibiéndose a los trabajadores permanecer sobre estos espacios.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('Utilización de herramientas adecuadas para la manipulación de piezas calientes y frías. Hacer uso de los Equipos de Protección Individual adecuados.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 6, utf8_decode('Medidas preventivas'), 0, 'J');
    $pdf->Ln(3);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('No tocar los equipos de trabajo presentes en las instalaciones (estufas, esterilizadores, calefactores, congeladores, calderas...). En caso de que los trabajos contratados impliquen su manipulación por personal capacitado y autorizado, se emplearán los EPI’s adecuados (guantes de protección frente a alta temperatura EN 407, guantes para baja temperatura EN 511...).'), 0, 'J');
    $pdf->Ln(2.5);
}

if($infocae->garaje) {
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 10, utf8_decode('Cód. 12. Atrapamientos por o entre objetos.'), 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('Siguiendo el Real Decreto 486/1997, de 14 de abril, para la utilización de los equipos de trabajo, para evitar los atrapamientos entre distintas partes de la maquinaria se debe tener en cuenta los siguiente:'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Que equipo de trabajo es cualquier máquina, aparato, instrumento utilizado en el trabajo, es decir, cualquier elemento utilizado para desarrollar una actividad laboral.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Todos los equipos de trabajo deberán estar certificados, si no disponen de marcado CE deberán estar reconocidos por un Organismo de Control Acreditado (OCA) para su posterior puesta en conformidad.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Antes de utilizar una máquina o equipo por primera vez, el trabajador debe de recibir la información específica correspondiente a las condiciones de seguridad relativas a la utilización, ajuste y mantenimiento, manual de instrucciones, normas internas, etc.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Todo equipo de trabajo se usará sólo para las operaciones para las que ha sido diseñado.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Nunca se deberá usar una máquina que no disponga o tenga inutilizados los medios de protección, empujadores, guías, etc.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Evite el uso de anillos, pulseras, etc. éstos pueden engancharse con los órganos móviles de la máquina.'), 0, 'J');
    $pdf->Ln(2.5);
}

if($infocae->calderas) {
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 10, utf8_decode('Cód. 13. Explosiones.'), 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Ln(5);

    $pdf->MultiCell(0, 6, utf8_decode('Debido al combustible de la caldera ha de seguirse lo dispuesto en la NTP 357: Condiciones de seguridad en la carga y descarga de camiones cisterna: líquidos inflamables. En concreto:'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 6, utf8_decode('1. Condiciones de seguridad antes de la carga'), 0, 'J');
    $pdf->Ln(3);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('Dada la repetitividad inherente al desarrollo de esta actividad, antes de proceder a la descarga se habrá balizado y señalizado convenientemente la zona en el entorno de los tanques receptores (siguiendo el Real Decreto 74/1992, de 31 de enero ("vehículo en descarga")). Asimismo, se habrá comprobado el normal estado de la puesta a tierra del tanque.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('El camión-cisterna, debidamente inmovilizado y calzado, se situará de forma que en todo momento tenga expedita la salida, a cuyo fin el conductor junto con el personal receptor designado, controlará la descarga, con presencia física permanente, al tiempo que se habrá dispuesto con carácter previo y a distancia apropiada y conveniente, la dotación suficiente de elementos contra incendios, tanto de la cisterna como de la instalación en la que se descarga, ante cualquier contingencia.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 6, utf8_decode('2. Condiciones de seguridad durante la carga'), 0, 'J');
    $pdf->Ln(3);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('En el transcurso de las operaciones de carga, la presión de los grupos de bombeo permitirá visualizar, en el control que, tal y como queda reflejado, debe ejercerse durante este periodo, la existencia de fugas y goteos. Su detección debe conllevar la inutilización temporal de estos puntos de carga. A este respecto debe tenerse en cuenta la prohibición, en general, de realizar trabajos incompatibles con la seguridad en los terminales de carga, estando estos operativos.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('No obstante, y en el supuesto de que, por imperativos de carga, fuese preciso abordar trabajos de mantenimiento, se establecería, teniendo en cuenta las condiciones atmosféricas (temperatura, dirección del viento etc..), el régimen de distancias y la disposición de los medios y dispositivos de seguridad precisos (extintores, cortinas de agua, etc.), para que pueda subsanarse la avería con las debidas garantías de seguridad en el entorno de estos puntos de carga. Deberá contarse, además, con la correspondiente autorización escrita de realización de trabajos. Queda prohibido fumar en la zona.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 6, utf8_decode('3. Condiciones de seguridad después de la carga'), 0, 'J');
    $pdf->Ln(3);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('- Comprobar el correcto cerrado de válvulas y grifos.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Hacer revisiones periódicas de las instalaciones.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('- Queda prohibido fumar en la zona.'), 0, 'J');
    $pdf->Ln(2.5);
}

if($general) {
    $pdf->SetFont('Arial','B',10);
    $pdf->MultiCell(0,10,utf8_decode('Cód. 14. Sobreesfuerzos.'),0,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->MultiCell(0,6,utf8_decode('Las medidas que pueden evitar o minimizar los riesgos que lleva consigo la actividad de manipulación manual de cargas según El Real Decreto 487/1997, de 14 de abril, sobre disposiciones mínimas de seguridad y salud relativas a la manipulación manual de cargas que entrañe riesgos, en particular dorsolumbares, para los trabajadores.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('En la manipulación de cargas el peso máximo que se recomienda no sobrepasar en condiciones ideales de manipulación es de 25 Kg. No obstante, si las personas que deben manipular la carga son mujeres, jóvenes o mayores no se recomienda superar los 15 Kg.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('Recomendaciones a seguir:'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('1) Colocación de los pies:'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('- Aproxímese a la carga y coloque los pies un poco separados para tener una postura estable y equilibrada.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('2) Adopción de la postura para el levantamiento:'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('- Flexione las piernas manteniendo en todo momento la espalda derecha, no flexione más que las rodillas.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('3) Levantamiento de la carga:'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('- Acerque la carga lo máximo posible al cuerpo estirando las piernas, pero manteniendo la espalda derecha.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('- Utilice la fuerza de las piernas para elevarla, no fuerce la espalda.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('- Procure no efectuar giros del tronco, colóquese siempre cerca y enfrente de la carga.'),0,'J');$pdf->Ln(2.5);

    $pdf->SetFont('Arial','B',10);
    $pdf->MultiCell(0,10,utf8_decode('Cód. 15. Ruido'),0,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->MultiCell(0,6,utf8_decode('Según lo establecido en el Real Decreto 286/2006, de 10 de marzo, sobre la protección de la salud y la seguridad de los trabajadores contra los riesgos relacionados con la exposición al ruido, las disposiciones encaminadas a evitar o a reducir la exposición.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('De esta forma, los riesgos derivados de la exposición al ruido deberán eliminarse en su origen o reducirse al nivel más bajo posible, teniendo en cuenta los avances técnicos y la disponibilidad de medidas de control del riesgo en su origen.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('La reducción de estos riesgos se basará en los principios generales de prevención establecidos en el artículo 15 de la Ley 31/1995, de 8 de noviembre, y tendrá en consideración especialmente:'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('a) otros métodos de trabajo que reduzcan la necesidad de exponerse al ruido;'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('b) la elección de equipos de trabajo adecuados que generen el menor nivel posible de ruido, habida cuenta ruido;'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('c) la reducción técnica del ruido.'),0,'J');$pdf->Ln(2.5);
    $pdf->SetFont('Arial','B',10);
    $pdf->MultiCell(0,6,utf8_decode('Ruido de los equipos de trabajo'),0,'J');$pdf->Ln(3);
    $pdf->SetFont('Arial','',10);
    $pdf->MultiCell(0,6,utf8_decode('En muchos casos es posible solucionar el problema sustituyendo los equipos por otros que emitan menos ruido.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('También es posible evitar la transmisión del ruido encerrando la fuente de ruido, por ejemplo, utilizando carcasas recubiertas de material absorbente para impresoras, o aislando la fuente, por ejemplo, reuniendo las impresoras en un local especial en el que no haya personas de forma habitual.'),0,'J');$pdf->Ln(2.5);

    $pdf->SetFont('Arial','B',10);
    $pdf->MultiCell(0,10,utf8_decode('Cód. 16. Golpes y cortes con objetos o herramientas.'),0,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->MultiCell(0,6,utf8_decode('El riesgo de corte con objetos puede producirse cuando se manipulan elementos cortantes como tijeras, cuters, guillotinas, etc. '),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('Recomendaciones:'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('- Utilizar las herramientas según las instrucciones del fabricante y para la función que han sido diseñadas.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('- Respete las protecciones que impiden el acceso a los elementos cortantes y móviles de equipos como guillotinas, destructores de documentos, ventiladores, etc.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('- Mantenga las herramientas cortantes: tijeras, cuters, etc. en zonas seguras y en buen estado, así mismo se colocarán en sus fundas protectoras, una vez no sean útiles.'),0,'J');$pdf->Ln(2.5);

    $pdf->SetFont('Arial','B',10);
    $pdf->MultiCell(0,10,utf8_decode('Cód. 17. Contactos eléctricos.'),0,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->MultiCell(0,6,utf8_decode('El riesgo eléctrico se puede producir en la utilización de equipos conectados a la corriente eléctrica como, por ejemplo: ascensores, grupos de presión, enchufes, luminarias, etc. Generalmente es debido a derivaciones en los equipos, instalaciones mal protegidas o aisladas o sobrecarga de enchufes.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('Se deben seguir en todo momento las recomendaciones de Real Decreto 842/2002, de 2 de agosto y Real Decreto 614/2001, de 8 de junio, sobre disposiciones mínimas para la protección de la salud y seguridad de los trabajadores frente al riesgo eléctrico. Principalmente:'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('Las instalaciones eléctricas ha de ajustarse a reglamentos normas de seguridad.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('- Realización de inspecciones periódicas de todas las áreas de trabajo a cargo de personal autorizado, con objeto de detectar y eliminar posibles factores de riesgo, como la presencia de aparatos y equipo eléctrico carente de conexión a tierra o de un mantenimiento adecuado.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('- Inclusión de la seguridad de los sistemas eléctricos, tanto en las directrices, como en los programas de formación en el centro de trabajo.'),0,'J');$pdf->Ln(2.5);
    $pdf->SetFont('Arial','B',10);
    $pdf->MultiCell(0,6,utf8_decode('a) En este punto han de implantarse entre en todas las empresas que desarrollen trabajos en la comunidad:'),0,'J');$pdf->Ln(3);
    $pdf->SetFont('Arial','',10);
    $pdf->MultiCell(0,6,utf8_decode('- No manipular ningún elemento eléctrico con las manos mojadas, en ambientes húmedos o mojados accidentalmente (por ejemplo, en caso de inundaciones) y siempre que estando en locales de características especiales (mojados, húmedos o de atmósfera pulverulenta) no se esté equipado de los medios de protección personal necesarios.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('- Emplear los procedimientos establecidos de trabajo en instalaciones eléctricas.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('- No quitar nunca la puesta a tierra de los equipos e instalaciones.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('- No realizar nunca operaciones en líneas eléctricas, cuadros, centros de transformación o equipos eléctricos si no se posee la formación necesaria para ello.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('- No retirar nunca los recubrimientos o aislamientos de las partes activas de los sistemas.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('- No conectar cables sin clavija de conexión homologada.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('- No sobrecargar los enchufes utilizando ladrones o regletas de forma abusiva.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('- Utilizar alargadores exclusivamente de forma temporal y en situaciones de urgencia.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('- Elegir alargadores capaces de soportar el voltaje generado.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('- Desconectar el equipo antes de desenchufarlo.'),0,'J');$pdf->Ln(2.5);
    $pdf->SetFont('Arial','B',10);
    $pdf->MultiCell(0,6,utf8_decode('b) En caso de accidente eléctrico:'),0,'J');$pdf->Ln(3);
    $pdf->SetFont('Arial','',10);
    $pdf->MultiCell(0,6,utf8_decode('- Llamar a los servicios de emergencias: 112'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('- No tocar a la persona hasta verificar con seguridad que no está en contacto con ninguna fuente eléctrica.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('- Si está en contacto, buscar la manera de cortar la corriente y en caso de no encontrar la manera de cortar la corriente, se utilizará un objeto de madera, plástico (una silla, un palo,...) o cualquier elemento no conductor de la electricidad para separar a la víctima.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('- Si es una línea de alto voltaje, no acercarse a más de seis metros mientras exista corriente eléctrica.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('- Una vez separada de la corriente y asegurada la víctima, evitar en la medida de lo posible moverla, sobre todo, el cuello y la cabeza, pues podría tener alguna lesión vertebral.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('- Comprobar su grado de conciencia y respiración. En caso de que no respire, proceder a realizar maniobras de reanimación cardiopulmonar. Si respira, es preferible no mover a la víctima y vigilarla constantemente, comprobando su respiración cada 2-4 minutos, ya que podría entrar en parada cardiorrespiratoria. Si la víctima está inconsciente, taparla con mantas o abrigos y elevar sus piernas.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('- Tratar las quemaduras con agua o suero fisiológico para limpiarlas, y taparlas con gasas estériles o paños limpios. Permanecer con el accidentado hasta que llegue la ayuda médica.'),0,'J');$pdf->Ln(2.5);

    $pdf->SetFont('Arial','B',10);
    $pdf->MultiCell(0,10,utf8_decode('Cód. 18. Atropellos o golpes y choques con o contra vehículos. Accidentes de tránsito (In itinere).'),0,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->Ln(5);

    $pdf->MultiCell(0,6,utf8_decode('Tanto al dirigirse por el trayecto habitual desde la casa al trabajo o al regresar del mismo (accidente "in-itinere"), como en los desplazamientos propios de la actividad laboral (accidente "en misión"), puede ocurrir un accidente en el que influyen distintas condiciones como climatológica desfavorable, o el estrés generado por el desplazamiento.'),0,'J');$pdf->Ln(2.5);
    $pdf->SetFont('Arial','B',10);
    $pdf->MultiCell(0,6,utf8_decode('Medidas preventivas recomendadas para los automovilistas'),0,'J');$pdf->Ln(3);
    $pdf->SetFont('Arial','',10);
    $pdf->MultiCell(0,6,utf8_decode('Respetar en todo momento la señalización y demás Normas del Código de Circulación.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('Mantener el vehículo en perfectas condiciones de utilización, efectuando las revisiones técnicas periódicas establecidas legalmente (ITV), así como las revisiones establecidas por el fabricante del vehículo.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('Verificar y comprobar los sistemas básicos del vehículo (nivel de aceite, nivel de agua, luces, frenos, presión de los neumáticos, etc.).'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('Adaptar la velocidad a las condiciones climatológicas, de la circulación y de la vía.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('Mantener siempre la distancia de seguridad.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('Señalar anticipadamente los cambios de dirección. Se debe facilitar la incorporación de otros vehículos.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('No hablar por teléfono móvil si no se dispone de sistema de manos libres homologado, ni manipular documentos mientras se conduce. Evitar la ingesta de alcohol o de cualquier otra sustancia depresora del sistema nervioso central.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('Disponer de los elementos reglamentarios de parada (triángulos y chaleco reflectante), reparación y recambio (luces y rueda de repuesto). '),0,'J');$pdf->Ln(2.5);
    $pdf->SetFont('Arial','B',10);
    $pdf->MultiCell(0,6,utf8_decode('Medidas preventivas recomendadas para los viandantes'),0,'J');$pdf->Ln(3);
    $pdf->SetFont('Arial','',10);
    $pdf->MultiCell(0,6,utf8_decode('Respetar las señales de tráfico, los semáforos y las indicaciones de los agentes.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('Cruzar perpendicular a la acera y utilizando los pasos de peatones. En todos los casos, asegúrese de que tiene suficiente visibilidad. Preste especial atención a las entradas y salidas de los garajes.'),0,'J');$pdf->Ln(2.5);
    $pdf->SetFont('Arial','B',10);
    $pdf->MultiCell(0,6,utf8_decode('Medidas preventivas recomendadas para circulación de vehículos en el recinto del centro (garajes)'),0,'J');$pdf->Ln(3);
    $pdf->SetFont('Arial','',10);
    $pdf->MultiCell(0,6,utf8_decode('Se evitará que personas y vehículos coincidan en las zonas destinadas a aparcamiento en la medida de lo posibles. Respetar las señalizaciones y recorridos establecidos en el recinto.'),0,'J');$pdf->Ln(2.5);

    $pdf->SetFont('Arial','B',10);
    $pdf->MultiCell(0,10,utf8_decode('Cód. 19. Proyección de fragmentos o partículas.'),0,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->MultiCell(0,6,utf8_decode('Circunstancia que se puede manifestar en lesiones producidas por piezas, fragmentos o pequeñas partículas de material, proyectadas por una máquina, herramientas o materia prima a conformar. Formación y empleo de EPIs'),0,'J');$pdf->Ln(2.5);
    $pdf->SetFont('Arial','B',10);
    $pdf->MultiCell(0,6,utf8_decode('Medidas preventivas recomendadas'),0,'J');$pdf->Ln(3);
    $pdf->SetFont('Arial','',10);
    $pdf->MultiCell(0,6,utf8_decode('Pantallas, transparentes si es posible, de modo que situadas entre el trabajador y la pieza/herramienta, detengan las proyecciones . Si son transparentes, deberán renovarse cuando dificulten la visibilidad. Sistemas de aspiración con la potencia suficiente para absorber las partículas que se produzcan. Pantallas que aíslen el puesto de trabajo (protección frente a terceras personas). En máquinas de funcionamiento automático, pantallas protectoras que encierren completamente la zona en que se producen las proyecciones . Se pueden combinar con un sistema de aspiración. Equipos de Protección Individual: se recurrirá a ellos cuando no sea posible aplicar las protecciones colectivas. Como medio de protección de los ojos, se utilizarán gafas de seguridad , cuyos oculares serán seleccionados en función del riesgo que deban proteger como proyecciones de líquidos, impacto...Como protección de la cara se utilizarán pantallas, abatibles o fijas, según las necesidades. Como protección de las manos se utilizarán guantes de protección.'),0,'J');$pdf->Ln(3);

    $pdf->SetFont('Arial','B',10);
    $pdf->MultiCell(0,10,utf8_decode('Cód. 20.  Estrés térmico.'),0,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->MultiCell(0,6,utf8_decode('Exceso de calor que los trabajadores reciben y acumulan en su cuerpo. En ocasiones es debido a la actividad física que estos realizan, ya que algunos trabajos pueden requerir un gran esfuerzo físico y actividades en zonas interiores o exteriores expuestos a altas temperaturas.'),0,'J');$pdf->Ln(2.5);
    $pdf->SetFont('Arial','B',10);
    $pdf->MultiCell(0,6,utf8_decode('Medidas preventivas recomendadas'),0,'J');$pdf->Ln(3);
    $pdf->SetFont('Arial','',10);
    $pdf->MultiCell(0,6,utf8_decode('Informar y formar a los trabajadores sobre los riesgos relacionados con el calor, sus efectos y las medidas preventivas a adoptar. Habilitar zonas de descanso climatizadas, así como ambientes frescos y a la sombra. Proporcionar agua potable en las proximidades de los puestos de trabajo. Suministrar equipos de protección individual adecuados a los trabajadores (ropas amplias, transpirables, de tejido ligero y colores claros). Evitar realizar un gran gasto de energía. Proporcionar por parte del empresario ayudas mecánicas y equipos de trabajo para la manipulación de cargas. Adaptar los horarios. Organiza turnos rotativos para reducir el tiempo de la exposición al calor siempre que sea posible. Evita los trabajos pesados en las horas centrales del día (entre las 11 y las 16) y realiza descansos frecuentes. Considerar que es necesario un periodo de 7 a 15 días de adaptación para que el trabajador se aclimate al calor. Evitar el trabajo aislado, favoreciendo el trabajo en equipo para facilitar la supervisión mutua de los trabajadores.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('Además de la Ley 31/1995 de Prevención de Riesgos Laborales y del Reglamento de los Servicios de Prevención (Real Decreto 39/1997), para la prevención de los riesgos derivados del estrés térmico se aplica la normativa detallada en el Real Decreto 486/1997, de 14 de abril. En este Real Decreto se regulan y establecen las disposiciones mínimas de seguridad y salud en los espacios de trabajo.'),0,'J');$pdf->Ln(2.5);
    $pdf->MultiCell(0,6,utf8_decode('Este Real Decreto, específica en el anexo III, los rangos óptimos de temperatura y de humedad en los lugares de trabajo, en función del tipo de trabajo realizado (ligero o sedentario).'),0,'J');$pdf->Ln(2.5);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 10, utf8_decode('Cód. 21. Señalización'), 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('El Anexo I del Real Decreto 485/1997, de 14 de abril, sobre disposiciones mínimas en materia de señalización de seguridad y salud en el trabajo, NTP 888 Señalización de emergencia en los centros de trabajo, NTP 188: Señales de seguridad para centros y locales de trabajo y la Guía técnica del Instituto Nacional de Seguridad e Higiene en el Trabajo sobre señalización de seguridad y salud en el trabajo, fijan las disposiciones mínimas en esta materia:'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 6, utf8_decode('1. Señalización de Riesgos, prohibiciones y obligaciones'), 0, 'J');
    $pdf->Ln(3);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('La señalización dirigida a advertir a los trabajadores de la presencia de un riesgo, o a recordarles la existencia de una prohibición u obligación, se realizará mediante señales en forma de panel que se ajusten a lo dispuesto, para cada caso, en el anexo III Real Decreto 485/1997, de 14 de abril.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 6, utf8_decode('2. Riesgo de caídas, choques y golpes'), 0, 'J');
    $pdf->Ln(3);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('a) Para la señalización de desniveles, obstáculos u otros elementos que originen riesgos de caída de personas, choques o golpes podrá optarse, a igualdad de eficacia, por el panel que corresponda según lo dispuesto en el apartado anterior o por un color de seguridad, o bien podrán utilizarse ambos complementariamente.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('b) La delimitación de aquellas zonas de los locales de trabajo a las que el trabajador tenga acceso con ocasión de éste, en las que se presenten riesgos de caída de personas, caída de objetos, choques o golpes, se realizará mediante un color de seguridad.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('c) La señalización por color referida en los dos apartados anteriores se efectuarán mediante franjas alternas amarillas y negras. Las franjas deberán tener una inclinación aproximada de 45 grados y ser de dimensiones similares de acuerdo con el siguiente modelo.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 6, utf8_decode('3. Señalización de equipos de protección contra incendios'), 0, 'J');
    $pdf->Ln(3);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('a) Los equipos de protección contra incendios deberán ser de color rojo o predominantemente rojo, de forma que se puedan identificar fácilmente por su color propio.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('b) El emplazamiento de los equipos de protección contra incendios se señalizará mediante el color rojo o por una señal en forma de panel de las indicadas en el apartado 3.4.º del anexo III Real Decreto 485/1997, de 14 de abril. Cuando sea necesario, las vías de acceso a los equipos se mostrarán mediante las señales indicativas adicionales especificadas en dicho anexo.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 6, utf8_decode('4. Señalización de medios y equipos de salvamento y socorro'), 0, 'J');
    $pdf->Ln(3);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('La señalización para la localización e identificación de las vías de evacuación y de los equipos de salvamento o socorro se realizará mediante señales en forma de panel de las indicadas en el apartado 3.5.º del anexo III Real Decreto 485/1997, de 14 de abril.'), 0, 'J');
    $pdf->Ln(2.5);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 6, utf8_decode('5. Señalización en caso de emergencia'), 0, 'J');
    $pdf->Ln(3);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('La señalización dirigida a alertar a los trabajadores o a terceros de la aparición de una situación de peligro y de la consiguiente y urgente necesidad de actuar de una forma determinada o de evacuar la zona de peligro, se realizará mediante una señal luminosa, una señal acústica o una comunicación verbal. A igualdad de eficacia podrá optarse por una cualquiera de las tres; también podrá emplearse una combinación de una señal luminosa con una señal acústica o con una comunicación verbal.'), 0, 'J');
    $pdf->Ln(2.5);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 10, utf8_decode('Cód. 21. Condiciones Ambientales'), 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Ln(5);
    $pdf->MultiCell(0, 6, utf8_decode('Real Decreto 486/1997, de 14 de abril, por el que se establecen las disposiciones mínimas de seguridad y salud en los lugares de trabajo.'), 0, 'J');
    $pdf->Ln(2.5);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 10, utf8_decode('Cód. 21. Servicios Higiénicos'), 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Ln(2.5);
    $pdf->MultiCell(0, 6, utf8_decode('Real Decreto 486/1997, de 14 de abril, por el que se establecen las disposiciones mínimas de seguridad y salud en los lugares de trabajo.'), 0, 'J');
    $pdf->Ln(5);
}

if($infocae->ascensores) {
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 10, utf8_decode('Cód. 21. Ascensores'), 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('Real Decreto 203/2016, de 20 de mayo, por el que se establecen los requisitos esenciales de seguridad para la comercialización de ascensores y componentes de seguridad para ascensores.'), 0, 'J');
    $pdf->Ln(5);
}

if($general) {
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 10, utf8_decode('Cód. 21. Formación e información'), 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('Art. 18 y 19 de la Ley de Prevención de Riesgos Laborales (LPRL)'), 0, 'J');$pdf->Ln(2.5);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 10, utf8_decode('Cód. 21. Orden y limpieza'), 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('Real Decreto 486/1997, de 14 de abril, por el que se establecen las disposiciones mínimas de seguridad y salud en los lugares de trabajo.'), 0, 'J');$pdf->Ln(2.5);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 10, utf8_decode('Cód. 21. Humedades'), 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('Real Decreto 486/1997, de 14 de abril, por el que se establecen las disposiciones mínimas de seguridad y salud en los lugares de trabajo.'), 0, 'J');$pdf->Ln(2.5);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 10, utf8_decode('Cód. 21. Evacuaciones'), 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('Art. 20 de la Ley de Prevención de Riesgos Laborales (LPRL).'), 0, 'J');$pdf->Ln(2.5);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 10, utf8_decode('Cód. 21. Vigilancia de la salud'), 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('Art. 22 de la Ley de Prevención de Riesgos Laborales (LPRL).'), 0, 'J');$pdf->Ln(2.5);
}

if($infocae->pistas) {
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 10, utf8_decode('Cód. 21. Botiquín'), 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('Real Decreto 486/1997, de 14 de abril, por el que se establecen las disposiciones mínimas de seguridad y salud en los lugares de trabajo.'), 0, 'J');$pdf->Ln(2.5);
}

if($infocae->piscina || $infocae->aseopiscina){
    $pdf->SetFont('Arial','B',10);
    $pdf->MultiCell(0,10,utf8_decode('Cód. 21. Piscina'),0,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->MultiCell(0,6,utf8_decode('En todo momento la empresa contratada para el mantenimiento, limpieza y reparaciones de la misma cumplirá con lo dispuesto en materia de prevención del Decreto 485/2019, de 4 de junio, por el que se aprueba el Reglamento Técnico-Sanitario de las Piscinas en Andalucía.'),0,'J');$pdf->Ln(2.5);
}

if($infocae->equipospresion) {
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 10, utf8_decode('Cód. 21. Cuarto de calderas'), 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('Real Decreto 486/1997, de 14 de abril, por el que se establecen las disposiciones mínimas de seguridad y salud en los lugares de trabajo.'), 0, 'J');    $pdf->Ln(2.5);
}

//5
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
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
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,utf8_decode('6. CONCLUSIONES'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('El resultado de la Evaluación de Riesgos pone de manifiesto la existencia de situaciones de riesgo y/o incumplimientos reglamentarios que deben ser evitados o minimizados, para ello se proponen una serie de medidas preventivas que deberán formar parte de la planificación de la actividad preventiva, que deberá ser aprobada e implantada por parte de los responsables pertinentes de conformidad con la Ley de Prevención de Riesgos Laborales.'),0,'J');$pdf->Ln(2.5);
$pdf->Ln(50);
$pdf->MultiCell(0,6,utf8_decode('Informe elaborado por: D. Patricio García Alonso'),0,'R');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Técnico Superior en Prevención de Riesgos Laborales'),0,'R');$pdf->Ln(2.5);

//7
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,10,strtoupper(utf8_decode('7. Fotografías Geolocalizadas de la C.PP.')),0,'L');
for($p=0;$p<$infocae->anexo-1;$p++){
    $pdf->AddPage();
}

// Write all to the output
$pdf->Output("Informe CAE - ".$cname.".pdf",'I');