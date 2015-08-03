<h2>Editando el registro de <span class='muted'>agenda</span> para el cliente seleccionado</h2>
<br/>
<?php echo render('agenda/_form'); ?>
<p><?php echo Html::anchor('agenda/view/'.$agenda->id, 'Ver registro'); ?> | <?php echo Html::anchor('agenda', 'Volver'); ?></p>
