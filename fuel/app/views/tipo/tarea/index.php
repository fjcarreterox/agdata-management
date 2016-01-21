<h2>Listado de los <span class='muted'>tipos de tareas</span> definidos en el sistema</h2>
<br>
<?php if ($tipo_tareas): ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Tipo</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tipo_tareas as $item): ?>
            <tr>

                <td><?php echo $item->nombre; ?></td>
                <td><?php echo $item->descripcion; ?></td>
                <td><?php echo Model_Servicio::find($item->tipo)->get('nombre'); ?></td>
                <td>
                    <div class="btn-toolbar">
                        <div class="btn-group">
                            <?php echo Html::anchor('tipo/tarea/view/' . $item->id, '<span class="glyphicon glyphicon-eye-open"></span> Detalle', array('class' => 'btn btn-default')); ?>
                            <?php echo Html::anchor('tipo/tarea/edit/' . $item->id, '<span class="glyphicon glyphicon-pencil"></span> Editar', array('class' => 'btn btn-success')); ?>
                            <?php echo Html::anchor('tipo/tarea/delete/' . $item->id, '<span class="glyphicon glyphicon-trash"></span> Eliminar', array('class' => 'btn btn-danger', 'onclick' => "return confirm('¿Estás seguro de esto?')")); ?>
                        </div>
                    </div>

                </td>
            </tr>
        <?php endforeach; ?>    </tbody>
    </table>
<?php else: ?>
    <p>No se han encontrado aún definidos ningún tipo de tarea.</p>
<?php endif; ?><p>
    <?php echo Html::anchor('tipo/tarea/create', '<span class="glyphicon glyphicon-plus"></span> Añadir un nuevo tipo de tarea', array('class' => 'btn btn-primary')); ?>
</p>