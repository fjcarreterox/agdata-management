<?php
class Controller_Rel_Comconts extends Controller_Template
{

	public function action_index()
	{
		$data['rel_comconts'] = Model_Rel_Comcont::find('all');
		$this->template->title = "Rel_comconts";
		$this->template->content = View::forge('rel/comconts/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('rel/comconts');

		if ( ! $data['rel_comcont'] = Model_Rel_Comcont::find($id))
		{
			Session::set_flash('error', 'Could not find rel_comcont #'.$id);
			Response::redirect('rel/comconts');
		}

		$this->template->title = "Rel_comcont";
		$this->template->content = View::forge('rel/comconts/view', $data);

	}

	public function action_create($idc = null)
	{
		$com = Model_Cliente::find($idc);
		if (Input::method() == 'POST')
		{
			$val = Model_Rel_Comcont::validate('create');

			if ($val->run())
			{
				$rel_comcont = Model_Rel_Comcont::forge(array(
					'idcom' => Input::post('idcom'),
					'idcontrata' => Input::post('idcontrata'),
					'servicio' => Input::post('servicio'),
					'fechaenvio' => Input::post('fechaenvio'),
				));

				if ($rel_comcont and $rel_comcont->save()) {
					Session::set_flash('success', 'Añadida una nueva contrata: #'.$rel_comcont->id.'.');
                    Response::redirect('clientes/view/'.$idc);
				}

				else
				{
					Session::set_flash('error', 'No se ha podido almancenar la relación en el sistema.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		$data['cname'] = $com->nombre;
        $data['idc']=$idc;
		$this->template->title = "Relación entre Comunidades y contratas";
		$this->template->content = View::forge('rel/comconts/create',$data);

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('rel/comconts');

		if ( ! $rel_comcont = Model_Rel_Comcont::find($id))
		{
			Session::set_flash('error', 'No se ha encontrado la relación: #'.$id);
			Response::redirect('/');
		}

		$val = Model_Rel_Comcont::validate('edit');

		if ($val->run())
		{
			$rel_comcont->idcom = Input::post('idcom');
			$rel_comcont->idcontrata = Input::post('idcontrata');
			$rel_comcont->servicio = Input::post('servicio');
			$rel_comcont->fechaenvio = Input::post('fechaenvio');

			if ($rel_comcont->save())
			{
				Session::set_flash('success', 'Información actualizada: #' . $id);
				Response::redirect('clientes/view/'.$rel_comcont->idcom);
			}
			else
			{
				Session::set_flash('error', 'Could not update rel_comcont #' . $id);
			}
		}
		else
		{
			if (Input::method() == 'POST')
			{
				$rel_comcont->idcom = $val->validated('idcom');
				$rel_comcont->idcontrata = $val->validated('idcontrata');
				$rel_comcont->servicio = $val->validated('servicio');
				$rel_comcont->fechaenvio = $val->validated('fechaenvio');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('rel_comcont', $rel_comcont, false);
		}
        $data['cname']=Model_Cliente::find($rel_comcont->idcom)->get('nombre');
        $data['idc']=$rel_comcont->idcom;
		$this->template->title = "Edición de relacion entre C.PP y contratas";
		$this->template->content = View::forge('rel/comconts/edit',$data);

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('rel/comconts');

		if ($rel_comcont = Model_Rel_Comcont::find($id))
		{
			$rel_comcont->delete();

			Session::set_flash('success', 'Relación borrada del sistema: #'.$id);
		}

		else
		{
			Session::set_flash('error', 'No se ha podido eliminar la relación: #'.$id);
		}

		Response::redirect('clientes/view/'.$rel_comcont->idcom);

	}

    public function action_update_date($id = null)
    {
        is_null($id) and Response::redirect('/');

        if ($rel_comcont = Model_Rel_Comcont::find($id)) {
            $idc = $rel_comcont->get('idcom');
            $rel_comcont->fechaenvio = date('Y-m-d');
            if ($rel_comcont->save()) {
                Session::set_flash('success', 'Fecha de envío actualizada a fecha de hoy: #' . $id);
            } else {
                Session::set_flash('error', 'No se ha podido actualizar la fecha de envío del informe C.A.E.: #' . $id);
            }
        }
        Response::redirect('clientes/view/'.$idc);
    }
}
