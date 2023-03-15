<?php 
class Autoload{   // Autocargador de archivos con sus clases.
    
	public function __construct(){
		
        spl_autoload_register(function($class_name){ // Método que enruta los archivos automaticamente.
            $models_path = './models/' .$class_name. '.php';
            $controllers_path = './controllers/' .$class_name. '.php';

            // Métodos que verifican sí existen los archivos.
            if(file_exists($models_path))  require_once($models_path);
            if(file_exists($controllers_path))  require_once($controllers_path);
		});
		
	}
	
	public function __destruct(){
		//unset($this);
	}
}
?>