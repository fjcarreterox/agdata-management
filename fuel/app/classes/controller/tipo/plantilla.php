<?php
class Controller_Tipo_Plantilla extends Controller_Template
{
	public function action_index(){
		$data['tipo_plantillas'] = Model_Tipo_Plantilla::find('all');
		$this->template->title = "Listado de los tipos de plantillas";
		$this->template->content = View::forge('tipo/plantilla/index', $data);
	}

	public function action_view($id = null){
		is_null($id) and Response::redirect('tipo/plantilla');

		if ( ! $data['tipo_plantilla'] = Model_Tipo_Plantilla::find($id)){
			Session::set_flash('error', 'No se ha podido encontrar la plantilla deseada.');
			Response::redirect('tipo/plantilla');
		}

		$this->template->title = "Ver datos del tipo de plantilla";
		$this->template->content = View::forge('tipo/plantilla/view', $data);
	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Tipo_Plantilla::validate('create');

			if ($val->run())
			{
				$tipo_plantilla = Model_Tipo_Plantilla::forge(array(
					'nombre' => Input::post('nombre'),
					'cuerpo' => Input::post('cuerpo'),
				));

				if ($tipo_plantilla and $tipo_plantilla->save())
				{
					Session::set_flash('success', 'Nuevo tipo de plantilla añadido al sistema.');
					Response::redirect('tipo/plantilla');
				}
				else{
					Session::set_flash('error', 'No se ha podido almacenar el nuevo tipo de plantilla.');
				}
			}
			else{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Crear nuevo tipo de plantilla";
		$this->template->content = View::forge('tipo/plantilla/create');
	}

	public function action_edit($id = null){
		is_null($id) and Response::redirect('tipo/plantilla');

		if ( ! $tipo_plantilla = Model_Tipo_Plantilla::find($id)){
			Session::set_flash('error', 'No se ha podido localizar el tipo de plantilla buscado');
			Response::redirect('tipo/plantilla');
		}

		$val = Model_Tipo_Plantilla::validate('edit');

		if ($val->run()){
			$tipo_plantilla->nombre = Input::post('nombre');
			$tipo_plantilla->cuerpo = Input::post('cuerpo');

			if ($tipo_plantilla->save()){
				Session::set_flash('success', 'Tipo de plantilla actualizado.');
				Response::redirect('tipo/plantilla');
			}
			else{
				Session::set_flash('error', 'No se han podido almacenar los cambios en el tipo de plantilla.');
			}
		}
		else{
			if (Input::method() == 'POST')
			{
				$tipo_plantilla->nombre = $val->validated('nombre');
				$tipo_plantilla->cuerpo = $val->validated('cuerpo');
				Session::set_flash('error', $val->error());
			}
			$this->template->set_global('tipo_plantilla', $tipo_plantilla, false);
		}

		$this->template->title = "Modificando tipo de plantilla";
		$this->template->content = View::forge('tipo/plantilla/edit');
	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('tipo/plantilla');

		if ($tipo_plantilla = Model_Tipo_Plantilla::find($id)){
			$tipo_plantilla->delete();

			Session::set_flash('success', 'Tipo de plantilla borrado del sistema.');
		}
		else{
			Session::set_flash('error', 'No se ha podido eliminar el tipo de plantilla seleccionado.');
		}

		Response::redirect('tipo/plantilla');
	}
}