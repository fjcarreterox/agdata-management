<?php
class Controller_Contrato extends Controller_Template
{
	public function action_index()
	{
		$data['contratos'] = Model_Contrato::find('all');
		$this->template->title = "Contratos";
		$this->template->content = View::forge('contrato/index', $data);
	}

    public function action_doc()
    {
        $this->template->title = "Generar Contrato";
        $this->template->content = View::forge('contrato/doc');
    }

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('contrato');

		if ( ! $data['contrato'] = Model_Contrato::find($id))
		{
			Session::set_flash('error', 'No se ha podido localizar el contrato deseado');
			Response::redirect('contrato');
		}

		$this->template->title = "Detalle de contrato";
		$this->template->content = View::forge('contrato/view', $data);
	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Contrato::validate('create');

			if ($val->run())
			{
				$contrato = Model_Contrato::forge(array(
					'idcliente' => Input::post('idcliente'),
					'idpres' => Input::post('idpres'),
					'idpersonal' => Input::post('idpersonal'),
					'fecha_firma' => Input::post('fecha_firma'),
				));

				if ($contrato and $contrato->save()){
					Session::set_flash('success', 'Contrato añadido al sistema.');
					Response::redirect('contrato');
				}
				else{
					Session::set_flash('error', 'No se ha podido crear un nuevo contrato en el sistema.');
				}
			}
			else{
				Session::set_flash('error', $val->error());
			}
		}
        $data['clientes'] = Model_Cliente::find('all',array('order_by'=>'nombre'));

		$this->template->title = "Crear nuevo contratos";
		$this->template->content = View::forge('contrato/create',$data);
	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('contrato');

		if ( ! $contrato = Model_Contrato::find($id))
		{
			Session::set_flash('error', 'No se ha podido localizar el contrato indicado.');
			Response::redirect('contrato');
		}

		$val = Model_Contrato::validate('edit');

		if ($val->run()){
			$contrato->idcliente = Input::post('idcliente');
			$contrato->idpres = Input::post('idpres');
			$contrato->idpersonal = Input::post('idpersonal');
			$contrato->fecha_firma = Input::post('fecha_firma');

			if ($contrato->save()){
				Session::set_flash('success', 'Contrato actualizado correctamente');
				Response::redirect('contrato');
			}
			else{
				Session::set_flash('error', 'No se ha podido actualizar el contrato indicado.');
			}
		}
		else{
			if (Input::method() == 'POST')
			{
				$contrato->idcliente = $val->validated('idcliente');
				$contrato->idpres = $val->validated('idpres');
				$contrato->idpersonal = $val->validated('idpersonal');
				$contrato->fecha_firma = $val->validated('fecha_firma');
				Session::set_flash('error', $val->error());
			}
			$this->template->set_global('contrato', $contrato, false);
		}
		$this->template->title = "Editando detalle de contrato";
		$this->template->content = View::forge('contrato/edit');
	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('contrato');

		if ($contrato = Model_Contrato::find($id))
		{
			$contrato->delete();
			Session::set_flash('success', 'Contrato borrado del sistema.');
		}
		else{
			Session::set_flash('error', 'No se ha podido eliminar el contrato');
		}

		Response::redirect('contrato');
	}
}