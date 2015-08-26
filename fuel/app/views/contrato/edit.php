<h2>Editando los principales datos del <span class='muted'>contrato</span></h2>
<br>

<?php echo render('contrato/_form'); ?>
<p>
	<?php echo Html::anchor('contrato/view/'.$contrato->id, 'View',array('class'=>'btn btn-success')); ?>&nbsp;&nbsp;
    <?php echo Html::anchor('contrato', 'Volver',array('class'=>'btn btn-danger')); ?>
</p>
