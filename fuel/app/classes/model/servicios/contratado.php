<?php
use Orm\Model;

class Model_Servicios_Contratado extends Model
{
	protected static $_properties = array(
		'id',
		'idcliente',
		'idtipo_servicio',
		'importe',
		'year',
		'mes_factura',
		'periodicidad',
		'cuota',
		'forma_pago',
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
		$val->add_field('idtipo_servicio', 'Idtipo Servicio', 'required|valid_string[numeric]');
		$val->add_field('importe', 'Importe', 'required|valid_string[numeric]');
		$val->add_field('year', 'Year', 'required|valid_string[numeric]');
		$val->add_field('mes_factura', 'Mes Factura', 'required|max_length[255]');
		$val->add_field('periodicidad', 'Periodicidad', 'required|max_length[255]');
		$val->add_field('cuota', 'Cuota', 'required|valid_string[numeric]');
		$val->add_field('forma_pago', 'Forma Pago', 'required|max_length[255]');

		return $val;
	}

}
