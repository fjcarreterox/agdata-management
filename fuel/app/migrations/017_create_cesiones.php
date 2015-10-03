<?php

namespace Fuel\Migrations;

class Create_cesiones
{
	public function up()
	{
		\DBUtil::create_table('cesiones', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'idcliente' => array('constraint' => 11, 'type' => 'int'),
			'idtipo_empresa' => array('constraint' => 11, 'type' => 'int'),
			'nombre' => array('constraint' => 255, 'type' => 'varchar'),
			'cifnif' => array('constraint' => 255, 'type' => 'varchar'),
			'servicio' => array('constraint' => 255, 'type' => 'varchar'),
			'rep_legal_name' => array('constraint' => 255, 'type' => 'varchar'),
			'rep_legal_dni' => array('constraint' => 255, 'type' => 'varchar'),
			'rep_legal_cargo' => array('constraint' => 255, 'type' => 'varchar'),
			'tel' => array('constraint' => 11, 'type' => 'int'),
			'domicilio' => array('constraint' => 255, 'type' => 'varchar'),
			'localidad' => array('constraint' => 255, 'type' => 'varchar'),
			'cp' => array('constraint' => 11, 'type' => 'int'),
			'fecha_contrato' => array('type' => 'date'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('cesiones');
	}
}