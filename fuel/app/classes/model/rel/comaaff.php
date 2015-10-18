<?php
use Orm\Model;

class Model_Rel_Comaaff extends Model
{
	protected static $_properties = array(
		'id',
		'idcom',
		'idaaff',
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
		$val->add_field('idcom', 'Idcom', 'required|valid_string[numeric]');
		$val->add_field('idaaff', 'Idaaff', 'required|valid_string[numeric]');

		return $val;
	}

}
