<?php
class Controller_Clientes extends Controller_Template
{

	public function action_index()
	{
		$data['clientes'] = Model_Cliente::find('all');
		$this->template->title = "Clientes";
		$this->template->content = View::forge('clientes/index', $data);
	}

    public function action_activos()
    {
        $data['clientes'] = Model_Cliente::find('all',array('where'=>array('estado'=>4)));
        $this->template->title = "Clientes activos";
        $this->template->content = View::forge('clientes/index', $data);
    }

    public function action_presupuestados()
    {
        $data['clientes'] = Model_Cliente::find('all',array('where'=>array('estado'=>3)));
        $this->template->title = "Clientes activos";
        $this->template->content = View::forge('clientes/presupuestados', $data);
    }

    public function action_comunidades_aaff($idaaff)
    {
        $data['clientes'] = Model_Cliente::find('all',array('where'=>array('estado'=>4)));
        $nombre = Model_Personal::find($idaaff)->get('nombre');
        $data['nombre'] = $nombre;
        $this->template->title = "Comunidades gestionadas por $nombre";
        $this->template->content = View::forge('clientes/comunidades', $data);
    }

    public function action_potenciales()
    {
        $data['clientes'] = Model_Cliente::find('all',array('where'=>array(array('estado','<',4))));
        $this->template->title = "Clientes potenciales";
        $this->template->content = View::forge('clientes/index', $data);
    }

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('clientes');

		if ( ! $data['cliente'] = Model_Cliente::find($id))
		{
			Session::set_flash('error', 'No se ha podido localizar al cliente solicitado.');
			Response::redirect('clientes');
		}else{
            $data['ficha'] = Model_Ficha::find('first',array('where'=>array('idcliente'=>$id)));
            $data['adaptacion'] = Model_Adaptacion::find('first',array('where'=>array('idcliente'=>$id)));
            $data['ficheros'] = Model_Fichero::find('all',array('where'=>array('idcliente'=>$id)));
            $data['contactos'] = Model_Personal::find('all',array('where'=>array('idcliente'=>$id)));
        }

		$this->template->title = "Ficha completa de cliente";
		$this->template->content = View::forge('clientes/view_panel', $data);
	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Cliente::validate('create');

			if ($val->run())
			{
				$cliente = Model_Cliente::forge(array(
					'nombre' => Input::post('nombre'),
					'tipo' => Input::post('tipo'),
					'cif_nif' => Input::post('cif_nif'),
					'direccion' => Input::post('direccion'),
					'cpostal' => Input::post('cpostal'),
					'loc' => Input::post('loc'),
					'prov' => Input::post('prov'),
					'tel' => Input::post('tel'),
					'pweb' => Input::post('pweb'),
					'email' => Input::post('email'),
					'actividad' => Input::post('actividad'),
					'observ' => Input::post('observ'),
					'estado' => Input::post('estado'),
				));

				if ($cliente and $cliente->save()){
					Session::set_flash('success', 'Nuevo cliente añadido al sistema.');
					Response::redirect('clientes');
				}
				else{
					Session::set_flash('error', 'No se ha podido crear el cliente. Inténtelo más tarde.');
				}
			}
			else{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Clientes";
		$this->template->content = View::forge('clientes/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('clientes');

		if ( ! $cliente = Model_Cliente::find($id))
		{
			Session::set_flash('error', 'No se ha podido encontrar el cliente deseado.');
			Response::redirect('clientes');
		}

		$val = Model_Cliente::validate('edit');

		if ($val->run())
		{
			$cliente->nombre = Input::post('nombre');
			$cliente->tipo = Input::post('tipo');
			$cliente->cif_nif = Input::post('cif_nif');
			$cliente->direccion = Input::post('direccion');
			$cliente->cpostal = Input::post('cpostal');
			$cliente->loc = Input::post('loc');
			$cliente->prov = Input::post('prov');
			$cliente->tel = Input::post('tel');
			$cliente->pweb = Input::post('pweb');
			$cliente->email = Input::post('email');
			$cliente->actividad = Input::post('actividad');
			$cliente->observ = Input::post('observ');
			$cliente->estado = Input::post('estado');

			if ($cliente->save()){
				Session::set_flash('success', 'Datos de cliente actualizados.');
				Response::redirect('clientes');
			}
			else{
				Session::set_flash('error', 'No se han podido actualizar los datos del cliente.');
			}
		}
		else
		{
			if (Input::method() == 'POST')
			{
				$cliente->nombre = $val->validated('nombre');
				$cliente->tipo = $val->validated('tipo');
				$cliente->cif_nif = $val->validated('cif_nif');
				$cliente->direccion = $val->validated('direccion');
				$cliente->cpostal = $val->validated('cpostal');
				$cliente->loc = $val->validated('loc');
				$cliente->prov = $val->validated('prov');
				$cliente->tel = $val->validated('tel');
				$cliente->pweb = $val->validated('pweb');
				$cliente->email = $val->validated('email');
				$cliente->actividad = $val->validated('actividad');
				$cliente->observ = $val->validated('observ');
				$cliente->estado = $val->validated('estado');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('cliente', $cliente, false);
		}
		$this->template->title = "Clientes";
		$this->template->content = View::forge('clientes/edit');
	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('clientes');

		if ($cliente = Model_Cliente::find($id)){
			$cliente->delete();
			Session::set_flash('success', 'Cliente borrado del sistema.');
		}
		else{
			Session::set_flash('error', 'No se ha podido eliminar el cliente solicitado.');
		}
		Response::redirect('clientes');
	}
}