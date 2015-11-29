<?php
class Controller_Personal extends Controller_Template
{
	/*public function action_index()
	{
		$data['personals'] = Model_Personal::find('all');
		$this->template->title = "Personal del cliente";
		$this->template->content = View::forge('personal/index', $data);
	}*/

    public function action_index($idcliente)
    {
        if(is_null($idcliente)){
            $idcliente = $_POST['idcliente'];
        }

        $contactos = Model_Personal::find('all',array("where"=>array("idcliente"=>$idcliente)));

        if (count($contactos)>0){
            $data["idcliente"] = $idcliente;
            $data["contactos"] = $contactos;
            $data["message"] = "TODO OK.";
        }
        else{
            $data["idcliente"] = $idcliente;
            $data["message"] = "ERROR.";
        }
        $content_type = array('Content-type'=>'application/json');
        return new \Response(json_encode($data),200,$content_type);
    }

    public function action_aaff()
    {
        $data['personals'] = Model_Personal::find('all',array('where' => array('relacion' => 5)));
        $this->template->title = "Personal del cliente";
        $this->template->content = View::forge('personal/index', $data);
    }

    public function action_list($idcliente = null)
    {
        is_null($idcliente) and Response::redirect('personal/index');

        if (!Model_Cliente::find($idcliente))
        {
            Session::set_flash('error', 'No se ha podido encontrar al cliente buscado.');
            Response::redirect('personal/index');
        }
        else {
            $nombre_cliente = Model_Cliente::find($idcliente)->get('nombre');

            $data['personal'] = Model_Personal::find('all', array('where' => array('idcliente' => $idcliente)));
            $data['nombre_cliente'] = $nombre_cliente;

            $this->template->title = "Listado de personal del cliente $nombre_cliente";
            $this->template->content = View::forge('personal/list', $data);
        }
    }

    public function action_listall(){
        $data['personal'] = Model_Personal::find('all',array('order_by'=>'id'));
        $this->template->title = "Listado de personal de todos los clientes";
        $this->template->content = View::forge('personal/listall', $data);
    }

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('personal/list');

		if ( ! $data['personal'] = Model_Personal::find($id))
		{
			Session::set_flash('error', 'No se ha podido encontrar al trabajador especificado.');
			Response::redirect('personal/list');
		}

		$this->template->title = "Personal";
		$this->template->content = View::forge('personal/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Personal::validate('create');

			if ($val->run())
			{
				$personal = Model_Personal::forge(array(
					'idcliente' => Input::post('idcliente'),
					'tratamiento' => Input::post('tratamiento'),
					'nombre' => Input::post('nombre'),
					'dni' => Input::post('dni'),
					'tlfno' => Input::post('tlfno'),
					'email' => Input::post('email'),
					'cargofuncion' => Input::post('cargofuncion'),
					'relacion' => Input::post('relacion'),
				));

				if ($personal and $personal->save()){
					Session::set_flash('success', 'Añadido nuevo trabajador al sistema.');
					Response::redirect('personal/listall');
				}
				else{
					Session::set_flash('error', 'No se pudo almacenar los datos del trabajador.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
        $data["clientes"] = Model_Cliente::find('all',array('order_by'=>'nombre'));
        $data["relaciones"] = Model_Relacion::find('all',array('order_by'=>'nombre'));

		$this->template->title = "Alta de Personal";
		$this->template->content = View::forge('personal/create',$data);
	}

    public function action_associate($idcliente){
        if (Input::method() == 'POST'){
         //TODO: create new relation
        }
        else {
            $data['personal'] = Model_Personal::find('all');
            $data['idcliente'] = $idcliente;
            $data['nombre'] = Model_Cliente::find($idcliente)->get('nombre');
        }
        $this->template->title = "Asociar persona al cliente";
        $this->template->content = View::forge('personal/associate', $data);
    }

    public function action_create_in_costumer($idcliente)
    {
        if (Input::method() == 'POST')
        {
            $val = Model_Personal::validate('create');

            if ($val->run())
            {
                $personal = Model_Personal::forge(array(
                    'idcliente' => Input::post('idcliente'),
                    'tratamiento' => Input::post('tratamiento'),
                    'nombre' => Input::post('nombre'),
                    'dni' => Input::post('dni'),
                    'tlfno' => Input::post('tlfno'),
                    'email' => Input::post('email'),
                    'cargofuncion' => Input::post('cargofuncion'),
                    'relacion' => Input::post('relacion'),
                ));

                if ($personal and $personal->save())
                {
                    Session::set_flash('success', 'Añadido nuevo trabajador al sistema.');
                    Response::redirect('personal/list');
                }
                else
                {
                    Session::set_flash('error', 'No se pudo almacenar los datos del trabajador.');
                }
            }
            else
            {
                Session::set_flash('error', $val->error());
            }
        }
        $data["clientes"][0] = Model_Cliente::find($idcliente);
        $data["relaciones"] = Model_Relacion::find('all',array('order_by'=>'nombre'));

        $this->template->title = "Alta de Personal";
        $this->template->content = View::forge('personal/create_in_costumer',$data);
    }

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('personal/list');

		if ( ! $personal = Model_Personal::find($id))
		{
			Session::set_flash('error', 'No se ha podido encontrar al trabajador especificado');
			Response::redirect('personal/list');
		}

		$val = Model_Personal::validate('edit');

		if ($val->run())
		{
			$personal->idcliente = Input::post('idcliente');
			$personal->tratamiento = Input::post('tratamiento');
			$personal->nombre = Input::post('nombre');
			$personal->dni = Input::post('dni');
			$personal->tlfno = Input::post('tlfno');
			$personal->email = Input::post('email');
			$personal->cargofuncion = Input::post('cargofuncion');
			$personal->relacion = Input::post('relacion');

			if ($personal->save()){
				Session::set_flash('success', 'Datos del trabajador actualizados');
				Response::redirect('personal/listall');
			}
			else{
				Session::set_flash('error', 'No se han podido actualizar los datos del trabajador.');
			}
		}
		else{
			if (Input::method() == 'POST')
			{
				$personal->idcliente = $val->validated('idcliente');
				$personal->tratamiento = $val->validated('tratamiento');
				$personal->nombre = $val->validated('nombre');
				$personal->dni = $val->validated('dni');
				$personal->tlfno = $val->validated('tlfno');
				$personal->email = $val->validated('email');
				$personal->cargofuncion = $val->validated('cargofuncion');
				$personal->relacion = $val->validated('relacion');
				Session::set_flash('error', $val->error());
			}
			$this->template->set_global('personal', $personal, false);
		}
        $data["clientes"] = Model_Cliente::find('all',array('order_by'=>'nombre'));
        $data["relaciones"] = Model_Relacion::find('all',array('order_by'=>'nombre'));

		$this->template->title = "Personal";
		$this->template->content = View::forge('personal/edit',$data);
	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('personal/list');

		if ($personal = Model_Personal::find($id)){
			$personal->delete();
			Session::set_flash('success', 'Trabajador borrado del sistema.');
		}
		else{
			Session::set_flash('error', 'No se ha podido borrar al trabajado especificado.');
		}
		Response::redirect('personal/list');
	}

    public function action_contactos($idcliente){
        if(is_null($idcliente)){
            $idcliente = $_POST['idcliente'];
        }

        $contactos = Model_Personal::find('all',array("where"=>array("idcliente"=>$idcliente)));

        if (count($contactos)>0){
            $data["idcliente"] = $idcliente;
            $data["contactos"] = $contactos;
            $data["message"] = "TODO OK.";
        }
        else{
            $data["idcliente"] = $idcliente;
            $data["message"] = "ERROR.";
        }
        $content_type = array('Content-type'=>'application/json');
        return new \Response(json_encode($data),200,$content_type);
    }

    public function action_getRepLegal($idcliente = null)
    {
        if(is_null($idcliente)) $idcliente = $_POST['idcliente'];
        $tipo_cliente = Model_Cliente::find($idcliente)->get('tipo');

        //communities are diferent on this
        if($tipo_cliente==6){
            //Look for its aaff
            $rel_aaff = Model_Rel_Comaaff::find('first',array('where'=>array('idcom'=>$idcliente)));
            $rep_legal = Model_Personal::find('first',array('where'=>array('idcliente'=>$rel_aaff->idaaff,'relacion'=>1)));
        }
        else{
            $rep_legal = Model_Personal::find('first',array('where'=>array('idcliente'=>$idcliente,'relacion'=>1)));
        }

        if ($rep_legal != null){
            $data["id"] = $rep_legal->id;
            $data["nombre"] = $rep_legal->nombre;
            $data["cargo"] = $rep_legal->cargofuncion;
            $data["message"] = "TODO OK.";
        }
        else{
            $data["idcliente"] = $idcliente;
            $data["message"] = "ERROR.";
        }
        $content_type = array('Content-type'=>'application/json');
        return new \Response(json_encode($data),200,$content_type);
    }
}
