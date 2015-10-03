<?php

namespace Fuel\Migrations;

class Create_tipo_cesionaria
{
	public function up()
	{
		\DBUtil::create_table('tipo_cesionaria', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'nombre' => array('constraint' => 255, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('tipo_cesionaria');
	}
}