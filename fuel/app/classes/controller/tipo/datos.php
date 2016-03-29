<?php
class Controller_Tipo_Datos extends Controller_Template{

	public function action_index()	{
		$data['tipo_datos'] = Model_Tipo_Dato::find('all',array('order_by'=>array('tipo','nombre')));
		$this->template->title = "Listado ccon todos los tipos de datos";
		$this->template->content = View::forge('tipo/datos/index', $data);
	}

	public function action_view($id = null){
		is_null($id) and Response::redirect('tipo/datos');

		if ( ! $data['tipo_dato'] = Model_Tipo_Dato::find($id)){
			Session::set_flash('error', 'Could not find tipo_dato #'.$id);
			Response::redirect('tipo/datos');
		}

		$this->template->title = "Tipo_dato";
		$this->template->content = View::forge('tipo/datos/view', $data);
	}

	public function action_create(){
		if (Input::method() == 'POST')
		{
			$val = Model_Tipo_Dato::validate('create');

			if ($val->run()){
				$tipo_dato = Model_Tipo_Dato::forge(array(
					'nombre' => Input::post('nombre'),
					'tipo' => Input::post('tipo'),
					'nivel' => Input::post('nivel'),
				));

				if ($tipo_dato and $tipo_dato->save()){
					Session::set_flash('success', 'Añadido nuevo tipo de dato en el sistema.');
					Response::redirect('tipo/datos');
				}
				else{
					Session::set_flash('error', 'No se ha podido crear el nuevo tipo de dato.');
				}
			}
			else{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Tipo_Datos";
		$this->template->content = View::forge('tipo/datos/create');
	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('tipo/datos');

		if ( ! $tipo_dato = Model_Tipo_Dato::find($id))
		{
			Session::set_flash('error', 'Could not find tipo_dato #'.$id);
			Response::redirect('tipo/datos');
		}

		$val = Model_Tipo_Dato::validate('edit');

		if ($val->run())
		{
			$tipo_dato->nombre = Input::post('nombre');
			$tipo_dato->tipo = Input::post('tipo');
			$tipo_dato->nivel = Input::post('nivel');

			if ($tipo_dato->save())
			{
				Session::set_flash('success', 'Updated tipo_dato #' . $id);

				Response::redirect('tipo/datos');
			}

			else
			{
				Session::set_flash('error', 'Could not update tipo_dato #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$tipo_dato->nombre = $val->validated('nombre');
				$tipo_dato->tipo = $val->validated('tipo');
				$tipo_dato->nivel = $val->validated('nivel');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('tipo_dato', $tipo_dato, false);
		}

		$this->template->title = "Tipo_datos";
		$this->template->content = View::forge('tipo/datos/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('tipo/datos');

		if ($tipo_dato = Model_Tipo_Dato::find($id))
		{
			$tipo_dato->delete();

			Session::set_flash('success', 'Deleted tipo_dato #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete tipo_dato #'.$id);
		}

		Response::redirect('tipo/datos');

	}

}
