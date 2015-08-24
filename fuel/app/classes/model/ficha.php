<?php
use Orm\Model;

class Model_Ficha extends Model
{
	protected static $_properties = array(
		'id',
		'idcliente',
		'movil_contacto',
		'email_contacto',
		'cnae',
		'convenio',
		'otras_sedes',
		'num_trabajadores',
		'num_equipos',
		'representacion_legal',
		'fecha_bienvenida',
		'fecha_auditoria',
		'iban',
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
		//$val->add_field('movil_contacto', 'Movil Contacto', 'required|valid_string[numeric]');
		//$val->add_field('email_contacto', 'Email Contacto', 'required|max_length[255]');
		//$val->add_field('cnae', 'Cnae', 'required|valid_string[numeric]');
		//$val->add_field('convenio', 'Convenio', 'required|max_length[255]');
		//$val->add_field('otras_sedes', 'Otras Sedes', 'required|max_length[255]');
		//$val->add_field('num_trabajadores', 'Num Trabajadores', 'required|valid_string[numeric]');
		//$val->add_field('num_equipos', 'Num Equipos', 'required|valid_string[numeric]');
		//$val->add_field('representacion_legal', 'Representacion Legal', 'required|valid_string[numeric]');
		//$val->add_field('fecha_bienvenida', 'Fecha Bienvenida', 'required');
		//$val->add_field('fecha_auditoria', 'Fecha Auditoria', 'required');
		//$val->add_field('iban', 'Iban', 'required|max_length[255]');
		//$val->add_field('fecha_firma', 'Fecha Firma', 'required');

		return $val;
	}

}
