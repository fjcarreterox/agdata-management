<?php
class Controller_Rel_Estructura extends Controller_Template
{

	public function action_index()
	{
		$data['rel_estructuras'] = Model_Rel_Estructura::find('all');
		$this->template->title = "Rel_estructuras";
		$this->template->content = View::forge('rel/estructura/index', $data);

	}

	public function action_view($id = null){
		is_null($id) and Response::redirect('rel/estructura');

		if ( ! $data['rel_estructura'] = Model_Rel_Estructura::find($id)){
			Session::set_flash('error', 'No se ha podido localizar la asociación deseada.');
			Response::redirect('rel/estructura');
		}

		$this->template->title = "Detalle de la asociación";
		$this->template->content = View::forge('rel/estructura/view', $data);
	}

	public function action_data($idfichero = null){
		is_null($idfichero) and Response::redirect('rel/estructura');

		$data['estructura'] = Model_Rel_Estructura::find('all',array('where'=>array('idfichero'=>$idfichero)));
        $data['tipofichero']=Model_Fichero::find($idfichero)->get('idtipo');
        $data['idcliente']=Model_Fichero::find($idfichero)->get('idcliente');
        $data['idfichero']=$idfichero;

		$this->template->title = "Estructura del fichero seleccionado";
		$this->template->content = View::forge('rel/estructura/view_all', $data);
	}

	public function action_create($idfichero = null)
	{
		if (Input::method() == 'POST'){
			$val = Model_Rel_Estructura::validate('create');

			if ($val->run()){
				$rel_estructura = Model_Rel_Estructura::forge(array(
					'idfichero' => Input::post('idfichero'),
					'idtipodato' => Input::post('idtipodato'),
				));

				if ($rel_estructura and $rel_estructura->save()){
					Session::set_flash('success', 'Nuevo tipo añadido a la estructura.');
					Response::redirect('rel/estructura/data/'.$rel_estructura->idfichero);
				}
				else{
					Session::set_flash('error', 'Could not save rel_estructura.');
				}
			}
			else{
				Session::set_flash('error', $val->error());
			}
		}
        $data["datos"] = Model_Tipo_Dato::find('all',array('order_by'=>'tipo'));
        $data["idfichero"] = $idfichero;

		$this->template->title = "Rel_Estructuras";
		$this->template->content = View::forge('rel/estructura/create',$data);

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('rel/estructura');

		if ( ! $rel_estructura = Model_Rel_Estructura::find($id))
		{
			Session::set_flash('error', 'Could not find rel_estructura #'.$id);
			Response::redirect('rel/estructura');
		}

		$val = Model_Rel_Estructura::validate('edit');

		if ($val->run())
		{
			$rel_estructura->idfichero = Input::post('idfichero');
			$rel_estructura->idtipodato = Input::post('idtipodato');

			if ($rel_estructura->save())
			{
				Session::set_flash('success', 'Updated rel_estructura #' . $id);

				Response::redirect('rel/estructura');
			}

			else
			{
				Session::set_flash('error', 'Could not update rel_estructura #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$rel_estructura->idfichero = $val->validated('idfichero');
				$rel_estructura->idtipodato = $val->validated('idtipodato');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('rel_estructura', $rel_estructura, false);
		}

		$this->template->title = "Rel_estructuras";
		$this->template->content = View::forge('rel/estructura/edit');

	}

	public function action_delete($id = null){
		is_null($id) and Response::redirect('rel/estructura');

		if ($rel_estructura = Model_Rel_Estructura::find($id)){
			$rel_estructura->delete();
			Session::set_flash('success', 'Relación estructural (fichero - dato) borrada.');
			Response::redirect('rel/estructura/data/'.$rel_estructura->idfichero);
		}
		else{
			Session::set_flash('error', 'No se ha podido borrar la relación señalada.');
            Response::redirect('404');
		}
	}
}
