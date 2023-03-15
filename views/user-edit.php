<section id="show2">
	<article class="abc">
	<aside class="bc">
<?php
$date = "";
$num = 0;
$table = 0;

$users_controller = new UsersController($date, $num, $table);
$user = $users_controller->get($_POST['us']);

if( $_POST['rot'] == 'user-edit' && $_SESSION['role'] == 'Admin' && !isset($_POST['crud']) ){
	
	//$user = $users_controller->get($_POST['us']);
	
	if( empty($user) ){
		$template = '
		     <div class= "container">
	            <p class= "item error">No existe el Usuario. <b>%s</b></p>
	         </div>
	         <script>
	             window.onload = function(){
		     		reloadPage("users")
		     	}
	         </script>
	    ';
		
		printf($template, $_POST['us']);
		
	}else{
		$role_admin = ($user[0]['role'] == 'Admin') ? 'checked' : '';
		$role_user = ($user[0]['role'] == 'User') ? 'checked' : '';
		
		$template_user = '
		    <label class= "p1"><b>Editar Usuario</b></label>
		    <form method= "POST" class= "item">
		        <div class= "p_25">
		             <input type= "text" placeholder= "usuario" value= "%s" disabled required>
			       <input type= "hidden" name= "us" value= "%s">
		         </div>
		         <div class= "p_25">
		              <input type= "hidden" name= "email" placeholder= "email" value= "%s" required>
		         </div>
		         <div class= "p_25">
		              <input type= "text" name= "name" value= "%s">
		         </div>
		         <div class= "p_25">
		              <input type= "text" name= "tabla" value= "%s">
		         </div>
		         <div class= "p_25">
		            <input type= "radio" name= "role" id= "admin" value= "Admin" %s required><label for= "admin">Administrador</label>
			      <input type= "radio" name= "role" id= "noadmin" value= "User" %s required><label for= "noadmin">Usuario</label>
		         </div>
			    <div class= "p_25">
		            <input class= "button edit"  type= "submit" value= "Editar">
				    <input class= "button delete" type= "button" value= "Cancelar" onclick= "history.back()">	
			        <input type= "hidden" name= "rot" value= "user-edit">
				    <input type= "hidden" name= "crud" value= "setu">
		         </div>
            </form>		   
	   ';
	   
	   printf(
	       $template_user,
		     $user[0]['us'],
		     $user[0]['us'],
	         $user[0]['email'],
	         $user[0]['name'],
	         $user[0]['tabla'],
		    $role_admin,
		    $role_user
	   );

	}
}else if($_POST['rot'] == 'user-edit' && $_SESSION['role'] == 'Admin' && $_POST['crud'] == 'setu' ){
	// esta variable "$role" es para verificar el rol al cual se le hará modificación.
	$role = $user[0]['role']; 

	if ($_POST['tabla'] < 1 || $_POST['tabla'] > 16) {
	   	$template = '
	   <div class= "container">
	      <label class= "p1">
	   	    <b>
	           <p class= "item edit">El número es invalido, este no debe ser menor de 1 y ni mayor de 16.</p>
	        </b>
	      </label>
	   </div>
	   <script>
	        window.onload = function(){
				reloadPage("users")
			}
	   </script>
	';
	 
	 printf($template, $_POST['tabla']);
	   }else{
	$save_user = array(
	    'us' => $_POST['us'],
	    'email' => $_POST['email'],
	    'name' => $_POST['name'],
	    'tabla' => $_POST['tabla'],
	    'role' => $_POST['role']
	);

	$user = $users_controller->setu($save_user);
	
	

	if ($_SESSION['role'] == 'Admin' && $role == 'User') {
		$template = '
	       <div class= "container">
	            <label class= "p1">
	   	            <b>
	                    <p class= "item edit">El Usuario <mark><b>%s</b></mark> salvado.</p>
	                </b>
	            </label>
	       </div>
	       <script>
	            window.onload = function(){
				    reloadPage("users")
			    }
	       </script>
	    ';
	 
	     printf($template, $_POST['us']);

	    } else {
		    $template = '
	       <div class= "container">
	            <label class= "p1">
	   	            <b>
	                    <p class= "item edit">El Usuario <mark><b>%s</b></mark> salvado.</p>
	                    <p>Deberá iniciar sesión nuevamente.</p>
	                </b>
	            </label>
	       </div>
	       <script>
	            window.onload = function(){
				    reloadPage("users")
			    }
	       </script>
	       
	    ';
	 
	     printf($template, $_POST['us']);
	    }
	}
	 
}else{
	$controller = new ViewController();
	$controller-> load_view('error401');
}
?>
</aside>
</article>
</section>

<!-- $role = $user[0]['role'];
	var_dump($_SESSION['role']);
	//var_dump($_POST['rot'], $_SESSION['role'], $_POST['crud']);
	if ($_POST['tabla'] < 1 || $_POST['tabla'] > 16) {
		//var_dump($_POST['tabla']);
	   	$template = '
	   <div class= "container">
	      <label class= "p1">
	   	    <b>
	           <p class= "item edit">El número es invalido, este no debe ser menor de 1 y ni mayor de 16.</p>
	        </b>
	      </label>
	   </div>
	   <script>
	        window.onload = function(){
				reloadPage("users")
			}
	   </script>
	';
	 
	 printf($template, $_POST['tabla']);

	 }else{

	$save_user = array(
	    'us' => $_POST['us'],
	    'email' => $_POST['email'],
	    'name' => $_POST['name'],
	    'tabla' => $_POST['tabla'],
	    'role' => $_POST['role']
	);

	$user = $users_controller->setu($save_user);
	
	if ($_SESSION['role'] == 'Admin' && $role != 'User') {
		$template = '
	       <div class= "container">
	            <label class= "p1">
	   	            <b>
	                    <p class= "item edit">El Usuario <mark><b>%s</b></mark> salvado.</p>
	                </b>
	            </label>
	       </div>
	       <script>
	            window.onload = function(){
				    reloadPage("users")
			    }
	       </script>
	    ';
	 
	     printf($template, $_POST['us']);

	    } else {
		    $template = '
	       <div class= "container">
	            <label class= "p1">
	   	            <b>
	                    <p class= "item edit">El Usuario <mark><b>%s</b></mark> salvado.</p>
	                    <p>Deberá iniciar sesión nuevamente.</p>
	                </b>
	            </label>
	       </div>
	       <h1>En Admin</h1>
	       <script>
	            window.onload = function(){
				    reloadPage("users")
			    }
	       </script>
	       
	    ';
	 
	     printf($template, $_POST['us']);
	    }
	 } -->