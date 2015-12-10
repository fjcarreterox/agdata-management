<?php
use Orm\Model;

class Model_Cesione extends Model
{
	protected static $_properties = array(
		'id',
		'idcliente',
		'idfichero',
		'idtipo_empresa',
		'nombre',
		'cifnif',
		'servicio',
		'rep_legal_name',
		'rep_legal_dni',
		'rep_legal_cargo',
		'tel',
		'domicilio',
		'localidad',
		'cp',
		'fecha_contrato',
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
		$val->add_field('idfichero', 'Fichero de datos', 'required|valid_string[numeric]');
		$val->add_field('idtipo_empresa', 'Tipo de empresa cesionaria', 'required|valid_string[numeric]');
		$val->add_field('nombre', 'Nombre cesionario', 'required|max_length[255]');
		$val->add_field('cifnif', 'CIF/NIF', 'required|max_length[255]');
		$val->add_field('servicio', 'Servicio', 'required|max_length[255]');
		$val->add_field('rep_legal_name', 'Nombre del Representante Legal', 'required|max_length[255]');
		$val->add_field('rep_legal_dni', 'DNI del Representante Legal', 'required|max_length[255]');
		$val->add_field('rep_legal_cargo', 'Cargo del Representante Legal', 'required|max_length[255]');
		//$val->add_field('tel', 'Teléfono', 'required|valid_string[numeric]');
		$val->add_field('domicilio', 'Domicilio', 'required|max_length[255]');
		$val->add_field('localidad', 'Localidad', 'required|max_length[255]');
		$val->add_field('cp', 'Código Postal', 'required|valid_string[numeric]');
		//$val->add_field('fecha_contrato', 'Fecha de firma del Contrato', 'required');

		return $val;
	}

}
