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
            
				    header('Location: ./?error='.$_POST['us']);
				    die();
				}else{
					
					 $_SESSION['ok'] = true;
                     var_dump($session);
					 foreach($session as $row){
						 
						 $_SESSION['us'] = $row['us'];
						 $_SESSION['email'] = $row['email'];
						 $_SESSION['name'] = $row['name'];
						 $_SESSION['tabla'] = $row['tabla'];
						 $_SESSION['pass'] = $row['pass'];
						 $_SESSION['role'] = $row['role'];
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