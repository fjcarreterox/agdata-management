<?php
class Controller_Servicios_Contratados extends Controller_Template
{
	public function action_index(){
		$data['servicios_contratados'] = Model_Servicios_Contratado::find('all');
		$this->template->title = "Servicios_contratados";
		$this->template->content = View::forge('servicios/contratados/index', $data);
	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('servicios/contratados');

		if ( ! $data['servicios_contratado'] = Model_Servicios_Contratado::find($id))
		{
			Session::set_flash('error', 'No se ha podido localizar el servicio contratado deseado.');
			Response::redirect('servicios/contratados');
		}

		$this->template->title = "Servicios_contratado";
		$this->template->content = View::forge('servicios/contratados/view', $data);
	}

    public function action_doc($idcontrato = null){
        is_null($idcontrato) and Response::redirect('servicios/contratados');

        if ( ! $data['servicios_contratados'] = Model_Servicios_Contratado::find('all',array('where'=>array('idcontrato'=>$idcontrato))))
        {
            Session::set_flash('error', 'No se han podido localizar los servicios contratados por el cliente.');
            Response::redirect('servicios/contratados');
        }

        $this->template->title = "Servicios contratados: vista previa del documento";
        $this->template->content = View::forge('servicios/contratados/doc', $data);
    }

	public function action_create($idcontrato)
	{
        is_null($idcontrato) and Response::redirect('servicios/contratados');

		if (Input::method() == 'POST')
		{
			$val = Model_Servicios_Contratado::validate('create');

			if ($val->run())
			{
				$servicios_contratado = Model_Servicios_Contratado::forge(array(
					'idcontrato' => Input::post('idcontrato'),
					'idtipo_servicio' => Input::post('idtipo_servicio'),
					'importe' => Input::post('importe'),
					'year' => Input::post('year'),
					'mes_factura' => Input::post('mes_factura'),
					'periodicidad' => Input::post('periodicidad'),
					'cuota' => Input::post('cuota'),
					'forma_pago' => Input::post('forma_pago'),
				));

				if ($servicios_contratado and $servicios_contratado->save()){
					Session::set_flash('success', 'Se ha añadido un nuevo servicio al cliente.');
					Response::redirect('contrato/view/'.$idcontrato);
				}
				else{
					Session::set_flash('error', 'No se ha podido crear el servicio contratado deseado.');
				}
			}
			else{
				Session::set_flash('error', $val->error());
			}
		}
        $contrato = Model_Contrato::find($idcontrato);
        $data['nombre'] = Model_Cliente::find($contrato->idcliente)->get('nombre');
        $data['idcontrato'] = $idcontrato;

		$this->template->title = "Servicios_Contratados";
		$this->template->content = View::forge('servicios/contratados/create',$data);

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('servicios/contratados');

		if ( ! $servicios_contratado = Model_Servicios_Contratado::find($id))
		{
			Session::set_flash('error', 'No se ha podido localizar el servicio contratado');
			Response::redirect('servicios/contratados');
		}

		$val = Model_Servicios_Contratado::validate('edit');

		if ($val->run())
		{
			$servicios_contratado->idcontrato = Input::post('idcontrato');
			$servicios_contratado->idtipo_servicio = Input::post('idtipo_servicio');
			$servicios_contratado->importe = Input::post('importe');
			$servicios_contratado->year = Input::post('year');
			$servicios_contratado->mes_factura = Input::post('mes_factura');
			$servicios_contratado->periodicidad = Input::post('periodicidad');
			$servicios_contratado->cuota = Input::post('cuota');
			$servicios_contratado->forma_pago = Input::post('forma_pago');

			if ($servicios_contratado->save()){
				Session::set_flash('success', 'Servicio contratado actualizado.');
				Response::redirect('contrato/view/'.$servicios_contratado->idcontrato);
			}
			else{
				Session::set_flash('error', 'No se ha podido actualizar el servicio contratado seleccionado.');
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$servicios_contratado->idcontrato = $val->validated('idcontrato');
				$servicios_contratado->idtipo_servicio = $val->validated('idtipo_servicio');
				$servicios_contratado->importe = $val->validated('importe');
				$servicios_contratado->year = $val->validated('year');
				$servicios_contratado->mes_factura = $val->validated('mes_factura');
				$servicios_contratado->periodicidad = $val->validated('periodicidad');
				$servicios_contratado->cuota = $val->validated('cuota');
				$servicios_contratado->forma_pago = $val->validated('forma_pago');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('servicios_contratado', $servicios_contratado, false);
		}
        $contrato = Model_Contrato::find($servicios_contratado->idcontrato);
        $data['nombre'] = Model_Cliente::find($contrato->idcliente)->get('nombre');
        $data['idcontrato'] = $servicios_contratado->idcontrato;

		$this->template->title = "Servicios contratados";
		$this->template->content = View::forge('servicios/contratados/edit',$data);

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('servicios/contratados');

		if ($servicios_contratado = Model_Servicios_Contratado::find($id)){
			$servicios_contratado->delete();
			Session::set_flash('success', 'Borrado el servicio contratado por el cliente.');
		}
		else{
			Session::set_flash('error', 'No se ha podido eliminar el servicio contratado seleccionado.');
		}

		Response::redirect('servicios/contratados');
	}
}