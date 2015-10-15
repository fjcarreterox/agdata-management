<?php
class Controller_Tipo_Situacion extends Controller_Template
{

	public function action_index(){
		$data['tipo_situacions'] = Model_Tipo_Situacion::find('all');
		$this->template->title = "Tipo_situacions";
		$this->template->content = View::forge('tipo/situacion/index', $data);
	}

	public function action_view($id = null){
		is_null($id) and Response::redirect('tipo/situacion');

		if ( ! $data['tipo_situacion'] = Model_Tipo_Situacion::find($id))
		{
			Session::set_flash('error', 'No se ha podido encontrar el tipo de solicitado.');
			Response::redirect('tipo/situacion');
		}

		$this->template->title = "Tipo de situación del cliente";
		$this->template->content = View::forge('tipo/situacion/view', $data);
	}

	public function action_create(){
		if (Input::method() == 'POST')
		{
			$val = Model_Tipo_Situacion::validate('create');

			if ($val->run())
			{
				$tipo_situacion = Model_Tipo_Situacion::forge(array(
					'tipo' => Input::post('tipo'),
				));

				if ($tipo_situacion and $tipo_situacion->save()){
					Session::set_flash('success', 'Añadido al sistema un nuevo tipo de situación.');
					Response::redirect('tipo/situacion');
				}
				else{
					Session::set_flash('error', 'No se ha podido crear el nuevo tipo de situación en el sistema.');
				}
			}
			else{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Crear nuevo tipo de situación";
		$this->template->content = View::forge('tipo/situacion/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('tipo/situacion');

		if ( ! $tipo_situacion = Model_Tipo_Situacion::find($id))
		{
			Session::set_flash('error', 'No se ha podido encontrar el tipo de solicitado.');
			Response::redirect('tipo/situacion');
		}

		$val = Model_Tipo_Situacion::validate('edit');

		if ($val->run())
		{
			$tipo_situacion->tipo = Input::post('tipo');

			if ($tipo_situacion->save()){
				Session::set_flash('success', 'Tipo de situación actualizado.');
				Response::redirect('tipo/situacion');
			}
			else{
				Session::set_flash('error', 'No se ha podido actualizar el nuevo tipo de situación.');
			}
		}

		else{
			if (Input::method() == 'POST'){
				$tipo_situacion->tipo = $val->validated('tipo');
				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('tipo_situacion', $tipo_situacion, false);
		}

		$this->template->title = "Tipo de situaciones";
		$this->template->content = View::forge('tipo/situacion/edit');
	}

	public function action_delete($id = null){
		is_null($id) and Response::redirect('tipo/situacion');

		if ($tipo_situacion = Model_Tipo_Situacion::find($id)){
			$tipo_situacion->delete();

			Session::set_flash('success', 'Borrado el tipo de situación seleccionado');
		}
		else{
			Session::set_flash('error', 'No se ha podido borrar el tipo de situación seleccionado.');
		}

		Response::redirect('tipo/situacion');
	}
}
