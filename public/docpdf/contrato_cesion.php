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
    function Header(){
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

    // Pie de página
    function Footer(){
        // Posición: a 1,5 cm del final
        //$this->SetY(-15);
        // Arial italic 8
        //$this->SetFont('Arial','I',8);
        // Número de página
        //$this->Cell(0,10,utf8_decode('Página '.$this->PageNo().' de {nb}'),0,0,'C');
    }
}

global $data;
$data = base64_decode(substr($_SERVER['QUERY_STRING'],2,strlen($_SERVER['QUERY_STRING'])));
//$data = base64_decode($_GET['q']);
parse_str($data);
$cliente=json_decode(html_entity_decode(urldecode($cliente_data)),true);
$rep=json_decode(html_entity_decode(urldecode($rep_data)),true);
$ficheros=json_decode(html_entity_decode(urldecode($ficheros)),true);

$pdf = new PDFp();
$pdf->AddFont('Arial','','arial.php');
$title = 'CONTRATO DE ACCESO A DATOS POR CUENTA DE TERCEROS';
$pdf->SetTitle($title);
$pdf->SetAuthor('Análisis y gestión de datos S.L.');
$pdf->SetMargins(20,15,20);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);

/* datos intervinientes */
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,strtoupper($title),0,1,'C');
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,'Suscrito entre',0,1,'C');
$pdf->SetFont('Arial','B',12);

$pdf->Cell(0,10,utf8_decode($cliente["nombre"].' y '.$rep["nombre"]),0,1,'C');

$pdf->SetFont('Arial','',12);
$fecha = explode("-",date("d-m-Y"));
$pdf->Cell(0,10,'En Sevilla, a '.$fecha[0].' de '.$pdf->getMes($fecha[1]).' de '.$fecha[2],0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,strtoupper('reunidos'),0,1,'C');

$pdf->SetFont('Arial','',9);
$rep_name=".....................................................................................";
if(strcmp($cliente["rep_nombre"],'')!=0){
    $rep_name = $cliente["rep_nombre"];
}
$rep_dni = "..................................";
if(strcmp($cliente["rep_dni"],'')!=0){
    $rep_dni = $cliente["rep_dni"];
}
$pdf->MultiCell(0, 6, utf8_decode('De una parte, '.$rep_name.', mayor de edad, con  DNI ' . $rep_dni . ', en nombre y representación de '.$cliente["nombre"].', con domicilio en '.$cliente["dir"].', C.P. '.$cliente["cp"].' de '.$cliente["loc"].', provincia de '.$cliente["prov"].' y CIF nº '.$cliente["cif_nif"].' (En adelante RESPONSABLE DEL FICHERO)'), 0, 'J');
$pdf->Ln(5);

$pdf->MultiCell(0, 6, utf8_decode('De otra, ' . $rep["nombre_rep"] . ', mayor de edad, con  DNI ' . $rep["dni"] . ', en nombre y representación de ' . $rep["nombre"] . ', con domicilio en ' . $rep["dir"] . ', C.P. ' . $rep["cp"] . ' de ' . $rep["loc"] . ', provincia de ' . $rep["prov"] . ' y CIF nº '. $rep["cif_nif"].' (En adelante ENCARGADO DEL TRATAMIENTO)'), 0, 'J');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,strtoupper('acuerdan'),0,1,'C');
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(0, 6, utf8_decode('Celebrar el presente contrato de acceso a datos por cuenta de terceros, que tiene por objeto garantizar la seguridad de datos de carácter personal y evitar su tratamiento o acceso no autorizado, o la pérdida de los mismos, conforme establece la Ley Orgánica 15/1999 de Protección de Datos de Carácter Personal.'), 0, 'J');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,strtoupper('estipulaciones'),0,1,'C');

/* estipulaciones */
$pdf->SetFont('Arial','B',9);
$pdf->Cell(0,10,strtoupper('primera'),0,1,'L');
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(0, 6, utf8_decode('Ambas partes se encuentran vinculadas por una relación contractual de prestación de servicios de '.$rep["servicio"].' para '.$cliente["nombre"].'.'),0,'J');
$pdf->Ln(3);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(0,10,strtoupper('segunda'),0,1,'L');
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(0, 6, utf8_decode('En orden a la prestación de dichos servicios es necesario que el Encargado del Tratamiento tenga acceso a los datos de carácter personal contenidos en los ficheros bajo la titularidad del Responsable del Fichero.'),0,'J');
$pdf->Ln(3);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(0,10,strtoupper('tercera'),0,1,'L');
$pdf->SetFont('Arial','',9);
$pdf->MultiCell(0, 6, utf8_decode('Que por esta razón conforme a lo dispuesto en el Art. 12 de la LOPD, ambas partes libremente y de común acuerdo, deciden regular este acceso y tratamiento de datos de carácter personal de conformidad con las siguientes: '),0,'J');

$pdf->AddPage();
/* clausulas */
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,mb_strtoupper(utf8_decode('claúsulas')),0,1,'C');
$pdf->SetFont('Arial','',9);

$ficheros_str="";
$str="el fichero denominado ".strtoupper($ficheros[0]["tipo"]);
if(count($ficheros)>1){
    foreach($ficheros as $k => $f) {
        if($k!=0) {
            $ficheros_str .= ', "' . $f["tipo"].'"';
        }
        else{
            $ficheros_str .= '"'.$f["tipo"].'"';
        }
    }
    $str="los ficheros denominados ".strtoupper($ficheros_str);
}

$pdf->MultiCell(0, 7, utf8_decode('1ª.- El Responsable del Fichero pone a disposición del Encargado del Tratamiento '.$str.'.'),0,'J'); // si hay más, poner plural
$pdf->Ln(3);
$pdf->MultiCell(0, 7, utf8_decode('2ª.-  El acceso por parte del Encargado del Tratamiento a los datos de carácter personal contenidos en estos ficheros, se realizará única y exclusivamente con la finalidad de prestar servicios de '.$rep["servicio"].' para el Responsable del Fichero.'),0,'J');
$pdf->Ln(3);
$pdf->MultiCell(0, 7, utf8_decode('3ª.- El Encargado del Tratamiento únicamente tratará los datos conforme a las instrucciones dadas por el Responsable del Fichero y nos los utilizará con fines distintos al de este contrato, ni los comunicará a terceros sin su consentimiento.'),0,'J');
$pdf->Ln(3);
$pdf->MultiCell(0, 7, utf8_decode('4ª.- El Encargado del Tratamiento está obligado al secreto profesional respecto de los datos de carácter personal y al deber guardarlos incluso después de finalizar sus relaciones con el Responsable del Fichero.'),0,'J');
$pdf->Ln(3);
$pdf->MultiCell(0, 7, utf8_decode('5ª.- El Encargado del Tratamiento se compromete a adoptar las medidas de índole técnica y organizativas necesarias que garanticen la seguridad de los datos de carácter personal y eviten su tratamiento o acceso no autorizado, alteración o pérdida de los mismos, conforme a lo estipulado en la Ley Orgánica 15/1999 de Protección de Datos de Carácter Personal.'),0,'J');
$pdf->Ln(3);
$pdf->MultiCell(0, 7, utf8_decode('6ª.- El Encargado del Tratamiento no registrará datos de carácter personal en ficheros que no reúnan las condiciones que establece el Reglamento de desarrollo de la Ley Orgánica 15/1999, de 13 de diciembre, de Protección de Datos de Carácter Personal, con respecto a su seguridad o integridad, y a las de los centros de tratamiento locales, equipos, sistemas y programas instalados. '),0,'J');
$pdf->Ln(3);
$pdf->MultiCell(0, 7, utf8_decode('7ª.- Una vez cumplida la prestación contractual, los datos de carácter personal serán destruidos o devueltos al Responsable del Fichero, al igual que cualquier soporte o documento en los que conste algún dato de carácter personal objeto de tratamiento.'),0,'J');
$pdf->Ln(3);
$pdf->MultiCell(0, 7, utf8_decode('8ª.- El Responsable del Fichero quedan eximido de responsabilidad alguna derivada del incumplimiento por parte del Encargado del Tratamiento, o del personal sujeto al mismo, de las estipulaciones acordadas en el presente contrato.'),0,'J');
$pdf->Ln(3);
$pdf->MultiCell(0, 7, utf8_decode('9ª.- Las partes contratantes se someten expresamente al fuero de los Juzgados y Tribunales de la ciudad de Sevilla, para cuantas acciones o reclamaciones pudieran derivarse de este contrato.'),0,'J');
$pdf->Ln(5);
$pdf->MultiCell(0, 7, utf8_decode('Tanto el Responsable del Fichero como el Encargado del Tratamiento, aceptan el presente contrato en los términos y condiciones estipuladas en el mismo, y en prueba de ello, y para cumplimiento de lo convenido, lo firman por duplicado.'),0,'J');

/* firmas */
$pdf->SetLeftMargin(20);
$pdf->SetFont('Arial','',9);
$pdf->Ln(5);
$pdf->MultiCell(0, 6, utf8_decode($cliente["rep_nombre"] . '                                                          '. $rep["nombre_rep"]), 0, 'C');
$nombre_empresa="              ";
if($rep["tipo"] != 3){
    $nombre_empresa=$rep["nombre"];
}
$pdf->Ln(7);
$pdf->MultiCell(0, 6, utf8_decode($cliente["nombre"] . '                                                                    '.$nombre_empresa) , 0, 'C');


/* Imprimimos */
$pdf->Output("CONTRATO-CESION-".$cliente['nombre']."-".$rep['nombre'].".pdf",'I');