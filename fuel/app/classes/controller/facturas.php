<?php
class Controller_Facturas extends Controller_Template{

	public function action_index(){
		$data['facturas'] = Model_Factura::find('all');
		$this->template->title = "Facturas";
		$this->template->content = View::forge('facturas/index', $data);
	}

	public function action_list($estado){
        if(strcmp($estado,"noemit")==0){
            $str="Facturas no emitidas";
            $data['facturas'] = Model_Factura::find('all',array('where'=>array('estado'=>'no emitida'),'order_by'=>array('num_fact'=>'asc')));
        }
		else{
            $str="Histórico de facturas";
            $data['facturas'] = Model_Factura::find('all',array('where'=>array(array('estado','<>','no emitida'))));
        }
		$data['title'] = $str;
        $this->template->title = $str;
		$this->template->content = View::forge('facturas/list', $data);
	}

    public function action_issue($idf){
        $estado_str = "emitida";
        $f = Model_Factura::find($idf);

        if (strcmp($f->num_fact, '') != 0) {
            Session::set_flash('error', 'Esta factura ya ha sido emitida con el nº L' . str_pad($f->num_fact, 3, 0, STR_PAD_LEFT) . "/" . $f->anyo_cobro);
            Response::redirect('facturas/view_sc/'.$f->idsc);
        } else{
            $query = Model_Factura::query();
            $max_id = $query->max('num_fact');
            $f->num_fact=$max_id+1;
            $f->estado = "emitida";
            $f->save();
            Response::redirect('facturas/view_sc/'.$f->idsc);
        }
    }

    public function action_view_sc($idsc){
        $idcontract = Model_Servicios_Contratado::find($idsc)->get('idcontrato');
        $idc = Model_Contrato::find($idcontract)->get('idcliente');
        $data['cname'] = Model_Cliente::find($idc)->get('nombre');
        $idserv = Model_Servicios_Contratado::find($idsc)->get('idtipo_servicio');
        $data['idcont'] = $idcontract;
        $data['cuota'] = Model_Servicios_Contratado::find($idsc)->get('cuota');
        $data['forma'] = Model_Servicios_Contratado::find($idsc)->get('forma_pago');
        $data['servicio'] = Model_Servicio::find($idserv)->get('nombre');
        $data['facturas'] = Model_Factura::find('all',array('where'=>array("idsc"=>$idsc)));

        $this->template->title = "Facturas asociadas a un servicio contratado";
        $this->template->content = View::forge('facturas/view_sc', $data);
    }

    public function action_generate($idsc){
        $s = Model_Servicios_Contratado::find($idsc);

        $idcontract = Model_Servicios_Contratado::find($idsc)->get('idcontrato');
        $data['cuota'] = Model_Servicios_Contratado::find($idsc)->get('cuota');
        $data['forma'] = Model_Servicios_Contratado::find($idsc)->get('forma_pago');
        $idc = Model_Contrato::find($idcontract)->get('idcliente');
        $data['cname'] = Model_Cliente::find($idc)->get('nombre');
        $idserv = $s->get('idtipo_servicio');
        $data['idcont'] = $idcontract;
        $data['servicio'] = Model_Servicio::find($idserv)->get('nombre');

        $tipo = $s->idtipo_servicio;
        $nfact=$s->get('periodicidad');
        if($tipo == 2){$nfact=2*$nfact;}
        if($s->get('periodicidad')==0){$nfact=1;}

        if(!Model_Factura::find('first',array('where'=>array('idsc'=>$idsc)))) {
            $now = strtotime("01-".$s->mes_factura."-".$s->year);
            for ($i = 0; $i < $nfact; $i++) {
                $year = date('Y',$now);
                $month = date('m',$now);
                $fact = Model_Factura::forge(array(
                    'num_fact' => '',
                    'num_cuota' => $i+1,
                    'idsc' => $s->id,
                    'mes_cobro' => $month,
                    'anyo_cobro' => $year,
                    'estado' => 'no emitida',
                ));
                $now = strtotime("+1 month",$now);
                $fact->save();
            }
        }
        $data['facturas'] = Model_Factura::find('all',array('where'=>array('idsc'=>$idsc)));
        $this->template->title = "Facturas asociadas a un servicio contratado";
        $this->template->content = View::forge('facturas/view_sc', $data);
    }

    public function action_month_invoices(){
        $year = date('Y',time());
        $month = date('m',time());
        $data['facturas'] = Model_Factura::find('all',array('where'=>array('mes_cobro'=>$month,'anyo_cobro'=>$year)));
        $data['title'] = "facturas de ".getMes($month)." de ".$year;

        $this->template->title = "Facturas del mes $month";
        $this->template->content = View::forge('facturas/list', $data);
    }

	public function action_view($id = null){
		is_null($id) and Response::redirect('facturas');

		if ( ! $data['factura'] = Model_Factura::find($id)){
			Session::set_flash('error', 'Could not find factura #'.$id);
			Response::redirect('facturas');
		}

		$this->template->title = "Factura";
		$this->template->content = View::forge('facturas/view', $data);
	}

	public function action_create(){
		if (Input::method() == 'POST'){
			$val = Model_Factura::validate('create');

			if ($val->run()){
				$factura = Model_Factura::forge(array(
					'num_fact' => Input::post('num_fact'),
					'num_cuota' => Input::post('num_cuota'),
					'idsc' => Input::post('idsc'),
					'mes_cobro' => Input::post('mes_cobro'),
					'anyo_cobro' => Input::post('anyo_cobro'),
					'estado' => Input::post('estado'),
				));

				if ($factura and $factura->save()){
					Session::set_flash('success', 'Added factura #'.$factura->id.'.');
					Response::redirect('facturas');
				}
				else{
					Session::set_flash('error', 'Could not save factura.');
				}
			}
			else{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Facturas";
		$this->template->content = View::forge('facturas/create');

	}

	public function action_edit($id = null){
		is_null($id) and Response::redirect('facturas');

		if ( ! $factura = Model_Factura::find($id))		{
			Session::set_flash('error', 'No hemos podido encontrar la factura seleccionada.');
			Response::redirect('facturas');
		}

		$val = Model_Factura::validate('edit');

		if ($val->run()){
			$factura->num_fact = Input::post('num_fact');
			$factura->num_cuota = Input::post('num_cuota');
			$factura->idsc = Input::post('idsc');
			$factura->mes_cobro = Input::post('mes_cobro');
			$factura->anyo_cobro = Input::post('anyo_cobro');
			$factura->estado = Input::post('estado');

			if ($factura->save()){
				Session::set_flash('success', 'Factura actualizada correctamente.');
				Response::redirect('facturas/view_sc/'.$factura->idsc);
			}
			else{
				Session::set_flash('error', 'No hemos podido actualizar la factura seleccionada.');
			}
		}
		else{
			if (Input::method() == 'POST'){
				$factura->num_fact = $val->validated('num_fact');
				$factura->num_cuota = $val->validated('num_cuota');
				$factura->idsc = $val->validated('idsc');
				$factura->mes_cobro = $val->validated('mes_cobro');
				$factura->anyo_cobro = $val->validated('anyo_cobro');
				$factura->estado = $val->validated('estado');
				Session::set_flash('error', $val->error());
			}
			$this->template->set_global('factura', $factura, false);
		}
		$this->template->title = "Facturas";
		$this->template->content = View::forge('facturas/edit');
	}

	public function action_delete($id = null){
		is_null($id) and Response::redirect('facturas');

		if ($factura = Model_Factura::find($id)){
			$factura->delete();
			Session::set_flash('success', 'Deleted factura #'.$id);
		}
		else{
			Session::set_flash('error', 'Could not delete factura #'.$id);
		}
		Response::redirect('facturas');
	}
}
