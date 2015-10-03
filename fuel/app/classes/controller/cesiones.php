<?php
class Controller_Cesiones extends Controller_Template
{
	public function action_index(){
		$data['cesiones'] = Model_Cesione::find('all');
		$this->template->title = "Cesiones de datos";
		$this->template->content = View::forge('cesiones/index', $data);
	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('cesiones');

		if ( ! $data['cesione'] = Model_Cesione::find($id)){
			Session::set_flash('error', 'Could not find cesione #'.$id);
			Response::redirect('cesiones');
		}

		$this->template->title = "Cesione";
		$this->template->content = View::forge('cesiones/view', $data);
	}

	public function action_create($idcliente)
	{
		if (Input::method() == 'POST'){
			$val = Model_Cesione::validate('create');

			if ($val->run())	{
				$cesion = Model_Cesione::forge(array(
					'idcliente' => Input::post('idcliente'),
					'idfichero' => Input::post('idfichero'),
					'idtipo_empresa' => Input::post('idtipo_empresa'),
					'nombre' => Input::post('nombre'),
					'cifnif' => Input::post('cifnif'),
					'servicio' => Input::post('servicio'),
					'rep_legal_name' => Input::post('rep_legal_name'),
					'rep_legal_dni' => Input::post('rep_legal_dni'),
					'rep_legal_cargo' => Input::post('rep_legal_cargo'),
					'tel' => Input::post('tel'),
					'domicilio' => Input::post('domicilio'),
					'localidad' => Input::post('localidad'),
					'cp' => Input::post('cp'),
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
        $data['tipos_empresas'] = Model_Tipo_Cesionaria::find('all');
        $data['ficheros'] = Model_Fichero::find('all',array('where'=>array('idcliente'=>$idcliente)));

		$this->template->title = "Crear nueva cesión de datos";
		$this->template->content = View::forge('cesiones/create',$data);

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('cesiones');

		if ( ! $cesione = Model_Cesione::find($id))
		{
			Session::set_flash('error', 'Could not find cesione #'.$id);
			Response::redirect('cesiones');
		}

		$val = Model_Cesione::validate('edit');

		if ($val->run())
		{
			$cesione->idcliente = Input::post('idcliente');
			$cesione->idtipo_empresa = Input::post('idtipo_empresa');
			$cesione->nombre = Input::post('nombre');
			$cesione->cifnif = Input::post('cifnif');
			$cesione->servicio = Input::post('servicio');
			$cesione->rep_legal_name = Input::post('rep_legal_name');
			$cesione->rep_legal_dni = Input::post('rep_legal_dni');
			$cesione->rep_legal_cargo = Input::post('rep_legal_cargo');
			$cesione->tel = Input::post('tel');
			$cesione->domicilio = Input::post('domicilio');
			$cesione->localidad = Input::post('localidad');
			$cesione->cp = Input::post('cp');
			$cesione->fecha_contrato = Input::post('fecha_contrato');

			if ($cesione->save())
			{
				Session::set_flash('success', 'Updated cesione #' . $id);

				Response::redirect('cesiones');
			}

			else
			{
				Session::set_flash('error', 'Could not update cesione #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$cesione->idcliente = $val->validated('idcliente');
				$cesione->idtipo_empresa = $val->validated('idtipo_empresa');
				$cesione->nombre = $val->validated('nombre');
				$cesione->cifnif = $val->validated('cifnif');
				$cesione->servicio = $val->validated('servicio');
				$cesione->rep_legal_name = $val->validated('rep_legal_name');
				$cesione->rep_legal_dni = $val->validated('rep_legal_dni');
				$cesione->rep_legal_cargo = $val->validated('rep_legal_cargo');
				$cesione->tel = $val->validated('tel');
				$cesione->domicilio = $val->validated('domicilio');
				$cesione->localidad = $val->validated('localidad');
				$cesione->cp = $val->validated('cp');
				$cesione->fecha_contrato = $val->validated('fecha_contrato');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('cesione', $cesione, false);
		}

		$this->template->title = "Cesiones";
		$this->template->content = View::forge('cesiones/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('cesiones');

		if ($cesione = Model_Cesione::find($id))
		{
			$cesione->delete();

			Session::set_flash('success', 'Deleted cesione #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete cesione #'.$id);
		}

		Response::redirect('cesiones');

	}

}
