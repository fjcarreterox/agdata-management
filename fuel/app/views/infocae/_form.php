<?php
    echo Form::open(array("class"=>"form-horizontal")); ?>
	<fieldset>
		<div class="form-group">
			<?php /*echo Form::label('Cliente', 'idcliente', array('class'=>'control-label'));*/ ?>
            <?php echo Form::input('idcliente', Input::post('idcliente', isset($infocae) ? $infocae->idcliente : $idcliente), array('type'=>'hidden')); ?>
		</div>
        <table boder="yes" class="table table-striped table-bordered table-hover table-responsive">
            <tr>
                <td><?php echo Form::label('Portal', 'portal', array('class'=>'control-label'));?></td>
                <td>
                    <?php echo Form::label('No', 'portal');?>
                    <?php echo Form::radio('portal', Input::post('portal', 0), (!isset($infocae) or (isset($infocae) && $infocae->portal==0)) ? true : null);?>&nbsp;&nbsp;&nbsp;
                    <?php echo Form::label('Sí', 'portal');?>
                    <?php echo Form::radio('portal', Input::post('portal', 1), isset($infocae) && $infocae->portal==1 ? true : null);?>
                </td>
            </tr>
            <tr>
                <td><?php echo Form::label('Azotea', 'azotea', array('class'=>'control-label'));?></td>
                <td>
                    <?php echo Form::label('No', 'azotea');?>
                    <?php echo Form::radio('azotea', Input::post('azotea', 0), (!isset($infocae) or (isset($infocae) && $infocae->azotea==0)) ? true : null);?>&nbsp;&nbsp;&nbsp;
                    <?php echo Form::label('Sí', 'azotea');?>
                    <?php echo Form::radio('azotea', Input::post('azotea', 1), isset($infocae) && $infocae->azotea==1 ? true : null);?>
                </td>
            </tr>
            <tr>
                <td><?php echo Form::label('Escaleras', 'escaleras', array('class'=>'control-label'));?></td>
                <td>
                    <?php echo Form::label('No', 'escaleras');?>
                    <?php echo Form::radio('escaleras', Input::post('escaleras', 0), (!isset($infocae) or (isset($infocae) && $infocae->escaleras==0)) ? true : null);?>&nbsp;&nbsp;&nbsp;
                    <?php echo Form::label('Sí', 'escaleras');?>
                    <?php echo Form::radio('escaleras', Input::post('escaleras', 1), isset($infocae) && $infocae->escaleras==1 ? true : null);?>
                </td>
            </tr>
            <tr>
                <td><?php echo Form::label('Sótano', 'sotano', array('class'=>'control-label'));?></td>
                <td>
                    <?php echo Form::label('No', 'sotano');?>
                    <?php echo Form::radio('sotano', Input::post('sotano', 0), (!isset($infocae) or (isset($infocae) && $infocae->sotano==0)) ? true : null);?>&nbsp;&nbsp;&nbsp;
                    <?php echo Form::label('Sí', 'sotano');?>
                    <?php echo Form::radio('sotano', Input::post('sotano', 1), isset($infocae) && $infocae->sotano==1 ? true : null);?>
                </td>
            </tr>
            <tr>
                <td><?php echo Form::label('Cuarto de contadores de luz', 'contadoresluz', array('class'=>'control-label'));?></td>
                <td>
                    <?php echo Form::label('No', 'contadoresluz');?>
                    <?php echo Form::radio('contadoresluz', Input::post('contadoresluz', 0), (!isset($infocae) or (isset($infocae) && $infocae->contadoresluz==0)) ? true : null);?>&nbsp;&nbsp;&nbsp;
                    <?php echo Form::label('Sí', 'contadoresluz');?>
                    <?php echo Form::radio('contadoresluz', Input::post('contadoresluz', 1), isset($infocae) && $infocae->contadoresluz==1 ? true : null);?>
                </td>
            </tr>
            <tr>
                <td><?php echo Form::label('Instalación eléctrica de baja tensión', 'bajatension', array('class'=>'control-label'));?></td>
                <td>
                    <?php echo Form::label('No', 'bajatension');?>
                    <?php echo Form::radio('bajatension', Input::post('bajatension', 0), (!isset($infocae) or (isset($infocae) && $infocae->bajatension==0)) ? true : null);?>&nbsp;&nbsp;&nbsp;
                    <?php echo Form::label('Sí', 'bajatension');?>
                    <?php echo Form::radio('bajatension', Input::post('bajatension', 1), isset($infocae) && $infocae->bajatension==1 ? true : null);?>
                </td>
            </tr>
            <tr>
                <td><?php echo Form::label('Cuarto de equipos de presión de agua', 'equipospresion', array('class'=>'control-label'));?></td>
                <td>
                    <?php echo Form::label('No', 'equipospresion');?>
                    <?php echo Form::radio('equipospresion', Input::post('equipospresion', 0), (!isset($infocae) or (isset($infocae) && $infocae->equipospresion==0)) ? true : null);?>&nbsp;&nbsp;&nbsp;
                    <?php echo Form::label('Sí', 'equipospresion');?>
                    <?php echo Form::radio('equipospresion', Input::post('equipospresion', 1), isset($infocae) && $infocae->equipospresion==1 ? true : null);?>
                </td>
            </tr>
            <tr>
                <td><?php echo Form::label('Cuarto de contadores de agua', 'contadoresagua', array('class'=>'control-label'));?></td>
                <td>
                    <?php echo Form::label('No', 'contadoresagua');?>
                    <?php echo Form::radio('contadoresagua', Input::post('contadoresagua', 0), (!isset($infocae) or (isset($infocae) && $infocae->contadoresagua==0)) ? true : null);?>&nbsp;&nbsp;&nbsp;
                    <?php echo Form::label('Sí', 'contadoresagua');?>
                    <?php echo Form::radio('contadoresagua', Input::post('contadoresagua', 1), isset($infocae) && $infocae->contadoresagua==1 ? true : null);?>
                </td>
            </tr>
            <tr>
                <td><?php echo Form::label('Instalación de protección frente a incendios', 'incendios', array('class'=>'control-label'));?></td>
                <td>
                    <?php echo Form::label('No', 'incendios');?>
                    <?php echo Form::radio('incendios', Input::post('incendios', 0), (!isset($infocae) or (isset($infocae) && $infocae->incendios==0)) ? true : null);?>&nbsp;&nbsp;&nbsp;
                    <?php echo Form::label('Sí', 'incendios');?>
                    <?php echo Form::radio('incendios', Input::post('incendios', 1), isset($infocae) && $infocae->incendios==1 ? true : null);?>
                </td>
            </tr>
            <tr>
                <td><?php echo Form::label('Puerta de garaje', 'garaje', array('class'=>'control-label'));?></td>
                <td>
                    <?php echo Form::label('No', 'garaje');?>
                    <?php echo Form::radio('garaje', Input::post('garaje', 0), (!isset($infocae) or (isset($infocae) && $infocae->garaje==0)) ? true : null);?>&nbsp;&nbsp;&nbsp;
                    <?php echo Form::label('Sí', 'garaje');?>
                    <?php echo Form::radio('garaje', Input::post('garaje', 1), isset($infocae) && $infocae->garaje==1 ? true : null);?>
                </td>
            </tr>
            <tr>
                <td><?php echo Form::label('Ascensores', 'ascensores', array('class'=>'control-label'));?></td>
                <td>
                    <?php echo Form::label('No', 'ascensores');?>
                    <?php echo Form::radio('ascensores', Input::post('ascensores', 0), (!isset($infocae) or (isset($infocae) && $infocae->ascensores==0)) ? true : null);?>&nbsp;&nbsp;&nbsp;
                    <?php echo Form::label('Sí', 'ascensores');?>
                    <?php echo Form::radio('ascensores', Input::post('ascensores', 1), isset($infocae) && $infocae->ascensores==1 ? true : null);?>
                </td>
            </tr>
            <tr>
                <td><?php echo Form::label('Cuarto de Calderas', 'calderas', array('class'=>'control-label'));?></td>
                <td>
                    <?php echo Form::label('No', 'calderas');?>
                    <?php echo Form::radio('calderas', Input::post('calderas', 0), (!isset($infocae) or (isset($infocae) && $infocae->calderas==0)) ? true : null);?>&nbsp;&nbsp;&nbsp;
                    <?php echo Form::label('Sí', 'calderas');?>
                    <?php echo Form::radio('calderas', Input::post('calderas', 1), isset($infocae) && $infocae->calderas==1 ? true : null);?>
                </td>
            </tr>
            <tr>
                <td><?php echo Form::label('Pistas deportivas', 'pistas', array('class'=>'control-label'));?></td>
                <td>
                    <?php echo Form::label('No', 'pistas');?>
                    <?php echo Form::radio('pistas', Input::post('pistas', 0), (!isset($infocae) or (isset($infocae) && $infocae->pistas==0)) ? true : null);?>&nbsp;&nbsp;&nbsp;
                    <?php echo Form::label('Sí', 'pistas');?>
                    <?php echo Form::radio('pistas', Input::post('pistas', 1), isset($infocae) && $infocae->pistas==1 ? true : null);?>
                </td>
            </tr>
            <tr>
                <td><?php echo Form::label('Piscina', 'piscina', array('class'=>'control-label'));?></td>
                <td>
                    <?php echo Form::label('No', 'piscina');?>
                    <?php echo Form::radio('piscina', Input::post('piscina', 0), (!isset($infocae) or (isset($infocae) && $infocae->piscina==0)) ? true : null);?>&nbsp;&nbsp;&nbsp;
                    <?php echo Form::label('Sí', 'piscina');?>
                    <?php echo Form::radio('piscina', Input::post('piscina', 1), isset($infocae) && $infocae->piscina==1 ? true : null);?>
                </td>
            </tr>
            <tr>
                <td><?php echo Form::label('Aseo de piscina', 'aseopiscina', array('class'=>'control-label'));?></td>
                <td>
                    <?php echo Form::label('No', 'aseopiscina');?>
                    <?php echo Form::radio('aseopiscina', Input::post('aseopiscina', 0), (!isset($infocae) or (isset($infocae) && $infocae->aseopiscina==0)) ? true : null);?>&nbsp;&nbsp;&nbsp;
                    <?php echo Form::label('Sí', 'aseopiscina');?>
                    <?php echo Form::radio('aseopiscina', Input::post('aseopiscina', 1), isset($infocae) && $infocae->aseopiscina==1 ? true : null);?>
                </td>
            </tr>
            <tr>
                <td><?php echo Form::label('Zonas ajardinadas', 'jardines', array('class'=>'control-label'));?></td>
                <td>
                    <?php echo Form::label('No', 'jardines');?>
                    <?php echo Form::radio('jardines', Input::post('jardines', 0), (!isset($infocae) or (isset($infocae) && $infocae->jardines==0)) ? true : null);?>&nbsp;&nbsp;&nbsp;
                    <?php echo Form::label('Sí', 'jardines');?>
                    <?php echo Form::radio('jardines', Input::post('jardines', 1), isset($infocae) && $infocae->jardines==1 ? true : null);?>
                </td>
            </tr>
        </table>
        <br/>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Guardar información C.A.E.', array('class' => 'btn btn-primary')); ?>
        </div>
	</fieldset>
<?php echo Form::close(); ?>