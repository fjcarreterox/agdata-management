<?php
echo "<h3>Establecer nueva contraseña para <strong>$name</strong></h3>";
echo Form::open(array("class"=>"form-horizontal")); ?>
<fieldset>
    <div class="form-group">
        <?php echo Form::label('Nueva contraseña', 'email', array('class'=>'control-label')); ?><span class="red"> *</span>
        <?php echo Form::input('pass1', '', array('type'=>'password','class' => 'col-md-4 form-control', 'placeholder'=>'Escribe aquí la nueva contraseña')); ?>
    </div>
    <div class="form-group">
        <?php echo Form::label('Confirma la nueva contraseña', 'pass', array('class'=>'control-label')); ?><span class="red"> *</span>
        <?php echo Form::input('pass2', '', array('type'=>'password','class' => 'col-md-4 form-control', 'placeholder'=>'Confirma aquí la nueva contraseña')); ?>
    </div>
    <div class="form-group">
        <?php echo Form::label('¿Deseas notificar el cambio a alguno de los contactos definidos para este cliente?', 'notify', array('class'=>'control-label')); ?>
        <?php echo Form::input('notify', '', array('class' => 'col-md-1 form-control', 'type'=>'checkbox', 'default'=>'unchecked')); ?>
    </div>
    <div class="form-group">
        <?php echo Form::label('Correo al que se le notificará este cambio', 'contact', array('class'=>'control-label')); ?>
        <?php echo Form::input('contact', $email , array('class' => 'col-md-4 form-control', 'placeholder'=>'Escriba aquí la nueva contraseña o genere una aleatoria.')); ?>
    </div>
    <div class="form-group">
        <label class='control-label'>&nbsp;</label>
        <?php echo Form::button('submit', '<span class="glyphicon glyphicon-envelope"></span> Cambiar contraseña', array('class' => 'btn btn-warning','type'=>'submit','onclick' => "return validateForm($('form'))")); ?>
    </div>
</fieldset>
<?php echo Form::close(); ?>