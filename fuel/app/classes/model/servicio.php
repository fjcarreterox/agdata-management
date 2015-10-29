<?php
use Orm\Model;

class Model_Servicio extends Model
{
	protected static $_properties = array(
		'id',
		'nombre',
		'precio_base',
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
		$val->add_field('nombre', 'Nombre del servicio', 'required|max_length[255]');
		$val->add_field('precio_base', 'Precio base del servicio', 'required|valid_string[decimal]');

		return $val;
	}

}
