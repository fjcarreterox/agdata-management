<h2>Mostrando detalles del <span class='muted'>contrato</span> especificado</h2>
<br/>
<p>
	<strong>Cliente:</strong>
	<?php echo Model_Cliente::find($contrato->idcliente)->get('nombre'); ?></p>
<p>
	<strong>Presupuesto relacionado:</strong>
	<?php echo Model_Presupuesto::find($contrato->idpres)->get('num_p'); ?></p>
<p>
	<strong>Representante legal:</strong>
	<?php echo Model_Personal::find($contrato->idpersonal)->get('nombre'); ?></p>
<p>
	<strong>Fecha firma:</strong>
	<?php echo date_conv($contrato->fecha_firma); ?></p>
<p>
    <strong>Periodo de Facturación:</strong>
    <?php
        switch($contrato->periodicidad){
            case 1: echo "mensual";break;
            case 2: echo "trimestral";break;
            case 3: echo "anual";break;
            default: echo "NO ESPECIFICADO";
        }
    ?></p>
<br/>
<?php echo Html::anchor('contrato/edit/'.$contrato->id, 'Editar datos',array('class'=>'btn btn-success')); ?>&nbsp;&nbsp;
<?php echo Html::anchor('contrato', 'Volver',array('class'=>'btn btn-danger')); ?>