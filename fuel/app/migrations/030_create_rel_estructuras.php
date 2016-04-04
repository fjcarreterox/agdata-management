<?php

namespace Fuel\Migrations;

class Create_rel_estructuras
{
	public function up()
	{
		\DBUtil::create_table('rel_estructuras', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'idfichero' => array('constraint' => 11, 'type' => 'int'),
			'idtipodato' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('rel_estructuras');
	}
}