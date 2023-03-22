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
	
	public function get($user_id = ''){  // Obtiene los datos desde la clase "UsersModels".
		return $this->model->get($user_id);
	}
	
	public function del( $user_id = '' ){ // Envia los datos a eliminar a la clase "UsersModels".
		return $this->model->del($user_id);
	}

	public function saber_dia(){ // Verifica la condición de las tablas según fecha y día de la semana.
        return $this->model->saber_dia($this->date, $this->num, $this->table);
	}

	public function nroIntentos($us = ''){ // Obtener el números de intentos hechos al logearse.
		return $this->model->attempts($us);
	}

	public function setIntentos($us_data = array()){ // Actualiza los intentos al logearse.
		return $this->model->setAttempts($us_data);
	}

	public function resetIntentos($us_data = array()){ // Resetea la columna "intentos" en la DDBB.
		return $this->model->resetAttemps($us_data);
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