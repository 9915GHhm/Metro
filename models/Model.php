<?php
abstract class Model{
	private static $db_host = 'localhost';
	private static $db_user = 'root';
	private static $db_pass = '';
	private static $db_name = 'register';
	private static $db_charset = 'utf8';
	private $conex;
	protected $query;
	protected $rows = array();
	
	abstract protected function set();
	abstract protected function setu();
	abstract protected function get();
	abstract protected function del();
	
	private function db_open(){
		$this->conex = new mysqli(
		    self::$db_host,
		    self::$db_user,
		    self::$db_pass,
		    self::$db_name  
		);
		$this->conex->set_charset(self::$db_charset);
	}
	
	private function db_close(){
		$this->conex->close();
	}

	protected function set_query(){
		$this->db_open();
		$this->conex->query($this->query);
		$this->db_close();
	}

	protected function get_query(){
		$this->db_open();
		
		$result = $this->conex->query($this->query);
		While( $this->rows[] = $result->fetch_assoc() );
		$result->close();	
		$this->db_close();
		
		return array_pop($this->rows);
	}

	protected function get_access(){
		$this->db_open();
		
		$result = $this->conex->query($this->query);
		While( $this->rows[] = $result->fetch_assoc() );
		$result->close();	
		$this->db_close();
		
		return array_pop($this->rows);
	}
}
?>


















