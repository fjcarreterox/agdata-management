<?php
use Orm\Model;

class Model_Adaptacion extends Model
{
	protected static $_properties = array(
		'id',
		'idcliente',
		'num_serv',
		'num_pc',
		'num_pc_online',
		'num_laptop',
		'num_laptop_online',
		'pass_freq',
		'backup_freq',
		'management_sw',
		'access_control',
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
		$val->add_field('num_serv', 'Núm. servidores de datos', 'required|valid_string[numeric]');
		$val->add_field('num_pc', 'Núm. PCs', 'required|valid_string[numeric]');
		$val->add_field('num_pc_online', 'Núm. PCs conectados', 'required|valid_string[numeric]');
		$val->add_field('num_laptop', 'Núm. portátiles', 'required|valid_string[numeric]');
		$val->add_field('num_laptop_online', 'Núm. portátiles conectados', 'required|valid_string[numeric]');
		$val->add_field('pass_freq', 'Frecuencia de cambio de contraseña', 'required|max_length[255]');
		$val->add_field('backup_freq', 'Frecuencia de copias de seguridad', 'required|max_length[255]');
		//$val->add_field('management_sw', 'Management Sw', 'required|max_length[255]');
		//$val->add_field('access_control', 'Access Control', 'required|max_length[255]');

		return $val;
	}

}
