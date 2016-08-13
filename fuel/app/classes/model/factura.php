<?php
use Orm\Model;

class Model_Factura extends Model
{
	protected static $_properties = array(
		'id',
		'num_fact',
		'num_cuota',
		'idsc',
		'mes_cobro',
		'anyo_cobro',
		'estado',
		'fecha_emision',
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
		/*$val->add_field('num_fact', 'Num Fact', 'required|max_length[255]');*/
		$val->add_field('idsc', 'Idsc', 'required|valid_string[numeric]');
		$val->add_field('mes_cobro', 'Mes Cobro', 'required|valid_string[numeric]');
		$val->add_field('anyo_cobro', 'Anyo Cobro', 'required|valid_string[numeric]');
		$val->add_field('estado', 'Estado', 'required|max_length[255]');

		return $val;
	}

}
