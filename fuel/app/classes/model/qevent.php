<?php
use Orm\Model;

class Model_Qevent extends Model
{
	protected static $_properties = array(
		'id',
        'idcustomer',
		'type',
		'target_audience',
		'date_time',
		'location',
		'broadcast',
		'resources',
		'complementary_services',
		'observ',
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

	public static function validate($factory){
		$val = Validation::forge($factory);
		$val->add_field('type', 'Type', 'required|max_length[255]');
		$val->add_field('target_audience', 'Target Audience', 'required|max_length[255]');
		$val->add_field('date_time', 'Date Time', 'required|max_length[255]');
		$val->add_field('location', 'Location', 'required|max_length[255]');
		$val->add_field('broadcast', 'Broadcast', 'required|max_length[255]');
		$val->add_field('resources', 'Resources', 'required|max_length[255]');
		$val->add_field('complementary_services', 'Complementary Services', 'required|max_length[255]');
		$val->add_field('observ', 'Observaciones / Comentarios', 'max_length[500]');

		return $val;
	}
}
