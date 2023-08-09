<?php
use Orm\Model;

class Model_Rel_Comcont extends Model
{
	protected static $_properties = array(
		'id',
		'idcom',
		'idcontrata',
		'servicio',
		'fechaenvio',
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
		$val->add_field('idcontrata', 'Idcontrata', 'required|valid_string[numeric]');
		$val->add_field('servicio', 'Servicio', 'required|max_length[255]');
		//$val->add_field('fechaenvio', 'Fechaenvio', 'required');

		return $val;
	}

}
