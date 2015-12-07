<?php
class Controller_Rel_Comaaff extends Controller_Template
{
    /* Private helpers */
    public function is_associated($idcom){
        $res = false;
        if(Model_Rel_Comaaff::find('all',array('where'=>array('idcom'=>$idcom)))){
            $res = true;
        }
        return $res;
    }

	public function action_index(){
		$data['rel_comaaffs'] = Model_Rel_Comaaff::find('all');
		$this->template->title = "Rel_comaaffs";
		$this->template->content = View::forge('rel/comaaff/index', $data);
	}

    public function action_comunidades($idaaff){
        $data['comunidades'] = Model_Rel_Comaaff::find('all',array('where'=>array('idaaff'=>$idaaff)));
        $nombre = Model_Cliente::find($idaaff)->get('nombre');
        $data['nombre'] = $nombre;
        $data['idaaff'] = $idaaff;

        $this->template->title = "Comunidades gestionadas por $nombre";
        $this->template->content = View::forge('clientes/comunidades', $data);
    }

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('rel/comaaff');

		if ( ! $data['rel_comaaff'] = Model_Rel_Comaaff::find($id))
		{
			Session::set_flash('error', 'Could not find rel_comaaff #'.$id);
			Response::redirect('rel/comaaff');
		}

		$this->template->title = "Rel_comaaff";
		$this->template->content = View::forge('rel/comaaff/view', $data);

	}

	public function action_create($idcom){

        is_null($idcom) and Response::redirect('welcome/index');

		if (Input::method() == 'POST'){
			$val = Model_Rel_Comaaff::validate('create');

			if ($val->run()){
				$rel_comaaff = Model_Rel_Comaaff::forge(array(
					'idcom' => Input::post('idcom'),
					'idaaff' => Input::post('idaaff'),
				));

				if ($rel_comaaff and $rel_comaaff->save()){
					Session::set_flash('success', 'Añadida nueva relación entre comunidad y administrador de fincas.');
					Response::redirect('clientes/view/'.$idcom);
				}
				else{
					Session::set_flash('error', 'No se ha podido crear la relación entre comunidad y administrador de fincas.');
				}
			}
			else{
				Session::set_flash('error', $val->error());
			}
		}
        $nombre = Model_Cliente::find($idcom)->get('nombre');

        $data['nombre'] = $nombre;
        $data['idcom'] = $idcom;

		$this->template->title = "Gestión de comunidades: asociar administrador";
		$this->template->content = View::forge('rel/comaaff/create',$data);

	}

    public function action_addcom($idaaff){

        is_null($idaaff) and Response::redirect('welcome/index');

        if (Input::method() == 'POST'){
            $val = Model_Rel_Comaaff::validate('create');

            if ($val->run()){
                $rel_comaaff = Model_Rel_Comaaff::forge(array(
                    'idcom' => Input::post('idcom'),
                    'idaaff' => Input::post('idaaff'),
                ));

                /*if(!$this->is_associated($rel_comaaff->idcom)) {*/
                    if ($rel_comaaff and $rel_comaaff->save()) {
                        Session::set_flash('success', 'Añadida nueva relación entre comunidad y adminitrador de fincas.');
                        Response::redirect('rel/comaaff/comunidades/' . $idaaff);
                    } else {
                        Session::set_flash('error', 'No se ha podido crear la relación entre comunidad y administrador de fincas.');
                    }
                /*}
                else{
                    Session::set_flash('error', 'La comunidad elegida ya se encuentra asociada a éste o a otro administrador. Por favor, elige otra comunidad de propietarios.');
                }*/
            }
            else{
                Session::set_flash('error', $val->error());
            }
        }
        $nombre = Model_Cliente::find($idaaff)->get('nombre');

        $data['nombre'] = $nombre;
        $data['idaaff'] = $idaaff;

        $this->template->title = "Gestión de comunidades: asociar comunidad";
        $this->template->content = View::forge('rel/comaaff/addcom',$data);

    }

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('rel/comaaff');

		if ( ! $rel_comaaff = Model_Rel_Comaaff::find($id))
		{
			Session::set_flash('error', 'Could not find rel_comaaff #'.$id);
			Response::redirect('rel/comaaff');
		}

		$val = Model_Rel_Comaaff::validate('edit');

		if ($val->run()){
			$rel_comaaff->idcom = Input::post('idcom');
			$rel_comaaff->idaaff = Input::post('idaaff');

			if ($rel_comaaff->save()){
				Session::set_flash('success', 'Asociación de administrador de fincas actualizada');
				Response::redirect('clientes/view/'.$rel_comaaff->idcom);
			}
			else{
				Session::set_flash('error', 'Could not update rel_comaaff #' . $id);
			}
		}
		else{
			if (Input::method() == 'POST')
			{
				$rel_comaaff->idcom = $val->validated('idcom');
				$rel_comaaff->idaaff = $val->validated('idaaff');
				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('rel_comaaff', $rel_comaaff, false);
		}

        $data['nombre'] = Model_Cliente::find($rel_comaaff->idcom)->get('nombre');
        $data['idcom'] = $rel_comaaff->idcom;

		$this->template->title = "Editando relación entre comunidad y administrador de fincas";
		$this->template->content = View::forge('rel/comaaff/edit',$data);

	}

	public function action_delete($idcom,$idaaff)
	{
	    if(is_null($idcom) || is_null($idaaff)){
            Session::set_flash('error', 'No se ha podido eliminar la asociación con el administrador de fincas.');
        }
        else{
            $rels = Model_Rel_Comaaff::find('all',array('where'=>array('idcom'=>$idcom,'idaaff'=>$idaaff)));

            foreach($rels as $rel){
                $rel->delete();
            }
            Session::set_flash('success', 'Borrada la asociación con el administrador de fincas.');
		}
		Response::redirect('clientes/aaff/');
	}
}
