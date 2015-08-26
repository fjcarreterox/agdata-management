<?php

namespace Fuel\Migrations;

class Create_contratos
{
	public function up()
	{
		\DBUtil::create_table('contratos', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'idcliente' => array('constraint' => 11, 'type' => 'int'),
			'idpres' => array('constraint' => 11, 'type' => 'int'),
			'idpersonal' => array('constraint' => 11, 'type' => 'int'),
			'fecha_firma' => array('type' => 'date'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('contratos');
	}
}