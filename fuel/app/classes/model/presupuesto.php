<?php
use Orm\Model;

class Model_Presupuesto extends Model
{
	protected static $_properties = array(
		'id',
		'num_p',
		'idcliente',
		'fecha',
		'fecha_entrega',
        'importe',
		'idestado',
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
		$val->add_field('num_p', 'Num P', 'required|valid_string[numeric]');
		$val->add_field('idcliente', 'Idcliente', 'required|valid_string[numeric]');
		$val->add_field('fecha', 'Fecha', 'required');
		//$val->add_field('fecha_entrega', 'Fecha Entrega', 'required');
		$val->add_field('importe', 'Importe', 'required');
		$val->add_field('idestado', 'Idestado', 'required|valid_string[numeric]');

		return $val;
	}

}
