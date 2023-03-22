<?php

class Router{
	public $route;
	
	public function __construct($route){

		$session_options = array(
		   'use_only_cookies' => 1,
		   'read_and_close' => false
		);
		
		if( !isset($_SESSION) )  session_start($session_options);
		
		if( !isset($_SESSION['ok']) )  $_SESSION['ok'] = false;
		
		if($_SESSION['ok']){
			
			$this->route =  isset($_GET['rot']) ? $_GET['rot'] : 'home';
			$controller = new ViewController();
			
			switch($this->route){
				case 'home':			    
                    $controller->load_view('home');
				break;
				
				case 'users':
                    if( !isset( $_POST['rot'] ) )  $controller->load_view('users');
					else if( $_POST['rot'] == 'user-add' )  $controller->load_view('user-add');
					else if( $_POST['rot'] == 'user-edit' )  $controller->load_view('user-edit');
					else if( $_POST['rot'] == 'user-delete' )  $controller->load_view('user-delete');
				break;

				case 'acerca':
                    if( $_GET['rot'] == 'acerca' )  $controller->load_view('acerca');
                break;

                case 'trabajos':
                    if( $_GET['rot'] == 'trabajos' )  $controller->load_view('trabajos');
                break;

                case 'contacto':
                    if( $_GET['rot'] == 'contacto' )  $controller->load_view('contacto');
                break;
				
				case 'salir':
				    $user_session = new SessionController();
				    $user_session->logout();
				break;
				
				default :
				    $controller->load_view('error404');
				break;
			}

		}else if (isset($_GET['rot'])) {
               
                $this->route =  isset($_GET['rot']) ? $_GET['rot'] : 'registro';
        		$controller = new ViewController();
        		switch($this->route){
				case 'registro':			    
                        $controller->load_view('registro');
				break;

				case 'acerca':
                    $controller->load_view('acerca');
                break;

                case 'trabajos':
                    $controller->load_view('trabajos');
                break;

                case 'contacto':
                    $controller->load_view('contacto');
                break;

				case 'salir':
				    $user_session = new SessionReg();
				    $session = $user_session->logout();
			    }
			
		}else{
			
			if( !isset($_POST['us']) && !isset($_POST['pass']) ){
				$login_form = new ViewController();
			    $login_form->load_view('login');
			}else{
				$user_session = new SessionController();
				$session = $user_session->login($_POST['us'], $_POST['pass']);
				
				if(empty($session)){
					
					$login_form = new ViewController();
			        $login_form->load_view('login');

					$controller = new UsersController($_POST['us'], $_POST['pass']);
					$resp = $controller->nroIntentos($_POST['us']);

					foreach($resp as $valor){
						$token = $valor['token'];
						$usuario = $valor['us'];
						$intentos = $valor['intentos'] - 1;
					}

					$save_user = array(
						'token' => $token,
						'us' => $usuario,
						'intentos' => $intentos
					);

					$resp = $controller->setIntentos($save_user);

					$resp = $controller->nroIntentos($_POST['us']);

					foreach($resp as $val){
						$token = $val['token'];
						$usuario = $val['us'];
						$correo = $val['email'];
						$int = $val['intentos'];
					}

					if (preg_match('/^[0-9a-zA-ZñÑüÜáéíóúÁÉÍÓÚ ]+$/', $_POST['us']) == false){
                     	
    		            header('Location: ./?error='.$_POST['us']);

    		         }elseif ($usuario == ''){
                     	
    		            header('Location: ./?error='.$_POST['us']);

			         } elseif (preg_match('/^[0-9a-zA-Z@_*.]+$/', $_POST['pass']) == false){

                        if ($int > 0) {
                        header('Location: ./?error2=Colocó caracteres no perimitidos, revise sus datos.<br>Tienes máximo 3 intentos, de los cuales te quedan '. $int);
                        }else{
			         		header('Location: ./?error3=RECAPTCHA: ha superado el límite de intentos');
                        }

			         } else {

			         	if ($int > 0) {
			         		if($int == 1){
			         			header('Location: ./?error3=El usuario ' . $usuario . '  y/o contraseña no coinciden.<br>Tienes máximo 3, de los cuales te queda '. $int);
			         		}else{
			         			header('Location: ./?error3=El usuario ' . $usuario . '  y/o contraseña no coinciden.<br>Tienes máximo 3, de los cuales te quedan '. $int);
			         		}
				        
			         	}else{
			         		header('Location: ./?error3=RECAPTCHA: ha superado el límite de intentos');
                        }
				     }

				}else{
					
					 $_SESSION['ok'] = true;
                
					 foreach($session as $row){
						 
						 $_SESSION['us'] = $row['us'];
						 $_SESSION['token'] = $row['token'];
						 $_SESSION['email'] = $row['email'];
						 $_SESSION['name'] = $row['name'];
						 $_SESSION['tabla'] = $row['tabla'];
						 $_SESSION['pass'] = $row['pass'];
						 $_SESSION['role'] = $row['role'];
						 $_SESSION['intentos'] = $row['intentos'];
					 }
					 
					 header('Location: ./');
				}
			}	
		}
	}
	
	public function __destruct(){
		//unset($this);
	}
}
?>