<?php

namespace Fuel\Migrations;

class Create_presupuestos
{
	public function up()
	{
		\DBUtil::create_table('presupuestos', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'num_p' => array('constraint' => 11, 'type' => 'int'),
			'idcliente' => array('constraint' => 11, 'type' => 'int'),
			'fecha' => array('type' => 'date'),
			'fecha_entrega' => array('type' => 'date'),
            'importe' => array('type' =>'decimal'),
			'idestado' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('presupuestos');
	}
}