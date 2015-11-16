<h2>Mostrando detalles del <span class='muted'>contrato</span> especificado</h2>
<br/>
<p>
	<strong>Cliente:</strong>
	<?php echo Model_Cliente::find($contrato->idcliente)->get('nombre'); ?></p>
<p>
	<strong>Presupuesto relacionado:</strong>
	<?php echo Html::anchor('presupuesto/view/'.Model_Presupuesto::find($contrato->idpres)->get('id'),'P00'.Model_Presupuesto::find($contrato->idpres)->get('num_p')); ?></p>
<p>
	<strong>Representante legal:</strong>
	<?php
        if($contrato->idpersonal != null) {
            echo Model_Personal::find($contrato->idpersonal)->get('nombre');
        }
        else{
            echo '<span class="red">-- AÚN NO ESPECIFICADO --</span>';
        }
    ?></p>
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
            case 4: echo "pago único";break;
            default: echo "<span class='red'>-- AÚN NO ESPECIFICADO --</span>";
        }
    ?></p>
<br/>
<?php echo Html::anchor('contrato/edit/'.$contrato->id, '<span class="glyphicon glyphicon-pencil"></span> Editar datos',array('class'=>'btn btn-success')); ?>&nbsp;&nbsp;
<?php echo Html::anchor('contrato', '<span class="glyphicon glyphicon-backward"></span> Volver al listado',array('class'=>'btn btn-danger')); ?>