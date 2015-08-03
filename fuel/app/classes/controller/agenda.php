<?php
class Controller_Agenda extends Controller_Template
{

	public function action_index()
	{
		$data['agendas'] = Model_Agenda::find('all');
		$this->template->title = "Agendas";
		$this->template->content = View::forge('agenda/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('agenda');

		if ( ! $data['agenda'] = Model_Agenda::find($id))
		{
			Session::set_flash('error', 'Could not find agenda #'.$id);
			Response::redirect('agenda');
		}

		$this->template->title = "Agenda";
		$this->template->content = View::forge('agenda/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Agenda::validate('create');

			if ($val->run())
			{
				$agenda = Model_Agenda::forge(array(
					'idcliente' => Input::post('idcliente'),
					'last_call' => Input::post('last_call'),
					'next_call' => Input::post('next_call'),
					'last_visit' => Input::post('last_visit'),
					'next_visit' => Input::post('next_visit'),
					'send_info' => Input::post('send_info'),
					'observaciones' => Input::post('observaciones'),
				));

				if ($agenda and $agenda->save())
				{
					Session::set_flash('success', 'Added agenda #'.$agenda->id.'.');

					Response::redirect('agenda');
				}

				else
				{
					Session::set_flash('error', 'Could not save agenda.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Agendas";
		$this->template->content = View::forge('agenda/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('agenda');

		if ( ! $agenda = Model_Agenda::find($id))
		{
			Session::set_flash('error', 'Could not find agenda #'.$id);
			Response::redirect('agenda');
		}

		$val = Model_Agenda::validate('edit');

		if ($val->run())
		{
			$agenda->idcliente = Input::post('idcliente');
			$agenda->last_call = Input::post('last_call');
			$agenda->next_call = Input::post('next_call');
			$agenda->last_visit = Input::post('last_visit');
			$agenda->next_visit = Input::post('next_visit');
			$agenda->send_info = Input::post('send_info');
			$agenda->observaciones = Input::post('observaciones');

			if ($agenda->save())
			{
				Session::set_flash('success', 'Updated agenda #' . $id);

				Response::redirect('agenda');
			}

			else
			{
				Session::set_flash('error', 'Could not update agenda #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$agenda->idcliente = $val->validated('idcliente');
				$agenda->last_call = $val->validated('last_call');
				$agenda->next_call = $val->validated('next_call');
				$agenda->last_visit = $val->validated('last_visit');
				$agenda->next_visit = $val->validated('next_visit');
				$agenda->send_info = $val->validated('send_info');
				$agenda->observaciones = $val->validated('observaciones');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('agenda', $agenda, false);
		}

		$this->template->title = "Agendas";
		$this->template->content = View::forge('agenda/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('agenda');

		if ($agenda = Model_Agenda::find($id))
		{
			$agenda->delete();

			Session::set_flash('success', 'Deleted agenda #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete agenda #'.$id);
		}

		Response::redirect('agenda');

	}

}
