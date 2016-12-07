<?php
class Controller_Clientes extends Controller_Template
{
    public function action_index(){
        $data['clientes'] = Model_Cliente::find('all',array('order_by'=>'nombre'));
        $data['intro'] = "todos";
        $this->template->title = "Todos los clientes del sistema";
        $this->template->content = View::forge('clientes/index', $data);
    }

    public function action_new_pass($idc){
        $c = Model_Cliente::find($idc);
        $data['idc'] = $idc;
        $email = "";
        $data['name'] = $c->get('nombre');
        if ($c->get('email') != "") {
            $email = $c->get('email');
        }
        $data['email'] = $email;
        if (Input::method() == 'POST') {
            if(Input::post('pass1') != Input::post('pass2')){
                Session::set_flash('error', 'Las contraseñas no coinciden. Por favor, vuelve a introducir otra.');
                Response::redirect('clientes/new_pass',$data);
            }
            else{
                $c->password = md5(Input::post('pass1'));
                if($c->save()){Session::set_flash('success', 'Contraseña actualizada en el sistema.');}
                else{Session::set_flash('error', 'Se ha producido un error al establecer la contraseña. Inténtalo más tarde.');}
                Response::redirect('clientes/view/'.$idc);
            }
        } else {

        }
        $this->template->title = "Cambio de contraseña del área interna de cliente";
        $this->template->content = View::forge('clientes/new_pass', $data);
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
            $idcliente = Input::post('idcliente');
            if($idcliente==0){
                Session::set_flash('error', 'Por favor, selecciona un cliente válido.');
                Response::redirect('clientes/doclopd');
            }

            $data['idcliente'] = $idcliente;
            $data['name'] = Model_Cliente::find($idcliente)->get('nombre');
            $data['type'] = Model_Cliente::find($idcliente)->get('tipo');

            $cesiones = Model_Cesione::find('all',array('where'=>array('idcliente'=>$idcliente)));
            $cesionaria = 0;
            foreach($cesiones as $c){
                if($cesionaria != $c->idcesionaria){
                    $cesionaria = $c->idcesionaria;
                    $data['cesiones'][] = $c;
                }
            }
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
        }
        $this->template->title = "Documentación LOPD";
        $this->template->content = View::forge('clientes/doclopd', $data);
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
        $this->template->content = View::forge('clientes/nointeresados', $data);
    }

    public function action_mantenimiento(){
        $data['clientes'] = Model_Cliente::find('all',array('where'=>array('estado'=>6,array('tipo','<>',6))));
        $data['intro'] = "en régimen de mantenimiento de la LOPD";
        $this->template->title = "Clientes en régimen de mantenimiento de la LOPD";
        $this->template->content = View::forge('clientes/mantenimiento', $data);
    }

    public function action_filter($idtype){

        switch($idtype){
            case 1:
                $data['intro'] = "en proceso de adaptación a la LOPD";
                $this->template->title = "Clientes en proceso de adaptación a la LOPD";
                break;
            case 2:
                $data['intro'] = "en régimen de mantenimiento de la LOPD";
                $this->template->title = "Clientes en régimen de mantenimiento de la LOPD";
                break;
            case 3: //gest
                break;
            case 4: //blog
                $data['intro'] = "servicio de gestión de blogs";
                $this->template->title = "Clientes con servicio de blogs";
                break;
            case 5: //social
                $data['intro'] = "servicio de gestión de Redes Sociales";
                $this->template->title = "Clientes con servicio de Redes Sociales";
                break;
            case 6: //design
                $data['intro'] = "servicio de diseño";
                $this->template->title = "Clientes con servicio de diseño";
                break;
            case 7: //event
                $data['intro'] = "servicio de gestión de eventos";
                $this->template->title = "Clientes con servicio de gestión de eventos";
                break;
        }
        $data["clientes"] = array();
        $servs = Model_Servicios_Contratado::find('all',array('where'=>array('idtipo_servicio'=>$idtype)));
        foreach($servs as $s){
            $contract= Model_Contrato::find($s->idcontrato);
            if (Model_Cliente::find($contract->idcliente) != null) {
                $data["clientes"][] = Model_Cliente::find($contract->idcliente);
            }
        }
        $this->template->content = View::forge('clientes/filter', $data);
    }

    public function action_nointeresados(){
        $data['clientes'] = Model_Cliente::find('all',array('where'=>array('estado'=>4)));
        $data['intro'] = "No Interesados";
        $this->template->title = "Contactos aún no interesados";
        $this->template->content = View::forge('clientes/nointeresados', $data);
    }

    public function action_tareas_mantenimiento($idcliente,$idcontrato=null){

        if($idcontrato == null) {
            $data['contratos'] = Model_Contrato::find('all', array('where' => array('idcliente' => $idcliente)));
        }
        else{
            $data['contrato'] = Model_Contrato::find($idcontrato);
        }
        $data['nombre'] = Model_Cliente::find($idcliente)->get('nombre');
        $data['idcliente'] = $idcliente;
        $this->template->title = "Tareas de mantenimiento del cliente";
        $this->template->content = View::forge('clientes/tareas', $data);
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
            //Tipo comunidad / asociación
            $type = Model_Cliente::find($id)->get('tipo');
            if ($type == 6 || $type == 10) {
                $data['aaff'] = Model_Rel_Comaaff::find('all', array('where' => array('idcom' => $id)));
            }
            $data['presupuestos'] = Model_Presupuesto::find('all', array('where' => array('idcliente' => $id)));
            $data['adaptacion'] = Model_Adaptacion::find('first', array('where' => array('idcliente' => $id)));
            $data['ficheros'] = Model_Fichero::find('all', array('where' => array('idcliente' => $id)));
            $data['contratos'] = Model_Contrato::find('all', array('where' => array('idcliente' => $id)));
            $data['cesiones'] = Model_Cesione::find('all',array('where'=>array('idcliente'=>$id)));
            $data['contactos'] = Model_Personal::find('all',array('where'=>array('idcliente'=>$id)));
            $data['grupossedes'] = Model_Gruposede::find('all',array('where'=>array('idcliente'=>$id)));
        }

		$this->template->title = "Ficha completa de cliente";
		$this->template->content = View::forge('clientes/view_panel', $data);
	}

    public function action_doc_cesion($idcliente = null,$idcesionaria = null)
    {
        is_null($idcliente) and Response::redirect('clientes');

        if ( ! $data['cliente'] = Model_Cliente::find($idcliente)){
            Session::set_flash('error', 'No se han podido localizar los datos del cliente solicitado.');
            Response::redirect('clientes');
        }else{
            $data['cesionaria'] = Model_Cliente::find($idcesionaria);
        }
        $data['cesiones'] = Model_Cesione::find('all',array('where'=>array('idcliente'=>$idcliente,'idcesionaria'=>$idcesionaria)));

        $this->template->title = "Contrato de cesión de datos";
        $this->template->content = View::forge('clientes/doc_cesion', $data);
    }

    public function action_doc_seguridad($idcliente = null){

        is_null($idcliente) and Response::redirect('clientes');

        $type = Model_Cliente::find($idcliente)->get('tipo');

        if ( ! $data['cliente'] = Model_Cliente::find($idcliente)){
            Session::set_flash('error', 'No se han podido localizar los datos del cliente solicitado.');
            Response::redirect('clientes');
        }else{
            //Tipo comunidad / asociación
            if($type == 6 || $type == 10){
                $data['rels_aaff'] = Model_Rel_Comaaff::find('all',array('where'=>array('idcom'=>$idcliente)));
                $data['pres'] = Model_Personal::find('first',array('where'=>array('idcliente'=>$idcliente,'relacion'=>6)));
            }
            else{
                $data['personal'] = Model_Personal::find('first',array('where'=>array('idcliente'=>$idcliente,'relacion'=>6)));
                $data['cesiones'] = Model_Cesione::find('all',array('where'=>array('idcliente'=>$idcliente)));
            }
        }
        $data['trabajadores'] = Model_Personal::find('all',array('where'=>array('idcliente'=>$idcliente,'relacion'=>4)));
        $data["ficheros"] = Model_Fichero::find('all',array('where'=>array('idcliente'=>$idcliente)));

        $this->template->title = "Documento de seguridad";
        $this->template->content = View::forge('clientes/doc_seguridad', $data);
    }

    public function action_clausula_empleados($idcliente = null){

        is_null($idcliente) and Response::redirect('clientes');

        if ( ! $data['cliente'] = Model_Cliente::find($idcliente)){
            Session::set_flash('error', 'No se han podido localizar los datos del cliente solicitado.');
            Response::redirect('clientes');
        }else{
            $data['trabajadores'] = Model_Personal::find('all',array('where'=>array('idcliente'=>$idcliente,'relacion'=>4)));
        }

        $this->template->title = "Cláusulas legales de empleados";
        $this->template->content = View::forge('clientes/clausula_empleados', $data);
    }

	public function action_create(){
		if (Input::method() == 'POST')
		{
			$val = Model_Cliente::validate('create');

			if ($val->run()){
				$cliente = Model_Cliente::forge(array(
					'nombre' => Input::post('nombre'),
					'tipo' => Input::post('tipo'),
					'cif_nif' => Input::post('cif_nif'),
					'iban' => Input::post('iban'),
					'direccion' => Input::post('direccion'),
					'cpostal' => Input::post('cpostal'),
					'loc' => Input::post('loc'),
					'prov' => Input::post('prov'),
					'tel' => Input::post('tel'),
					'tel2' => Input::post('tel2'),
					'pweb' => Input::post('pweb'),
					'num_trab' => Input::post('num_trab'),
					'email' => Input::post('email'),
					'actividad' => Input::post('actividad'),
					'observ' => Input::post('observ'),
					'estado' => Input::post('estado'),
					'idsituacion' => Input::post('idsituacion'),
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

    public function action_edit($id = null){
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
            $cliente->iban = Input::post('iban');
            $cliente->direccion = Input::post('direccion');
            $cliente->cpostal = Input::post('cpostal');
            $cliente->loc = Input::post('loc');
            $cliente->prov = Input::post('prov');
            $cliente->tel = Input::post('tel');
            $cliente->tel2 = Input::post('tel2');
            $cliente->pweb = Input::post('pweb');
            $cliente->num_trab = Input::post('num_trab');
            $cliente->email = Input::post('email');
            $cliente->actividad = Input::post('actividad');
            $cliente->observ = Input::post('observ');
            $cliente->estado = Input::post('estado');
            $cliente->idsituacion = Input::post('idsituacion');

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
        else{
            if (Input::method() == 'POST'){
                $cliente->nombre = $val->validated('nombre');
                $cliente->tipo = $val->validated('tipo');
                $cliente->cif_nif = $val->validated('cif_nif');
                $cliente->iban = $val->validated('iban');
                $cliente->direccion = $val->validated('direccion');
                $cliente->cpostal = $val->validated('cpostal');
                $cliente->loc = $val->validated('loc');
                $cliente->prov = $val->validated('prov');
                $cliente->tel = $val->validated('tel');
                $cliente->tel2 = $val->validated('tel2');
                $cliente->pweb = $val->validated('pweb');
                $cliente->num_trab = $val->validated('num_trab');
                $cliente->email = $val->validated('email');
                $cliente->actividad = $val->validated('actividad');
                $cliente->observ = $val->validated('observ');
                $cliente->estado = $val->validated('estado');
                $cliente->idsituacion = $val->validated('idsituacion');

                Session::set_flash('error', $val->error());
            }

            $this->template->set_global('cliente', $cliente, false);
        }
        $this->template->title = "Editar ficha de clientes";
        $this->template->content = View::forge('clientes/edit');
    }

	public function action_delete($id = null){
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
