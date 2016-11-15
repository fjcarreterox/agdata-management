<?php
class Controller_Qevents extends Controller_Template{

	public function action_index(){
		$data['qevents'] = Model_Qevent::find('all');
		$this->template->title = "Qevents";
		$this->template->content = View::forge('qevents/index', $data);
	}

	public function action_view($id = null){
		is_null($id) and Response::redirect('qevents');

		if ( ! $data['qevent'] = Model_Qevent::find($id)){
			Session::set_flash('error', 'Could not find qevent #'.$id);
			Response::redirect('qevents');
		}

		$this->template->title = "Detalle de evento";
		$this->template->content = View::forge('qevents/view', $data);
	}

	public function action_create($idc){
		if (Input::method() == 'POST'){
			$val = Model_Qevent::validate('create');

			if ($val->run()){

				$qevent = Model_Qevent::forge(array(
					'idcustomer' => Input::post('idcustomer'),
					'type' => Input::post('type'),
					'target_audience' => Input::post('target_audience'),
					'date_time' => Input::post('date_time'),
					'location' => Input::post('location'),
					'broadcast' => Input::post('broadcast'),
					'resources' => Input::post('resources'),
					'complementary_services' => Input::post('complementary_services'),
					'observ' => Input::post('observ'),
				));

				if ($qevent and $qevent->save()){
					Session::set_flash('success', 'Añadida al sistema toda la información recogida sobre eventos');
					Response::redirect('clientes/view/'.$idc);
				}
				else{
					Session::set_flash('error', 'No se ha podido guardar los datos del cuestionario.');
				}
			}
			else{
				Session::set_flash('error', $val->error());
			}
		}
        $data["idc"] = $idc;
        $data["cname"] = Model_Cliente::find($idc)->get('nombre');

		$this->template->title = "Cuestionario para Eventos";
		$this->template->content = View::forge('qevents/create',$data);
	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('qevents');

		if ( ! $qevent = Model_Qevent::find($id))
		{
			Session::set_flash('error', 'Could not find qevent #'.$id);
			Response::redirect('qevents');
		}

		$val = Model_Qevent::validate('edit');

		if ($val->run())
		{
			$qevent->type = Input::post('type');
			$qevent->target_audience = Input::post('target_audience');
			$qevent->date_time = Input::post('date_time');
			$qevent->location = Input::post('location');
			$qevent->broadcast = Input::post('broadcast');
			$qevent->resources = Input::post('resources');
			$qevent->complementary_services = Input::post('complementary_services');
			$qevent->observ = Input::post('observ');

			if ($qevent->save()){
				Session::set_flash('success', 'Updated qevent #' . $id);
				Response::redirect('qevents');
			}
			else{
				Session::set_flash('error', 'Could not update qevent #' . $id);
			}
		}
		else{
			if (Input::method() == 'POST'){
				$qevent->type = $val->validated('type');
				$qevent->target_audience = $val->validated('target_audience');
				$qevent->date_time = $val->validated('date_time');
				$qevent->location = $val->validated('location');
				$qevent->broadcast = $val->validated('broadcast');
				$qevent->resources = $val->validated('resources');
				$qevent->complementary_services = $val->validated('complementary_services');
				$qevent->observ = $val->validated('observ');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('qevent', $qevent, false);
		}

		$this->template->title = "Qevents";
		$this->template->content = View::forge('qevents/edit');

	}

	public function action_delete($id = null)	{
		is_null($id) and Response::redirect('qevents');
		if ($qevent = Model_Qevent::find($id)){
			$qevent->delete();
			Session::set_flash('success', 'Deleted qevent #'.$id);
		}
		else{
			Session::set_flash('error', 'Could not delete qevent #'.$id);
		}
		Response::redirect('qevents');
	}

}
