<?php
use Orm\Model;

class Model_Cliente extends Model
{
	protected static $_properties = array(
		'id',
		'nombre',
		'tipo',
		'cif_nif',
		'direccion',
		'cpostal',
		'loc',
		'prov',
		'tel',
		'pweb',
		'actividad',
		'observ',
		'estado',
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
		$val->add_field('nombre', 'Nombre', 'required|max_length[255]');
		$val->add_field('tipo', 'Tipo', 'required|valid_string[numeric]');
		$val->add_field('cif_nif', 'Cif Nif', 'required|max_length[255]');
		$val->add_field('direccion', 'Direccion', 'required|max_length[255]');
		$val->add_field('cpostal', 'Cpostal', 'required|valid_string[numeric]');
		$val->add_field('loc', 'Loc', 'required|max_length[255]');
		$val->add_field('prov', 'Prov', 'required|max_length[255]');
		$val->add_field('tel', 'Tel', 'required|valid_string[numeric]');
		$val->add_field('pweb', 'Pweb', 'required|max_length[255]');
		$val->add_field('actividad', 'Actividad', 'required|max_length[255]');
		$val->add_field('observ', 'Observ', 'required|max_length[255]');
		$val->add_field('estado', 'Estado', 'required|valid_string[numeric]');

		return $val;
	}

}
