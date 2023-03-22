<?php
class UsersModels extends Model{
	protected $fh;
    protected $tabla;
    protected $see;
	
	public function __construct($date, $num, $table = 0){ // La variable "$table" puede ser sobreescrita.
		
		$this->fh = $date;
        
    if($table == 'Selección')
        $this->tabla = $num; 
    else 
        $this->tabla = $table;
	}

	public function set( $user_data = array() ){  // Registrar datos.
		
		foreach($user_data as $key => $value){
			$$key = $value; // El doble signo de "$$" es para crear variables de la vaiable "$key" de los
			// datos que vienen en el arreglo($user_data) y esto se denómina (Variables variable) por tal
			// motivo se declara así "$$key".
			    
                $token = MD5($_POST['us'].'+'.$_POST['email']); // Genera un token, por ahora sin uso.
				$clave = $_POST['pass'];                         
				$pass = password_hash($clave, PASSWORD_DEFAULT); // Encripta la contraseña
				$intentos = 4; // Inicializa la columna "intentos" de la DDBB en el Nº 4.
			}
				$this->query = "Call Add_User('$us', '$token', '$email', '$name', '$tabla', '". $pass ."', '$role', '$intentos')";
				
			$this->set_query();
		}

		public function setu( $user_data = array() ){  // Actualiza los datos.
            
			foreach ($user_data as $key => $value) {
				$$key = $value;   // El "$$key" es una (Variables variables).
			}
            
			$this->query = "UPDATE usuarios SET us='$us', email='$email', name='$name', tabla='$tabla', role='$role' WHERE us = '$us'";
			                 
			$this->set_query();
		}
		
		public function get($us = ''){  // Se obtienen los datos.
			
			$this ->query = ($us != '')
			?"SELECT * FROM usuarios WHERE us = '$us'" 
			:"SELECT us, token, email, name, tabla, role FROM usuarios";
			
			$this->get_query();
			
			$num_rows = count($this->rows);
			
			$data = array();
			foreach($this->rows as $key => $value){
				array_push($data, $value); 
			}
			return $data;
		}
		
		public function del( $us = '' ){  // Elimina los datos.
			
			$this->query = "DELETE FROM usuarios WHERE us = '$us'";
			$this->set_query();
		}

		public function setAttempts($us_data = array()){  // Establece el Nº de intentos.
             
			foreach($us_data as $llave => $valor){
				$$llave = $valor;   // El "$$llave" es una (Variables variables).
			}

			$this->query = "UPDATE usuarios SET intentos='$intentos' WHERE token='$token'";
			$this->set_query();
		}

		public function attempts($us){   // Se obtiene el Nº de intentos.
            
			$this->query = "SELECT * FROM usuarios WHERE us = '$us'";
			$this->get_query();

			$num_rows = count($this->rows);
			$data = array();
			foreach($this->rows as $llave => $valor){
				array_push($data, $valor);
			}
			return $data;
		}

		public function resetAttemps($us, $pass){  // Zetea el Nº de intentos en 4 en la BBDD.
           
			$data = array();
			foreach($this->rows as $key => $value){
				array_push($data, $value); 			
			}

			$row = array_column($data, 'pass');
			
			foreach ($row as $hash) 
				$pwd = (password_verify($_POST['pass'], $hash)) ? true : false; 

			$this->query = "UPDATE usuarios SET intentos = 4 WHERE us = '$us' AND '$pwd' = true ";
			$this->set_query();
		}
		
		public function validate_user($us, $pass){ // Método para verificar la contraseña.
			
			$this->query = "SELECT * FROM usuarios WHERE us = '$us'";

			$this->get_query();
            
			$data = array();
			foreach($this->rows as $key => $value){
				array_push($data, $value); 			
			}
            
			$row = array_column($data, 'pass');
			//print_r($row);
			foreach ($row as $hash) 
				if (password_verify($_POST['pass'], $hash)) return $data;                          
		}

		public function saber_dia() { // Método que realiza la función de ver en qué condición está cada tabla con respecto al día, mes y año.
			$method = new Algorithm($this->fh, $this->tabla);
			$method->algorithm();
		}
		
		public function __destruct(){
			
		}
	}
