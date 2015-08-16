<?php

namespace Fuel\Migrations;

class Create_fichas
{
	public function up()
	{
		\DBUtil::create_table('fichas', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'idcliente' => array('constraint' => 11, 'type' => 'int'),
			'movil_contacto' => array('constraint' => 11, 'type' => 'int'),
			'email_contacto' => array('constraint' => 255, 'type' => 'varchar'),
			'CNAE' => array('constraint' => 11, 'type' => 'int'),
			'convenio' => array('constraint' => 255, 'type' => 'varchar'),
			'otras_sedes' => array('constraint' => 255, 'type' => 'varchar'),
			'num_trabajadores' => array('constraint' => 11, 'type' => 'int'),
			'num_equipos' => array('constraint' => 11, 'type' => 'int'),
			'representacion_legal' => array('constraint' => 11, 'type' => 'int'),
			'fecha_bienvenida' => array('type' => 'date'),
			'fecha_auditoria' => array('type' => 'date'),
			'iban' => array('constraint' => 255, 'type' => 'varchar'),
			'fecha_firma' => array('type' => 'date'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('fichas');
	}
}