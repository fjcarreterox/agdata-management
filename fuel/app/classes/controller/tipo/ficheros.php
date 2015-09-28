<?php
class Controller_Tipo_Ficheros extends Controller_Template
{

	public function action_index(){
		$data['tipo_ficheros'] = Model_Tipo_Fichero::find('all');
		$this->template->title = "Tipo de ficheros";
		$this->template->content = View::forge('tipo/ficheros/index', $data);

	}

	public function action_view($id = null){
		is_null($id) and Response::redirect('tipo/ficheros');

		if ( ! $data['tipo_fichero'] = Model_Tipo_Fichero::find($id))
		{
			Session::set_flash('error', 'No se ha podido encontrar el tipo de fichero solicitado.');
			Response::redirect('tipo/ficheros');
		}

		$this->template->title = "Tipo de fichero";
		$this->template->content = View::forge('tipo/ficheros/view', $data);

	}

	public function action_create(){
		if (Input::method() == 'POST')
		{
			$val = Model_Tipo_Fichero::validate('create');

			if ($val->run())
			{
				$tipo_fichero = Model_Tipo_Fichero::forge(array(
					'tipo' => Input::post('tipo'),
					'finalidad' => Input::post('finalidad'),
				));

				if ($tipo_fichero and $tipo_fichero->save()){
					Session::set_flash('success', 'Añadido un nuevo tipo de fichero.');
					Response::redirect('tipo/ficheros');
				}
				else{
					Session::set_flash('error', 'No se ha podido almacenar el nuevo tipo de fichero.');
				}
			}
			else{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Crear nuevo Tipo de fichero";
		$this->template->content = View::forge('tipo/ficheros/create');
	}

	public function action_edit($id = null){
		is_null($id) and Response::redirect('tipo/ficheros');

		if ( ! $tipo_fichero = Model_Tipo_Fichero::find($id))
		{
			Session::set_flash('error', 'Could not find tipo_fichero #'.$id);
			Response::redirect('tipo/ficheros');
		}

		$val = Model_Tipo_Fichero::validate('edit');

		if ($val->run())
		{
			$tipo_fichero->tipo = Input::post('tipo');
			$tipo_fichero->finalidad = Input::post('finalidad');

			if ($tipo_fichero->save()){
				Session::set_flash('success', 'Tipo de fichero actualizado.');
				Response::redirect('tipo/ficheros');
			}
			else{
				Session::set_flash('error', 'No se ha podido actualizar el tipo de fichero solicitado.');
			}
		}
		else{
			if (Input::method() == 'POST')
			{
				$tipo_fichero->tipo = $val->validated('tipo');
				$tipo_fichero->finalidad = $val->validated('finalidad');
				Session::set_flash('error', $val->error());
			}
			$this->template->set_global('tipo_fichero', $tipo_fichero, false);
		}

		$this->template->title = "Tipo de ficheros";
		$this->template->content = View::forge('tipo/ficheros/edit');
	}

	public function action_delete($id = null){
		is_null($id) and Response::redirect('tipo/ficheros');

		if ($tipo_fichero = Model_Tipo_Fichero::find($id)){
			$tipo_fichero->delete();

			Session::set_flash('success', 'Borrado del sistema.');
		}else{
			Session::set_flash('error', 'No se ha podido eliminar el tipo de fichero solicitado.');
		}
		Response::redirect('tipo/ficheros');
	}
}
