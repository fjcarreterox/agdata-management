<?php
class Controller_Contrato extends Controller_Template
{
	public function action_index(){
		$data['contratos'] = Model_Contrato::find('all');
		$this->template->title = "Contratos";
		$this->template->content = View::forge('contrato/index', $data);
	}

    public function action_doc($idcontrato){
        $contrato = Model_Contrato::find($idcontrato);

        $c = Model_Cliente::find($contrato->idcliente);
        $cliente = array(
            "id"=> $c->id,
            "nombre"=> $c->nombre,
            "tipo"=> $c->tipo,
            "cif"=> $c->cif_nif,
            "dir"=> $c->direccion,
			"cp"=>$c->cpostal,
			"loc"=>$c->loc,
			"prov"=>$c->prov,
            "actividad"=> $c->actividad,
            "iban"=> $c->iban
        );

        //only for communities
        if($c->tipo == 6){
            $rel_aaff = Model_Rel_Comaaff::find('first', array('where' => array('idcom' => $c->id)));
            if($rel_aaff != null) {
                $aaff = Model_Cliente::find($rel_aaff->idaaff);
                $aaff_data = array(
                    "nombre" => $aaff->nombre,
                    "cif" => $aaff->cif_nif,
                    "dir" => $aaff->direccion,
                    "cp" => $aaff->cpostal,
                    "loc" => $aaff->loc,
                    "prov" => $aaff->prov
                );
            }else{
                $aaff_data = array();
            }
            $data['aaff'] = $aaff_data;
        }
        $tratamiento_ops = array("D.","Dª");
        $rep =  Model_Personal::find($contrato->idpersonal);
        if($rep != null){
            $rep_legal = array(
                "nombre" => $tratamiento_ops[$rep->tratamiento]." ".$rep->nombre,
                "nif" => $rep->dni
            );
        }

        $data['servicios'] = Model_Servicios_Contratado::find('all',array('where'=>array('idcontrato'=>$idcontrato)));
        $data['cliente'] = $cliente;
        $data['rep_legal'] = $rep_legal;
		$data['contract'] = array("id"=>$contrato->id,"date"=>$contrato->fecha_firma);

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

	public function action_create($idcliente = null)
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
            $data['clientes'][] = Model_Cliente::find($idcliente);
        }
        else {
            $data['clientes'] = Model_Cliente::find('all', array('where'=>array(array('estado','>',4),array('estado','<',7)),'order_by' => 'nombre'));
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
        $data['clientes'][] = Model_Cliente::find($contrato->idcliente);

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

	public function action_month_search(){
        if (Input::method() == 'POST'){
            $date = explode('-',Input::post('date_sign'));
            $date_str="$date[0]-$date[1]-%";
            //$data['contracts'] = Model_Contrato::find('all',array('where'=>array(array('fecha_firma','like',$date_str)),'order_by'=>'fecha_firma'));
            $data['services'] = Model_Servicios_Contratado::find('all',array('where'=>array('year'=>$date[0],'mes_factura'=>$date[1]),'order_by'=>'idcontrato'));
            $data['title'] = getMes($date[1])." de ".$date[0];
            $this->template->title = "Contratos con servicios que comienzan en ".getMes($date[1])." de ".$date[0];
            $this->template->content = View::forge('contrato/services',$data);
        }
        else{
            $this->template->title = "Buscar servicios para una fecha determinada";
            $this->template->content = View::forge('contrato/month_search');
        }
    }
}