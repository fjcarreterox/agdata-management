<?php
class Controller_Adaptacion extends Controller_Template
{

	public function action_index()
	{
		$data['adaptacions'] = Model_Adaptacion::find('all');
		$this->template->title = "Adaptacions";
		$this->template->content = View::forge('adaptacion/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('adaptacion');

		if ( ! $data['adaptacion'] = Model_Adaptacion::find($id))
		{
			Session::set_flash('error', 'Could not find adaptacion #'.$id);
			Response::redirect('adaptacion');
		}

		$this->template->title = "Adaptacion";
		$this->template->content = View::forge('adaptacion/view', $data);

	}

	public function action_create($idcliente){
		if (Input::method() == 'POST'){
			$val = Model_Adaptacion::validate('create');

			if ($val->run()){
				$adaptacion = Model_Adaptacion::forge(array(
					'idcliente' => Input::post('idcliente'),
					'num_serv' => Input::post('num_serv'),
					'num_pc' => Input::post('num_pc'),
					'num_pc_online' => Input::post('num_pc_online'),
					'num_laptop' => Input::post('num_laptop'),
					'num_laptop_online' => Input::post('num_laptop_online'),
					'pass_freq' => Input::post('pass_freq'),
					'backup_freq' => Input::post('backup_freq'),
					'storage' => Input::post('storage')
				));

				if ($adaptacion and $adaptacion->save()){
					Session::set_flash('success', 'Creada la auditoría de adaptación en el sistema.');
					Response::redirect('clientes/view/'.$idcliente);
				}else{
					Session::set_flash('error', 'Hubo un problema al crear la auditoría de adaptación.');
				}
			}
			else{
				Session::set_flash('error', $val->error());
			}
		}
        $nombre = Model_Cliente::find($idcliente)->get('nombre');
        $data['nombre'] = $nombre;
        $data['idcliente'] = $idcliente;

		$this->template->title = "Auditoría de adaptación";
		$this->template->content = View::forge('adaptacion/create',$data);
	}

	public function action_edit($id = null){
		is_null($id) and Response::redirect('adaptacion');

		if ( ! $adaptacion = Model_Adaptacion::find($id)){
			Session::set_flash('error', 'No se ha podido localizar el cuestionario de adaptación solicitado.');
			Response::redirect('clientes/index');
		}

		$val = Model_Adaptacion::validate('edit');

		if ($val->run()){
			$adaptacion->idcliente = Input::post('idcliente');
			$adaptacion->num_serv = Input::post('num_serv');
			$adaptacion->num_pc = Input::post('num_pc');
			$adaptacion->num_pc_online = Input::post('num_pc_online');
			$adaptacion->num_laptop = Input::post('num_laptop');
			$adaptacion->num_laptop_online = Input::post('num_laptop_online');
			$adaptacion->pass_freq = Input::post('pass_freq');
			$adaptacion->backup_freq = Input::post('backup_freq');
			$adaptacion->storage = Input::post('storage');

			if ($adaptacion->save()){
				Session::set_flash('success', 'Datos del cuestionario básico actualizados.');
				Response::redirect('clientes/view/'.$adaptacion->idcliente);
			}
			else{
				Session::set_flash('error', 'No se han podido actualizar los datos del cuestionario');
			}
		}
		else{
			if (Input::method() == 'POST'){
				$adaptacion->idcliente = $val->validated('idcliente');
				$adaptacion->num_serv = $val->validated('num_serv');
				$adaptacion->num_pc = $val->validated('num_pc');
				$adaptacion->num_pc_online = $val->validated('num_pc_online');
				$adaptacion->num_laptop = $val->validated('num_laptop');
				$adaptacion->num_laptop_online = $val->validated('num_laptop_online');
				$adaptacion->pass_freq = $val->validated('pass_freq');
				$adaptacion->backup_freq = $val->validated('backup_freq');
				$adaptacion->storage = $val->validated('storage');

				Session::set_flash('error', $val->error());
			}
			$this->template->set_global('adaptacion', $adaptacion, false);
		}
        $data['idcliente'] = $adaptacion->idcliente;
		$this->template->title = "Editar datos del cuestionario básico de adaptación";
		$this->template->content = View::forge('adaptacion/edit',$data);
	}

	public function action_delete($id = null){
		is_null($id) and Response::redirect('adaptacion');

		if ($adaptacion = Model_Adaptacion::find($id)){
			$adaptacion->delete();
			Session::set_flash('success', 'Deleted adaptacion #'.$id);
		}
		else{
			Session::set_flash('error', 'Could not delete adaptacion #'.$id);
		}

		Response::redirect('adaptacion');
	}
}