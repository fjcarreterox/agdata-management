<?php

namespace Fuel\Migrations;

class Create_tipo_ficheros
{
	public function up()
	{
		\DBUtil::create_table('tipo_ficheros', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'tipo' => array('constraint' => 255, 'type' => 'varchar'),
			'finalidad' => array('constraint' => 255, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('tipo_ficheros');
	}
}