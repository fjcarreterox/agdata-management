<?php
class Controller_Usuario extends Controller_Template
{

	public function action_index()
	{
		$data['usuarios'] = Model_Usuario::find('all');
		$this->template->title = "Usuarios";
		$this->template->content = View::forge('usuario/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('usuario');

		if ( ! $data['usuario'] = Model_Usuario::find($id))
		{
			Session::set_flash('error', 'Could not find usuario #'.$id);
			Response::redirect('usuario');
		}

		$this->template->title = "Usuario";
		$this->template->content = View::forge('usuario/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Usuario::validate('create');

			if ($val->run())
			{
				$usuario = Model_Usuario::forge(array(
					'nombre' => Input::post('nombre'),
					'password' => Input::post('password'),
					'email' => Input::post('email'),
					'role' => Input::post('role'),
				));

				if ($usuario and $usuario->save())
				{
					Session::set_flash('success', 'Added usuario #'.$usuario->id.'.');

					Response::redirect('usuario');
				}

				else
				{
					Session::set_flash('error', 'Could not save usuario.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Usuarios";
		$this->template->content = View::forge('usuario/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('usuario');

		if ( ! $usuario = Model_Usuario::find($id))
		{
			Session::set_flash('error', 'Could not find usuario #'.$id);
			Response::redirect('usuario');
		}

		$val = Model_Usuario::validate('edit');

		if ($val->run())
		{
			$usuario->nombre = Input::post('nombre');
			$usuario->password = Input::post('password');
			$usuario->email = Input::post('email');
			$usuario->role = Input::post('role');

			if ($usuario->save())
			{
				Session::set_flash('success', 'Updated usuario #' . $id);

				Response::redirect('usuario');
			}

			else
			{
				Session::set_flash('error', 'Could not update usuario #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$usuario->nombre = $val->validated('nombre');
				$usuario->password = $val->validated('password');
				$usuario->email = $val->validated('email');
				$usuario->role = $val->validated('role');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('usuario', $usuario, false);
		}

		$this->template->title = "Usuarios";
		$this->template->content = View::forge('usuario/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('usuario');

		if ($usuario = Model_Usuario::find($id))
		{
			$usuario->delete();

			Session::set_flash('success', 'Deleted usuario #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete usuario #'.$id);
		}

		Response::redirect('usuario');

	}

}
