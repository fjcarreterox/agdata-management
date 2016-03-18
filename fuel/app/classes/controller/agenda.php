<?php
class Controller_Agenda extends Controller_Template
{
	public function action_index(){ //only visits and audits
		//$data['agendas'] = Model_Agenda::find('all',array('where'=>array('tipo'=>1),'order_by'=>array('fecha'=>'desc','hora'=>'desc')));
		$data['agendas'] = Model_Agenda::find('all',array('where'=>array(array('tipo' => '1'), // <-- note the array
            'or' => array('tipo' => '3')),'order_by'=>array('fecha'=>'asc','hora'=>'asc')));

        $data['title'] = "Gestión de visitas y calendario";
        $data['calendar'] = 1;
        $data['intro'] = "Gestión y control de visitas, tanto para clientes como para posibles clientes.";
        $data['void'] = Model_Agenda::find('all',array('where'=>array('tipo'=>0),'order_by'=>array('fecha'=>'asc','hora'=>'asc')));

		$this->template->title = "Agenda de visitas";
		$this->template->content = View::forge('agenda/index', $data);
	}

    public function action_calendar(){
        $eventos = Model_Agenda::find('all',array('where'=>array(array('tipo'=>1),'or'=>array(array('tipo' ,'>', '2')))));
        foreach($eventos as $e){
            $cliente_name = "";
            if($e->idcliente != 0){$cliente_name = Model_Cliente::find($e->idcliente)->get('nombre');}
            $data['eventos'][$e->id] = array(
                "fecha" => $e->fecha,
                "hora" => $e->hora,
                "tipo" => $e->tipo,
                "idcliente" => $e->idcliente,
                "cliente" => $cliente_name,
                "obs" => $e->observaciones
            );
        }
        $data['default_date'] = date("Y-m-d",time());
        $this->template->title = "Calendario de visitas";
        $this->template->content = View::forge('agenda/calendar', $data);
    }

    public function action_usercal($iduser){
        $eventos = Model_Agenda::find('all',array('where'=>array(array(array('tipo'=>1),'or'=>array('tipo' ,'>', '2')))));

        foreach($eventos as $e){
            if($e->iduser == $iduser) {
                $cliente_name = "";
                if($e->idcliente != 0){$cliente_name = Model_Cliente::find($e->idcliente)->get('nombre');}
                $data['eventos'][$e->id] = array(
                    "fecha" => $e->fecha,
                    "hora" => $e->hora,
                    "tipo" => $e->tipo,
                    "idcliente" => $e->idcliente,
                    "cliente" => $cliente_name,
                    "obs" => $e->observaciones
                );
            }
        }
        $data['default_date'] = date("Y-m-d",time());
        $data['cal_title'] = "Calendario propio para el usuario: ".Model_Usuario::find($iduser)->get('nombre');
        $this->template->title = "Calendario de visitas para el usuario ".Model_Usuario::find($iduser)->get('nombre');
        $this->template->content = View::forge('agenda/calendar', $data);
    }

    public function action_llamadas_comerciales() //only calls
    {
        $agenda = array();
        $entradas = Model_Agenda::find('all',array('where'=>array('tipo'=>2),'order_by'=>array('fecha'=>'asc','hora'=>'asc')));
        foreach($entradas as $e){
            if(Model_Cliente::find($e->idcliente)->get('estado')<3){
                $agenda[] = $e;
            }
        }
        $data['agendas'] = $agenda;
        $data['title'] = "Gestión de llamadas comerciales";
        $data['intro'] = "Creación y seguimiento diario de las llamadas comerciales realizadas a posibles clientes.";
        $data['calendar'] = 0;
        $data['void'] = Model_Agenda::find('all',array('where'=>array('tipo'=>0),'order_by'=>array('fecha'=>'desc','hora'=>'desc')));

        $this->template->title = "Gestión de llamadas";
        $this->template->content = View::forge('agenda/index', $data);
    }

    public function action_activos(){
        $agenda = array();
        $entradas = Model_Agenda::find('all');
        foreach($entradas as $e){
            if($e->idcliente == 0 || Model_Cliente::find($e->idcliente)->get('estado')==5 || //if active customer
                Model_Cliente::find($e->idcliente)->get('estado')==6){
                $agenda[] = $e;
            }
        }
        $data['agendas'] = $agenda;
        $data['title'] = "Gestión de eventos para clientes activos";
        $data['intro'] = "Llamadas y visitas de clientes activos en el sistema.";
        $data['calendar'] = 1;
        $data['void'] = Model_Agenda::find('all',array('where'=>array('tipo'=>0),'order_by'=>array('fecha'=>'desc','hora'=>'desc')));

        $this->template->title = "Gestión de llamadas y visitas";
        $this->template->content = View::forge('agenda/activos', $data);
    }

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('agenda');

		if ( ! $data['agenda'] = Model_Agenda::find($id)){
			Session::set_flash('error', 'No se ha encontrado el evento buscado en la Agenda');
			Response::redirect('agenda');
		}

		$this->template->title = "Ver detalle del evento de la Agenda";
		$this->template->content = View::forge('agenda/view', $data);
	}

    public function action_view_events($idcliente = null)
    {
        is_null($idcliente) and Response::redirect('agenda');

        if ( ! $data['agendas'] = Model_Agenda::find('all', array('where'=>array('idcliente'=>$idcliente)))){
            Session::set_flash('error', 'No se han encontrado los eventos del cliente buscado en la Agenda');
            Response::redirect('agenda');
        }
        $data["title"] = "Eventos relacionados con el cliente: ".Model_Cliente::find($idcliente)->get("nombre");
        $data["calendar"] = 0;
        $data["void"] = array();

        $this->template->title = "Ver detalle del evento de la Agenda";
        $this->template->content = View::forge('agenda/index', $data);
    }

    public function action_create_asunto(){
        if (Input::method() == 'POST'){
            $val = Model_Agenda::validate('create');

            if ($val->run()){
                $agenda = Model_Agenda::forge(array(
                    'idcliente' => 0,
                    'tipo' => 4,
                    'fecha' => Input::post('fecha'),
                    'hora' => Input::post('hora'),
                    'send_info' => 0,
                    'observaciones' => Input::post('observaciones'),
                    'iduser' => Input::post('iduser'),
                ));

                if ($agenda and $agenda->save()){
                    Session::set_flash('success', 'Añadadido nuevo asunto propio a la Agenda.');
                    Response::redirect('agenda/activos');
                }
                else{
                    Session::set_flash('error', 'No se ha podido crear el asunto propio en la Agenda.');
                }
            }else{
                Session::set_flash('error', $val->error());
            }
        }

        $data['users'] = Model_Usuario::find('all');
        $this->template->title = "Crear nuevo asunto propio en la Agenda";
        $this->template->content = View::forge('agenda/create_asunto',$data);
    }

	public function action_create($idcliente = null)
	{
		if (Input::method() == 'POST'){
			$val = Model_Agenda::validate('create');

			if ($val->run()){
				if($idcliente != null){$id=$idcliente;}
				else{$id=Input::post('idcliente');}
				$agenda = Model_Agenda::forge(array(
						'idcliente' => $id,
						'tipo' => Input::post('tipo'),
						'fecha' => Input::post('fecha'),
						'hora' => Input::post('hora'),
						'send_info' => Input::post('send_info'),
						'observaciones' => Input::post('observaciones'),
						'iduser' => Input::post('iduser'),
				));

				if ($agenda and $agenda->save()){
					Session::set_flash('success', 'Añadadido nuevo evento a la Agenda.');
                    $observ ="";
                    $c = Model_Cliente::find($agenda->idcliente);
                    $observ = $c->get('observ');
                    $observ .= "\n- (".date('d-m-Y').") ".$agenda->observaciones;
                    $c->observ = $observ;
                    $c->save();

					if($agenda->tipo == 1)
						Response::redirect('agenda');
					else
						Response::redirect('agenda/llamadas_comerciales');
				}
				else{
					Session::set_flash('error', 'No se ha podido crear el evento en la Agenda.');
				}
			}else{
				Session::set_flash('error', $val->error());
			}
		}
		if($idcliente != null){
			$data["clientes"][] = Model_Cliente::find($idcliente);
		}
		else{
			$data["clientes"] = Model_Cliente::find('all',array('where'=>array(array('estado','<',4)),'order_by'=>'nombre'));
		}
        $data['users'] = Model_Usuario::find('all');
		$this->template->title = "Crear nuevo evento en la Agenda";
		$this->template->content = View::forge('agenda/create',$data);
	}

    public function action_create_activo($idcliente = null)
    {
        if (Input::method() == 'POST'){
            $val = Model_Agenda::validate('create');

            if ($val->run()){
                if($idcliente != null){$id=$idcliente;}
                else{$id=Input::post('idcliente');}
                $agenda = Model_Agenda::forge(array(
                    'idcliente' => $id,
                    'tipo' => Input::post('tipo'),
                    'fecha' => Input::post('fecha'),
                    'hora' => Input::post('hora'),
                    'send_info' => Input::post('send_info'),
                    'observaciones' => Input::post('observaciones'),
                    'iduser' => Input::post('iduser'),
                ));

                if ($agenda and $agenda->save()){
                    Session::set_flash('success', 'Añadadido nuevo evento a la Agenda.');
                    $observ ="";
                    $c = Model_Cliente::find($agenda->idcliente);
                    $observ = $c->get('observ');
                    $observ .= "\n- (".date('d-m-Y').") ".$agenda->observaciones;
                    $c->observ = $observ;
                    $c->save();
                    Response::redirect('agenda/activos');
                }
                else{
                    Session::set_flash('error', 'No se ha podido crear el evento en la Agenda.');
                }
            }else{
                Session::set_flash('error', $val->error());
            }
        }
        if($idcliente != null){
            $data["clientes"][] = Model_Cliente::find($idcliente);
        }
        else{
            $data["clientes"] = Model_Cliente::find('all',array('where'=>array(array('estado'=>5),'or'=>array('estado' =>6)),'order_by'=>'nombre'));
        }
        $data['users'] = Model_Usuario::find('all');
        $this->template->title = "Crear nuevo evento en la Agenda para clientes activos";
        $this->template->content = View::forge('agenda/create',$data);
    }

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('agenda');

		if ( ! $agenda = Model_Agenda::find($id)){
			Session::set_flash('error', 'No se ha podido crear el evento para la Agenda.');
			Response::redirect('agenda');
		}

		$val = Model_Agenda::validate('edit');

		if ($val->run()){
			$agenda->idcliente = Input::post('idcliente');
			$agenda->tipo = Input::post('tipo');
			$agenda->fecha = Input::post('fecha');
			$agenda->hora = Input::post('hora');
			$agenda->send_info = Input::post('send_info');
			$agenda->observaciones = Input::post('observaciones');
			$agenda->iduser = Input::post('iduser');

			if ($agenda->save()){
				Session::set_flash('success', 'Evento actualizado en la Agenda');
                $observ ="";
                $c = Model_Cliente::find($agenda->idcliente);
                $observ = $c->get('observ');
                $observ .= "\n- (".date('d-m-Y').") ".$agenda->observaciones;
                $c->observ = $observ;
                $c->save();

                if($c->estado == 5 || $c->estado == 6){
                    Response::redirect('agenda/activos');
                }
                else {
                    if ($agenda->tipo == 1)
                        Response::redirect('agenda');
                    else
                        Response::redirect('agenda/llamadas_comerciales');
                }
			}
			else{
				Session::set_flash('error', 'No se ha podido actualizar el evento solicitado en la Agenda.');
			}
		}
		else{
			if (Input::method() == 'POST')
			{
				$agenda->idcliente = $val->validated('idcliente');
				$agenda->tipo = $val->validated('tipo');
				$agenda->fecha = $val->validated('fecha');
				$agenda->hora = $val->validated('hora');
				$agenda->send_info = $val->validated('send_info');
				$agenda->observaciones = $val->validated('observaciones');
				$agenda->iduser = $val->validated('iduser');

				Session::set_flash('error', $val->error());
			}
			$this->template->set_global('agenda', $agenda, false);
		}
        $data["clientes"][] = Model_Cliente::find($agenda->idcliente);
        $data['users'] = Model_Usuario::find('all');
		$this->template->title = "Editando evento de la Agenda";
		$this->template->content = View::forge('agenda/edit',$data);
	}

	public function action_delete($id = null){
		is_null($id) and Response::redirect('agenda');
        $agenda = Model_Agenda::find($id);
        $tipo = $agenda->tipo;
		if ($agenda){
			$agenda->delete();
			Session::set_flash('success', 'Se ha borrado el evento solicitado de la Agenda');
		}
		else{
			Session::set_flash('error', 'No se ha podido borrar el evento solicitado.');
		}
        if($tipo == 1 || $tipo == 3) //visits or audits
            Response::redirect('agenda');
        else
            Response::redirect('agenda/llamadas_comerciales');
	}
}