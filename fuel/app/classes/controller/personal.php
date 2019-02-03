<?php
class Controller_Personal extends Controller_Template
{
    public function action_index($idcliente){
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

    public function action_aaff(){
        $data['personals'] = Model_Personal::find('all',array('where' => array('relacion' => 5)));
        $this->template->title = "Personal del cliente";
        $this->template->content = View::forge('personal/index', $data);
    }

    public function action_list($idcliente = null){
        is_null($idcliente) and Response::redirect('personal/index');

        if (!Model_Cliente::find($idcliente)){
            Session::set_flash('error', 'No se ha podido encontrar al cliente buscado.');
            Response::redirect('personal/listall');
        }
        else {
            $nombre_cliente = Model_Cliente::find($idcliente)->get('nombre');
            $data['personal'] = Model_Personal::find('all', array('where' => array('idcliente' => $idcliente)));
            $data['nombre_cliente'] = $nombre_cliente;
            $this->template->title = "Listado de personal del cliente $nombre_cliente";
            $this->template->content = View::forge('personal/listall', $data);
        }
    }

    public function action_listall(){
        $data['personal'] = Model_Personal::find('all',array('order_by'=>'id'));
        $this->template->title = "Listado de personal de todos los clientes";
        $this->template->content = View::forge('personal/listall', $data);
    }

	public function action_view($id = null){
		is_null($id) and Response::redirect('personal/listall');

		if ( ! $data['personal'] = Model_Personal::find($id)){
			Session::set_flash('error', 'No se ha podido encontrar al trabajador especificado.');
			Response::redirect('personal/listall');
		}

		$this->template->title = "Personal";
		$this->template->content = View::forge('personal/view', $data);
	}

	public function action_create($idcliente = null){

		if (Input::method() == 'POST'){
			$val = Model_Personal::validate('create');

			if ($val->run()){
				$personal = Model_Personal::forge(array(
					'idcliente' => Input::post('idcliente'),
					'tratamiento' => Input::post('tratamiento'),
					'nombre' => Input::post('nombre'),
					'dni' => Input::post('dni'),
					'tlfno' => Input::post('tlfno'),
					'email' => Input::post('email'),
					'cargofuncion' => Input::post('cargofuncion'),
					'relacion' => Input::post('relacion'),
					'access' => Input::post('access'),
					'fecha_alta' => Input::post('fecha_alta'),
					'fecha_baja' => Input::post('fecha_baja'),
				));

				if ($personal and $personal->save()){
					Session::set_flash('success', 'Añadido nuevo trabajador al sistema.');
					Response::redirect('clientes/view/'.$personal->idcliente);
				}
				else{
					Session::set_flash('error', 'No se pudo almacenar los datos del trabajador.');
				}
			}
			else{
				Session::set_flash('error', $val->error());
			}
		}
        if($idcliente == null) {
            $data["clientes"] = Model_Cliente::find('all', array('order_by' => 'nombre'));
            $data["title"] = "de cliente ";
        }
        else{
            $data["clientes"] = Model_Cliente::find('all', array('where'=>array('id'=>$idcliente),'order_by' => 'nombre'));
            $data["title"] = "para el cliente ".Model_Cliente::find($idcliente)->get('nombre');
        }

        $data["relaciones"] = Model_Relacion::find('all',array('order_by'=>'nombre'));

		$this->template->title = "Alta de nuevo Personal en el sistema";
		$this->template->content = View::forge('personal/create',$data);
	}

	public function action_edit($id = null){
		is_null($id) and Response::redirect('personal/listall');

		if ( ! $personal = Model_Personal::find($id)){
			Session::set_flash('error', 'No se ha podido encontrar al trabajador especificado');
			Response::redirect('personal/listall');
		}

		$val = Model_Personal::validate('edit');

		if ($val->run()){
			$personal->idcliente = Input::post('idcliente');
			$personal->tratamiento = Input::post('tratamiento');
			$personal->nombre = Input::post('nombre');
			$personal->dni = Input::post('dni');
			$personal->tlfno = Input::post('tlfno');
			$personal->email = Input::post('email');
			$personal->cargofuncion = Input::post('cargofuncion');
			$personal->relacion = Input::post('relacion');
			$personal->access = Input::post('access');
			$personal->fecha_alta = Input::post('fecha_alta');
			$personal->fecha_baja = Input::post('fecha_baja');

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
				$personal->access = $val->validated('access');
				$personal->fecha_alta = $val->validated('fecha_alta');
				$personal->fecha_baja = $val->validated('fecha_baja');
				Session::set_flash('error', $val->error());
			}
			$this->template->set_global('personal', $personal, false);
		}
        $data["clientes"] = Model_Cliente::find('all',array('order_by'=>'nombre'));
        $data["relaciones"] = Model_Relacion::find('all',array('order_by'=>'nombre'));

		$this->template->title = "Personal";
		$this->template->content = View::forge('personal/edit',$data);
	}

	public function action_delete($id = null){
		is_null($id) and Response::redirect('personal/listall');
        //TODO: this person appear on a contract? If so, put a zero in that field.
		if ($personal = Model_Personal::find($id)){
            $contracts = Model_Contrato::find('all',array('where'=>array('idpersonal'=>$id)));
            if(count($contracts)>0){
                foreach($contracts as $c){
                    //marked as not available. We need to associate another person instead.
                    $c->idpersonal=0;
                }
            }
            //$personal->delete();
			Session::set_flash('success', 'Trabajador borrado del sistema.');
		}
		else{
			Session::set_flash('error', 'No se ha podido borrar al trabajado especificado.');
		}
		Response::redirect('personal/listall');
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

    public function action_getRepLegal($idcliente = null){
        if(is_null($idcliente)) $idcliente = $_POST['idcliente'];
        $data = array();
        if($idcliente) {
            $tipo_cliente = Model_Cliente::find($idcliente)->get('tipo');
            $rep_legal[] = array();
            $rep_legal[] = Model_Personal::find('first', array('where' => array('idcliente' => $idcliente, 'relacion' => 1)));
            //communities and asociations are diferent on this
            if ($tipo_cliente == 6 || $tipo_cliente == 10) {
                //Look for its aaff
                if ($rel_aaff = Model_Rel_Comaaff::find('first', array('where' => array('idcom' => $idcliente)))) {
                    if (Model_Personal::find('first', array('where' => array('idcliente' => $rel_aaff->idaaff, 'relacion' => 1)))) {
                        $rep_legal[] = Model_Personal::find('first', array('where' => array('idcliente' => $rel_aaff->idaaff, 'relacion' => 1)));
                    }
                }
            }

            if (count($rep_legal) > 0) {
                foreach ($rep_legal as $i => $rep) {
                    if (count($rep) > 0) {
                        $data[$i]["id"] = $rep->id;
                        $data[$i]["nombre"] = $rep->nombre;
                        $data[$i]["cargo"] = $rep->cargofuncion;
                    }
                }
                $data["message"] = "TODO OK.";
            } else {
                $data["idcliente"] = $idcliente;
                $data["message"] = "ERROR.";
            }
        }
        $content_type = array('Content-type'=>'application/json');
        return new \Response(json_encode($data),200,$content_type);
    }
}