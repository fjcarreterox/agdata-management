<h2>Añadir un nuevo <span class='muted'>cliente</span> en el sistema</h2>
<br/>
<p>Los datos obligatorios a rellenar serán su <b>nombre, tipo de cliente, provincia, teléfono y actividad</b> a la que se
    dedica. El estado por defecto será <b>No contactado</b>, pero se podrá cambiar.
El resto de campos se pueden dejar vacíos para rellenarlos más adelante.</p>
<?php echo render('clientes/_form'); ?>
<p><?php echo Html::anchor('clientes', 'Volver'); ?></p>
