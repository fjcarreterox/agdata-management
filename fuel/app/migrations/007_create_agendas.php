<?php

namespace Fuel\Migrations;

class Create_agendas
{
	public function up()
	{
		\DBUtil::create_table('agendas', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'idcliente' => array('constraint' => 11, 'type' => 'int'),
			'last_call' => array('type' => 'date'),
			'next_call' => array('type' => 'date'),
			'last_visit' => array('type' => 'date'),
			'next_visit' => array('type' => 'date'),
			'send_info' => array('type' => 'boolean'),
			'observaciones' => array('constraint' => 255, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('agendas');
	}
}