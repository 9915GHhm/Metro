<?php
class SessionReg{
	private $session;
	
	public function logout(){
		session_start();
		session_unset();
		session_destroy();
		header('Location: ./');
	}
	
	public function __destruct(){
		//unset($this);
	}
}
?>