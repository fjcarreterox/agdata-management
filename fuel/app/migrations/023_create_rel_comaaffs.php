<?php

namespace Fuel\Migrations;

class Create_rel_comaaffs
{
	public function up()
	{
		\DBUtil::create_table('rel_comaaffs', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'idcom' => array('constraint' => 11, 'type' => 'int'),
			'idaaff' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('rel_comaaffs');
	}
}