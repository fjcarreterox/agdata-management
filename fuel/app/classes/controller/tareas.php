<?php
class Controller_Tareas extends Controller_Template{

	public function action_index(){
		$data['tareas'] = Model_Tarea::find('all');
		$this->template->title = "Tareas";
		$this->template->content = View::forge('tareas/index', $data);
	}

    public function action_list($idcliente,$tipo=null){
        $task = Model_Tarea::forge();
        $data['tareas_adapt'] = array();
        $data['tareas_supp'] = array();
        if($tipo != null){
            if($tipo == 1){$data['tareas_adapt'] = $task->getAdapTasks($idcliente);}
            elseif($tipo == 2){$data['tareas_supp'] = $task->getSuppTasks($idcliente);}
        }
        else {
            $data['tareas_adapt'] = $task->getAdapTasks($idcliente);
            $data['tareas_supp'] = $task->getSuppTasks($idcliente);
        }

        $email_resp="NO DEFINIDO";
        $resp = Model_Personal::find('first',array('where'=>array('idcliente'=>$idcliente,'relacion'=>3)));
        if($resp != null){
            $email_resp = $resp->email;
        }

        $data['idcliente'] = $idcliente;
		$data['email_resp'] = $email_resp;

        $this->template->title = "Tareas del cliente seleccionado";
        $this->template->content = View::forge('tareas/list', $data);
    }

	public function action_view($id = null){
		is_null($id) and Response::redirect('tareas');

		if ( ! $data['tarea'] = Model_Tarea::find($id)){
			Session::set_flash('error', 'Could not find tarea #'.$id);
			Response::redirect('tareas');
		}

		$this->template->title = "Detalle de la tarea";
		$this->template->content = View::forge('tareas/view', $data);
	}

	public function action_create(){
		if (Input::method() == 'POST'){
			$val = Model_Tarea::validate('create');

			if ($val->run()){
				$tarea = Model_Tarea::forge(array(
					'idcliente' => Input::post('idcliente'),
					'idtipotarea' => Input::post('idtipotarea'),
					'fecha' => Input::post('fecha'),
					'fecha_respuesta' => Input::post('fecha_respuesta'),
					'comentario' => Input::post('comentario'),
				));

				if ($tarea and $tarea->save()){
					Session::set_flash('success', 'Added tarea #'.$tarea->id.'.');
					Response::redirect('tareas');
				}
				else{
					Session::set_flash('error', 'Could not save tarea.');
				}
			}
			else{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Crear una nueva tarea";
		$this->template->content = View::forge('tareas/create');
	}

	public function action_edit($id = null){
		is_null($id) and Response::redirect('tareas');

		if ( ! $tarea = Model_Tarea::find($id)){
			Session::set_flash('error', 'No se ha podido encontrar la tarea deseada.');
			Response::redirect('tareas');
		}

		$val = Model_Tarea::validate('edit');

		if ($val->run()){
			$tarea->idcliente = Input::post('idcliente');
			$tarea->idtipotarea = Input::post('idtipotarea');
			$tarea->fecha = Input::post('fecha');
			$tarea->fecha_respuesta = Input::post('fecha_respuesta');
			$tarea->comentario = Input::post('comentario');

			if ($tarea->save()){
				$serv=Model_Tipo_Tarea::find($tarea->idtipotarea)->get('tipo');
				Session::set_flash('success', 'Fecha actualizada para la tarea');
				Response::redirect('tareas/list/'.$tarea->idcliente.'/'.$serv);
			}
			else{
				Session::set_flash('error', 'No se ha podido actualizar la tarea deseada.');
			}
		}
		else{
			if (Input::method() == 'POST'){
				$tarea->idcliente = $val->validated('idcliente');
				$tarea->idtipotarea = $val->validated('idtipotarea');
				$tarea->fecha = $val->validated('fecha');
				$tarea->fecha_respuesta = $val->validated('fecha_respuesta');
				$tarea->comentario = $val->validated('comentario');
				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('tarea', $tarea, false);
		}

		$this->template->title = "Editar detalle de la tarea seleccionada";
		$this->template->content = View::forge('tareas/edit');
	}

	public function action_delete($id = null){
		is_null($id) and Response::redirect('tareas');

		if ($tarea = Model_Tarea::find($id)){
			$tarea->delete();
			Session::set_flash('success', 'Tarea borrada del sistema.');
		}
		else{
			Session::set_flash('error', 'No se ha podido borrar la tarea seleccionada.');
		}
		Response::redirect('tareas');
	}
}
