<?php
class UsersModels extends Model{
	public $fh;
    public $tabla;
    public $see;
    private $Result;
	
	public function __construct($date, $num, $table = 0){ // La variable "$table" puede ser sobreescrita.
		
		$this->fh = $date;
        
    if($table == 'Selección')
        $this->tabla = $num; 
    else 
        $this->tabla = $table;
	}

	public function set( $user_data = array() ){
		
		foreach($user_data as $key => $value){
			$$key = $value; // El "$$key(variable, variable)", para que los datos recibidos en el arreglo "$user_data" se alamacenen en variables.
			    
                $token = MD5($_POST['us'].'+'.$_POST['email']); // Genera un token, por ahora sin uso.
				$clave = $_POST['pass'];                         
				$pass = password_hash($clave, PASSWORD_DEFAULT); // Encripta la contraseña  
			}
				$this->query = "Call Add_User('$us', '$token', '$email', '$name', '$tabla', '". $pass ."', '$role')";
				
			$this->set_query();
		}

		public function setu( $user_data = array() ){
            
			foreach ($user_data as $key => $value) {
				$$key = $value;
				//$token = MD5($_POST['us'].'+'.$_POST['email']); // Será utilizado en el futuro.
			}

			$this->query = "UPDATE usuarios SET email = '$email', name = '$name', tabla = '$tabla', role = '$role' 
			                WHERE us = '$us'";
			                 
			$this->set_query();
		}
		
		public function get($us = ''){
			
			$this ->query = ($us != '')
			?"SELECT * FROM usuarios WHERE us = '$us'" 
			:"SELECT us, email, name, tabla, role FROM usuarios";
			
			$this->get_query();
			
			$num_rows = count($this->rows);
			
			$data = array();
			foreach($this->rows as $key => $value){
				array_push($data, $value); 
			}
			return $data;
		}
		
		public function del( $us = '' ){
			
			$this->query = "DELETE FROM usuarios WHERE us = '$us'";
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
			print_r($row);
			foreach ($row as $hash) 
				if (password_verify($_POST['pass'], $hash)) return $data;                          
		}

		public function saber_dia() { // Método que realiza la función de ver en qué condición está cada tabla con respecto al día, mes y año. Este métdo será cambiado a otro archivo en el futuro.
            
			$fr = explode("-", $this->fh);
			@$fer = $fr[0]."/".$fr[1]."/".$fr[2];
			$days = array('Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado');
			$num = @$days[date('N', strtotime($fer))];
			$see = ($num !== NULL)?$num:"Domingo";

			if (!isset($this->fh)) {

				require_once('../metro/views/welcome.php');

			}elseif($fer === '//' or $this->tabla === 'Selección'){

				require_once('../metro/views/must.php');

			}else{
				switch ($this->tabla){
					case '1':
					$ele = '30/06/2017';
					$fe = explode("/", $ele);
					$fech = $fe[2]."-".$fe[1]."-".$fe[0];
					break;

					case '2':
					$ele = '02/07/2017';
					$fe = explode("/", $ele);
					$fech = $fe[2]."-".$fe[1]."-".$fe[0];
					break;

					case '3':
					$ele = '04/07/2017';
					$fe = explode("/", $ele);
					$fech = $fe[2]."-".$fe[1]."-".$fe[0];
					break;

					case '4':
					$ele = '06/07/2017';
					$fe = explode("/", $ele);
					$fech = $fe[2]."-".$fe[1]."-".$fe[0];
					break;

					case '5':
					$ele = '08/07/2017';
					$fe = explode("/", $ele);
					$fech = $fe[2]."-".$fe[1]."-".$fe[0];
					break;

					case '6':
					$ele = '10/07/2017';
					$fe = explode("/", $ele);
					$fech = $fe[2]."-".$fe[1]."-".$fe[0];
					break;

					case '7':
					$ele = '12/07/2017';
					$fe = explode("/", $ele);
					$fech = $fe[2]."-".$fe[1]."-".$fe[0];
					break;

					case '8':
					$ele = '14/07/2017';
					$fe = explode("/", $ele);
					$fech = $fe[2]."-".$fe[1]."-".$fe[0];
					break;

					case '9':
					$ele = '16/07/2017';
					$fe = explode("/", $ele);
					$fech = $fe[2]."-".$fe[1]."-".$fe[0];
					break;

					case '10':
					$ele = '18/07/2017';
					$fe = explode("/", $ele);
					$fech = $fe[2]."-".$fe[1]."-".$fe[0];
					break;

					case '11':
					$ele = '20/07/2017';
					$fe = explode("/", $ele);
					$fech = $fe[2]."-".$fe[1]."-".$fe[0];
					break;

					case '12':
					$ele = '22/07/2017';
					$fe = explode("/", $ele);
					$fech = $fe[2]."-".$fe[1]."-".$fe[0];
					break;

					case '13':
					$ele = '24/07/2017';
					$fe = explode("/", $ele);
					$fech = $fe[2]."-".$fe[1]."-".$fe[0];
					break;

					case '14':
					$ele = '26/07/2017';
					$fe = explode("/", $ele);
					$fech = $fe[2]."-".$fe[1]."-".$fe[0];
					break;

					case '15':
					$ele = '28/07/2017';
					$fe = explode("/", $ele);
					$fech = $fe[2]."-".$fe[1]."-".$fe[0];
					break;

					default:
					$ele = '30/07/2017';
					$fe = explode("/", $ele);
					$fech = $fe[2]."-".$fe[1]."-".$fe[0];
					break;
				}
				$dia = $this->fh;
				$f = explode("-", $dia);
				$fecha = $f[0]."/".$f[1]."/".$f[2];

				$V = array(
					'Es tu 1er. día de trabajo para la noche.',
					'Es tu 2do. día de trabajo para la noche.',
					'Es tu 3er. día de trabajo para la noche.',
					'Es tu 4to. día de trabajo para la noche.',
					'Es tu 5to. día de trabajo para la noche.',
					'Estás de noche!',
					'Es tu 1er. día libre de la noche.',
					'Es tu 2do. día libre de la noche.',
					'Es tu 1er. día de trabajo para los 3.',
					'Es tu 2do. día de trabajo para los 3.',
					'Es tu 3er. día de trabajo para los 3.',
					'Es tu 4to. día de trabajo para los 3.',
					'Es tu 5to. día de trabajo para los 3.',
					'Es tu 1er. día libre de los 3.',
					'Es tu 2do. día libre de los 3.',
					'Es tu 3er. día libre de los 3.'
				);

				$segundos=strtotime($fecha) - $pe=strtotime($fech);
				$N=intval($segundos/60/60/24, $pe/60/60/24) % 16;  

				$dia2 = $this->fh;
				$f2 = explode("-", $dia2);
				$fecha2 = $f2[2]."/".$f2[1]."/".$f2[0];

				if ($N + $this->tabla <= 15) {
					$N = ($N + $this->tabla) % 16;
					if ($N < 0) {
						$N = $N * (-1);
						$this->Result = $V[$N];
						if(isset($this->fh)){
							require_once('../metro/views/condition.php');

						}
					}else{
						$this->Result = $V[$N];
						if(isset($this->fh)){
							require_once('../metro/views/condition.php');

						}
					}
					if ($N == 3) {
						exit();
					}
				}else{
					$N = ($N + $this->tabla) % 16;
					$this->Result = $V[$N];
					if(isset($this->fh)){
						require_once('../metro/views/condition.php');

					}
				}
			}

		}
		
		public function __destruct(){
			
		}
	}
