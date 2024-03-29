<?php

class Controller_Doc extends Controller_Template{

	public function action_index(){
		$data["subnav"] = array('index'=> 'active' );
		$this->template->title = 'Documentación comercial';
		$this->template->content = View::forge('doc/index', $data);
	}

    public function action_aaff(){
        $this->template->title = 'Documentación para AA.FF.';
        $this->template->content = View::forge('doc/aaff');
    }

    public function action_report(){
        $this->template->title = "Informes del sistema";
        $this->template->content = View::forge('doc/report');
    }

    public function view_all($idc){
        //TODO: list all the documents for a single customer/contact
    }

	public function action_portada($idcliente){
		$data["name"] = Model_Cliente::find($idcliente)->get('nombre');
		$data["type"] = Model_Cliente::find($idcliente)->get('tipo');
		return View::forge('doc/portada',$data)->render();
	}

    public function action_cert($idcliente){
        $data["name"] = Model_Cliente::find($idcliente)->get('nombre');
        return View::forge('doc/cert',$data)->render();
    }

    public function action_funciones($idcliente){
        $data["cname"] = Model_Cliente::find($idcliente)->get('nombre');
        $data['rep'] = Model_Personal::find('first',array('where'=>array('idcliente'=>$idcliente,'relacion'=>1)));
        return View::forge('doc/funciones',$data)->render();
    }

    public function action_presupuesto($idcliente){
        //TODO
    }

    public function action_contrato($idcustomer, $idcontract){
        $c=Model_Cliente::find($idcustomer);
        $isCPP=($c->tipo == 6)? true: false;
        $contract = Model_Contrato::find($idcontract);

        $data['customer'] = $c;
        $data['contract'] = $contract;
        $data['services'] = Model_Servicios_Contratado::find('all',array('where'=>array('idcontrato'=>$idcontract)));
        $rep =  Model_Personal::find($contract->idpersonal);
        $data['rep'] =  $rep;
        if(count($data['services'])==1 ){
            $serv = array_pop($data['services']);
            if($serv->idtipo_servicio==3) {
                $data['services'] = $serv;
                return View::forge('doc/contrato_gestoria', $data)->render();
            }
            //Id tipo NEOs
            /*else if($serv->idtipo_servicio==8){
                $data['services'] = $serv;
                return View::forge('doc/contrato_neos', $data)->render();
            }*/
            $data['services'][0] = $serv;
        }

        if($isCPP){
            if(Model_Cliente::find($rep->idcliente)){
                $data["aaff"] = Model_Cliente::find($rep->idcliente);
                $data["aaff_nombre"] = Model_Cliente::find($rep->idcliente)->get('nombre');
                $data["aaff_cif"] = Model_Cliente::find($rep->idcliente)->get('cif_nif');
            }
            else{
                $data["aaff_nombre"] = "    ";
            }
            return View::forge('doc/contrato_cpp',$data)->render();
        }else{
            return View::forge('doc/contrato',$data)->render();
        }
    }

    public function action_seguridad($idc){
        $c=Model_Cliente::find($idc);
        $isCPP=($c->tipo == 6 || $c->tipo == 10)? true: false;
        //getting all the customer data
        $data["idc"]=$idc;
        $data["type"] = Model_Tipo_Cliente::find($c->tipo)->get('tipo');
        $data["cname"]=$c->nombre;
        $data["cif"]=$c->cif_nif;
        $data["dir"]=$c->direccion;
        $data["cp"]=$c->cpostal;
        $data["loc"]=$c->loc;
        $data["prov"]=$c->prov;
        //workers info
        $data['trab'] = Model_Personal::find('all',array('where'=>array('idcliente'=>$idc,'relacion'=>4)));
        //Registered files info
        $files_raw = Model_Fichero::find('all',array('where'=>array('idcliente'=>$idc)));
        $files=array();
        //Obtaining the max level for all the registered files
        $max_level = 0;
        $levels = array("No especificado","Básico","Medio","Alto");
        if($files_raw!=null){
            foreach($files_raw as $f){
                $files[]=array(
                    "id" => $f->id,
                    "idtype" => $f->idtipo,
                    "name" => Model_Tipo_Fichero::find($f->idtipo)->get('tipo'),
                    "target" => Model_Tipo_Fichero::find($f->idtipo)->get('finalidad'),
                    "level_name" => $levels[$f->nivel],
                    "idlevel" => $f->nivel,
                    "supp" => $f->soporte
                );
                if($f->nivel > $max_level){
                    $max_level=$f->nivel;
                }
            }
        }
        $data['files'] = $files;
        $data['max_level'] = $max_level;
        $data['ces'] = Model_Cesione::find('all',array('where'=>array('idcliente'=>$idc)));

        if($isCPP){
            $rels_aaff = Model_Rel_Comaaff::find('all',array('where'=>array('idcom'=>$idc)));
            $reps_data = null;
            foreach($rels_aaff as $rel_aaff) {
                $aaff = Model_Cliente::find($rel_aaff->idaaff);
                $rep = Model_Personal::find('first', array('where' => array('idcliente' => $aaff->id, 'relacion' => 1)));
                if ($rep != null) {
                    $reps_data[] = array(
                        "nombre" => $rep->get('nombre'),
                        "dni" => $rep->get('dni'),
                        "nombre_aaff" => $aaff->nombre,
                        "dir" => $aaff->direccion,
                        "cp" => $aaff->cpostal,
                        "loc" => $aaff->loc,
                        "prov" => $aaff->prov
                    );
                }
            }
            $data['reps'] = $reps_data;
            $data['num_reps'] = count($reps_data);
            $data['pres'] = Model_Personal::find('first',array('where'=>array('idcliente'=>$idc,'relacion'=>6)));
            return View::forge('doc/seguridad_cpp',$data)->render();
        }
        else{
            $data['reps'] = Model_Personal::find('first', array('where' => array('idcliente' => $idc, 'relacion' => 1)));
            $data['rep_seg'] = Model_Personal::find('first', array('where' => array('idcliente' => $idc, 'relacion' => 3)));
            $data['personal'] = Model_Personal::find('first',array('where'=>array('idcliente'=>$idc,'relacion'=>6)));
            return View::forge('doc/seguridad',$data)->render();
        }
    }

    public function action_allin1($idc){
        $c=Model_Cliente::find($idc);
        $isCPP=($c->tipo == 6)? true: false;
        //getting all the customer data
        $data["idc"]=$idc;
        $data["type"] = Model_Tipo_Cliente::find($c->tipo)->get('tipo');
        $data["cname"]=$c->nombre;
        $data["cif"]=$c->cif_nif;
        $data["dir"]=$c->direccion;
        $data["cp"]=$c->cpostal;
        $data["loc"]=$c->loc;
        $data["prov"]=$c->prov;
        $data["email"]=$c->email;
        $data["act"]=$c->actividad;
        $data["web"]=$c->pweb;
        //workers info
        $data['trab'] = Model_Personal::find('all',array('where'=>array('idcliente'=>$idc,'relacion'=>4)));
        //Registered files info
        $files_raw = Model_Fichero::find('all',array('where'=>array('idcliente'=>$idc)));
        //Obtaining the max level for all the registered files
        $max_level = 0;
        $levels = array("No especificado","Básico","Medio","Alto");

        foreach($files_raw as $f){
            $files[]=array(
                "id" => $f->id,
                "idtype" => $f->idtipo,
                "name" => Model_Tipo_Fichero::find($f->idtipo)->get('tipo'),
                "target" => Model_Tipo_Fichero::find($f->idtipo)->get('finalidad'),
                "level_name" => $levels[$f->nivel],
                "idlevel" => $f->nivel,
                "supp" => $f->soporte,
                "base" => $f->base,
                "origen" => $f->origen,
                "recogida" => $f->recogida,
            );
            if($f->nivel > $max_level){
                $max_level=$f->nivel;
            }
        }
        $data['files'] = $files;
        $data['max_level'] = $max_level;
        $data['ces'] = Model_Cesione::find('all',array('where'=>array('idcliente'=>$idc)));

        if($isCPP){
            $rels_aaff = Model_Rel_Comaaff::find('all',array('where'=>array('idcom'=>$idc)));
            $reps_data = null;
            foreach($rels_aaff as $rel_aaff) {
                $aaff = Model_Cliente::find($rel_aaff->idaaff);
                $rep = Model_Personal::find('first', array('where' => array('idcliente' => $aaff->id, 'relacion' => 1)));
                if ($rep != null) {
                    $reps_data[] = array(
                        "nombre" => $rep->get('nombre'),
                        "dni" => $rep->get('dni'),
                        "nombre_aaff" => $aaff->nombre,
                        "dir" => $aaff->direccion,
                        "cp" => $aaff->cpostal,
                        "loc" => $aaff->loc,
                        "prov" => $aaff->prov
                    );
                }
            }
            $data['reps'] = $reps_data;
            $data['num_reps'] = count($reps_data);
            $data['pres'] = Model_Personal::find('first',array('where'=>array('idcliente'=>$idc,'relacion'=>6)));
            return View::forge('doc/allin1_cpp',$data)->render();
        }
        else{
            $data['reps'] = Model_Personal::find('first', array('where' => array('idcliente' => $idc, 'relacion' => 1)));
            $data['rep_seg'] = Model_Personal::find('first', array('where' => array('idcliente' => $idc, 'relacion' => 3)));
            $data['personal'] = Model_Personal::find('first',array('where'=>array('idcliente'=>$idc,'relacion'=>6)));
            return View::forge('doc/allin1',$data)->render();
        }
    }

    public function action_letters($idc){
        $c = Model_Cliente::find($idc);
        $isCPP = ($c->tipo == 6) ? true : false;
        //getting all the customer data
        $data["idc"] = $idc;
        $data["type"] = Model_Tipo_Cliente::find($c->tipo)->get('tipo');
        $data["num_type"] = $c->tipo;
        $data["cname"] = $c->nombre;
        $data["cif"] = $c->cif_nif;
        $data["dir"] = $c->direccion;
        $data["cp"] = $c->cpostal;
        $data["loc"] = $c->loc;
        $data["prov"] = $c->prov;
        $data["email"] = $c->email;
        $data["act"] = $c->actividad;
        $data["web"] = $c->pweb;

        return View::forge('doc/letters', $data)->render();
    }

    public function action_clausula($idcliente,$type){
        //TODO: for customers, employees and providers
        $t=strtoupper($type);
        $data = array();
        $data["idc"]=$idcliente;
        switch($t){
            case 'E':
                //TODO
                //return \Fuel\Core\Response::redirect('clientes/clausula_empleados/'.$idcliente);
                $data['rep'] = Model_Personal::find('all',array('where'=>array('idcliente'=>$idcliente,'relacion'=>1)));
                $data['trab'] = Model_Personal::find('all',array('where'=>array('idcliente'=>$idcliente,'relacion'=>4)));
                return View::forge('doc/clause/employee',$data)->render();
                break;
            case 'C':
                return View::forge('doc/clause/customer',$data)->render();
                break;
            case 'CV':
                return View::forge('doc/clause/cvs',$data)->render();
                break;
            default: break;
        }
    }

    public function action_coletilla($idcliente){
        $data["name"] = Model_Cliente::find($idcliente)->get('nombre');
        $dir = Model_Cliente::find($idcliente)->get('direccion');
        $data["dir"] = base64_encode($dir.", ".Model_Cliente::find($idcliente)->get('cpostal').", ".Model_Cliente::find($idcliente)->get('loc').", en la provincia de ".Model_Cliente::find($idcliente)->get('prov'));
        return View::forge('doc/coletilla',$data)->render();
    }

    public function action_factura($idfac){
        $f = Model_Factura::find($idfac);
        $data["num_fact"] = $f->num_fact;
        $data["num_cuota"] = $f->num_cuota;
        $data["year"] = $f->anyo_cobro;
        $data["fecha_emision"] = $f->fecha_emision;
        $idsc = Model_Servicios_Contratado::find($f->get('idsc'));
        $data["importe"] = $idsc->cuota;
        $data["nombre_serv"] = Model_Servicio::find($idsc->idtipo_servicio)->get('nombre');
        $query = Model_Factura::query()->where('idsc', $idsc->id);
        $data["total_fact"] = $query->count();
        $idcont = Model_Contrato::find($idsc->get('idcontrato'));
        $data["forma"] = $idsc->forma_pago;
        $data["cname"] = Model_Cliente::find($idcont->get('idcliente'))->get('nombre');
        $data["cif"] = Model_Cliente::find($idcont->get('idcliente'))->get('cif_nif');
        $data["dir"] = Model_Cliente::find($idcont->get('idcliente'))->get('direccion');
        $data["cp"] = Model_Cliente::find($idcont->get('idcliente'))->get('cpostal');
        $data["loc"] = Model_Cliente::find($idcont->get('idcliente'))->get('loc');
        $data["prov"] = Model_Cliente::find($idcont->get('idcliente'))->get('prov');
        return View::forge('doc/factura',$data)->render();
    }

    public function action_solicitud_video($idcliente){
        $af = Model_Rel_Comaaff::find('first',array('where'=>array('idcom'=>$idcliente)));
        $data["afname"] = Model_Cliente::find($af->idaaff)->get('nombre');
        $data["afdir1"] = Model_Cliente::find($af->idaaff)->get('direccion');
        $data["afdir2"] = Model_Cliente::find($af->idaaff)->get('cpostal').' - '.Model_Cliente::find($af->idaaff)->get('prov');
        $data["name"] = Model_Cliente::find($idcliente)->get('nombre');
        $data["dir"] = Model_Cliente::find($idcliente)->get('direccion').", con C.P. ".Model_Cliente::find($idcliente)->get('cpostal').", en ".Model_Cliente::find($idcliente)->get('loc').", en la provincia de ".Model_Cliente::find($idcliente)->get('prov');
        return View::forge('doc/solicitud',$data)->render();
    }

    public function action_vigencia($idc){
        $data["name"] = Model_Cliente::find($idc)->get('nombre');
        $data["cif"] = Model_Cliente::find($idc)->get('cif_nif');
        $data['pres'] = Model_Personal::find('first',array('where'=>array('idcliente'=>$idc,'relacion'=>6)));
        $af = Model_Rel_Comaaff::find('first',array('where'=>array('idcom'=>$idc)));
        $data["afname"] = Model_Cliente::find($af->idaaff)->get('nombre');
        $data["afdir1"] = Model_Cliente::find($af->idaaff)->get('direccion');
        $data["afdir2"] = Model_Cliente::find($af->idaaff)->get('cpostal').' de '.Model_Cliente::find($af->idaaff)->get('prov');
        $data["rep"] = Model_Personal::find('first', array('where' => array('idcliente' => $af->idaaff, 'relacion' => 1)));
        return View::forge('doc/vigencia',$data)->render();
    }

    public function action_noacta($idc){
        $data['pres'] = Model_Personal::find('first',array('where'=>array('idcliente'=>$idc,'relacion'=>6)));
        $data["name"] = Model_Cliente::find($idc)->get('nombre');
        $data["cif"] = Model_Cliente::find($idc)->get('cif_nif');
        return View::forge('doc/noacta',$data)->render();
    }

    public function action_cesion($idc,$idces){
        $c=Model_Cliente::find($idc);
        $isCPP=($c->tipo == 6)? true: false;
        $data['cname'] = $c->nombre;
        $data['cif_nif'] = $c->cif_nif;
        $data["dir"]=$c->direccion;
        $data["cp"]=$c->cpostal;
        $data["loc"]=$c->loc;
        $data["prov"]=$c->prov;
        $files = array();
        if($isCPP){
            $data['pres'] = Model_Personal::find('first',array('where'=>array('idcliente'=>$idc,'relacion'=>6)));
            $rep_legal = Model_Personal::find('first',array('where'=>array('idcliente'=>$idces,'relacion'=>1)));

            $rep_legal_name = str_repeat(".",120);
            $rep_legal_dni = str_repeat(".",50);
            if($rep_legal != null){
                $rep_legal_name = $rep_legal->nombre;
                $rep_legal_dni = $rep_legal->dni;
            }
            $rep["nombre"] = $rep_legal_name;
            $rep["dni"] = $rep_legal_dni;
            $rep["nombre_aaff"] = Model_Cliente::find($idces)->get('nombre');
            $rep["aaff_type"] = Model_Cliente::find($idces)->get('tipo');
            $rep["activ"] = Model_Cliente::find($idces)->get('actividad');
            $rep["cif_nif"] = Model_Cliente::find($idces)->get('cif_nif');
            $rep["dir"] = Model_Cliente::find($idces)->get('direccion');
            $rep["cp"] = Model_Cliente::find($idces)->get('cpostal');
            $rep["loc"] = Model_Cliente::find($idces)->get('loc');
            $rep["prov"] = Model_Cliente::find($idces)->get('prov');

            $cesion = Model_Cesione::find('first',array('where'=>array('idcliente'=>$idc,'idcesionaria'=>$idces)));
            if($cesion != null){
                $files[]["type"] = Model_Tipo_Fichero::find(Model_Fichero::find($cesion->idfichero)->get('idtipo'))->get('tipo');
            }
            else {
                $files_tmp = Model_Fichero::find('all', array('where' => array('idcliente' => $idc)));
                foreach ($files_tmp as $f) {
                    $files[]["type"] = Model_Tipo_Fichero::find($f->idtipo)->get('tipo');
                }
            }

            $data['files'] = $files;
            $data['rep'] = $rep;
            return View::forge('doc/cesion_cpp',$data)->render();
        }
        else{
            $cesiones = Model_Cesione::find('all',array('where'=>array('idcliente'=>$idc,'idcesionaria'=>$idces)));
            foreach ($cesiones as $c){
                $files[] = array(
                    "type" => Model_Tipo_Fichero::find(Model_Fichero::find($c->idfichero)->get('idtipo'))->get('tipo'),
                    "level" => Model_Fichero::find($c->idfichero)->get('nivel'),
                    "supp" => Model_Fichero::find($c->idfichero)->get('soporte'));
            }
            $data['files'] = $files;
            $data['rep_legal'] = Model_Personal::find('first',array('where'=>array('idcliente'=>$idc,'relacion'=>1)));
            $data['ces'] = Model_Cliente::find($idces);
            $data['rep_legal_ces'] = Model_Personal::find('first', array('where' => array('idcliente' => $idces, 'relacion' => 1)));
            return View::forge('doc/cesion',$data)->render();
        }
    }
}
