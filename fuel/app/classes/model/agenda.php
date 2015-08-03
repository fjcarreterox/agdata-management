<?php
use Orm\Model;

class Model_Agenda extends Model
{
	protected static $_properties = array(
		'id',
		'idcliente',
		'last_call',
		'next_call',
		'last_visit',
		'next_visit',
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
		$val->add_field('idcliente', 'Idcliente', 'required|valid_string[numeric]');
		$val->add_field('last_call', 'Last Call', 'required');
		$val->add_field('next_call', 'Next Call', 'required');
		$val->add_field('last_visit', 'Last Visit', 'required');
		$val->add_field('next_visit', 'Next Visit', 'required');
		$val->add_field('send_info', 'Send Info', 'required');
		$val->add_field('observaciones', 'Observaciones', 'required|max_length[255]');

		return $val;
	}

}
