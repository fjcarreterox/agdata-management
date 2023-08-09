<?php
use Orm\Model;

class Model_Infocae extends Model
{
	protected static $_properties = array(
		'id',
		'idcliente',
		'portal',
		'azotea',
		'escaleras',
		'sotano',
		'contadoresluz',
		'bajatension',
		'equipospresion',
		'contadoresagua',
		'incendios',
		'garaje',
		'ascensores',
		'calderas',
		'pistas',
		'piscina',
		'aseopiscina',
		'jardines',
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
		$val->add_field('portal', 'Portal', 'required|valid_string[numeric]');
		$val->add_field('azotea', 'Azotea', 'required|valid_string[numeric]');
		$val->add_field('escaleras', 'Escaleras', 'required|valid_string[numeric]');
		$val->add_field('sotano', 'Sotano', 'required|valid_string[numeric]');
		$val->add_field('contadoresluz', 'Contadoresluz', 'required|valid_string[numeric]');
		$val->add_field('bajatension', 'Bajatension', 'required|valid_string[numeric]');
		$val->add_field('equipospresion', 'Equipospresion', 'required|valid_string[numeric]');
		$val->add_field('contadoresagua', 'Contadoresagua', 'required|valid_string[numeric]');
		$val->add_field('incendios', 'Incendios', 'required|valid_string[numeric]');
		$val->add_field('garaje', 'Garaje', 'required|valid_string[numeric]');
		$val->add_field('ascensores', 'Ascensores', 'required|valid_string[numeric]');
		$val->add_field('calderas', 'Calderas', 'required|valid_string[numeric]');
		$val->add_field('pistas', 'Pistas', 'required|valid_string[numeric]');
		$val->add_field('piscina', 'Piscina', 'required|valid_string[numeric]');
		$val->add_field('aseopiscina', 'Aseopiscina', 'required|valid_string[numeric]');
		$val->add_field('jardines', 'Jardines', 'required|valid_string[numeric]');

		return $val;
	}

}
