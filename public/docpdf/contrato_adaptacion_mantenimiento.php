<?php
require('./fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
    function Header()
    {
        // Logo
        //$this->Image('logo.png',10,8,33);
        // Arial bold 15
        $this->SetFont('Arial','U',15);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        // Posición: a 1,5 cm del final
        $this->Cell(30,10,utf8_decode('CONTRATO DE PRESTACIÓN DE SERVICIOS'),0,0,'C');
        // Salto de línea
        $this->Ln(20);
    }

// Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    function getMes($mes){
        switch($mes){
            case '01':
                return "Enero";
                break;
            case '02':
                return "Febrero";
                break;
            case '03':
                return "Marzo";
                break;
            case '04':
                return "Abril";
                break;
            case '05':
                return "Mayo";
                break;
            case '06':
                return "Junio";
                break;
            case '07':
                return "Julio";
                break;
            case '08':
                return "Agosto";
                break;
            case '09':
                return "Septiembre";
                break;
            case '10':
                return "Octubre";
                break;
            case '11':
                return "Noviembre";
                break;
            case '12':
                return "Diciembre";
                break;
        }
    }
}

// Creación del objeto de la clase heredada
$pdf = new PDF();

$title = 'Contrato de prestación de servicios';
$pdf->SetTitle($title);
$pdf->SetAuthor('Análisis y gestión de datos S.L.');

$pdf->SetMargins(12,10,12);

$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Arial','',12);
$fecha = date("d-m-Y",time());
$fecha_array=explode('-',$fecha);
$mes = $pdf->getMes($fecha_array[1]);
$fecha = "$fecha_array[0]-$mes-$fecha_array[2]";
$pdf->Cell(0,10,'En Sevilla, a '.str_replace("-"," de ",$fecha),0,0,'C');
$pdf->Ln(20);

/* reunidos */
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'REUNIDOS',0,1,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('          De una parte, D.'.$_GET["name"].', mayor de edad, con DNI nº , como representante legal de la empresa X. Con CIF Nº B-, con domicilio en la calle C.P. de, Se hace constar que interviene como mandatario de la Comunidad de Propietarios , CIF nº H (en adelante, EL BENEFICIARIO).'),0);
$pdf->Ln(10);
$pdf->MultiCell(0,6,utf8_decode('          De otra, D.  Casimiro Galán Garrido, mayor de edad, con DNI nº 28.884.460-W, en nombre y representación de ANÁLISIS Y GESTIÓN DE DATOS, S.L. (AGDATA), con domicilio social en Tomares (Sevilla), Edificio RAMCAB en Avda. del Aljarafe, S/N Planta 2ª módulo 42, y CIF nº  B-91.341.297 (en adelante, EL PRESTATARIO).'),0);
$pdf->Ln(10);
$pdf->MultiCell(0,6,utf8_decode('        Ambas partes (en adelante "las partes") se reconocen mutua y recíprocamente, la capacidad legal necesaria y suficiente para el otorgamiento del presente contrato mercantil y'),0);
$pdf->Ln(10);

/* manifiestan */
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'MANIFIESTAN',0,1,'C');
$pdf->Ln(10);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'PRIMERA',0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('Que EL PRESTATARIO es una empresa que desarrolla, entre otras, la actividad de prestación de servicios de Auditoría de Seguridad en la Protección de Datos de Carácter Personal en aras a la adecuación de todo tipo de entidades y profesionales sometidos al cumplimiento de la Ley Orgánica 15/1999 de Protección de Datos de Carácter Personal (LOPD).'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'SEGUNDA',0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('Que EL BENEFICIARIO desarrolla como actividad principal la administración de fincas.'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'TERCERA',0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('Que conforme a los expositivos precedentes, ambas partes han convenido en el otorgamiento del presente contrato de PRESTACIÓN DE SERVICIOS DE AUDITORIA Y CONSULTORÍA DE SEGURIDAD EN LA PROTECCIÓN DE DATOS DE CARÁCTER PERSONAL, que se regirá por lo dispuesto en el Código de Comercio y el Código Civil, y de forma especial por las siguientes.'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('CLAÚSULAS'),0,1,'C');
$pdf->Ln(10);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('1ª.- OBJETO'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('El objeto del presente contrato es la prestación al BENEFICIARIO de los servicios de asesoramiento y consultoría en materia de protección de datos que se detallan a continuación, conforme a las exigencias contenidas en la normativa vigente en materia de Protección de Datos de Carácter Personal respecto a los datos personales que el BENEFICIARIO tiene declarados.'),0);
$pdf->Ln(10);

$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,6,utf8_decode('Servicios iniciales de adaptación / actualización:'),0);
$pdf->SetFont('Arial','',12);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('- Análisis previo pormenorizado del estado del cliente. Auditoría previa y estudio de su documentación, para identificar deficiencias actuales en materia de protección de datos.'),0);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('- Actualización del Documento de Seguridad del Administrador de Fincas, si fuese necesario.'),0);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('- Notificaciones a la Agencia Española de Protección de Datos, de las modificaciones, bajas o altas necesarias para la correcta adecuación de sus ficheros de datos personales.'),0);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('- Redacción de documentos, contratos y cláusulas legales necesarios para asegurar el correcto cumplimiento de la Ley y su Reglamento de desarrollo.'),0);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('    Una vez concluidos estos servicios de adaptación / actualización inicial, se concretará entre las partes el inicio de los servicios de mantenimiento durante un periodo anual, que será renovado automáticamente y con idéntica duración si ninguna de las partes con un mes de antelación a su finalización, advierte de forma fehaciente su voluntad de rescindir el presente contrato.'),0);
$pdf->Ln(10);

/* mantenimiento */
$pdf->SetFont('Arial','B',12);
$pdf->MultiCell(0,6,utf8_decode('Servicios de mantenimiento:'),0);
$pdf->SetFont('Arial','',12);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('- Asesoramiento continuo y la resolución de todo tipo de consultas planteadas por el Administrador de Fincas en materia de protección de datos al PRESTATARIO.'),0);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('- Modificaciones posteriores del Documento de Seguridad, que deban realizarse cuando se produzcan las situaciones contempladas en la normativa que impliquen su modificación.'),0);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('- Notificaciones a la Agencia Española de Protección de Datos, de las modificaciones, bajas o altas que se produzcan en los ficheros de datos titularidad del BENEFICIARIO.'),0);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('- Redacción de documentos, contratos y cláusulas legales que resulten necesarios para asegurar el correcto cumplimiento de la normativa vigente.'),0);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('- La adaptación a posibles novedades que puedan producirse en la normativa española sobre protección de datos que se produzcan durante la vigencia del presente contrato.'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('2ª.- PRECIO'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('El precio fijado para los servicios de adaptación/actualización descritos, asciende a un importe único de 90 EUROS, impuestos no incluidos, que el BENEFICIARIO abonará mediante pago domiciliado en su cuenta con código IBAN nº XXXXX'),0);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('El precio fijado para los servicios de mantenimiento descritos asciende a un importe anual de  50 EUROS, impuestos no incluidos, que el BENEFICIARIO abonará mediante pago domiciliado en su cuenta con código IBAN nº XXXXXXX'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('3ª.- DURACIÓN'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('El presente contrato tendrá una vigencia de un año desde la fecha de la firma. Transcurrido dicho término, el contrato se prorrogará automáticamente por idéntico periodo si ninguna de las partes comunica su deseo de finalizar la relación contractual con al menos un mes de antelación del final del tiempo estipulado.'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('4ª.- CONFIDENCIALIDAD'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('Ambas partes se comprometen y obligan a guardar la máxima confidencialidad en toda la información y/o documentación, relativa al BENEFICIARIO y/o a sus clientes que, sin ser de dominio público, se ponga a disposición del PRESTATARIO en el marco de la prestación de los servicios definidos en el presente contrato.'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('5ª.- CAUSAS DE RESOLUCIÓN DEL CONTRATO'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('1. Falta de cumplimiento de cualquiera de las obligaciones que figuran en el presente Contrato.'),0);
$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('2. De la misma manera, procederá en especial la resolución de este contrato cuando alguna de las partes hubiere sido declarada en quiebra, cuando haya sido admitida a trámite su solicitud de suspensión de pagos, o cuando estuviera en situación técnica de insolvencia provisional.'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('6ª.- NULIDAD PARCIAL'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('Toda clausula o disposición del presente contrato que sea declarada nula, ilegal o inválida, no afectará ni invalidará ninguna de las demás cláusulas y disposiciones, las cuales permanecerán plenamente vigentes.'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('7ª.- ENTRADA EN VIGOR'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('El presente contrato, entrará en vigor a partir de la fecha de este contrato.'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('8ª.- CARÁCTER MERCANTIL'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('Este contrato tiene carácter mercantil, y se regirá por sus propias clausulas y en lo no previsto en las mismas, se regirá por lo previsto en el Código Comercio español, leyes mercantiles españolas complementarias y aplicables al caso, y con carácter subsidiario por el Código Civil español.'),0);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,utf8_decode('9ª.- MODIFICACIONES'),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('Cualquier modificación de lo previsto en este contrato deberá formalizarse por escrito suscrito por las partes y anexado al mismo.'),0);
$pdf->Ln(20);

/* firmas */
$pdf->MultiCell(0,6,utf8_decode('Fdo. por el beneficiario                                         Fdo. por el prestatario'),0,'C');
$pdf->Image('firma.png',125,110,50);
$pdf->Ln(30);
$pdf->MultiCell(0,6,utf8_decode('__________________                                         Casimiro Galán Garrido'),0,'C');
/* Imprimimos */
$pdf->Output();
?>