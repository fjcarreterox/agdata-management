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

	public function action_create($idcliente)
	{
        is_null($idcliente) and Response::redirect('servicios/contratados');

		if (Input::method() == 'POST')
		{
			$val = Model_Servicios_Contratado::validate('create');

			if ($val->run())
			{
				$servicios_contratado = Model_Servicios_Contratado::forge(array(
					'idcliente' => Input::post('idcliente'),
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
					Response::redirect('cliente/view/'.$idcliente);
				}
				else{
					Session::set_flash('error', 'No se ha podido crear el servicio contratado deseado.');
				}
			}
			else{
				Session::set_flash('error', $val->error());
			}
		}

        $data['nombre'] = Model_Cliente::find($idcliente)->get('nombre');
        $data['idcliente'] = $idcliente;

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
			$servicios_contratado->idcliente = Input::post('idcliente');
			$servicios_contratado->idtipo_servicio = Input::post('idtipo_servicio');
			$servicios_contratado->importe = Input::post('importe');
			$servicios_contratado->year = Input::post('year');
			$servicios_contratado->mes_factura = Input::post('mes_factura');
			$servicios_contratado->periodicidad = Input::post('periodicidad');
			$servicios_contratado->cuota = Input::post('cuota');
			$servicios_contratado->forma_pago = Input::post('forma_pago');

			if ($servicios_contratado->save()){
				Session::set_flash('success', 'Servicio contratado actualizado.');
				Response::redirect('clientes/view/'.$servicios_contratado->idcliente);
			}
			else{
				Session::set_flash('error', 'No se ha podido actualizar el servicio contratado seleccionado.');
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$servicios_contratado->idcliente = $val->validated('idcliente');
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

        $data['nombre'] = Model_Cliente::find($servicios_contratado->idcliente)->get('nombre');
        $data['idcliente'] = $servicios_contratado->idcliente;

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
