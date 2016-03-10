<?php
class Controller_Tipo_Tarea extends Controller_Template
{
	public function action_index(){
		$data['tipo_tareas'] = Model_Tipo_Tarea::find('all');
		$this->template->title = "Listado de los tipos de tareas";
		$this->template->content = View::forge('tipo/tarea/index', $data);
	}

	public function action_view($id = null){
		is_null($id) and Response::redirect('tipo/tarea');

		if ( ! $data['tipo_tarea'] = Model_Tipo_Tarea::find($id))
		{
			Session::set_flash('error', 'Could not find tipo_tarea #'.$id);
			Response::redirect('tipo/tarea');
		}

		$this->template->title = "Tipo_tarea";
		$this->template->content = View::forge('tipo/tarea/view', $data);
	}

	public function action_create(){
		if (Input::method() == 'POST'){
			$val = Model_Tipo_Tarea::validate('create');

			if ($val->run()){
				$tipo_tarea = Model_Tipo_Tarea::forge(array(
					'nombre' => Input::post('nombre'),
					'descripcion' => Input::post('descripcion'),
					'tipo' => Input::post('tipo'),
					'idplantilla' => Input::post('idplantilla'),
				));

				if ($tipo_tarea and $tipo_tarea->save()){
					Session::set_flash('success', 'Nuevo tipo de tarea añadido al sistema.');
					Response::redirect('tipo/tarea');
				}
                else{
					Session::set_flash('error', 'No se ha podido crear el nuevo tipo de tarea.');
				}
			}
			else{
				Session::set_flash('error', $val->error());
			}
		}
        $data["servicios"] = Model_Servicio::find('all');

		$this->template->title = "Crear nuevo tipo de tarea";
		$this->template->content = View::forge('tipo/tarea/create',$data);
	}

	public function action_edit($id = null){
		is_null($id) and Response::redirect('tipo/tarea');

		if ( ! $tipo_tarea = Model_Tipo_Tarea::find($id)){
			Session::set_flash('error', 'No se ha podido encontrar el tipo de tarea especificado.');
			Response::redirect('tipo/tarea');
		}

		$val = Model_Tipo_Tarea::validate('edit');

		if ($val->run()){
			$tipo_tarea->nombre = Input::post('nombre');
			$tipo_tarea->descripcion = Input::post('descripcion');
			$tipo_tarea->tipo = Input::post('tipo');
			$tipo_tarea->idplantilla = Input::post('idplantilla');

			if ($tipo_tarea->save()){
				Session::set_flash('success', 'Tipo de tarea actualizada con éxito');
				Response::redirect('tipo/tarea');
			}
			else{
				Session::set_flash('error', 'No se ha podido actualizar el tipo de tarea seleccionado.');
			}
		}
		else{
			if (Input::method() == 'POST'){
				$tipo_tarea->nombre = $val->validated('nombre');
				$tipo_tarea->descripcion = $val->validated('descripcion');
				$tipo_tarea->tipo = $val->validated('tipo');
				$tipo_tarea->idplantilla = $val->validated('idplantilla');
				Session::set_flash('error', $val->error());
			}
			$this->template->set_global('tipo_tarea', $tipo_tarea, false);
		}
        $data["servicios"] = Model_Servicio::find('all');
        $data["plantillas"] = Model_Tipo_Plantilla::find('all',array('order_by'=>'id'));

		$this->template->title = "Tipo_tareas";
		$this->template->content = View::forge('tipo/tarea/edit',$data);
	}

	public function action_delete($id = null){
		is_null($id) and Response::redirect('tipo/tarea');

		if ($tipo_tarea = Model_Tipo_Tarea::find($id)){
			$tipo_tarea->delete();
			Session::set_flash('success', 'Se ha borrado el tipo de tarea solicitado.');
		}
		else{
			Session::set_flash('error', 'No se ha podido eliminar el tipo de tarea especificado.');
		}
		Response::redirect('tipo/tarea');
	}
}
