<h2>Ficha completa del cliente: <span class='muted'><?php echo $cliente->nombre; ?></span> </h2>
<br/>
<h3 class="datos_cliente">1. Datos básicos</h3>
<p>En la siguiente tabla mostramos los datos comúnes a todo tipo de clientes: <strong>estado, DNI/NIF, tipo de cliente,
dirección completa, teléfono, página web, actividad a la que se dedica y las observaciones</strong> que estimemos oportunas.</p>
<table class="table table-striped table-bordered table-hover">
    <thead></thead>
    <tbody>
        <tr class="text-center">
            <td><?php echo Model_Estados_Cliente::find($cliente->estado)->get('nombre'); ?></td>
            <td><?php echo $cliente->cif_nif; ?></td>
            <td><?php echo Model_Tipo_Cliente::find($cliente->tipo)->get('tipo'); ?></td>
        </tr>
        <tr>
            <td colspan="3"><?php echo $cliente->direccion; ?>, <?php echo $cliente->cpostal; ?>, <?php echo $cliente->loc; ?>. <?php echo $cliente->prov; ?></td>
        </tr>
        <tr class="text-center">
            <td><?php echo $cliente->tel; ?></td>
            <td><?php echo $cliente->pweb; ?></td>
            <td><?php echo $cliente->actividad; ?></td>
        </tr>
        <tr>
            <td colspan="3"><?php echo $cliente->observ; ?></td>
        </tr>
    </tbody>
</table>
<p>Hasta que el cliente no alcance el estado de <strong>activo</strong> en el sistema no será necesario recoger más información que la aquí mostrada.</p>
<?php echo Html::anchor('clientes/edit/'.$cliente->id, 'Editar datos básicos',array('class'=>'btn btn-success')); ?> &nbsp;&nbsp;
<?php echo Html::anchor('clientes', 'Volver al listado de clientes',array('class'=>'btn btn-danger')); ?>
<br/>
<br/>
<?php if(($cliente->estado == 4)):?>
    <h3 class="datos_cliente">2. Datos específicos</h3>
    <?php if(empty($ficha)):?>
        <p>Se ha detectado que este cliente se ha pasado al estado <strong>ACTIVO</strong> pero aún no tiene creada su ficha completa de cliente con los
datos específicos requeridos para gestionar adecuadamente los servicios contratados.</p>
        <p>Cree dicha ficha pulsando en el siguiente botón: </p>
        <?php echo Html::anchor('ficha/create/'.$cliente->id, 'Crear ficha completa de cliente',array('class'=>'btn btn-success')); ?>
    <?php else: ?>

        <p>Los clientes <strong>activos</strong> deben tener cumplimentados ciertos campos adicionales que nos ayuden a gestionar los servicios
        contratados.</p>
        <p>Son los siguientes:</p>
        <table class="table table-striped table-bordered table-hover table-responsive">
            <tbody>
                <tr>
                    <td><strong>Móvil de contacto</strong></td>
                    <td><?php echo $ficha->movil_contacto; ?></td>
                </tr>
                <tr>
                    <td><strong>E-mail de contacto</strong></td>
                    <td><?php echo $ficha->email_contacto; ?></td>
                </tr>
                <tr>
                    <td><strong>Código CNAE</strong></td>
                    <td><?php echo $ficha->cnae; ?></td>
                </tr>
                <tr>
                    <td><strong>Convenio colectivo</strong></td>
                    <td><?php echo $ficha->convenio; ?></td>
                </tr>
                <tr>
                    <td><strong>Ubicación de otras sedes</strong></td>
                    <td><?php echo $ficha->otras_sedes; ?></td>
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
                    <td><?php echo $ficha->representacion_legal; ?></td>
                </tr>
                <tr>
                    <td><strong>Código IBAN</strong></td>
                    <td><?php echo $ficha->iban; ?></td>
                </tr>
                <tr>
                    <td><strong>Fecha envío correo de bienvenida</strong></td>
                    <td><?php echo date_conv($ficha->fecha_bienvenida); ?></td>
                </tr>
                <tr>
                    <td><strong>Fecha de auditoría</strong></td>
                    <td><?php echo date_conv($ficha->fecha_auditoria); ?></td>
                </tr>
                <tr>
                    <td><strong>Fecha de firma del contrato</strong></td>
                    <td><?php echo date_conv($ficha->fecha_firma); ?></td>
                </tr>

            </tbody>
        </table>
        <?php echo Html::anchor('ficha/edit/'.$cliente->id, 'Editar datos específicos',array('class'=>'btn btn-success')); ?> &nbsp;&nbsp;
        <?php echo Html::anchor('clientes', 'Volver al listado de clientes',array('class'=>'btn btn-danger')); ?>
    <?php endif; ?>
<?php endif;?>
<br/>
<br/>
<h3 class="datos_cliente">3. Personas de contacto</h3>
<?php if(empty($contactos)): ?>
    <p>No se ha encontrado aún personal de este cliente registrado en nuestro sistema.</p>
<?php else: ?>
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
<?php echo Html::anchor('personal/create_in_costumer/'.$cliente->id, 'Añadir personal',array('class'=>'btn btn-success')); ?>