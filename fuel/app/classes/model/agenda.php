<?php
use Orm\Model;

class Model_Agenda extends Model
{
	protected static $_properties = array(
		'id',
		'idcliente',
		'tipo',
		'fecha',
        'hora',
		'send_info',
		'observaciones',
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
		//$val->add_field('send_info', 'Información enviada', 'required');
		//$val->add_field('observaciones', 'observaciones', 'required|max_length[255]');
		return $val;
	}
}
