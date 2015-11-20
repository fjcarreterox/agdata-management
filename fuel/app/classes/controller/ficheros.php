<?php
class Controller_Ficheros extends Controller_Template
{
	public function action_index(){
		$data['ficheros'] = Model_Fichero::find('all');
		$this->template->title = "Ficheros de datos";
		$this->template->content = View::forge('ficheros/index', $data);
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
		if (Input::method() == 'POST')
		{
			$val = Model_Fichero::validate('create');

			if ($val->run())
			{
				$fichero = Model_Fichero::forge(array(
					'idtipo' => Input::post('idtipo'),
					'idcliente' => Input::post('idcliente'),
					'ubicacion' => Input::post('ubicacion'),
					'soporte' => Input::post('soporte'),
					'nivel' => Input::post('nivel'),
					'inscrito' => Input::post('inscrito'),
					'fecha' => Input::post('fecha'),
					'cesion' => Input::post('cesion'),
				));

				if ($fichero and $fichero->save()){
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
			$fichero->ubicacion = Input::post('ubicacion');
			$fichero->soporte = Input::post('soporte');
			$fichero->nivel = Input::post('nivel');
			$fichero->inscrito = Input::post('inscrito');
			$fichero->fecha = Input::post('fecha');
			$fichero->cesion = Input::post('cesion');

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
				$fichero->ubicacion = $val->validated('ubicacion');
				$fichero->soporte = $val->validated('soporte');
				$fichero->nivel = $val->validated('nivel');
				$fichero->inscrito = $val->validated('inscrito');
				$fichero->fecha = $val->validated('fecha');
				$fichero->cesion = $val->validated('cesion');

				Session::set_flash('error', $val->error());
			}
			$this->template->set_global('fichero', $fichero, false);
		}

        $data['tipos'] = Model_Tipo_Fichero::find('all');
        $data['idcliente'] = $fichero->idcliente;

		$this->template->title = "Editar datos de fichero de datos";
		$this->template->content = View::forge('ficheros/edit',$data);
	}

	public function action_delete($id = null){
		is_null($id) and Response::redirect('ficheros');

		if ($fichero = Model_Fichero::find($id)){
			$fichero->delete();
			Session::set_flash('success', 'Fichero de datos borrado del sistema.');
		}
		else{
			Session::set_flash('error', 'No se ha podido borrar el fichero de datos deseado.');
		}

		Response::redirect('ficheros');
	}
}
