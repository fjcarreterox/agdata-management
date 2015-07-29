<?php
class Controller_Servicios extends Controller_Template
{

	public function action_index()
	{
		$data['servicios'] = Model_Servicio::find('all');
		$this->template->title = "Servicios";
		$this->template->content = View::forge('servicios/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('servicios');

		if ( ! $data['servicio'] = Model_Servicio::find($id))
		{
			Session::set_flash('error', 'Could not find servicio #'.$id);
			Response::redirect('servicios');
		}

		$this->template->title = "Servicio";
		$this->template->content = View::forge('servicios/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Servicio::validate('create');

			if ($val->run())
			{
				$servicio = Model_Servicio::forge(array(
					'nombre' => Input::post('nombre'),
				));

				if ($servicio and $servicio->save())
				{
					Session::set_flash('success', 'Added servicio #'.$servicio->id.'.');

					Response::redirect('servicios');
				}

				else
				{
					Session::set_flash('error', 'Could not save servicio.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Servicios";
		$this->template->content = View::forge('servicios/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('servicios');

		if ( ! $servicio = Model_Servicio::find($id))
		{
			Session::set_flash('error', 'Could not find servicio #'.$id);
			Response::redirect('servicios');
		}

		$val = Model_Servicio::validate('edit');

		if ($val->run())
		{
			$servicio->nombre = Input::post('nombre');

			if ($servicio->save())
			{
				Session::set_flash('success', 'Updated servicio #' . $id);

				Response::redirect('servicios');
			}

			else
			{
				Session::set_flash('error', 'Could not update servicio #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$servicio->nombre = $val->validated('nombre');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('servicio', $servicio, false);
		}

		$this->template->title = "Servicios";
		$this->template->content = View::forge('servicios/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('servicios');

		if ($servicio = Model_Servicio::find($id))
		{
			$servicio->delete();

			Session::set_flash('success', 'Deleted servicio #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete servicio #'.$id);
		}

		Response::redirect('servicios');

	}

}
