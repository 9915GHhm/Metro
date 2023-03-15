<?php

class SessionController{
	private $session;
	private $date;
	private $num;
	private $table;
	
	public function __construct(){
		$this->session = new UsersModels($this->date, $this->num, $this->table);
	}
	
	public function login($us, $pass){//Método que valida el usuario y contraseña en la clase "UsersModels".
		return $this->session->validate_user($us, $pass);
	}
	
	public function logout(){ // Método que cierra la sección.
		session_start();
		session_destroy();
		header('Location: ./');
	}
	
	public function __destruct(){
		//unset($this);
	}
}
?>