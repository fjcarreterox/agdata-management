<?php
class Controller_Estados_Presupuesto extends Controller_Template
{
	public function action_index()
	{
		$data['estados_presupuestos'] = Model_Estados_Presupuesto::find('all');
		$this->template->title = "Estados para presupuestos";
		$this->template->content = View::forge('estados/presupuesto/index', $data);
	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('estados/presupuesto');

		if ( ! $data['estados_presupuesto'] = Model_Estados_Presupuesto::find($id))
		{
			Session::set_flash('error', 'No se ha podido localizar el estado solicitado.');
			Response::redirect('estados/presupuesto');
		}

		$this->template->title = " Ver detalle del estados para presupuestos";
		$this->template->content = View::forge('estados/presupuesto/view', $data);
	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Estados_Presupuesto::validate('create');

			if ($val->run())
			{
				$estados_presupuesto = Model_Estados_Presupuesto::forge(array(
					'nombre' => Input::post('nombre'),
				));

				if ($estados_presupuesto and $estados_presupuesto->save()){
					Session::set_flash('success', 'Añadido el nuevo estado para presupuestos al sistema.');
					Response::redirect('estados/presupuesto');
				}else{
					Session::set_flash('error', 'No se ha podido almacenar el estado.');
				}
			}
			else{
				Session::set_flash('error', $val->error());
			}
		}
		$this->template->title = "Crear nuevo estado";
		$this->template->content = View::forge('estados/presupuesto/create');
	}

	public function action_edit($id = null){
		is_null($id) and Response::redirect('estados/presupuesto');

		if ( ! $estados_presupuesto = Model_Estados_Presupuesto::find($id))
		{
			Session::set_flash('error', 'No se ha podido localizar el estado solicitado.');
			Response::redirect('estados/presupuesto');
		}

		$val = Model_Estados_Presupuesto::validate('edit');

		if ($val->run())
		{
			$estados_presupuesto->nombre = Input::post('nombre');

			if ($estados_presupuesto->save())
			{
				Session::set_flash('success', 'Nombre del estado actualizado.');
				Response::redirect('estados/presupuesto');
			}
			else{
				Session::set_flash('error', 'No se ha podido actualizar el nombre del estado.');
			}
		}else{
			if (Input::method() == 'POST')
			{
				$estados_presupuesto->nombre = $val->validated('nombre');
				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('estados_presupuesto', $estados_presupuesto, false);
		}
    	$this->template->title = "Editar estado";
		$this->template->content = View::forge('estados/presupuesto/edit');
	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('estados/presupuesto');

		if ($estados_presupuesto = Model_Estados_Presupuesto::find($id))
		{
			$estados_presupuesto->delete();
			Session::set_flash('success', 'Borrado el estado solicitado.');
		}else{
			Session::set_flash('error', 'No se ha podido eliminar el estado solicitado.');
		}
		Response::redirect('estados/presupuesto');
	}
}
