<?php
use Orm\Model;

class Model_Fichero extends Model
{
	protected static $_properties = array(
		'id',
		'idtipo',
		'idcliente',
		'ubicacion',
		'soporte',
		'inscrito',
		'fecha',
		'cesion',
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
		$val->add_field('ubicacion', 'Ubicación', 'required|max_length[255]');
		$val->add_field('soporte', 'Soporte del fichero', 'required|max_length[255]');
		$val->add_field('inscrito', 'Inscrito en AEPD', 'required|valid_string[numeric]');
		//$val->add_field('fecha', 'Fecha de inscripción', 'required');
		$val->add_field('cesion', 'Cesión a terceros', 'required|valid_string[numeric]');
		return $val;
	}
}
