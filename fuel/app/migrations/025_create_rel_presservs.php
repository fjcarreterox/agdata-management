<?php

namespace Fuel\Migrations;

class Create_rel_presservs
{
	public function up()
	{
		\DBUtil::create_table('rel_presservs', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'idpres' => array('constraint' => 11, 'type' => 'int'),
			'idserv' => array('constraint' => 11, 'type' => 'int'),
			'precio' => array('type' => 'float'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('rel_presservs');
	}
}