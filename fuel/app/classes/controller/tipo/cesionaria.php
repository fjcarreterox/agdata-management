<?php
class Controller_Tipo_Cesionaria extends Controller_Template
{
	public function action_index(){
		$data['tipo_cesionaria'] = Model_Tipo_Cesionaria::find('all');
		$this->template->title = "Tipo_cesionaria";
		$this->template->content = View::forge('tipo/cesionaria/index', $data);
	}

	public function action_view($id = null)	{
		is_null($id) and Response::redirect('tipo/cesionaria');

		if ( ! $data['tipo_cesionarium'] = Model_Tipo_Cesionaria::find($id))
		{
			Session::set_flash('error', 'Could not find tipo_cesionarium #'.$id);
			Response::redirect('tipo/cesionaria');
		}

		$this->template->title = "Tipo_cesionarium";
		$this->template->content = View::forge('tipo/cesionaria/view', $data);
	}

	public function action_create(){
		if (Input::method() == 'POST'){
			$val = Model_Tipo_Cesionaria::validate('create');

			if ($val->run()){
				$tipo_cesionarium = Model_Tipo_Cesionaria::forge(array(
					'nombre' => Input::post('nombre'),
				));

				if ($tipo_cesionarium and $tipo_cesionarium->save()){
					Session::set_flash('success', 'Agregada al sistema correctamente.');
					Response::redirect('tipo/cesionaria');
				}
				else{
					Session::set_flash('error', 'No se ha podido registrar un nuevo tipo de empresa en el sistema');
				}
			}
			else{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Crear nuevo tipo de empresa cesionaria";
		$this->template->content = View::forge('tipo/cesionaria/create');
	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('tipo/cesionaria');

		if ( ! $tipo_cesionarium = Model_Tipo_Cesionaria::find($id))
		{
			Session::set_flash('error', 'Could not find tipo_cesionarium #'.$id);
			Response::redirect('tipo/cesionaria');
		}

		$val = Model_Tipo_Cesionaria::validate('edit');

		if ($val->run())
		{
			$tipo_cesionarium->nombre = Input::post('nombre');

			if ($tipo_cesionarium->save())
			{
				Session::set_flash('success', 'Updated tipo_cesionarium #' . $id);

				Response::redirect('tipo/cesionaria');
			}

			else
			{
				Session::set_flash('error', 'Could not update tipo_cesionarium #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$tipo_cesionarium->nombre = $val->validated('nombre');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('tipo_cesionarium', $tipo_cesionarium, false);
		}

		$this->template->title = "Tipo_cesionaria";
		$this->template->content = View::forge('tipo/cesionaria/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('tipo/cesionaria');

		if ($tipo_cesionarium = Model_Tipo_Cesionaria::find($id))
		{
			$tipo_cesionarium->delete();

			Session::set_flash('success', 'Deleted tipo_cesionarium #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete tipo_cesionarium #'.$id);
		}

		Response::redirect('tipo/cesionaria');

	}

}
