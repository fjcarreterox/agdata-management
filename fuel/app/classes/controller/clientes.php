<?php
class Controller_Clientes extends Controller_Template
{
    public function action_index(){
        $data['clientes'] = Model_Cliente::find('all',array('order_by'=>'nombre'));
        $data['intro'] = "todos";
        $this->template->title = "Todos los clientes del sistema";
        $this->template->content = View::forge('clientes/index', $data);
    }

    public function action_activos(){
        $clientes = Model_Cliente::find('all', array(
            'where' => array(
                array('estado', 5),
                'or' => array(
                    array('estado', 6),
                ),
            ),
        ));

        $data['intro'] = "en activo";
        $data['clientes'] = $clientes;

        $this->template->title = "Clientes activos";
        $this->template->content = View::forge('clientes/index', $data);
    }

    public function action_doclopd(){

        if (Input::method() == 'POST'){
            $data['idcliente'] = Input::post('idcliente');

            $this->template->title = "Documentación LOPD";
            $this->template->content = View::forge('clientes/doclopd', $data);
        }
        else{
            $clientes = Model_Cliente::find('all', array(
                'where' => array(
                    array('estado', 5),
                    'or' => array(
                        array('estado', 6),
                    ),
                ),
                'order_by' => array('nombre' => 'asc')
            ));

            $data['clientes'] = $clientes;

            $this->template->title = "Documentación LOPD";
            $this->template->content = View::forge('clientes/doclopd', $data);
        }
    }

    public function action_adaptacion(){
        $data['clientes'] = Model_Cliente::find('all',array('where'=>array('estado'=>5)));
        $data['intro'] = "en proceso de adaptación a la LOPD";
        $this->template->title = "Clientes en proceso de adaptación a la LOPD";
        $this->template->content = View::forge('clientes/adaptacion', $data);
    }

    public function action_nointeresados(){
        $data['clientes'] = Model_Cliente::find('all',array('where'=>array('estado'=>4)));
        $data['intro'] = "No Interesados";
        $this->template->title = "Contactos aún no interesados";
        $this->template->content = View::forge('clientes/index', $data);
    }

    public function action_mantenimiento(){
        $data['clientes'] = Model_Cliente::find('all',array('where'=>array('estado'=>6,array('tipo','<>',6))));
        $data['intro'] = "en régimen de mantenimiento de la LOPD";
        $this->template->title = "Clientes en régimen de mantenimiento de la LOPD";
        $this->template->content = View::forge('clientes/index', $data);
    }

    public function action_com_mantenimiento(){
        $data['clientes'] = Model_Cliente::find('all',array('where'=>array('estado'=>6,'tipo'=>6)));
        $data['intro'] = "en régimen de mantenimiento de la LOPD";
        $this->template->title = "Clientes en régimen de mantenimiento de la LOPD";
        $this->template->content = View::forge('clientes/index', $data);
    }

    public function action_presupuestados(){
        $data['clientes'] = Model_Cliente::find('all',array('where'=>array('estado'=>3)));
        $this->template->title = "Clientes presupuestados";
        $this->template->content = View::forge('clientes/presupuestados', $data);
    }

    public function action_aaff(){
        $data['clientes'] = Model_Cliente::find('all',array('where'=>array('tipo'=>1)));
        $data['intro'] = "Administradores de fincas";
        $this->template->title = "Clientes activos";
        $this->template->content = View::forge('clientes/aaff', $data);
    }

    public function action_potenciales()
    {
        $data['clientes'] = Model_Cliente::find('all',array('where'=>array(array('estado','<',3))));
        $data['intro'] = "posibles clientes";
        $this->template->title = "Posibles Clientes";
        $this->template->content = View::forge('clientes/potenciales', $data);
    }

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('clientes');

		if ( ! $data['cliente'] = Model_Cliente::find($id))
		{
			Session::set_flash('error', 'No se ha podido localizar al cliente solicitado.');
			Response::redirect('clientes');
		}else {
            //Tipo comunidad
            if (Model_Cliente::find($id)->get('tipo') == 6) {
                $data['aaff'] = Model_Rel_Comaaff::find('all', array('where' => array('idcom' => $id)));
            }
            $data['presupuestos'] = Model_Presupuesto::find('all', array('where' => array('idcliente' => $id)));
            $data['ficha'] = Model_Ficha::find('first', array('where' => array('idcliente' => $id)));
            $data['adaptacion'] = Model_Adaptacion::find('first', array('where' => array('idcliente' => $id)));
            $data['ficheros'] = Model_Fichero::find('all', array('where' => array('idcliente' => $id)));
            $data['contrato'] = Model_Contrato::find('first', array('where' => array('idcliente' => $id)));
            $data['cesiones'] = Model_Cesione::find('all',array('where'=>array('idcliente'=>$id)));
            $data['contactos'] = Model_Personal::find('all',array('where'=>array('idcliente'=>$id)));
        }

		$this->template->title = "Ficha completa de cliente";
		$this->template->content = View::forge('clientes/view_panel', $data);
	}

    public function action_doc_cesion($idcliente = null,$idcesionaria = null)
    {
        is_null($idcliente) and Response::redirect('clientes');

        if ( ! $data['cliente'] = Model_Cliente::find($idcliente))
        {
            Session::set_flash('error', 'No se han podido localizar los datos del cliente solicitado.');
            Response::redirect('clientes');
        }else{
            //Tipo comunidad
            if(Model_Cliente::find($idcliente)->get('tipo')==6){
                $data['rel_aaffs'] = Model_Rel_Comaaff::find('all',array('where'=>array('idcom'=>$idcliente)));
            }
            else{
                $data['cesionaria'] = Model_Cliente::find($idcesionaria);
            }
        }
        $data['cesiones'] = Model_Cesione::find('all',array('where'=>array('idcliente'=>$idcliente,'idcesionaria'=>$idcesionaria)));

        $this->template->title = "Contrato de cesión de datos";
        $this->template->content = View::forge('clientes/doc_cesion', $data);
    }

    public function action_doc_seguridad($idcliente = null){

        is_null($idcliente) and Response::redirect('clientes');

        if ( ! $data['cliente'] = Model_Cliente::find($idcliente))
        {
            Session::set_flash('error', 'No se han podido localizar los datos del cliente solicitado.');
            Response::redirect('clientes');
        }else{
            //Tipo comunidad
            if(Model_Cliente::find($idcliente)->get('tipo')==6){
                $data['rels_aaff'] = Model_Rel_Comaaff::find('all',array('where'=>array('idcom'=>$idcliente)));
                $data['pres'] = Model_Personal::find('first',array('where'=>array('idcliente'=>$idcliente,'relacion'=>6)));
            }
        }
        $data["ficheros"] = Model_Fichero::find('all',array('where'=>array('idcliente'=>$idcliente)));

        $this->template->title = "Contrato de cesión de datos";
        $this->template->content = View::forge('clientes/doc_seguridad', $data);
    }

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Cliente::validate('create');

			if ($val->run())
			{
				$cliente = Model_Cliente::forge(array(
					'nombre' => Input::post('nombre'),
					'tipo' => Input::post('tipo'),
					'cif_nif' => Input::post('cif_nif'),
					'direccion' => Input::post('direccion'),
					'cpostal' => Input::post('cpostal'),
					'loc' => Input::post('loc'),
					'prov' => Input::post('prov'),
					'tel' => Input::post('tel'),
					'tel2' => Input::post('tel2'),
					'pweb' => Input::post('pweb'),
					'email' => Input::post('email'),
					'actividad' => Input::post('actividad'),
					'observ' => Input::post('observ'),
					'estado' => Input::post('estado'),
				));

				if ($cliente and $cliente->save()){
					Session::set_flash('success', 'Nuevo cliente añadido al sistema.');
					Response::redirect('clientes/view/'.$cliente->id);
				}
				else{
					Session::set_flash('error', 'No se ha podido crear el cliente. Inténtelo más tarde.');
				}
			}
			else{
				Session::set_flash('error', $val->error());
			}
		}
		$this->template->title = "Nuevo cliente";
		$this->template->content = View::forge('clientes/create');
	}

    public function action_edit($id = null)
    {
        is_null($id) and Response::redirect('clientes');

        if ( ! $cliente = Model_Cliente::find($id))
        {
            Session::set_flash('error', 'No se ha podido encontrar el cliente deseado.');
            Response::redirect('clientes');
        }

        $val = Model_Cliente::validate('edit');

        if ($val->run())
        {
            $cliente->nombre = Input::post('nombre');
            $cliente->tipo = Input::post('tipo');
            $cliente->cif_nif = Input::post('cif_nif');
            $cliente->direccion = Input::post('direccion');
            $cliente->cpostal = Input::post('cpostal');
            $cliente->loc = Input::post('loc');
            $cliente->prov = Input::post('prov');
            $cliente->tel = Input::post('tel');
            $cliente->tel2 = Input::post('tel2');
            $cliente->pweb = Input::post('pweb');
            $cliente->email = Input::post('email');
            $cliente->actividad = Input::post('actividad');
            $cliente->observ = Input::post('observ');
            $cliente->estado = Input::post('estado');

            if ($cliente->save()){
                $t = Model_Tarea::forge();
                if($cliente->estado == 5){ //creating adaptation tasks
                    if(!$t->existsAdapTasks($id)){
                        \Fuel\Core\Log::error("---CREATING ADAPT TASKS!!");
                        $t->createAdapTasks($id);
                    }
                }
                elseif($cliente->estado == 6){ //creating support tasks
                    if(!$t->existsSuppTasks($id)){
                        \Fuel\Core\Log::error("---CREATING SUPP TASKS!!");
                        $t->createSuppTasks($id);
                    }
                }
                Session::set_flash('success', 'Datos de cliente actualizados.');
                Response::redirect('clientes/view/'.$id);
            }
            else{
                Session::set_flash('error', 'No se han podido actualizar los datos del cliente.');
            }
        }
        else
        {
            if (Input::method() == 'POST')
            {
                $cliente->nombre = $val->validated('nombre');
                $cliente->tipo = $val->validated('tipo');
                $cliente->cif_nif = $val->validated('cif_nif');
                $cliente->direccion = $val->validated('direccion');
                $cliente->cpostal = $val->validated('cpostal');
                $cliente->loc = $val->validated('loc');
                $cliente->prov = $val->validated('prov');
                $cliente->tel = $val->validated('tel');
                $cliente->tel2 = $val->validated('tel2');
                $cliente->pweb = $val->validated('pweb');
                $cliente->email = $val->validated('email');
                $cliente->actividad = $val->validated('actividad');
                $cliente->observ = $val->validated('observ');
                $cliente->estado = $val->validated('estado');

                Session::set_flash('error', $val->error());
            }

            $this->template->set_global('cliente', $cliente, false);
        }
        $this->template->title = "Clientes";
        $this->template->content = View::forge('clientes/edit');
    }

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('clientes');

		if ($cliente = Model_Cliente::find($id)){
			$cliente->delete();
			Session::set_flash('success', 'Cliente borrado del sistema.');
		}
		else{
			Session::set_flash('error', 'No se ha podido eliminar el cliente solicitado.');
		}
		Response::redirect('clientes');
	}
}
