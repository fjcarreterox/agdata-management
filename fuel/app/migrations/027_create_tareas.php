<?php

namespace Fuel\Migrations;

class Create_tareas
{
	public function up()
	{
		\DBUtil::create_table('tareas', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'idcliente' => array('constraint' => 11, 'type' => 'int'),
			'idtipotarea' => array('constraint' => 11, 'type' => 'int'),
			'fecha' => array('type' => 'date'),
			'fecha_respuesta' => array('type' => 'date'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('tareas');
	}
}