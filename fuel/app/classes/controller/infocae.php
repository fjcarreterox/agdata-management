<?php
class Controller_Infocae extends Controller_Template
{

	public function action_index()
	{
		$data['infocaes'] = Model_Infocae::find('all');
		$this->template->title = "Infocaes";
		$this->template->content = View::forge('infocae/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('infocae');

		if ( ! $data['infocae'] = Model_Infocae::find($id))
		{
			Session::set_flash('error', 'Could not find infocae #'.$id);
			Response::redirect('infocae');
		}

		$this->template->title = "Infocae";
		$this->template->content = View::forge('infocae/view', $data);

	}

	public function action_create($idcliente=null)
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Infocae::validate('create');

			if ($val->run())
			{
				$infocae = Model_Infocae::forge(array(
					'idcliente' => Input::post('idcliente'),
					'portal' => Input::post('portal'),
					'azotea' => Input::post('azotea'),
					'escaleras' => Input::post('escaleras'),
					'sotano' => Input::post('sotano'),
					'contadoresluz' => Input::post('contadoresluz'),
					'bajatension' => Input::post('bajatension'),
					'equipospresion' => Input::post('equipospresion'),
					'contadoresagua' => Input::post('contadoresagua'),
					'incendios' => Input::post('incendios'),
					'garaje' => Input::post('garaje'),
					'ascensores' => Input::post('ascensores'),
					'calderas' => Input::post('calderas'),
					'pistas' => Input::post('pistas'),
					'piscina' => Input::post('piscina'),
					'aseopiscina' => Input::post('aseopiscina'),
					'jardines' => Input::post('jardines'),
					'anexo' => Input::post('anexo'),
				));

				if ($infocae and $infocae->save())
				{
					Session::set_flash('success', 'Se ha almacenado correctamente la información para el Informe CAE: #'.$infocae->id.'.');
					Response::redirect('clientes/view/'.$idcliente);
				}

				else
				{
					Session::set_flash('error', 'No se ha podido guardar la información C.A.E.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		$data["idcliente"] = $idcliente;
		$data["nombre"] = Model_Cliente::find($idcliente)->get('nombre');

		$this->template->title = "Nuevo Formulario CAE";
		$this->template->content = View::forge('infocae/create',$data);

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('infocae');

		if ( ! $infocae = Model_Infocae::find($id))
		{
			Session::set_flash('error', 'No se ha podido encontrar la información para el #'.$id);
			Response::redirect('/');
		}

		$val = Model_Infocae::validate('edit');

		if ($val->run())
		{
			$infocae->idcliente = Input::post('idcliente');
			$infocae->portal = Input::post('portal');
			$infocae->azotea = Input::post('azotea');
			$infocae->escaleras = Input::post('escaleras');
			$infocae->sotano = Input::post('sotano');
			$infocae->contadoresluz = Input::post('contadoresluz');
			$infocae->bajatension = Input::post('bajatension');
			$infocae->equipospresion = Input::post('equipospresion');
			$infocae->contadoresagua = Input::post('contadoresagua');
			$infocae->incendios = Input::post('incendios');
			$infocae->garaje = Input::post('garaje');
			$infocae->ascensores = Input::post('ascensores');
			$infocae->calderas = Input::post('calderas');
			$infocae->pistas = Input::post('pistas');
			$infocae->piscina = Input::post('piscina');
			$infocae->aseopiscina = Input::post('aseopiscina');
			$infocae->jardines = Input::post('jardines');
			$infocae->anexo = Input::post('anexo');

			if ($infocae->save())
			{
				Session::set_flash('success', '¡Información C.A.E. Actualizada! (#' . $id.')');
				Response::redirect('clientes/view/'.$infocae->idcliente);
			}

			else{
				Session::set_flash('error', 'No se ha podido almancenar la información editada #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$infocae->idcliente = $val->validated('idcliente');
				$infocae->portal = $val->validated('portal');
				$infocae->azotea = $val->validated('azotea');
				$infocae->escaleras = $val->validated('escaleras');
				$infocae->sotano = $val->validated('sotano');
				$infocae->contadoresluz = $val->validated('contadoresluz');
				$infocae->bajatension = $val->validated('bajatension');
				$infocae->equipospresion = $val->validated('equipospresion');
				$infocae->contadoresagua = $val->validated('contadoresagua');
				$infocae->incendios = $val->validated('incendios');
				$infocae->garaje = $val->validated('garaje');
				$infocae->ascensores = $val->validated('ascensores');
				$infocae->calderas = $val->validated('calderas');
				$infocae->pistas = $val->validated('pistas');
				$infocae->piscina = $val->validated('piscina');
				$infocae->aseopiscina = $val->validated('aseopiscina');
				$infocae->jardines = $val->validated('jardines');
				$infocae->anexo = $val->validated('anexo');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('infocae', $infocae, false);
		}

		$data["idcliente"] = $infocae->idcliente;
        $data["nombre"] = Model_Cliente::find($infocae->idcliente)->get('nombre');

		$this->template->title = "Edición de Información C.A.E.";
		$this->template->content = View::forge('infocae/edit',$data);

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('/');

		if ($infocae = Model_Infocae::find($id)) {
			$idc=$infocae->get('idcliente');
			$infocae->delete();
			Session::set_flash('success', 'Información C.A.E. eliminada del sistema: #'.$id);
		}
		else {
			Session::set_flash('error', 'No se ha podido eliminar la información C.A.E. del sistema: #'.$id);
		}
		Response::redirect('/clientes/view/'.$idc);
	}

    public function action_report($id = null)
    {
        is_null($id) and Response::redirect('/');

        if ($infocae = Model_Infocae::find($id))
        {
            $rel_aaff = Model_Rel_Comaaff::find('first',array('where'=>array('idcom'=>$infocae->idcliente)));
            $rel_cont = Model_Rel_Comcont::find('all',array('where'=>array('idcom'=>$infocae->idcliente)));
            $contratas=array();
			foreach($rel_cont as $r){
                $c=array();
				$c['nombre']=Model_Cliente::find($r->idcontrata)->get("nombre");
				$c['cif']=Model_Cliente::find($r->idcontrata)->get("cif_nif");
				$c['servicio']=$r->servicio;
                $contratas[]=$c;
			}
            $data["infocae"]=$infocae;
            $data["contratas"]=$contratas;
            $data["adminfincas"]=Model_Cliente::find($rel_aaff->idaaff)->get("nombre");
            $data["cname"]=Model_Cliente::find($infocae->idcliente)->get("nombre");
            $data["cif"]=Model_Cliente::find($infocae->idcliente)->get("cif_nif");
            $data["direccion"]=Model_Cliente::find($infocae->idcliente)->get("direccion");
            $data["cpostal"]=Model_Cliente::find($infocae->idcliente)->get("cpostal");
            $data["loc"]=Model_Cliente::find($infocae->idcliente)->get("loc");
            $data["prov"]=Model_Cliente::find($infocae->idcliente)->get("prov");
            return View::forge('infocae/report',$data)->render();
        }
        else
        {
            Session::set_flash('error', 'No se ha podido geenerar el informe C.A.E: #'.$id);
        }
    }

}
