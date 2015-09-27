<h2>Ficha completa del cliente: <span class='muted'><?php echo $cliente->nombre; ?></span> </h2>
<br/>
<div class="panel-group" id="accordion">
    <div class="panel panel-default" id="panel1">
        <div class="panel-heading">
            <h3 class="panel-title datos_cliente"><span class="muted">
                <a data-toggle="collapse" data-target="#collapseOne" href="#collapseOne">
                    Contacto
                </a></span>
            </h3>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in">
            <div class="panel-body">
                <p>En la siguiente tabla mostramos los datos comúnes a todo tipo de clientes: <strong>estado, DNI/NIF, tipo de cliente,
                        dirección completa, teléfono, página web, e-mail de contacto, actividad a la que se dedica y las observaciones</strong> que estimemos oportunas.</p>
                <br/>
                <table class="table table-striped table-bordered table-hover">
                    <thead></thead>
                    <tbody>
                    <tr class="text-center">
                        <td><?php echo Model_Estados_Cliente::find($cliente->estado)->get('nombre'); ?></td>
                        <td><?php if($cliente->cif_nif!=''){echo $cliente->cif_nif;}else{echo '<span class="red">-- FALTA NIF/CIF --</span>';} ?></td>
                        <td colspan="2"><?php echo Model_Tipo_Cliente::find($cliente->tipo)->get('tipo'); ?></td>
                    </tr>
                    <tr>
                        <td colspan="4"><?php echo $cliente->direccion; ?>, <?php echo $cliente->cpostal; ?>, <?php echo $cliente->loc; ?>. <?php echo $cliente->prov; ?></td>
                    </tr>
                    <tr class="text-center">
                        <td><?php echo $cliente->tel; ?></td>
                        <td><?php if($cliente->pweb!=''){echo $cliente->pweb;}else{echo '<span class="red">-- FALTA PAG. WEB --</span>';} ?></td>
                        <td><?php if($cliente->email!=''){echo $cliente->email;}else{echo '<span class="red">-- FALTA E-MAIL --</span>';} ?></td>
                        <td><?php echo $cliente->actividad; ?></td>
                    </tr>
                    <tr>
                        <td colspan="4"><?php if($cliente->observ!=''){echo $cliente->observ;}else{echo '<span>Sin observaciones aún.</span>';} ?></td>
                    </tr>
                    </tbody>
                </table>
                <br/>
                <?php echo Html::anchor('clientes/edit/'.$cliente->id, '<span class="glyphicon glyphicon-pencil"></span> Editar datos básicos',array('class'=>'btn btn-success')); ?> &nbsp;
                <?php echo Html::anchor('clientes', '<span class="glyphicon glyphicon-backward"></span> Volver al listado de clientes',array('class'=>'btn btn-danger')); ?>
                <br/><br/>
                <?php if(empty($contactos)): ?>
                    <p>No se ha encontrado aún personal de este cliente registrado en nuestro sistema.</p>
                <?php else: ?>
                    <p>A continuación listamos el personal registrado en el sistema que tenga algún tipo de relación con nosotros</p>
                    <table class="table table-striped table-bordered table-hover table-responsive">
                        <thead>
                        <tr class="text-center">
                            <td><strong>Nombre</strong></td>
                            <td><strong>DNI</strong></td>
                            <td><strong>Cargo o función</strong></td>
                            <td><strong>Relación con AGDATA</strong></td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($contactos as $c): ?>
                            <tr>
                                <td><?php echo $c->nombre; ?></td>
                                <td><?php echo $c->dni; ?></td>
                                <td><?php echo $c->cargofuncion; ?></td>
                                <td><?php echo Model_Relacion::find($c->relacion)->get('nombre'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
                <?php echo Html::anchor('personal/associate/'.$cliente->id, '<span class="glyphicon glyphicon-plus"></span> Añadir personal',array('class'=>'btn btn-success')); ?>
            </div>
        </div>
    </div>
    <div class="panel panel-default" id="panel2">
        <div class="panel-heading">
            <h3 class="panel-title datos_cliente"><span class="muted">
                <a data-toggle="collapse" data-target="#collapseTwo" href="#collapseTwo" class="collapsed">
                    Presupuestos y contratos
                </a></span>
            </h3>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse">
            <div class="panel-body">
                    <?php if(empty($ficha)):?>
                        <p>Se ha detectado que este cliente aún no tiene creada su ficha completa con los
                            datos específicos requeridos para gestionar adecuadamente sus presupuestos y contratos.</p>
                        <?php echo Html::anchor('ficha/create/'.$cliente->id, '<span class="glyphicon glyphicon-list"></span> Crear ficha completa de cliente',array('class'=>'btn btn-success')); ?>
                    <?php else: ?>
                        <p>Los clientes deben tener cumplimentados los siguientes campos adicionales que nos ayuden a gestionar los servicios
                            contratados.</p>
                        <table class="table table-striped table-bordered table-hover table-responsive">
                            <tbody>
                            <tr>
                                <td><strong>Móvil de contacto</strong></td>
                                <td><?php if($ficha->movil_contacto!=0){echo $ficha->movil_contacto;}else{echo '<span class="red">-- FALTA MÓVIL DE CONTACTO --</span>';} ?></td>
                            </tr>
                            <tr>
                                <td><strong>E-mail de contacto</strong></td>
                                <td><?php if($ficha->email_contacto!=''){echo $ficha->email_contacto;}else{echo '<span class="red">-- FALTA EMAIL DE CONTACTO --</span>';} ?></td>
                            </tr>
                            <tr>
                                <td><strong>Código CNAE</strong></td>
                                <td><?php if($ficha->cnae!=0){echo $ficha->cnae;}else{echo '<span class="red">-- FALTA CÓDIGO CNAE --</span>';} ?></td>
                            </tr>
                            <tr>
                                <td><strong>Convenio colectivo</strong></td>
                                <td><?php if($ficha->convenio!=''){echo $ficha->convenio;}else{echo '<span class="red">-- FALTA CONVENIO COLECTIVO --</span>';} ?></td>
                            </tr>
                            <tr>
                                <td><strong>Ubicación de otras sedes</strong></td>
                                <td><?php if($ficha->otras_sedes!=''){echo $ficha->otras_sedes;}else{echo '<span>No especificadas.</span>';} ?></td>
                            </tr>
                            <tr>
                                <td><strong>Núm. aproximado de trabajadores</strong></td>
                                <td><?php echo $ficha->num_trabajadores; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Núm. aproximado de equipos informáticos</strong></td>
                                <td><?php echo $ficha->num_equipos; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Representacion legal</strong></td>
                                <td><?php
                                    if($ficha->representacion_legal)
                                        echo "SÍ";
                                    else
                                        echo "NO";?></td>
                            </tr>
                            <tr>
                                <td><strong>Código IBAN</strong></td>
                                <td><?php if($ficha->iban!=''){echo $ficha->iban;}else{echo '<span class="red">-- FALTA CÓDIGO IBAN --</span>';} ?></td>
                            </tr>
                            <tr>
                                <td><strong>Fecha envío correo de bienvenida</strong></td>
                                <td><?php echo date_conv($ficha->fecha_bienvenida); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Fecha de auditoría</strong></td>
                                <td><?php echo date_conv($ficha->fecha_auditoria); ?></td>
                            </tr>

                            </tbody>
                        </table>
                        <?php echo Html::anchor('ficha/edit/'.$cliente->id, '<span class="glyphicon glyphicon-pencil"></span> Editar datos específicos',array('class'=>'btn btn-success')); ?> &nbsp;
                        <?php echo Html::anchor('clientes', '<span class="glyphicon glyphicon-backward"></span> Volver al listado de clientes',array('class'=>'btn btn-danger')); ?>
                    <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="panel panel-default" id="panel3">
        <div class="panel-heading">
            <h3 class="panel-title datos_cliente"><span class="muted">
                <a data-toggle="collapse" data-target="#collapseThree" href="#collapseThree" class="collapsed">
                    Auditoría
                </a></span>
            </h3>
        </div>
        <div id="collapseThree" class="panel-collapse collapse">
            <div class="panel-body">
                <p>Pendiente de rellenar</p>
               </div>
        </div>
    </div>
</div>
<br/>