<?php
use Orm\Model;

class Model_Personal extends Model
{
	protected static $_properties = array(
		'id',
		'idcliente',
		'tratamiento',
		'nombre',
		'dni',
        'tlfno',
        'email',
		'cargofuncion',
		'relacion',
		'access',
		'fecha_alta',
		'fecha_baja',
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
		$val->add_field('idcliente', 'Idcliente', 'required|valid_string[numeric]');
		$val->add_field('nombre', 'Nombre', 'required|max_length[255]');
		//$val->add_field('dni', 'Dni', 'required|max_length[255]');
		//$val->add_field('tlfno', 'Teléfono', 'required|max_length[255]');
		//$val->add_field('email', 'E-amil', 'required|max_length[255]');
		//$val->add_field('cargofuncion', 'Cargofuncion', 'required|max_length[255]');
		$val->add_field('relacion', 'Relacion', 'required|valid_string[numeric]');
		$val->add_field('access', 'Acceso a los ficheros', 'required|max_length[255]');

		return $val;
	}

}
