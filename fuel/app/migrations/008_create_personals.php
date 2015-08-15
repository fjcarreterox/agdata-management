<?php

namespace Fuel\Migrations;

class Create_personals
{
	public function up()
	{
		\DBUtil::create_table('personals', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'idcliente' => array('constraint' => 11, 'type' => 'int'),
			'nombre' => array('constraint' => 255, 'type' => 'varchar'),
			'dni' => array('constraint' => 255, 'type' => 'varchar'),
			'cargofuncion' => array('constraint' => 255, 'type' => 'varchar'),
			'relacion' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('personals');
	}
}