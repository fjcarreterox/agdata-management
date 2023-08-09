<?php

namespace Fuel\Migrations;

class Create_infocaes
{
	public function up()
	{
		\DBUtil::create_table('infocaes', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'idcliente' => array('constraint' => 11, 'type' => 'int'),
			'portal' => array('constraint' => 11, 'type' => 'int'),
			'azotea' => array('constraint' => 11, 'type' => 'int'),
			'escaleras' => array('constraint' => 11, 'type' => 'int'),
			'sotano' => array('constraint' => 11, 'type' => 'int'),
			'contadoresluz' => array('constraint' => 11, 'type' => 'int'),
			'bajatension' => array('constraint' => 11, 'type' => 'int'),
			'equipospresion' => array('constraint' => 11, 'type' => 'int'),
			'contadoresagua' => array('constraint' => 11, 'type' => 'int'),
			'incendios' => array('constraint' => 11, 'type' => 'int'),
			'garaje' => array('constraint' => 11, 'type' => 'int'),
			'ascensores' => array('constraint' => 11, 'type' => 'int'),
			'calderas' => array('constraint' => 11, 'type' => 'int'),
			'pistas' => array('constraint' => 11, 'type' => 'int'),
			'piscina' => array('constraint' => 11, 'type' => 'int'),
			'aseopiscina' => array('constraint' => 11, 'type' => 'int'),
			'jardines' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('infocaes');
	}
}