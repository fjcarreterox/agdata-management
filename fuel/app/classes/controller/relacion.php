<?php
class Controller_Relacion extends Controller_Template
{
	public function action_index()
	{
		$data['relacions'] = Model_Relacion::find('all');
		$this->template->title = "Relaciones cliente/AGDATA";
		$this->template->content = View::forge('relacion/index', $data);
	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('relacion');

		if ( ! $data['relacion'] = Model_Relacion::find($id))
		{
			Session::set_flash('error', 'No se encontró el tipo de relación buscada.');
			Response::redirect('relacion');
		}
		$this->template->title = "Detalle del tipo de relación";
		$this->template->content = View::forge('relacion/view', $data);
	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Relacion::validate('create');

			if ($val->run())
			{
				$relacion = Model_Relacion::forge(array(
					'nombre' => Input::post('nombre'),
				));

				if ($relacion and $relacion->save())
				{
					Session::set_flash('success', 'Tipo de relación añadida.');
					Response::redirect('relacion');
    			}
				else{
					Session::set_flash('error', 'No se ha podido guardar el tipo de relación.');
				}
			}
			else{
				Session::set_flash('error', $val->error());
			}
		}
		$this->template->title = "Tipos de relaciones cliente/AGDATA";
		$this->template->content = View::forge('relacion/create');
	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('relacion');

		if ( ! $relacion = Model_Relacion::find($id))
		{
			Session::set_flash('error', 'No se ha encontrado el tipo de relación buscado.');
			Response::redirect('relacion');
		}

		$val = Model_Relacion::validate('edit');

		if ($val->run())
		{
			$relacion->nombre = Input::post('nombre');

			if ($relacion->save()){
				Session::set_flash('success', 'Tipo de relación actualizada');
				Response::redirect('relacion');
			}else{
				Session::set_flash('error', 'No se ha podido actualizar el tipo de relación.');
			}
		}
		else{
			if (Input::method() == 'POST')
			{
				$relacion->nombre = $val->validated('nombre');
				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('relacion', $relacion, false);
		}

		$this->template->title = "Tipos de relaciones cliente/AGDATA";
		$this->template->content = View::forge('relacion/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('relacion');

		if ($relacion = Model_Relacion::find($id))
		{
			$relacion->delete();
			Session::set_flash('success', 'Tipo de relación borrado.');
		}
		else{
			Session::set_flash('error', 'No se ha podido borrar el tipo de relación solicitado.');
		}
		Response::redirect('relacion');
	}
}
