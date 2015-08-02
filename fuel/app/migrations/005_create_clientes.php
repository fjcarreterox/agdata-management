<?php

namespace Fuel\Migrations;

class Create_clientes
{
	public function up()
	{
		\DBUtil::create_table('clientes', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'nombre' => array('constraint' => 255, 'type' => 'varchar'),
			'tipo' => array('constraint' => 11, 'type' => 'int'),
			'cif_nif' => array('constraint' => 255, 'type' => 'varchar'),
			'direccion' => array('constraint' => 255, 'type' => 'varchar'),
			'cpostal' => array('constraint' => 11, 'type' => 'int'),
			'loc' => array('constraint' => 255, 'type' => 'varchar'),
			'prov' => array('constraint' => 255, 'type' => 'varchar'),
			'tel' => array('constraint' => 11, 'type' => 'int'),
			'pweb' => array('constraint' => 255, 'type' => 'varchar'),
			'actividad' => array('constraint' => 255, 'type' => 'varchar'),
			'observ' => array('constraint' => 255, 'type' => 'varchar'),
			'estado' => array('constraint' => 255, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('clientes');
	}
}