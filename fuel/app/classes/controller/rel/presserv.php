<?php
class Controller_Rel_Presserv extends Controller_Template
{

	public function action_index()
	{
		$data['rel_presservs'] = Model_Rel_Presserv::find('all');
		$this->template->title = "Rel_presservs";
		$this->template->content = View::forge('rel/presserv/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('rel/presserv');

		if ( ! $data['rel_presserv'] = Model_Rel_Presserv::find($id))
		{
			Session::set_flash('error', 'Could not find rel_presserv #'.$id);
			Response::redirect('rel/presserv');
		}

		$this->template->title = "Rel_presserv";
		$this->template->content = View::forge('rel/presserv/view', $data);
	}

	public function action_create($idpres)
	{
		if (Input::method() == 'POST'){
			$val = Model_Rel_Presserv::validate('create');

			if ($val->run()){
				$rel_presserv = Model_Rel_Presserv::forge(array(
					'idpres' => Input::post('idpres'),
					'idserv' => Input::post('idserv'),
					'precio' => Input::post('precio'),
				));

				if ($rel_presserv and $rel_presserv->save()){
					Session::set_flash('success', 'Asociado nuevo servicio al presupuesto.');
					Response::redirect('presupuesto/view/'.$rel_presserv->idpres);
				}
				else{
					Session::set_flash('error', 'Could not save rel_presserv.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
        $data["servicios"] = Model_Servicio::find('all',array('order_by'=>'id'));
        $data['idpres'] = $idpres;

		$this->template->title = "Rel_Presservs";
		$this->template->content = View::forge('rel/presserv/create',$data);

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('rel/presserv');

		if ( ! $rel_presserv = Model_Rel_Presserv::find($id))
		{
			Session::set_flash('error', 'Could not find rel_presserv #'.$id);
			Response::redirect('rel/presserv');
		}

		$val = Model_Rel_Presserv::validate('edit');

		if ($val->run())
		{
			$rel_presserv->idpres = Input::post('idpres');
			$rel_presserv->idserv = Input::post('idserv');
			$rel_presserv->precio = Input::post('precio');

			if ($rel_presserv->save())
			{
				Session::set_flash('success', 'Updated rel_presserv #' . $id);

				Response::redirect('rel/presserv');
			}

			else
			{
				Session::set_flash('error', 'Could not update rel_presserv #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$rel_presserv->idpres = $val->validated('idpres');
				$rel_presserv->idserv = $val->validated('idserv');
				$rel_presserv->precio = $val->validated('precio');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('rel_presserv', $rel_presserv, false);
		}

		$this->template->title = "Rel_presservs";
		$this->template->content = View::forge('rel/presserv/edit');

	}

	public function action_delete($id = null){
		is_null($id) and Response::redirect('rel/presserv');

		if ($rel_presserv = Model_Rel_Presserv::find($id)){
			$rel_presserv->delete();
			Session::set_flash('success', 'Asociación de servicio borrada del presupuesto.');
		}
		else{
			Session::set_flash('error', 'No se ha podido eliminar el servicio del presupuesto.');
		}
		Response::redirect('presupuesto/view/'.$rel_presserv->idpres);
	}
}
