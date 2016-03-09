<?php
require('./fpdf.php');

define('EURO', chr(128) );


class PDFp extends FPDF
{
    function RoundedRect($x, $y, $w, $h, $r, $style = '')
    {
        $k = $this->k;
        $hp = $this->h;
        if($style=='F')
            $op='f';
        elseif($style=='FD' || $style=='DF')
            $op='B';
        else
            $op='S';
        $MyArc = 4/3 * (sqrt(2) - 1);
        $this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));
        $xc = $x+$w-$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));

        $this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);
        $xc = $x+$w-$r ;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
        $this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
        $xc = $x+$r ;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
        $this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
        $xc = $x+$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
        $this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
        $this->_out($op);
    }

    function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
    {
        $h = $this->h;
        $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
            $x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
    }

// Cabecera de página
    function Header()
    {        
		$data = $GLOBALS['data'];
		parse_str($data);
		
        $this->SetFont('Arial','B',16);
        $this->Cell(80);
        $this->Cell(0,10,utf8_decode('PRESUPUESTO'),0,0,'R');
        $this->SetFont('Arial','B',12);
        $this->Ln(10);
        $this->Cell(0,10,utf8_decode('Nº '.$nump),0,0,'R');
        $fecha = date("d-m-Y",time());
        $fecha_array=explode('-',$fecha);
        $mes = $this->getMes($fecha_array[1]);
        $fecha = "$fecha_array[0]-$mes-$fecha_array[2]";
        $this->SetFont('Arial','',12);
        $this->Ln(10);
        $this->Cell(0,10,'Sevilla, '.str_replace("-"," de ",$fecha),0,0,'R');
        $this->Image('./img/logo2.png',20,10,50);
        // Salto de línea
        $this->Ln(20);
    }

// Pie de página
    function Footer(){
        // Posición: a 1,5 cm del final
        //$this->SetY(-15);
        // Arial italic 8
        //$this->SetFont('Arial','I',8);
        // Número de página
        //$this->Cell(0,10,utf8_decode('Página '.$this->PageNo().' de {nb}'),0,0,'C');
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
        return "Mes";
    }
}

global $data;
$data = base64_decode($_GET['q']);
parse_str($data);
$servicios=json_decode($serv,true);

// Creación del objeto de la clase heredada
$pdf = new PDFp();

$pdf->AddFont('Arial','','arial.php');
$title = 'Presupuesto de servicios ofertados';
$pdf->SetTitle($title);
$pdf->SetAuthor('Análisis y gestión de datos S.L.');
$pdf->SetMargins(20,15,20);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Ln(5);

/* datos cliente */
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,mb_strtoupper(utf8_decode($nombre)),0,1,'L');
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,6,utf8_decode('A/A: '.$contacto),0,'L');
$pdf->Ln(15);

if(isset($servicios[1])) {
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, utf8_decode('ADAPTACIÓN INTEGRAL LOPD -  A.G.DATA'), 0, 1, 'C');
    $pdf->Ln(3);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('* AUDITORIA PREVIA en la sede del cliente para evaluar la situación LOPD.'), 0, 'L');
    $pdf->MultiCell(0, 6, utf8_decode('* INSCRIPCIÓN DE FICHEROS DE DATOS en la Agencia Española de Protección de Datos.'), 0, 'L');
    $pdf->MultiCell(0, 6, utf8_decode('* Orientación y FORMACIÓN AL RESPONSABLE DE SEGURIDAD designado por el cliente.'), 0, 'L');
    $pdf->MultiCell(0, 6, utf8_decode('* Redacción y ADAPTACIÓN LEGAL DE LA DOCUMENTACIÓN necesaria y contratos con terceros.'), 0, 'L');
    $pdf->MultiCell(0, 6, utf8_decode('* Elaboración del DOCUMENTO DE SEGURIDAD obligatorio, con los modelos de Anexos.'), 0, 'L');
    $pdf->Ln(2);
    //blue line
    $pdf->SetFillColor(0, 80, 185);
    $pdf->RoundedRect(20, 135, 160, 1, 0.5, 'DF');

    $pdf->SetFont('Arial', 'B', 11);
    $pdf->MultiCell(0, 6, utf8_decode('                                                                                                       IMPORTE: ' . number_format($servicios[1]['precio'], 2) . ' EUROS'), 0, 'L');
    $pdf->Ln(15);
}

if(isset($servicios[2])) {
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, utf8_decode('SERVICIOS DE MANTENIMIENTO BIANUAL -  A.G.DATA'), 0, 1, 'C');
    $pdf->Ln(3);
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 6, utf8_decode('* Actualización del documento de seguridad de nivel alto.'), 0, 'L');
    $pdf->MultiCell(0, 6, utf8_decode('* Inscripción, modificación y/o supresión de ficheros en la AEPD.'), 0, 'L');
    $pdf->MultiCell(0, 6, utf8_decode('* Asesoramiento jurídico continuo en materia de protección de datos.'), 0, 'L');
    $pdf->MultiCell(0, 6, utf8_decode('* Redacción / adaptación de documentos legales adicionales.'), 0, 'L');
    $pdf->MultiCell(0, 6, utf8_decode('* Adaptación a novedades que surjan en la normativa LOPD.'), 0, 'L');
    $pdf->MultiCell(0, 6, utf8_decode('* Contacto directo con el Responsable de Seguridad del cliente.'), 0, 'L');
    $pdf->MultiCell(0, 6, utf8_decode('* Atención a consultas sobre el ejercicio de derechos de los titulares.'), 0, 'L');
    $pdf->MultiCell(0, 6, utf8_decode('* Auditoría bianual obligatoria para niveles medio y alto de seguridad.'), 0, 'L');
    //blue line
    $pdf->SetFillColor(0, 80, 185);
    $ln=0;
    if(!isset($servicios[1])){$ln=66;}
    $pdf->RoundedRect(20, 219-$ln, 160, 1, 0.5, 'DF');

    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(0, 10, utf8_decode('                                                                                                       IMPORTE: ' . number_format($servicios[2]['precio'], 2) . ' EUROS'), 0, 1, 'L');
}
$pdf->Ln(5);

$pdf->SetFont('Arial','B',8);
$pdf->MultiCell(0,6,utf8_decode('CONDICIONES:'),0,'L');
$pdf->SetFont('Arial','',8);
$pdf->MultiCell(0,6,utf8_decode('21% I.V.A. no incluido.'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('VALIDEZ DE LA OFERTA: 30 días desde fecha presupuesto.'),0,'L');
$pdf->SetFont('Arial','',8);
if(isset($servicios[1])) {
    $pdf->SetFont('Arial','B',8);
    $pdf->MultiCell(0,6,utf8_decode('CONDICIONES DE PAGO:'),0,'L');
    $pdf->SetLeftMargin(25);
    $pdf->MultiCell(0, 6, utf8_decode('- ADAPTACIÓN INTEGRAL LOPD: Pago único al finalizar proceso de adaptación, contra factura.'), 0, 'L');
}

$pdf->AddPage();
/* aceptacion */

$pdf->SetFont('Arial','B',11);
//$pdf->SetLeftMargin(0);
$pdf->Cell(0,10,utf8_decode('ACEPTACIÓN DE PRESUPUESTO (Señale con una X los servicios que desee contratar)'),0,1,'C');

//$pdf->SetLeftMargin(45);
if(isset($servicios[1])) {
    $pdf->Cell(0, 10, utf8_decode('          [  ] Adaptación Integral A.G.DATA - LOPD           ' . number_format($servicios[1]['precio'], 2) . ' EUROS'), 0, 1, 'L');
}
if(isset($servicios[2])) {
    $pdf->Cell(0, 10, utf8_decode('          [  ] Mantenimiento bienal (2 años)                         ' . number_format($servicios[2]['precio'], 2) . ' EUROS'), 0, 1, 'L');
}
$pdf->Ln(3);

//$pdf->SetLeftMargin(12);
if(isset($servicios[1])) {
    $pdf->MultiCell(0,10,utf8_decode('FORMA DE PAGO DE LA ADAPTACIÓN (Señale con una X la opción elegida)'), 0, 'L');
    $pdf->Cell(0, 10, utf8_decode('          [  ] Transferencia bancaria'), 0, 1,'L');
    $pdf->Cell(0, 10, utf8_decode('          [  ] Domiciliación bancaria'), 0, 1,'L');
}
if(isset($servicios[2])) {
    $pdf->MultiCell(0, 10, utf8_decode('FORMA DE PAGO DEL MANTENIMIENTO (Señale con una X la opción elegida)'), 0, 'L');
    $pdf->Cell(0, 10, utf8_decode('          [  ] Transferencia bancaria'), 0, 1,'L');
    $pdf->Cell(0, 10, utf8_decode('          [  ] Domiciliación bancaria'), 0, 1,'L');
}

/* opciones de pago del mantenimiento */
if(isset($servicios[2])) {
    $pdf->SetFont('Arial','B',11);
    $pdf->MultiCell(0,10,utf8_decode('PLAZOS DE PAGO DEL MANTENIMIENTO LOPD (Señale con una X la opción elegida)'),0,'L');
    $pdf->Cell(0, 10, utf8_decode('          [  ] Pago mensual (24 cuotas)'), 0, 1, 'L');
    $pdf->Cell(0, 10, utf8_decode('          [  ] Pago trimestral (8 cuotas)'), 0, 1, 'L');
    $pdf->Cell(0, 10, utf8_decode('          [  ] Pago anual (2 cuotas)'), 0, 1, 'L');
}

$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0, 10, utf8_decode('(En caso de haber elegido DOMICILIACIÓN BANCARIA, indíquenos por favor su CÓDIGO IBAN COMPLETO: ........................................................................................ )'), 0,'L');
$pdf->Ln(7);
/* firmas */
$pdf->SetLeftMargin(25);
$pdf->SetFont('Arial','',11);
$pdf->MultiCell(0,6,utf8_decode('Atentamente                                                            Conforme cliente'),0,'L');
//$pdf->Image('./assets/img/firma.png',125,110,50);
$pdf->Ln(25);
$pdf->MultiCell(0,6,utf8_decode('D. Miguel Ángel Chávez                                         D.'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('Departamento de administración'),0,'L');
$pdf->Ln(5);
//$pdf->SetLeftMargin(5);
$pdf->SetFont('Arial','I',7);
$footprint = 'Presupuesto generado por '.$user.' el '.date("d-m-Y",$fecha).' a las '.date("H:i",$fecha);
$pdf->MultiCell(0,6,utf8_decode($footprint),0,'R');
/* Imprimimos */
$pdf->Output("P".$nump."-".date('Y').".pdf",'I');