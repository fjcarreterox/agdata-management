<?php
use Orm\Model;

class Model_Fichero extends Model
{
	protected static $_properties = array(
		'id',
		'idtipo',
		'idcliente',
		'soporte',
		'nivel',
		'base',
		'origen',
		'recogida',
		'trans',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('idtipo', 'Tipo de fichero', 'required|valid_string[numeric]');
		$val->add_field('idcliente', 'Cliente', 'required|valid_string[numeric]');
		$val->add_field('soporte', 'Sistema de tratamiento', 'required|max_length[255]');
		$val->add_field('nivel', 'Nivel de seguridad', 'required|valid_string[numeric]');
		$val->add_field('base', 'Base de legitimación', 'required|max_length[255]');
		$val->add_field('origen', 'Origen de los datos', 'required|max_length[255]');
		$val->add_field('recogida', 'Procedimiento de recogida de datos', 'required|max_length[255]');
		$val->add_field('trans', 'Transferencias internacionales de datos', 'required|max_length[255]');
		return $val;
	}
}
