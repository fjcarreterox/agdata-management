<h2>Editando el nombre del <span class='muted'>servicio</span> seleccionado:</h2>
<br/>
<?php echo render('servicios/_form'); ?>
<p><?php echo Html::anchor('servicios/view/'.$servicio->id, 'Ver'); ?> | <?php echo Html::anchor('servicios', 'Volver'); ?></p>
