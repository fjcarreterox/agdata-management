<?php
class Controller_Estados_Cliente extends Controller_Template
{
	public function action_index()
	{
		$data['estados_clientes'] = Model_Estados_Cliente::find('all');
		$this->template->title = "Estados de los clientes";
		$this->template->content = View::forge('estados/cliente/index', $data);
	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('estados/cliente');

		if ( ! $data['estados_cliente'] = Model_Estados_Cliente::find($id))
		{
			Session::set_flash('error', 'No se ha podido encontrar el estado solicitado.');
			Response::redirect('estados/cliente');
		}

		$this->template->title = "Estado de cliente";
		$this->template->content = View::forge('estados/cliente/view', $data);
	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Estados_Cliente::validate('create');

			if ($val->run())
			{
				$estados_cliente = Model_Estados_Cliente::forge(array(
					'nombre' => Input::post('nombre'),
				));

				if ($estados_cliente and $estados_cliente->save())
				{
					Session::set_flash('success', 'Añadido nuevo estado para clientes.');

					Response::redirect('estados/cliente');
				}
				else{
					Session::set_flash('error', 'No se ha podido almacenar el estado para cliente.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Estados para los clientes";
		$this->template->content = View::forge('estados/cliente/create');
	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('estados/cliente');

		if ( ! $estados_cliente = Model_Estados_Cliente::find($id))
		{
			Session::set_flash('error', 'No se ha podido localizar el estado solicitado.');
			Response::redirect('estados/cliente');
		}

		$val = Model_Estados_Cliente::validate('edit');

		if ($val->run())
		{
			$estados_cliente->nombre = Input::post('nombre');

			if ($estados_cliente->save())
			{
				Session::set_flash('success', 'Nombre del estado actualizado');

				Response::redirect('estados/cliente');
			}
			else{
				Session::set_flash('error', 'No se ha podido crear el estado.');
			}
		}
		else{
			if (Input::method() == 'POST')
			{
				$estados_cliente->nombre = $val->validated('nombre');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('estados_cliente', $estados_cliente, false);
		}

		$this->template->title = "Estados_clientes";
		$this->template->content = View::forge('estados/cliente/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('estados/cliente');

		if ($estados_cliente = Model_Estados_Cliente::find($id))
		{
			$estados_cliente->delete();

			Session::set_flash('success', 'Estado borrado.');
		}
		else		{
			Session::set_flash('error', 'No se ha podido eliminar el estado solicitado.');
		}

		Response::redirect('estados/cliente');
	}
}
