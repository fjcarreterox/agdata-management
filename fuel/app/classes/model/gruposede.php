<?php
use Orm\Model;

class Model_Gruposede extends Model
{
	protected static $_properties = array(
		'id',
		'idcliente',
		'tipo',
		'nombre',
		'dir',
		'cif',
		'ficheros',
		'contacto',
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
		$val->add_field('tipo', 'Tipo', 'required|max_length[255]');
		$val->add_field('nombre', 'Nombre', 'required|max_length[255]');
		//$val->add_field('dir', 'Dir', 'required|max_length[255]');
		//$val->add_field('cif', 'Cif', 'required|max_length[255]');
		//$val->add_field('ficheros', 'Ficheros', 'required|max_length[255]');
		//$val->add_field('contacto', 'Contacto', 'required|max_length[255]');

		return $val;
	}

}
