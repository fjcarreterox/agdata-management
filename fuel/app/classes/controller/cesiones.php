<?php
class Controller_Cesiones extends Controller_Template
{
	public function action_index(){
		$data['cesiones'] = Model_Cesione::find('all');
		$this->template->title = "Cesiones de datos";
		$this->template->content = View::forge('cesiones/index', $data);
	}

    public function action_doc($idcesion){
        $data['cesion'] = Model_Cesione::find($idcesion);
        $this->template->title = "Contrato de cesión de datos";
        $this->template->content = View::forge('cesiones/doc', $data);
    }

	public function action_view($id = null){
		is_null($id) and Response::redirect('cesiones');

		if ( ! $data['cesione'] = Model_Cesione::find($id)){
			Session::set_flash('error', 'No se ha podido encontrar la cesión de datos buscada.');
			Response::redirect('cesiones');
		}

		$this->template->title = "Cesiones de datos";
		$this->template->content = View::forge('cesiones/view', $data);
	}

	public function action_create($idcliente){
		if (Input::method() == 'POST'){
			$val = Model_Cesione::validate('create');

			if ($val->run())	{
				$cesion = Model_Cesione::forge(array(
					'idcliente' => Input::post('idcliente'),
					'idfichero' => Input::post('idfichero'),
					'idcesionaria' => Input::post('idcesionaria'),
					'idrep' => Input::post('idrep'),
					'fecha_contrato' => Input::post('fecha_contrato'),
				));

				if ($cesion and $cesion->save()){
					Session::set_flash('success', 'Registrada correctamente la nueva cesión de datos.');
					Response::redirect('clientes/view/'.$cesion->idcliente);
				}
				else{
					Session::set_flash('error', 'Hubo un problema al registrar la cesión de datos.');
				}
			}
			else{
				Session::set_flash('error', $val->error());
			}
		}
        $data['idcliente'] = $idcliente;
        //only 'cesionaria' state
        $data['cesionarias'] = Model_Cliente::find('all', array('where'=>array('estado'=>8)));
        $data['ficheros'] = Model_Fichero::find('all',array('where'=>array('idcliente'=>$idcliente)));

		$this->template->title = "Crear nueva cesión de datos";
		$this->template->content = View::forge('cesiones/create',$data);

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('cesiones');

		if ( ! $cesione = Model_Cesione::find($id)){
			Session::set_flash('error', 'No se ha podido encontrar la cesión de datos solicitada.');
			Response::redirect('cesiones');
		}

		$val = Model_Cesione::validate('edit');

		if ($val->run()){
			$cesione->idcliente = Input::post('idcliente');
			$cesione->idcesionaria = Input::post('idcesionaria');
			$cesione->idrep = Input::post('idrep');
			$cesione->fecha_contrato = Input::post('fecha_contrato');

			if ($cesione->save()){
				Session::set_flash('success', 'Cesión de datos actualizada.');
				Response::redirect('clientes/view/'.$cesione->idcliente);
			}
			else{
				Session::set_flash('error', 'No se ha podido actualizar la cesión de datos solicitada.');
			}
		}
		else{
			if (Input::method() == 'POST'){
				$cesione->idcliente = $val->validated('idcliente');
				$cesione->idcesionaria = $val->validated('idcesionaria');
				$cesione->idrep = $val->validated('idrep');
				$cesione->fecha_contrato = $val->validated('fecha_contrato');

				Session::set_flash('error', $val->error());
			}
			$this->template->set_global('cesione', $cesione, false);
		}

        $data['cesionarias'] = Model_Cliente::find('all', array('where'=>array('estado'=>8)));
        $data['idcliente'] = $cesione->idcliente;
        $data['ficheros'] = Model_Fichero::find('all',array('where'=>array('idcliente'=>$cesione->idcliente)));

		$this->template->title = "Cesiones";
		$this->template->content = View::forge('cesiones/edit',$data);
	}

	public function action_delete($id = null){
		is_null($id) and Response::redirect('cesiones');

		if ($cesione = Model_Cesione::find($id)){
			$cesione->delete();
			Session::set_flash('success', 'Cesión de datos eliminada del sistema (el fichero de datos, no).');
            Response::redirect('clientes/view/'.$cesione->idcliente);
		}
		else{
			Session::set_flash('error', 'No se ha podido eliminar del sistema la cesión de datos solicitada.');
            Response::redirect('cesiones');
		}
	}
}