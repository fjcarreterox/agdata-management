<?php
class PDFp extends PDF_MC_Table{
    var $customer = "";

    function __construct($orientation='P', $unit='mm', $size='A4',$num_f="N/D"){
        parent::__construct($orientation, $unit, $size);
        $this->num_f = $num_f;
    }

    function Header(){
        $this->AddFont('Futura','','ufonts.com_futura-book.php');
        $this->SetTextColor(0, 80, 185);
        $this->SetFont('Futura','',24);
        $this->Cell(0,5,'FACTURA',0,0,'R');
        $this->Ln(5);
        $this->SetFont('Futura','',11);
        $this->Cell(0,15,utf8_decode("Nº L".$this->num_f),0,0,'R');
        $this->Ln(10);
        $fecha = explode("-",date("d-m-Y"));
        $this->Cell(0,10,'Fecha: '.$fecha[0].' de '.getMes($fecha[1]).' de '.$fecha[2],0,1,'R');
        $this->Image('http://gestion.agdata.es/assets/img/logo2.png',20,13,40);
        $this->Ln(10);
    }

    function Footer(){
        $this->SetY(-30);
        $this->SetFont('Arial','',7);
        $this->MultiCell(0, 4, utf8_decode('En cumplimiento de lo dispuesto en la Ley Orgánica 15/1999 de 13 de diciembre, de Protección de Datos de Carácter Personal (LOPD), le informamos que sus datos han sido incorporados a un fichero propiedad de Análisis y Gestión de Datos SL, con la finalidad de prestarle los servicios contratados, siendo esta entidad responsable del fichero y de su tratamiento. Si lo desea puede ejercitar sus derechos de acceso, rectificación, cancelación y oposición, previstos en la Ley, dirigiendo un escrito a Análisis y Gestión de Datos SL a la dirección indicado en este documento.'), 'C');

    }
}

$cname = html_entity_decode($cname);
$pdf = new PDFp('P','mm','A4',str_pad($num_fact, 3, 0, STR_PAD_LEFT).' / '.$year);
define('EURO', chr(128) );

$pdf->AddFont('Arial','','arial.php');
$pdf->SetTextColor(0, 0, 0);
$title = 'Factura';
$pdf->SetTitle($title);
$pdf->SetAuthor('Análisis y gestión de datos S.L.');
$pdf->SetMargins(20,15,20);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Arial','B',11);
$pdf->SetWidths(array(110,50));
$pdf->SetAligns(array('L','L'));
$pdf->Row(array('NOMBRE: '.$cname,'CIF: '.$cif));
$pdf->Row(array('DIRECCIÓN: '.html_entity_decode($dir),'C.P: '.$cp));
$pdf->Row(array('LOCALIDAD: '.html_entity_decode($loc),'PROVINCIA: '.$prov));
$pdf->Ln(5);

/* estipulaciones */
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,strtoupper('servicios:'),0,1,'L');
$pdf->Ln(5);
$pdf->Cell(0,10,strtoupper(utf8_decode(html_entity_decode($nombre_serv)).' A.G.DATA LOPD - CUOTA '.$num_cuota.' DE '.$total_fact),0,1,'C');

$pdf->SetFillColor(0, 80, 185);
$pdf->RoundedRect(15, 142, 180, 1.5, 0.5, 'DF');
$pdf->Ln(10);
/* list of contents */
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('- ACTUALIZACIÓN DEL DOCUMENTO DE SEGURIDAD DE NIVEL MEDIO.'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('- ASESORAMIENTO JURIDICO EN MATERIA DE PROTECCIÓN DE DATOS.'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('- REDACCIÓN / ADAPTACIÓN DE DOCUMENTOS LEGALES ADICIONALES.'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('- ADAPTACIÓN A NOVEDADES EN LA NORMATIVA SOBRE PROTECCIÓN DE DATOS.'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('- CONTACTO DIRECTO CON EL RESPONSABLE DE SEGURIDAD.'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('- AUDITORIA BIANUAL OBLIGATORIA PARA NIVEL MEDIO DE SEGURIDAD.'),0,'L');
$pdf->Ln(3);

$pdf->SetLeftMargin(120);
$pdf->SetFont('Arial','B',10);
$pdf->SetWidths(array(30,35));
$pdf->SetAligns(array('C','R'));
$pdf->Row(array("IMPORTE",$importe.' Euros'));
$pdf->Row(array("I.V.A. (21%)",number_format($importe*0.21,2).' Euros'));
$pdf->Row(array("TOTAL",number_format($importe*1.21,2).' Euros'));
$pdf->Ln(5);

$pdf->SetLeftMargin(20);
$pdf->Ln(2);
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,6,utf8_decode('FORMA DE PAGO: '.html_entity_decode($forma)),0,'L');

$pdf->SetLeftMargin(20);
$pdf->Image('http://gestion.agdata.es/assets/img/firma.png',120,170,60);
$pdf->Ln(10);

/*$pdf->SetLeftMargin(20);
$pdf->Ln(10);
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(0, 6, utf8_decode('Dpto. Administración'),0,'L');
$pdf->MultiCell(0, 6, utf8_decode('Análisis y Gestión de Datos SL'),0,'L');
$pdf->Ln(10);*/

$pdf->SetTextColor(0, 80, 185);
$pdf->SetFont('Arial','B',9);
$pdf->MultiCell(0, 5, utf8_decode('Av. Del Aljarafe, S/N'),0,'L');
$pdf->MultiCell(0, 5, utf8_decode('Edif. Ramcab, Oficina 42'),0,'L');
$pdf->MultiCell(0, 5, utf8_decode('41940 Tomares (Sevilla)'),0,'L');
$pdf->MultiCell(0, 5, utf8_decode('Tlfn.. 954 15 73 39'),0,'L');
$pdf->MultiCell(0, 5, utf8_decode('www.agdata.es'),0,'L');
$pdf->SetTextColor(0, 0, 0);
$pdf->Output("FACTURA-L".str_pad($num_fact, 3, 0, STR_PAD_LEFT)."-".$year."-".$cname.".pdf",'I');