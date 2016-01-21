<?php
$servicios_ops = array();
foreach($servicios as $s){
    $servicios_ops[$s->id] = $s->nombre;
}
echo Form::open(array("class" => "form-horizontal")); ?>
    <fieldset>
        <div class="form-group">
            <?php echo Form::label('Nombre de la tarea', 'nombre', array('class' => 'control-label')); ?>
            <?php echo Form::input('nombre', Input::post('nombre', isset($tipo_tarea) ? $tipo_tarea->nombre : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'Nombre corto descriptivo')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Descripción', 'descripcion', array('class' => 'control-label')); ?>
            <?php echo Form::input('descripcion', Input::post('descripcion', isset($tipo_tarea) ? $tipo_tarea->descripcion : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'Descripción más detallada de la tarea')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Tipo', 'tipo', array('class' => 'control-label')); ?>
            <?php echo Form::select('tipo', Input::post('tipo', isset($tipo_tarea) ? $tipo_tarea->tipo : ''), $servicios_ops,array('class' => 'col-md-4 form-control')); ?>
        </div>
        <div class="form-group">
            <label class='control-label'>&nbsp;</label>
            <?php echo Form::button('submit', '<span class="glyphicon glyphicon-floppy-save"></span> Guardar cambios', array('class' => 'btn btn-primary','type'=>'submit')); ?>
        </div>
    </fieldset>
<?php echo Form::close(); ?>