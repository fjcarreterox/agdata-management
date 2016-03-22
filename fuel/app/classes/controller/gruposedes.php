<?php
class Controller_Gruposedes extends Controller_Template{

	public function action_index(){
		$data['gruposedes'] = Model_Gruposede::find('all');
		$this->template->title = "Gruposedes";
		$this->template->content = View::forge('gruposedes/index', $data);
	}

	public function action_view($id = null){
		is_null($id) and Response::redirect('gruposedes');

		if ( ! $data['gruposede'] = Model_Gruposede::find($id)){
			Session::set_flash('error', 'No se ha podido encontrar la relación entre empresas seleccionada.');
			Response::redirect('gruposedes');
		}
		$this->template->title = "Detalle de la relación seleccionada";
		$this->template->content = View::forge('gruposedes/view', $data);
	}

	public function action_create($idcliente){
		if (Input::method() == 'POST'){
			$val = Model_Gruposede::validate('create');

			if ($val->run()){
				$gruposede = Model_Gruposede::forge(array(
					'idcliente' => Input::post('idcliente'),
					'tipo' => Input::post('tipo'),
					'nombre' => Input::post('nombre'),
					'dir' => Input::post('dir'),
					'cif' => Input::post('cif'),
					'ficheros' => Input::post('ficheros'),
					'contacto' => Input::post('contacto'),
				));

				if ($gruposede and $gruposede->save()){
					Session::set_flash('success', 'Se ha añadido la nueva sede / empresa correctamente.');
					Response::redirect('clientes/view/'.$idcliente);
				}
				else{
					Session::set_flash('error', 'Could not save gruposede.');
				}
			}
			else{
				Session::set_flash('error', $val->error());
			}
		}
        $data["idcliente"] = $idcliente;
        $data["nombre"] = Model_Cliente::find($idcliente)->get('nombre');

		$this->template->title = "Registrar nueva sede o empresa del grupo";
		$this->template->content = View::forge('gruposedes/create',$data);
	}

	public function action_edit($id = null){
		is_null($id) and Response::redirect('gruposedes');

		if ( ! $gruposede = Model_Gruposede::find($id)){
			Session::set_flash('error', 'Could not find gruposede #'.$id);
			Response::redirect('gruposedes');
		}

		$val = Model_Gruposede::validate('edit');

		if ($val->run()){
			$gruposede->idcliente = Input::post('idcliente');
			$gruposede->tipo = Input::post('tipo');
			$gruposede->nombre = Input::post('nombre');
			$gruposede->dir = Input::post('dir');
			$gruposede->cif = Input::post('cif');
			$gruposede->ficheros = Input::post('ficheros');
			$gruposede->contacto = Input::post('contacto');

			if ($gruposede->save()){
				Session::set_flash('success', 'Datos de la relación entre empresas actualizados.');
				Response::redirect('clientes/view/'.$gruposede->idcliente);
			}
			else{
				Session::set_flash('error', 'Could not update gruposede #' . $id);
			}
		}
		else{
			if (Input::method() == 'POST'){
				$gruposede->idcliente = $val->validated('idcliente');
				$gruposede->tipo = $val->validated('tipo');
				$gruposede->nombre = $val->validated('nombre');
				$gruposede->dir = $val->validated('dir');
				$gruposede->cif = $val->validated('cif');
				$gruposede->ficheros = $val->validated('ficheros');
				$gruposede->contacto = $val->validated('contacto');
				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('gruposede', $gruposede, false);
		}

		$this->template->title = "Editando datos de la relación entre empresas seleccionada.";
		$this->template->content = View::forge('gruposedes/edit');
	}

	public function action_delete($id = null){
		is_null($id) and Response::redirect('gruposedes');
        $idcliente = Model_Gruposede::find($id)->get('idcliente');
		if ($gruposede = Model_Gruposede::find($id)){
			$gruposede->delete();
			Session::set_flash('success', 'Se ha borrado correctamente la sede / empresa del grupo.');
		}
		else{
			Session::set_flash('error', 'No se ha podido eliminar la sede o empresa del grupo solicitada.');
		}
		Response::redirect('clientes/view/'.$idcliente);
	}
}
