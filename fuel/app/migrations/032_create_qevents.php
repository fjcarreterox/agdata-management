<?php

namespace Fuel\Migrations;

class Create_qevents
{
	public function up()
	{
		\DBUtil::create_table('qevents', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'type' => array('constraint' => 255, 'type' => 'varchar'),
			'target_audience' => array('constraint' => 255, 'type' => 'varchar'),
			'date_time' => array('constraint' => 255, 'type' => 'varchar'),
			'location' => array('constraint' => 255, 'type' => 'varchar'),
			'broadcast' => array('constraint' => 255, 'type' => 'varchar'),
			'resources' => array('constraint' => 255, 'type' => 'varchar'),
			'complementary_services' => array('constraint' => 255, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('qevents');
	}
}