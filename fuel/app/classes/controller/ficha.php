<?php
class Controller_Ficha extends Controller_Template
{

	public function action_index()
	{
        \Fuel\Core\Response::redirect('clientes');
	}

	public function action_view($idcliente = null)
	{
		is_null($idcliente) and Response::redirect('ficha');

		if ( ! $data['ficha'] = Model_Ficha::find('first',$idcliente)){
			Session::set_flash('error', 'No se ha podido localizar la ficha de cliente solicitada.');
			Response::redirect('clientes');
		}

		$this->template->title = "Ficha de cliente";
		$this->template->content = View::forge('ficha/view', $data);
	}

	public function action_create($idcliente)
	{
        is_null($idcliente) and Response::redirect('clientes');

		if (Input::method() == 'POST'){
			$val = Model_Ficha::validate('create');

			if ($val->run()){
				$ficha = Model_Ficha::forge(array(
					'idcliente' => Input::post('idcliente'),
					'movil_contacto' => Input::post('movil_contacto'),
					'email_contacto' => Input::post('email_contacto'),
					'otras_sedes' => Input::post('otras_sedes'),
					'num_trabajadores' => Input::post('num_trabajadores'),
					'num_equipos' => Input::post('num_equipos'),
					'fecha_bienvenida' => Input::post('fecha_bienvenida'),
					'fecha_auditoria' => Input::post('fecha_auditoria'),
					'iban' => Input::post('iban'),
				));

				if ($ficha and $ficha->save()){
					Session::set_flash('success', 'Nueva ficha de cliente añadida al sistema.');
					Response::redirect('clientes/view/'.$idcliente);
				}else{
					Session::set_flash('error', 'No se ha podido almacenar la ficha de cliente.');
				}
			}
			else{
				Session::set_flash('error', $val->error());
			}
		}
        else{
            $data['idcliente'] = $idcliente;
        }

		$this->template->title = "Crear nueva ficha de cliente";
		$this->template->content = View::forge('ficha/create',$data);
	}

	public function action_edit($idcliente = null)
	{
		is_null($idcliente) and Response::redirect('clientes');

		if ( ! $ficha = Model_Ficha::find('first',array('where'=>array('idcliente'=>$idcliente)))){
			Session::set_flash('error', 'No se ha podido localizar la ficha de cliente solicitada.');
			Response::redirect('ficha');
		}

		$val = Model_Ficha::validate('edit');

		if ($val->run()){
			$ficha->idcliente = Input::post('idcliente');
			$ficha->movil_contacto = Input::post('movil_contacto');
			$ficha->email_contacto = Input::post('email_contacto');
			$ficha->otras_sedes = Input::post('otras_sedes');
			$ficha->num_trabajadores = Input::post('num_trabajadores');
			$ficha->num_equipos = Input::post('num_equipos');
			$ficha->fecha_bienvenida = Input::post('fecha_bienvenida');
			$ficha->fecha_auditoria = Input::post('fecha_auditoria');
			$ficha->iban = Input::post('iban');

			if ($ficha->save()){
				Session::set_flash('success', 'Ficha de cliente actualizada.');
				Response::redirect('clientes/view/'.$idcliente);
			}else{
				Session::set_flash('error', 'No se ha podido actualizar la ficha de cliente solicitada.');
			}
		}
		else{
			if (Input::method() == 'POST'){
				$ficha->idcliente = $val->validated('idcliente');
				$ficha->movil_contacto = $val->validated('movil_contacto');
				$ficha->email_contacto = $val->validated('email_contacto');
				$ficha->otras_sedes = $val->validated('otras_sedes');
				$ficha->num_trabajadores = $val->validated('num_trabajadores');
				$ficha->num_equipos = $val->validated('num_equipos');
				$ficha->fecha_bienvenida = $val->validated('fecha_bienvenida');
				$ficha->fecha_auditoria = $val->validated('fecha_auditoria');
				$ficha->iban = $val->validated('iban');
				Session::set_flash('error', $val->error());
			}
			$this->template->set_global('ficha', $ficha, false);
		}

		$this->template->title = "Datos específicos de la ficha de cliente";
		$this->template->content = View::forge('ficha/edit');
	}

	public function action_delete($id = null){
		is_null($id) and Response::redirect('ficha');

		if ($ficha = Model_Ficha::find($id)){
			$ficha->delete();
			Session::set_flash('success', 'Deleted ficha #'.$id);
		}else{
			Session::set_flash('error', 'Could not delete ficha #'.$id);
		}
		Response::redirect('ficha');
	}
}
