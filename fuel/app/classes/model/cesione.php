<?php
use Orm\Model;

class Model_Cesione extends Model
{
	protected static $_properties = array(
		'id',
		'idcliente',
		'idfichero',
		'idcesionaria',
		'idrep',
		'fecha_contrato',
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
		$val->add_field('idcliente', 'Cliente', 'required|valid_string[numeric]');
		$val->add_field('idfichero', 'Fichero de datos', 'required|valid_string[numeric]');
		$val->add_field('idcesionaria', 'Empresa cesionaria', 'required|valid_string[numeric]');
		$val->add_field('idrep', 'Representante Legal', 'required|valid_string[numeric]');
		//$val->add_field('fecha_contrato', 'Fecha de firma del Contrato', 'required');

		return $val;
	}
}