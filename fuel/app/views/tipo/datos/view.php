<h2>Mostrando detalle del <span class='muted'>tipo de dato</span> seleccionado</h2>
<br/>
<p>
	<strong>Nombre:</strong>
	<?php echo $tipo_dato->nombre; ?></p>
<p>
	<strong>Tipo de dato:</strong>
	<?php
    $tipo_ops = array("Datos de carácter identificativo","Datos de características personales",
        "Datos de circunstancias sociales","Datos académicos y profesionales","Datos de detalles de empleo",
        "Datos de información comercial","Datos económico-financieros y de seguros","Datos de transacciones",
        "Datos especialmente protegidos");
    echo $tipo_ops[$tipo_dato->tipo]; ?></p>
<p>
	<strong>Nivel de seguridad:</strong>
	<?php
    $nivel_ops = array("Básico","Medio","Alto");
    echo $nivel_ops[$tipo_dato->nivel]; ?></p>
<br/>
<?php echo Html::anchor('tipo/datos/edit/'.$tipo_dato->id, '<span class="glyphicon glyphicon-pencil"></span> Editar dato',array('class'=>'btn btn-success')); ?>&nbsp;&nbsp;
<?php echo Html::anchor('tipo/datos', '<span class="glyphicon glyphicon-trash"></span> Volver',array('class'=>'btn btn-danger')); ?>