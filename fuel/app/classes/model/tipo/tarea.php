<?php
use Orm\Model;

class Model_Tipo_Tarea extends Model{
	protected static $_properties = array(
		'id',
		'nombre',
		'descripcion',
		'tipo',
		'idplantilla',
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
		$val->add_field('nombre', 'Nombre', 'required|max_length[255]');
		$val->add_field('descripcion', 'Descripcion', 'required|max_length[255]');
		$val->add_field('tipo', 'Tipo', 'required|valid_string[numeric]');
		return $val;
	}
}
