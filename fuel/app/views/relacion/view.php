<h2>Mostrano detalle del tipo de relación</h2>
<p><strong>Nombre: </strong><?php echo $relacion->nombre; ?></p>
<?php echo Html::anchor('relacion/edit/'.$relacion->id, 'Editar nombre'); ?> |
<?php echo Html::anchor('relacion', 'Volver al listado de tipos de relaciones'); ?>