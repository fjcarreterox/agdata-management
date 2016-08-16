<h2>Buscar <span class="muted">facturas</span> en un mes concreto</h2>
<p>Selecciona un <strong>mes</strong> del calendario (el día es indiferente) en el desplegable de abajo para ver
    todas las facturas que deben emitirse en dicho mes.</p>
<?php
echo Form::open(array("class" => "form-horizontal")); ?>
<fieldset>
    <div class="form-group">
        <?php echo Form::label('Fecha de cobro', 'date_sign', array('class' => 'control-label')); ?><span
            class="red"> *</span>
        <?php echo Form::input('date_sign', '', array('class' => 'col-md-4 form-control', 'type' => 'date')); ?>
    </div>
    <div class="form-group">
        <label class='control-label'>&nbsp;</label>
        <?php echo Form::button('submit', '<span class="glyphicon glyphicon-search"></span> Buscar facturas', array('class' => 'btn btn-primary', 'type' => 'submit')); ?>
    </div>
</fieldset>
<?php echo Form::close();?>