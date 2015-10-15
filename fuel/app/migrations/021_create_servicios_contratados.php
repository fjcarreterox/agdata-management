<?php

namespace Fuel\Migrations;

class Create_servicios_contratados
{
	public function up()
	{
		\DBUtil::create_table('servicios_contratados', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'idcliente' => array('constraint' => 11, 'type' => 'int'),
			'idtipo_servicio' => array('constraint' => 11, 'type' => 'int'),
			'importe' => array('constraint' => 11, 'type' => 'int'),
			'year' => array('constraint' => 11, 'type' => 'int'),
			'mes_factura' => array('constraint' => 255, 'type' => 'varchar'),
			'periodicidad' => array('constraint' => 255, 'type' => 'varchar'),
			'cuota' => array('constraint' => 11, 'type' => 'int'),
			'forma_pago' => array('constraint' => 255, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('servicios_contratados');
	}
}