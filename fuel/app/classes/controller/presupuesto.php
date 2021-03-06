<?php
class Controller_Presupuesto extends Controller_Template
{
	public function action_index()
	{
		$data['presupuestos'] = Model_Presupuesto::find('all');
		$this->template->title = "Presupuestos";
		$this->template->content = View::forge('presupuesto/index', $data);
	}

    public function action_doc($id = null)
    {
        is_null($id) and Response::redirect('presupuesto');

        if ( ! $data['presupuesto'] = Model_Presupuesto::find($id))
        {
            Session::set_flash('error', 'No se ha podido localizar el presupuesto solicitado.');
            Response::redirect('presupuesto');
        }
        $data['rel_servicios'] = Model_Rel_Presserv::find('all',array('where'=>array('idpres'=>$id)));

        $this->template->title = "Generación de nuevo presupuesto";
        $this->template->content = View::forge('presupuesto/doc', $data);
    }

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('presupuesto');

		if ( ! $data['presupuesto'] = Model_Presupuesto::find($id))
		{
			Session::set_flash('error', 'No se ha podido localizar el presupuesto solicitado.');
			Response::redirect('presupuesto');
		}
        $data['rel_servicios'] = Model_Rel_Presserv::find('all',array('where'=>array('idpres'=>$id)));

		$this->template->title = "Ver detalle del presupuesto";
		$this->template->content = View::forge('presupuesto/view', $data);
	}

	public function action_create($idcliente = null){
		if (Input::method() == 'POST'){
			$val = Model_Presupuesto::validate('create');

			if ($val->run())
			{
				$presupuesto = Model_Presupuesto::forge(array(
					'num_p' => Input::post('num_p'),
					'idcliente' => Input::post('idcliente'),
					'fecha_entrega' => Input::post('fecha_entrega'),
					'idestado' => Input::post('idestado'),
					'iduser' => Session::get('iduser'),
					'observaciones' => Input::post('observaciones'),
				));

				if ($presupuesto and $presupuesto->save())
				{
					Session::set_flash('success', 'Presupuesto creado en el sistema.');
					Response::redirect('rel/presserv/create/'.$presupuesto->id);
    			}else{
					Session::set_flash('error', 'No se ha podido generar el presupuesto.');
				}
			}
			else{
				Session::set_flash('error', $val->error());
			}
		}

        $data["servicios"] = Model_Servicio::find('all',array('order_by'=>'id'));
        $data["estados"] = Model_Estados_Presupuesto::find('all',array('order_by'=>'id'));
        $data["clientes"] = Model_Cliente::find('all',array('where'=>array('estado'=>3),'order_by'=>'id'));
        if($idcliente!=null){
            $data["idcliente"] = $idcliente;
        }
        $data["num_presupuesto"] = Model_Presupuesto::max('num_p');

		$this->template->title = "Presupuestos";
		$this->template->content = View::forge('presupuesto/create',$data);
	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('presupuesto');

		if ( ! $presupuesto = Model_Presupuesto::find($id)){
			Session::set_flash('error', 'No se ha podido localizar el presupuesto solicitado.');
			Response::redirect('presupuesto');
		}

		$val = Model_Presupuesto::validate('edit');

		if ($val->run())
		{
			$presupuesto->num_p = Input::post('num_p');
			$presupuesto->idcliente = Input::post('idcliente');
			$presupuesto->fecha_entrega = Input::post('fecha_entrega');
			$presupuesto->idestado = Input::post('idestado');
			$presupuesto->observaciones = Input::post('observaciones');

			if ($presupuesto->save()){
				Session::set_flash('success', 'Presupuesto Núm. ' . $presupuesto->num_p .' actualizado.');
				Response::redirect('presupuesto/view/'.$presupuesto->id);
			}
			else{
				Session::set_flash('error', 'No se ha podido actualizar el presupuesto Núm: ' . $presupuesto->num_p);
			}
		}
		else{
			if (Input::method() == 'POST')
			{
				$presupuesto->num_p = $val->validated('num_p');
				$presupuesto->idcliente = $val->validated('idcliente');
				$presupuesto->fecha_entrega = $val->validated('fecha_entrega');
				$presupuesto->idestado = $val->validated('idestado');
				$presupuesto->observaciones = $val->validated('observaciones');
				Session::set_flash('error', $val->error());
			}
			$this->template->set_global('presupuesto', $presupuesto, false);
		}
        $data["servicios"] = Model_Servicio::find('all',array('order_by'=>'id'));
        $data["clientes"][0] = Model_Cliente::find('first',array('where'=>array('id'=>$presupuesto->idcliente)));
        $data["estados"] = Model_Estados_Presupuesto::find('all',array('order_by'=>'id'));

        $this->template->title = "Editando presupuesto";
		$this->template->content = View::forge('presupuesto/edit',$data);

	}

	public function action_delete($id = null)	{
		is_null($id) and Response::redirect('presupuesto');

		if ($presupuesto = Model_Presupuesto::find($id)){
			$presupuesto->delete();
			Session::set_flash('success', 'Presupuesto borrado satisfactoriamente del sistema.');
		}
		else{
			Session::set_flash('error', 'No se ha podido borrar el presupuesto solicitado.');
		}
		Response::redirect('presupuesto');
	}
}
