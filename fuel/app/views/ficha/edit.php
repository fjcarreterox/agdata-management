<h2>Editando los datos específicos de <span class='muted'>cliente</span></h2>
<br/>
<?php echo render('ficha/_form'); ?>
<p><?php echo Html::anchor('ficha/view/'.$ficha->idcliente, 'Ver detalles'); ?> | <?php echo Html::anchor('ficha', 'Volver'); ?></p>
