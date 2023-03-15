<section id="show2">
	<article class="abc">
	<aside class="bc">
<?php
$date = '';
$num = '';
$table = 0;
$users_controller = new UsersController($date, $num, $table);

if( $_POST['rot'] == 'user-delete' && !isset($_POST['crud']) ){
	
	$user = $users_controller->get($_POST['us']);
	
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
		$template_user = '
		    <label class= "p1"><b>Eliminar Usuario:</b></label>
		    <form method= "POST" class= "item">
		      <label class= "p1"><b>
			     ¿Esta seguro de eliminar el Usuario: <mark class= "p1">%s</mark>?
		      </b></label>
              <div class= "p_25">
                 <input class= "button delete" type= "submit"	value= "Aceptar">
				 <input class= "button cancel" type= "button" value= "Cancelar" onclick= "history.back()">
				 <input type= "hidden" name= "us" value= "%s">
		  	     <input type= "hidden" name= "rot" value= "user-delete">
                 <input type= "hidden" name= "crud" value= "del">
              </div>
            </form>		   
	   ';
	   
	   printf(
	       $template_user,
		   $user[0]['us'],
		   $user[0]['us']
	   );
	}
}else if($_POST['rot'] == 'user-delete' && $_POST['crud'] == 'del' ){
	
	if ($_SESSION['role'] == 'Admin') {
		$user = $users_controller->del($_POST['us']);
	$template = '
	   <div class= "container">
	   <label class= "p1"><b>
	       <p class= "item delete">El Usuario <mark><b>%s</b></mark> fue eliminado</p>
	       </b></label>
	   </div>
	   <script>
	        window.onload = function(){
				reloadPage("users")
			}
	   </script>
	';
	 
	 printf($template, $_POST['us']);

	}else{

	$user = $users_controller->del($_POST['us']);
	$template = '
	   <div class= "container">
	   <label class= "p1"><b>
	       <p class= "item delete">El Usuario <mark><b>%s</b></mark> fue eliminado</p>
	       </b></label>
	   </div>
	   <script>
	        window.onload = function(){
				reloadPage("salir")
			}
	   </script>
	';
	 
	 printf($template, $_POST['us']);
	}
	 
}else{
	$controller = new ViewController();
	$controller-> load_view('error401');
}
?>
</aside>
</article>
</section>
