<?php
class Controller_Servicios extends Controller_Template
{
	public function action_index(){
		$data['servicios'] = Model_Servicio::find('all');
		$this->template->title = "Listado de servicios";
		$this->template->content = View::forge('servicios/index', $data);
	}

	public function action_view($id = null){
		is_null($id) and Response::redirect('servicios');

		if ( ! $data['servicio'] = Model_Servicio::find($id)){
			Session::set_flash('error', 'No se ha podido localizar el servicio deseado.');
			Response::redirect('servicios');
		}

		$this->template->title = "Ver detalle de un servicio";
		$this->template->content = View::forge('servicios/view', $data);
	}

	public function action_create()	{
		if (Input::method() == 'POST')		{
			$val = Model_Servicio::validate('create');

			if ($val->run()){
				$servicio = Model_Servicio::forge(array(
					'nombre' => Input::post('nombre'),
					'categoria' => Input::post('categoria'),
				));

				if ($servicio and $servicio->save()){
					Session::set_flash('success', 'Añadido nuevo servicio al sistema.');
					Response::redirect('servicios');
				}
				else{
					Session::set_flash('error', 'No se ha podido crear el nuevo servicio en el sistema.');
				}
			}
			else{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Creación de un nuevo servicio";
		$this->template->content = View::forge('servicios/create');
	}

	public function action_edit($id = null){
		is_null($id) and Response::redirect('servicios');

		if ( ! $servicio = Model_Servicio::find($id)){
			Session::set_flash('error', 'No se ha podido localizar el servicio deseado.');
			Response::redirect('servicios');
		}

		$val = Model_Servicio::validate('edit');

		if ($val->run()){
			$servicio->nombre = Input::post('nombre');
			$servicio->categoria = Input::post('categoria');

			if ($servicio->save()){
				Session::set_flash('success', 'Datos del servicio actualizados.');
				Response::redirect('servicios');
			}
			else{
				Session::set_flash('error', 'No se ha podido actualizar el servicio.');
			}
		}
		else{
			if (Input::method() == 'POST'){
				$servicio->nombre = $val->validated('nombre');
				$servicio->categoria = $val->validated('categoria');
				Session::set_flash('error', $val->error());
			}
			$this->template->set_global('servicio', $servicio, false);
		}
		$this->template->title = "Servicios";
		$this->template->content = View::forge('servicios/edit');
	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('servicios');

		if ($servicio = Model_Servicio::find($id)){
			$servicio->delete();
			Session::set_flash('success', 'Servicio eliminado del sistema.');
		}
		else{
			Session::set_flash('error', 'No se ha podido eliminar el servicio del sistema.');
		}
		Response::redirect('servicios');
	}
}