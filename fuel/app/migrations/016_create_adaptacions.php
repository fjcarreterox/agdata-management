<?php

namespace Fuel\Migrations;

class Create_adaptacions
{
	public function up()
	{
		\DBUtil::create_table('adaptacions', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'idcliente' => array('constraint' => 11, 'type' => 'int'),
			'num_serv' => array('constraint' => 11, 'type' => 'int'),
			'num_pc' => array('constraint' => 11, 'type' => 'int'),
			'num_pc_online' => array('constraint' => 11, 'type' => 'int'),
			'num_laptop' => array('constraint' => 11, 'type' => 'int'),
			'num_laptop_online' => array('constraint' => 11, 'type' => 'int'),
			'pass_freq' => array('constraint' => 255, 'type' => 'varchar'),
			'backup_freq' => array('constraint' => 255, 'type' => 'varchar'),
			'management_sw' => array('constraint' => 255, 'type' => 'varchar'),
			'access_control' => array('constraint' => 255, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('adaptacions');
	}
}