<?php
class Controller_Tipo_Clientes extends Controller_Template
{

	public function action_index()
	{
		$data['tipo_clientes'] = Model_Tipo_Cliente::find('all');
		$this->template->title = "Tipo_clientes";
		$this->template->content = View::forge('tipo/clientes/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('tipo/clientes');

		if ( ! $data['tipo_cliente'] = Model_Tipo_Cliente::find($id))
		{
			Session::set_flash('error', 'Could not find tipo_cliente #'.$id);
			Response::redirect('tipo/clientes');
		}

		$this->template->title = "Tipo_cliente";
		$this->template->content = View::forge('tipo/clientes/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Tipo_Cliente::validate('create');

			if ($val->run())
			{
				$tipo_cliente = Model_Tipo_Cliente::forge(array(
					'tipo' => Input::post('tipo'),
				));

				if ($tipo_cliente and $tipo_cliente->save())
				{
					Session::set_flash('success', 'Añadido nuevo tipo de cliente: #'.$tipo_cliente->id.'.');

					Response::redirect('tipo/clientes');
				}

				else
				{
					Session::set_flash('error', 'No se ha podido guardar el nuevo tipo de cliente.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Tipo de Clientes";
		$this->template->content = View::forge('tipo/clientes/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('tipo/clientes');

		if ( ! $tipo_cliente = Model_Tipo_Cliente::find($id))
		{
			Session::set_flash('error', 'Could not find tipo_cliente #'.$id);
			Response::redirect('tipo/clientes');
		}

		$val = Model_Tipo_Cliente::validate('edit');

		if ($val->run())
		{
			$tipo_cliente->tipo = Input::post('tipo');

			if ($tipo_cliente->save())
			{
				Session::set_flash('success', 'Updated tipo_cliente #' . $id);

				Response::redirect('tipo/clientes');
			}

			else
			{
				Session::set_flash('error', 'Could not update tipo_cliente #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$tipo_cliente->tipo = $val->validated('tipo');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('tipo_cliente', $tipo_cliente, false);
		}

		$this->template->title = "Tipo_clientes";
		$this->template->content = View::forge('tipo/clientes/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('tipo/clientes');

		if ($tipo_cliente = Model_Tipo_Cliente::find($id))
		{
			$tipo_cliente->delete();

			Session::set_flash('success', 'Deleted tipo_cliente #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete tipo_cliente #'.$id);
		}

		Response::redirect('tipo/clientes');

	}

}
