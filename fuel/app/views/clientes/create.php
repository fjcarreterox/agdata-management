<h2>Añada un nuevo <span class='muted'>contacto</span> en el sistema</h2>
<br/>
<ul>
<li>Si es un <strong>posible cliente</strong>, su estado inicial será <strong>NO CONTACTADO</strong>.</li>
<li>Si ya es cliente, deberá indicarse su estado actual (en <strong>ADAPTACIÓN</strong> o en <strong>MANTENIMIENTO</strong>).</li>
</ul>
<p>Los campos no marcados con <span class="red">*</span> podrán ser completados más adelante.</p>
<?php echo render('clientes/_form'); ?>
<p><?php echo Html::anchor('welcome', '<span class="glyphicon glyphicon-backward"></span> Volver al menú principal',array('class'=>'btn btn-danger')); ?></p>
