<?php

class PDFp extends PDF_MC_Table{
    var $customer = "";

    function __construct($orientation='P', $unit='mm', $size='A4',$customer="NO DEFINIDO"){
        parent::__construct($orientation, $unit, $size);
        $this->customer = $customer;
    }

    function Header(){}

    function Footer(){}
}
$cname = html_entity_decode($cname);
$dir = html_entity_decode($dir);
$loc = html_entity_decode($loc);
$prov = html_entity_decode($prov);

$pdf = new PDFp('P','mm','A4',$cname);

$pdf->AddFont('Arial','','arial.php');
$title = 'Cartas para el ejercicio de derechos';
$pdf->SetTitle($title);
$pdf->SetAuthor('Análisis y gestión de datos S.L.');
$pdf->SetMargins(20,6,20);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Ln(5);

//Letters
$pdf->SetFont('Arial','B',16);
$pdf->MultiCell(0,10,utf8_decode('SOLICITUD DE EJERCICIO DEL DERECHO DE ACCESO'),0,'C');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('(Petición de información sobre los datos personales incluidos en fichero)'),0,'C');
$pdf->Ln(15);
$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,6,utf8_decode('DATOS DEL RESPONSABLE DEL TRATAMIENTO:'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);

$pdf->SetDrawColor(255, 255, 255);
$pdf->SetWidths(array(55,110));
$pdf->SetAligns(array('L','L'));
$pdf->SetFont('Arial','B',10);
$pdf->Row(array("Nombre o Entidad:","C.PP. ".$cname));
$pdf->Row(array("Dirección Completa:", $dir.', '.$cp.', '.$loc));
$pdf->Ln(10);

$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,6,utf8_decode('DATOS DEL SOLICITANTE (o representante legal)'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('D/Dª ....................................................................... mayor de edad, con D.N.I. ............................ (del que acompaña fotocopia), con domicilio en ..........................................................................................................., Localidad ............................................, provincia de .............................................C.P. ................ y correo electrónico ................................................... por medio del presente escrito manifiesta su deseo de ejercer su derecho de acceso, de conformidad con el artículo 15 del Reglamento 2016/679 del Parlamento Europeo y del Consejo, relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre circulación de estos datos, en consecuencia,'),0,'J');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,6,utf8_decode('SOLICITA.-'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('1.- Que se me facilite gratuitamente el derecho de acceso a los datos, que sobre mi persona figuren en sus ficheros o bases de datos.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('2.- Que la información comprenda de modo legible e inteligible las categorías de datos que sobre mi persona están incluidos en sus ficheros, las finalidades de su tratamiento, los destinatarios o cesionarios de mis datos, así como el origen de los datos, las transferencias internacionales realizadas o previstas y el plazo previsto de conservación de los datos.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('3.-. Que si la solicitud del derecho de acceso fuese estimada, se remita por correo, ordinario o electrónico, la información solicitada, sin dilación indebida, y en cualquier caso en el plazo de un mes a contar desde la recepción de esta solicitud.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('4.-. Que si Uds. no dan curso a la solicitud realizada, deben informarme igualmente en el plazo de un mes de los motivos de su no conformidad y de la posibilidad de presentar una reclamación ante la Agencia Española de Protección de Datos y ejercitar las acciones judiciales que estime oportunas.'),0,'J');$pdf->Ln(2.5);
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Fdo.'),0,'L');
$pdf->Ln(30);
$pdf->MultiCell(0,6,utf8_decode('En ............................, a ......... de ........................... de ...........'),0,'C');


$pdf->AddPage();
$pdf->SetFont('Arial','B',15);
$pdf->MultiCell(0,10,utf8_decode('SOLICITUD DE EJERCICIO DEL DERECHO DE PORTABILIDAD'),0,'C');
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('(Petición de información sobre los datos personales incluidos en fichero)'),0,'C');
$pdf->Ln(15);
$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,6,utf8_decode('DATOS DEL RESPONSABLE DEL TRATAMIENTO:'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);

$pdf->SetDrawColor(255, 255, 255);
$pdf->SetWidths(array(55,110));
$pdf->SetAligns(array('L','L'));
$pdf->SetFont('Arial','B',10);
$pdf->Row(array("Nombre o Entidad:","C.PP. ".$cname));
$pdf->Row(array("Dirección Completa:", $dir.', '.$cp.', '.$loc));
$pdf->Ln(10);

$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,6,utf8_decode('DATOS DEL SOLICITANTE (o representante legal)'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('D/Dª ....................................................................... mayor de edad, con D.N.I. ............................ (del que acompaña fotocopia), con domicilio en ..........................................................................................................., Localidad ............................................, provincia de .............................................C.P. ................ y correo electrónico ................................................... por medio del presente escrito manifiesta su deseo de ejercer su derecho de portabilidad, de conformidad con los artículos 12 y 20 del Reglamento 2016/679 del Parlamento Europeo y del Consejo, relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre circulación de estos datos, en consecuencia,'),0,'J');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,6,utf8_decode('SOLICITA.-'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('1.- Que se me facilite gratuitamente el derecho a la portabilidad de los datos que sobre mi persona figuren en sus ficheros o bases de datos.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('2.- Que la información se me facilite en un formato estructurado y de uso habitual y de lectura mecánica.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('3.-. Que si la solicitud fuese estimada, se me remita por correo, ordinario o electrónico, la información solicitada, sin dilación indebida, y en cualquier caso en el plazo de un mes a contar desde la recepción de esta solicitud.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('4.-. Que si Uds. no dan curso a la solicitud realizada, deben informarme igualmente en el plazo de un mes de los motivos de su no conformidad y de la posibilidad de presentar una reclamación ante la Agencia Española de Protección de Datos y ejercitar las acciones judiciales que estime oportunas.'),0,'J');$pdf->Ln(2.5);
$pdf->Ln(20);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Fdo.'),0,'L');
$pdf->Ln(30);
$pdf->MultiCell(0,6,utf8_decode('En ............................, a ......... de ........................... de ...........'),0,'C');


$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->MultiCell(0,10,utf8_decode("MODELO DE RESPUESTA AL EJERCICIO DEL\nDERECHO DE ACCESO O DE PORTABILIDAD"),0,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Estimado Sr./ Sra ............................................................ :'),0,'L');$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('En virtud de lo establecido en el Reglamento 2016/679 del Parlamento Europeo y del Consejo, relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre circulación de estos datos, y en respuesta a su solicitud, le comunicamos que:'),0,'L');$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('- Las categorías de datos objeto de tratamiento son:'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('   * datos identificativos,'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('   * datos de características personales,'),0,'L');
$pdf->MultiCell(0,6,utf8_decode('   * Etc ....................'),0,'L');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('- La finalidad del tratamiento es .....................................................................'),0,'L');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('- Los datos han sido obtenidos directamente del interesado y con su consentimiento'),0,'L');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('- No se van a realizar comunicaciones de datos a terceros'),0,'L');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('- El responsable no emplea técnicas automatizadas de elaboración de perfiles'),0,'L');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('- No se realizan transferencias internacionales de sus datos'),0,'L');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('- El plazo previsto para la conservación de los datos es de 5 años, atendiendo a la normativa civil y fiscal de prescripción de acciones'),0,'L');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('Le recordamos, por mandato del Artículo 15 del Reglamento Europeo, que puede Ud. solicitar la rectificación o supresión de sus datos personales o la limitación del tratamiento de sus datos, o a oponerse a los tratamientos, así como su derecho a presentar una reclamación ante la Agencia Española de Protección de Datos.'),0,'L');$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('Reciba un cordial saludo,'),0,'L');$pdf->Ln(5);
$pdf->Ln(30);
$pdf->MultiCell(0,6,utf8_decode('Fdo.'),0,'L');
$pdf->Ln(30);
$pdf->MultiCell(0,6,utf8_decode('En ............................, a ......... de ........................... de ...........'),0,'C');


$pdf->AddPage();
$pdf->SetFont('Arial','B',15);
$pdf->MultiCell(0,10,utf8_decode('SOLICITUD DE EJERCICIO DEL DERECHO DE RECTIFICACIÓN'),0,'C');
$pdf->Ln(15);
$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,6,utf8_decode('DATOS DEL RESPONSABLE DEL TRATAMIENTO:'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);

$pdf->SetDrawColor(255, 255, 255);
$pdf->SetWidths(array(55,110));
$pdf->SetAligns(array('L','L'));
$pdf->SetFont('Arial','B',10);
$pdf->Row(array("Nombre o Entidad:","C.PP. ".$cname));
$pdf->Row(array("Dirección Completa:", $dir.', '.$cp.', '.$loc));
$pdf->Ln(10);

$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,6,utf8_decode('DATOS DEL SOLICITANTE (o representante legal)'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('D/Dª ....................................................................... mayor de edad, con D.N.I. ............................ (del que acompaña fotocopia), con domicilio en ..........................................................................................................., Localidad ............................................, provincia de .............................................C.P. ................ y correo electrónico ................................................... por medio del presente escrito manifiesta su deseo de ejercer su derecho de rectificación, de conformidad con el artículo 16 del Reglamento 2016/679 del Parlamento Europeo y del Consejo, relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre circulación de estos datos, en consecuencia,'),0,'J');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,6,utf8_decode('SOLICITA.-'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('1.- Que se realice gratuitamente la rectificación de los datos que a continuación se indican:'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('2.- Que si la solicitud del derecho de acceso fuese estimada, se remita por correo, ordinario o electrónico, la información solicitada, sin dilación indebida, y en cualquier caso en el plazo de un mes a contar desde la recepción de esta solicitud.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('3.-. Que si Uds. no dan curso a la solicitud realizada, deben informarme igualmente en el plazo de un mes de los motivos de su no conformidad y de la posibilidad de presentar una reclamación ante la Agencia Española de Protección de Datos y ejercitar las acciones judiciales que estime oportunas.'),0,'J');$pdf->Ln(2.5);
$pdf->Ln(20);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Fdo.'),0,'L');
$pdf->Ln(30);
$pdf->MultiCell(0,6,utf8_decode('En ............................, a ......... de ........................... de ...........'),0,'C');

$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->MultiCell(0,10,utf8_decode("MODELO DE RESPUESTA AL EJERCICIO\nDEL DERECHO DE RECTIFICACIÓN"),0,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Estimado Sr./ Sra ............................................................ :'),0,'L');$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('En virtud de lo establecido en el artículo 16 del Reglamento 2016/679 del Parlamento Europeo y del Consejo, relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre circulación de estos datos, y en respuesta a su solicitud, le comunicamos que:'),0,'L');$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('- Hemos atendido su petición, procediendo dentro del plazo legal, a rectificar los datos indicados.'),0,'L');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('- Que hemos requerido a todos aquellos cesionarios de datos que tratan sus datos para la correcta prestación de los servicios contratados, para que rectifiquen igualmente sus datos con el fin de respetar el deber de calidad de los datos exigido por la normativa.'),0,'L');$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('Sin otro particular, reciba un cordial saludo,'),0,'L');
$pdf->Ln(30);
$pdf->MultiCell(0,6,utf8_decode('Fdo.'),0,'L');
$pdf->Ln(30);
$pdf->MultiCell(0,6,utf8_decode('En ............................, a ......... de ........................... de ...........'),0,'C');


$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->MultiCell(0,10,utf8_decode("SOLICITUD DE EJERCICIO DEL DERECHO\nDE OPOSICIÓN (CANCELACIÓN)"),0,'C');
$pdf->Ln(15);
$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,6,utf8_decode('DATOS DEL RESPONSABLE DEL TRATAMIENTO:'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);

$pdf->SetDrawColor(255, 255, 255);
$pdf->SetWidths(array(55,110));
$pdf->SetAligns(array('L','L'));
$pdf->SetFont('Arial','B',10);
$pdf->Row(array("Nombre o Entidad:","C.PP. ".$cname));
$pdf->Row(array("Dirección Completa:", $dir.', '.$cp.', '.$loc));
$pdf->Ln(10);

$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,6,utf8_decode('DATOS DEL SOLICITANTE (o representante legal)'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('D/Dª ....................................................................... mayor de edad, con D.N.I. ............................ (del que acompaña fotocopia), con domicilio en ..........................................................................................................., Localidad ............................................, provincia de .............................................C.P. ................ y correo electrónico ................................................... por medio del presente escrito manifiesta su deseo de ejercer su derecho de cancelación / oposición, de conformidad con el Artículo 21 del Reglamento 2016/679 del Parlamento Europeo y del Consejo, relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre circulación de estos datos, en consecuencia,'),0,'J');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',11);
$pdf->MultiCell(0,6,utf8_decode('EXPONGO.-'),0,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('1.- Que ejerzo mi derecho a oponerme al tratamiento que Uds. realizan de mis datos, por motivos relacionados con mi situación personal y que a continuación expongo, aportando la documentación justificativa.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('2.- Que en caso de que la solicitud fuese estimada, se me remita confirmación por correo, ordinario o electrónico, sin dilación indebida, y en cualquier caso en el plazo de un mes a contar desde la recepción de esta solicitud.'),0,'J');$pdf->Ln(2.5);
$pdf->MultiCell(0,6,utf8_decode('3.-. Que si Uds. no dan curso a la solicitud realizada, deben informarme igualmente en el plazo de un mes de los motivos de su no conformidad y de la posibilidad de presentar una reclamación ante la Agencia Española de Protección de Datos y ejercitar las acciones judiciales que estime oportunas.'),0,'J');$pdf->Ln(2.5);
$pdf->Ln(20);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Fdo.'),0,'L');
$pdf->Ln(30);
$pdf->MultiCell(0,6,utf8_decode('En ............................, a ......... de ........................... de ...........'),0,'C');

$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->MultiCell(0,10,utf8_decode("MODELO DE RESPUESTA AL EJERCICIO\nDEL DERECHO DE OPOSICIÓN (CANCELACIÓN)"),0,'C');
$pdf->Ln(10);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(0,6,utf8_decode('Estimado Sr./ Sra ............................................................ :'),0,'L');$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('En virtud de lo establecido en el artículo 21 del Reglamento 2016/679 del Parlamento Europeo y del Consejo, relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre circulación de estos datos, y en respuesta a su solicitud, le comunicamos que:'),0,'L');$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('Con fecha ....................................., dentro del plazo legal establecido, se ha procedido a anotar en nuestras bases de datos su oposición al tratamiento de los datos con la finalidad de ......................................................................'),0,'L');$pdf->Ln(5);
$pdf->MultiCell(0,6,utf8_decode('Sin otro particular, reciba un cordial saludo,'),0,'L');
$pdf->Ln(30);
$pdf->MultiCell(0,6,utf8_decode('Fdo.'),0,'L');
$pdf->Ln(30);
$pdf->MultiCell(0,6,utf8_decode('En ............................, a ......... de ........................... de ...........'),0,'C');


// Write all to the output
$pdf->Output("CARTAS-DERECHOS-C.PP.-".$cname.".pdf",'I');