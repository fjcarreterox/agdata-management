<?php
use Orm\Model;

class Model_Tarea extends Model
{
	protected static $_properties = array(
		'id',
		'idcliente',
		'idtipotarea',
		'fecha',
		'fecha_respuesta',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('idcliente', 'Idcliente', 'required|valid_string[numeric]');
		$val->add_field('idtipotarea', 'Idtipotarea', 'required|valid_string[numeric]');
		$val->add_field('fecha', 'Fecha', 'required');
		$val->add_field('fecha_respuesta', 'Fecha Respuesta', 'required');

		return $val;
	}
    /* CHECKS */
    public function existsAdapTasks($idcliente){
        $res = false;
        $tasks =Model_Tarea::find('all',array('where'=>array('idcliente'=>$idcliente)));
        if($tasks != null){
            foreach($tasks as $t){
                $taskType = Model_Tipo_Tarea::find($t->idtipotarea);
                if($taskType->tipo == 1) {
                    $res = true;
                }
            }
        }
        return $res;
    }

    public function existsSuppTasks($idcliente){
        $res = false;
        $tasks =Model_Tarea::find('all',array('where'=>array('idcliente'=>$idcliente)));
        if($tasks != null){
            foreach($tasks as $t){
                $taskType = Model_Tipo_Tarea::find($t->idtipotarea);
                if($taskType->tipo == 2) {
                    $res = true;
                }
            }
        }
        return $res;
    }

    /* GETTERS  */
    public function getAdapTasks($idcliente){
        $res = array();
        $tasks =Model_Tarea::find('all',array('where'=>array('idcliente'=>$idcliente),'order_by'=>array('fecha'=>'asc','idtipotarea'=>'asc')));
        if($tasks != null){
            foreach($tasks as $t){
                $taskType = Model_Tipo_Tarea::find($t->idtipotarea);
                if($taskType->tipo == 1) {
                    $res[] = $t;
                }
            }
        }
        return $res;
    }

    public function getSuppTasks($idcliente){
        $res = array();
        $tasks =Model_Tarea::find('all',array('where'=>array('idcliente'=>$idcliente),'order_by'=>array('fecha'=>'asc','idtipotarea'=>'asc')));
        if($tasks != null){
            foreach($tasks as $t){
                $taskType = Model_Tipo_Tarea::find($t->idtipotarea);
                if($taskType->tipo == 2) {
                    $res[] = $t;
                }
            }
        }
        return $res;
    }

    public function createAdapTasks($idcliente){
        $taskTypes = Model_Tipo_Tarea::find('all',array('where'=>array('tipo'=>1)));
        foreach($taskTypes as $t){
            //\Fuel\Core\Log::error($t->nombre."\n");
            $newTask = Model_Tarea::forge(array(
                    'idcliente' => $idcliente,
                    'idtipotarea' => $t->id,
                    'fecha' => '',
                    'fecha_respuesta'=>''
            ));

            if ($newTask and $newTask->save()){
                \Fuel\Core\Log::error('success', 'Tarea añadida '.$newTask->id.'.');
            }
        }
    }

    public function createSuppTasks($idcliente){
        $taskTypes = Model_Tipo_Tarea::find('all',array('where'=>array('tipo'=>2)));
        foreach($taskTypes as $t){
            \Fuel\Core\Log::error($t->nombre."\n");
            $newTask = Model_Tarea::forge(array(
                'idcliente' => $idcliente,
                'idtipotarea' => $t->id,
                'fecha' => '',
                'fecha_respuesta'=>''
            ));

            if ($newTask and $newTask->save()){
                \Fuel\Core\Log::error('success', 'Tarea añadida '.$newTask->id.'.');
            }
        }
    }
}
