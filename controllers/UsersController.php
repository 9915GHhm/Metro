<?php
class UsersController{
	private $model;
	private $date;
	private $num;
	private $table;   
	
	public function __construct($date, $num, $table = 0){    // Estas variables contienen los datos para
		$this->model = new UsersModels($date, $num, $table); // inicializar la aplicación.
	}
	
	public function set( $user_data = array() ){ // Este método envia los datos a guardar en la DDBB
		return $this->model->set($user_data);    // hacia la clase "UsersModels".
	}

	public function setu( $user_data = array() ){ // Este método envia los datos para la clase "UsersModels"
		return $this->model->setu($user_data);    // para ser actualizados en la "DDBB".
	}
	
	public function get($user_id = ''){  // Método que obtiene los datos desde la clase "UsersModels".
		return $this->model->get($user_id);
	}
	
	public function del( $user_id = '' ){ // Método que envia los datos a eliminar a la clase "UsersModels".
		return $this->model->del($user_id);
	}

	public function saber_dia(){ // Método que verifica la condición de las tablas a verificar.
        return $this->model->saber_dia($this->date, $this->num, $this->table);
	}

	public function noEmail($email){ // Método que verifica sí el Email es valdo.
        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
			return true;
			} else {
			return false;
		}
    }
	
	public function __destruct(){
		 //unset($this);
	}
}
?>