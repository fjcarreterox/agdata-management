<?php
class Controller_Ficheros extends Controller_Template
{
	public function action_index(){
		$data['ficheros'] = Model_Fichero::find('all');
		$this->template->title = "Ficheros de datos";
		$this->template->content = View::forge('ficheros/index', $data);
	}

	public function action_list(){
		$data['ficheros'] = Model_Fichero::find('all',array('order_by'=>'idcliente'));
		$this->template->title = "Listado completo de ficheros de datos";
		$this->template->content = View::forge('ficheros/list', $data);
	}

    public function action_viewall($idcliente){
		if(Session::get('idrol')==3 && strcmp(Session::get('iduser'),$idcliente)!=0){
			return \Fuel\Core\Response::redirect('welcome/not_found');
		}
        else{
            $data['ficheros'] = Model_Fichero::find('all',array('where'=>array('idcliente'=>$idcliente)));
            $this->template->title = "Ficheros de datos del cliente seleccionado";
            $data['cliente'] = Model_Cliente::find($idcliente)->get('nombre');
            $this->template->content = View::forge('ficheros/viewall', $data);
        }
    }

	public function action_view($id = null){
		is_null($id) and Response::redirect('ficheros');

		if ( ! $data['fichero'] = Model_Fichero::find($id))
		{
			Session::set_flash('error', 'No se ha podido encontrar el fichero deseado.');
			Response::redirect('ficheros');
		}

		$this->template->title = "Detalle de fichero de datos";
		$this->template->content = View::forge('ficheros/view', $data);
	}

	public function action_create($idcliente){

		if (Input::method() == 'POST'){
			$val = Model_Fichero::validate('create');

			if ($val->run())
			{
				$fichero = Model_Fichero::forge(array(
					'idtipo' => Input::post('idtipo'),
					'idcliente' => Input::post('idcliente'),
					'soporte' => Input::post('soporte'),
					'nivel' => Input::post('nivel'),
					'base' => Input::post('base'),
					'origen' => Input::post('origen'),
					'recogida' => Input::post('recogida'),
					'trans' => Input::post('trans')
				));

				if ($fichero and $fichero->save()){
					foreach(Input::post('estructura') as $dato){
						$estructura = Model_Rel_Estructura::forge(array(
											'idfichero' => $fichero->id,
											'idtipodato' => $dato
										));
						$estructura->save();
					}
					Session::set_flash('success', 'Nuevo fichero de datos añadido al sistema.');
					Response::redirect('clientes/view/'.$idcliente);
				}
				else{
					Session::set_flash('error', 'No se ha podido crear el nuevo fichero de datos.');
				}
			}
			else{
				Session::set_flash('error', $val->error());
			}
		}

        $nombre = Model_Cliente::find($idcliente)->get('nombre');

        $data['tipos'] = Model_Tipo_Fichero::find('all');
        $data['nombre'] = $nombre;
        $data['idcliente'] = $idcliente;
		$data['datos'] = Model_Tipo_Dato::find('all');

		$this->template->title = "Crear un nuevo fichero de datos";
		$this->template->content = View::forge('ficheros/create',$data);
	}

	public function action_edit($id = null){
		is_null($id) and Response::redirect('ficheros');

		if ( ! $fichero = Model_Fichero::find($id)){
			Session::set_flash('error', 'No se ha podido encontrar el fichero deseado.');
			Response::redirect('ficheros');
		}

		$val = Model_Fichero::validate('edit');

		if ($val->run()){
			$fichero->idtipo = Input::post('idtipo');
			$fichero->idcliente = Input::post('idcliente');
			$fichero->soporte = Input::post('soporte');
			$fichero->nivel = Input::post('nivel');
			$fichero->base = Input::post('base');
			$fichero->origen = Input::post('origen');
			$fichero->recogida = Input::post('recogida');
			$fichero->trans = Input::post('trans');

			if ($fichero->save()){
				Session::set_flash('success', 'Fichero de datos actualizado.');
				Response::redirect('ficheros/view/'.$fichero->id);
			}
			else{
				Session::set_flash('error', 'No ha sido posible actualizar el fichero de datos.');
			}
		}
		else{
			if (Input::method() == 'POST')
			{
				$fichero->idtipo = $val->validated('idtipo');
				$fichero->idcliente = $val->validated('idcliente');
				$fichero->soporte = $val->validated('soporte');
				$fichero->nivel = $val->validated('nivel');
				$fichero->base = $val->validated('base');
				$fichero->origen = $val->validated('origen');
				$fichero->recogida = $val->validated('recogida');
				$fichero->trans = $val->validated('trans');

				Session::set_flash('error', $val->error());
			}
			$this->template->set_global('fichero', $fichero, false);
		}

        $data['tipos'] = Model_Tipo_Fichero::find('all');
        $data['idcliente'] = $fichero->idcliente;
		$data['datos'] = array();

		$this->template->title = "Editar datos de fichero de datos";
		$this->template->content = View::forge('ficheros/edit',$data);
	}

	public function action_delete($id = null){
		is_null($id) and Response::redirect('ficheros');

		if ($fichero = Model_Fichero::find($id)){
			$fichero->delete();
			Session::set_flash('success', 'Fichero de datos borrado del sistema.');
			Response::redirect('clientes/view/'.$fichero->idcliente);
		}
		else{
			Session::set_flash('error', 'No se ha podido borrar el fichero de datos deseado.');
            Response::redirect('welcome');
		}
	}
}
