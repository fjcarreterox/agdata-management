<?php
$tipos_array = array();
foreach($tipos as $t){
    $tipos_array[$t->get('id')] = $t->get('tipo')." (".$t->get('finalidad').")";
}

$soporte_ops = array(
    "digital"=>"En formato digital",
    "papel"=>"En papel",
    "mixto"=>"Mixto"
);

$base_ops = array(
    "consent"=>"Consentimiento del interesado",
    "interes"=>"Interés legítimo",
    "ejecucion"=>"Ejecución de un contrato"
);
$origen_ops = array(
    "propio"=>"El propio interesado o su representante legal",
    "fuentes"=>"Fuentes accesibles al público",
    "entpriv"=>"Entidades privadas",
    "entpub"=>"Entidades públicas"
);
$recogida_ops = array(
    "personalmente"=>"Personalmente",
    "forms"=>"Formularios",
    "email"=>"E-mail",
    "internet"=>"Internet"
);
$boolean_ops = array( "0"=>"NO","1"=>"SÍ");

$niveles_ops = array("NO ESPECIFICADO","Básico","Medio","Alto");

echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Tipo de fichero (finalidad)', 'idtipo', array('class'=>'control-label')); ?>
			<?php echo Form::select('idtipo', Input::post('idtipo', isset($fichero) ? $fichero->idtipo : ''),$tipos_array, array('class' => 'col-md-4 form-control')); ?>
		</div>
        <?php echo Form::input('idcliente', Input::post('idcliente', isset($fichero) ? $fichero->idcliente : $idcliente), array('class' => 'col-md-4 form-control', 'type'=>'hidden')); ?>
		<div class="form-group">
			<?php echo Form::label('Sistema de tratamiento', 'soporte', array('class'=>'control-label')); ?>
			<?php echo Form::select('soporte', Input::post('soporte', isset($fichero) ? $fichero->soporte : ''),$soporte_ops, array('class' => 'col-md-4 form-control')); ?>
		</div>
        <div class="form-group">
            <?php echo Form::label('Nivel de seguridad', 'nivel', array('class'=>'control-label')); ?>
            <?php echo Form::select('nivel', Input::post('nivel', isset($fichero) ? $fichero->nivel : ''),$niveles_ops, array('class' => 'col-md-4 form-control')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Base de legitimación', 'base', array('class'=>'control-label')); ?>
            <?php echo Form::select('base', Input::post('base', isset($fichero) ? $fichero->base : ''),$base_ops, array('class' => 'col-md-4 form-control')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Origen de los datos', 'origen', array('class'=>'control-label')); ?>
            <?php echo Form::select('origen', Input::post('origen', isset($fichero) ? $fichero->origen : ''),$origen_ops, array('class' => 'col-md-4 form-control')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Procedimiento de recogida de datos', 'recogida', array('class'=>'control-label')); ?>
            <?php echo Form::select('recogida', Input::post('recogida', isset($fichero) ? $fichero->recogida : ''),$recogida_ops, array('class' => 'col-md-4 form-control')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Transferencias internacionales de datos', 'trans', array('class'=>'control-label')); ?>
            <?php echo Form::select('trans', Input::post('trans', isset($fichero) ? $fichero->trans : ''),$boolean_ops, array('class' => 'col-md-4 form-control')); ?>
        </div>
<?php
$datos_tmp=array();
foreach($datos as $d){
    $datos_tmp[$d["tipo"]][$d["id"]] = $d["nombre"];
}
$tipo_ops = array("Datos de carácter identificativo","Datos de características personales","Datos de circunstancias sociales","Datos académicos y profesionales","Datos de detalles de empleo","Datos de información comercial","Datos económico-financieros y de seguros","Datos de transacciones","Datos especialmente protegidos");
echo '<div class="panel-group" id="accordion">';
$i=1;
foreach($datos_tmp as $t => $dt){
    ?>
    <!-- FIRST PANEL -->
    <div class="panel panel-default" id="panel<?php echo $i;?>">
        <div class="panel-heading">
            <h3 class="panel-title datos_cliente"><span class="muted">
                <a data-toggle="collapse" data-target="#collapse<?php echo $i;?>" href="#collapse<?php echo $i;?>">
                    <?php echo $tipo_ops[$t];?>
                </a></span>
            </h3>
        </div>
        <div id="collapse<?php echo $i;?>" class="panel-collapse collapse in">
            <div class="panel-body">
                <?php
                foreach($dt as $id => $dato){
                    echo Form::input('estructura[]', $id, array('class' => '','type'=>'checkbox'));echo "&nbsp;".$dato."<br/>";
                 }
                ?>
            </div>
        </div>
    </div>
    <?php
    $i++;
}
echo "</div>";
?>
        <br/>
        <div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::button('submit', '<span class="glyphicon glyphicon-floppy-save"></span> Guardar cambios', array('class' => 'btn btn-primary','type'=>'submit')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>