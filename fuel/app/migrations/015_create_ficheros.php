<?php

namespace Fuel\Migrations;

class Create_ficheros
{
	public function up()
	{
		\DBUtil::create_table('ficheros', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'idtipo' => array('constraint' => 11, 'type' => 'int'),
			'ubicacion' => array('constraint' => 255, 'type' => 'varchar'),
			'soporte' => array('constraint' => 255, 'type' => 'varchar'),
			'inscrito' => array('constraint' => 11, 'type' => 'int'),
			'fecha' => array('type' => 'date'),
			'cesion' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('ficheros');
	}
}