<?php
class Controller_Contrato extends Controller_Template
{
	public function action_index()
	{
		$data['contratos'] = Model_Contrato::find('all');
		$this->template->title = "Contratos";
		$this->template->content = View::forge('contrato/index', $data);
	}

    public function action_doc($idcontrato){
        $contrato = Model_Contrato::find($idcontrato);

        $c = Model_Cliente::find($contrato->idcliente);
        $iban="NO DISPONIBLE";
        $f = Model_Ficha::find('first',array('where'=>array('idcliente'=>$contrato->idcliente)));
        if($f != null && $f->iban != ""){
            $iban = $f->iban;
        }
        $cliente = array(
            "nombre"=> $c->nombre,
            "tipo"=> $c->tipo,
            "cif"=> $c->cif_nif,
            "iban"=> $iban
        );

        //only for communities
        if($c->tipo == 6){
            $rel_aaff = Model_Rel_Comaaff::find('first',array('where'=>array('idcom'=>$c->id)));
            $aaff = Model_Cliente::find($rel_aaff->idaaff);

            $aaff_data = array(
                "nombre"=>$aaff->nombre,
                "cif"=>$aaff->cif_nif,
                "dir"=>$aaff->direccion,
                "cp"=>$aaff->cpostal,
                "loc"=>$aaff->loc,
                "prov"=>$aaff->prov
            );

            $data['aaff'] = $aaff_data;
        }

        $rep =  Model_Personal::find('first',array('where'=>array('idcliente'=>$aaff->id,'relacion'=>1)));
        $rep_legal = array(
            "nombre" => $rep->nombre,
            "nif" => $rep->dni
        );

        $data['servicios'] = Model_Servicios_Contratado::find('all',array('where'=>array('idcontrato'=>$idcontrato)));
        $data['cliente'] = $cliente;
        $data['rep_legal'] = $rep_legal;

        $this->template->title = "Vista previa para generar Contrato";
        $this->template->content = View::forge('contrato/doc',$data);
    }

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('contrato');

		if ( ! $data['contrato'] = Model_Contrato::find($id))
		{
			Session::set_flash('error', 'No se ha podido localizar el contrato deseado');
			Response::redirect('contrato');
		}
        $data['servicios'] = Model_Servicios_Contratado::find('all',array('where'=>array('idcontrato'=>$id)));

		$this->template->title = "Detalle de contrato";
		$this->template->content = View::forge('contrato/view', $data);
	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Contrato::validate('create');

			if ($val->run())
			{
				$contrato = Model_Contrato::forge(array(
					'idcliente' => Input::post('idcliente'),
					'idpres' => Input::post('idpres'),
					'idpersonal' => Input::post('idpersonal'),
					'fecha_firma' => Input::post('fecha_firma'),
				));

				if ($contrato and $contrato->save()){
					Session::set_flash('success', 'Contrato añadido al sistema.');
					Response::redirect('servicios/contratados/create/'.$contrato->id);
				}
				else{
					Session::set_flash('error', 'No se ha podido crear un nuevo contrato en el sistema.');
				}
			}
			else{
				Session::set_flash('error', $val->error());
			}
		}
        if($idcliente != null){
            $data['idcliente'] = $idcliente;
        }
        else {
            $data['clientes'] = Model_Cliente::find('all', array('order_by' => 'nombre'));
        }

		$this->template->title = "Crear nuevo contratos";
		$this->template->content = View::forge('contrato/create',$data);
	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('contrato');

		if ( ! $contrato = Model_Contrato::find($id))
		{
			Session::set_flash('error', 'No se ha podido localizar el contrato indicado.');
			Response::redirect('contrato');
		}

		$val = Model_Contrato::validate('edit');

		if ($val->run()){
			$contrato->idcliente = Input::post('idcliente');
			$contrato->idpres = Input::post('idpres');
			$contrato->idpersonal = Input::post('idpersonal');
			$contrato->fecha_firma = Input::post('fecha_firma');

			if ($contrato->save()){
				Session::set_flash('success', 'Contrato actualizado correctamente');
				Response::redirect('contrato');
			}
			else{
				Session::set_flash('error', 'No se ha podido actualizar el contrato indicado.');
			}
		}
		else{
			if (Input::method() == 'POST')
			{
				$contrato->idcliente = $val->validated('idcliente');
				$contrato->idpres = $val->validated('idpres');
				$contrato->idpersonal = $val->validated('idpersonal');
				$contrato->fecha_firma = $val->validated('fecha_firma');
				Session::set_flash('error', $val->error());
			}
			$this->template->set_global('contrato', $contrato, false);
		}
        $data['clientes'] = Model_Cliente::find('all', array('order_by' => 'nombre'));

		$this->template->title = "Editando detalle de contrato";
		$this->template->content = View::forge('contrato/edit',$data);
	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('contrato');

		if ($contrato = Model_Contrato::find($id)){
            $servicios_contratados = Model_Servicios_Contratado::find('all',array('where'=>array('idcontrato'=>$id)));
            foreach($servicios_contratados as $sc){
                $sc->delete();
            }
			$contrato->delete();
			Session::set_flash('success', 'Contrato borrado del sistema (incluyendo sus servicios contratados incluidos).');
		}
		else{
			Session::set_flash('error', 'No se ha podido eliminar el contrato deseado');
		}

		Response::redirect('contrato');
	}
}