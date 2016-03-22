<?php

namespace Fuel\Migrations;

class Create_gruposedes
{
	public function up()
	{
		\DBUtil::create_table('gruposedes', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'idcliente' => array('constraint' => 11, 'type' => 'int'),
			'tipo' => array('constraint' => 255, 'type' => 'varchar'),
			'nombre' => array('constraint' => 255, 'type' => 'varchar'),
			'dir' => array('constraint' => 255, 'type' => 'varchar'),
			'cif' => array('constraint' => 255, 'type' => 'varchar'),
			'ficheros' => array('constraint' => 255, 'type' => 'varchar'),
			'contacto' => array('constraint' => 255, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('gruposedes');
	}
}