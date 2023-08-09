<?php

namespace Fuel\Migrations;

class Create_rel_comconts
{
	public function up()
	{
		\DBUtil::create_table('rel_comconts', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'idcom' => array('constraint' => 11, 'type' => 'int'),
			'idcontrata' => array('constraint' => 11, 'type' => 'int'),
			'servicio' => array('constraint' => 255, 'type' => 'varchar'),
			'fechaenvio' => array('type' => 'date'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('rel_comconts');
	}
}