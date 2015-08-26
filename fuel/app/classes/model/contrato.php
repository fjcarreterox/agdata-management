<?php
use Orm\Model;

class Model_Contrato extends Model
{
	protected static $_properties = array(
		'id',
		'idcliente',
		'idpres',
		'idpersonal',
		'fecha_firma',
        'periodicidad',
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
		$val->add_field('idpres', 'Idpres', 'required|valid_string[numeric]');
		$val->add_field('idpersonal', 'Idpersonal', 'required|valid_string[numeric]');
		$val->add_field('fecha_firma', 'Fecha Firma', 'required');
		$val->add_field('periodicidad', 'Periodo facturación', 'required');

		return $val;
	}

}
