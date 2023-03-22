<section id="show2">
 <article class = "abc">
 	<aside class="bc">
<?php
$date = "";
$num = 0;
$table = 0;

$users_controller = new UsersController($date, $num, $table);
if($_SESSION['role'] == 'Admin'){
$users = $users_controller->get();
//var_dump($users);
print('<label class= "p1"><b>GESTIÓN DE USUARIOS</b></label>');
if( empty($users) ){
	print('
	    <div class= "container">
		    <p class= "item error">No Hay Usuarios</p>
		</div>
	');
}else{
	$template_users = '
	<div class= "item">
	   <table>
	      <tr>
		     <th>Usuario</th>
			 <th>Correo</th>
			 <th>Nombre</th>
			 <th>Tabla</th>
			 <th>Rol</th>
			 <th>Editar</th>
			 <th>Eliminar</th>
	      </tr>';
	for($n=0; $n<count($users); $n++){
		$template_users .= '
		    <tr>
			   <td id="focus">' . $users[$n]['us'] . '</td>
			   <td id="focus">' . $users[$n]['email'] . '</td>
			   <td id="focus">' . $users[$n]['name'] . '</td>
			   <td id="focus">' . $users[$n]['tabla'] . '</td>
			   <td id="focus">' . $users[$n]['role'] . '</td>
			   <td>
			      <form method= "POST">
				     <input type= "hidden" name= "rot" value= "user-edit">
				     <input type= "hidden" name= "us" value= "' . $users[$n]['us'] . '">
				     <input class= "button edit" type= "submit" value= "Editar">
                  </form>				   
			   </td>
				<td>
			      <form method= "POST">
				     <input type= "hidden" name= "rot" value= "user-delete">
				     <input type= "hidden" name= "us" value= "' . $users[$n]['us'] . '">
				     <input class= "button delete" type= "submit" value= "Eliminar">
                  </form>				   
			   </td>
			</tr>
		';
	}
	
	$template_users .= '
	   </table>
	 </div>
	';
	
	print($template_users);

}
}else{
	if( $_SESSION['role'] == 'User' && !isset($_POST['crud']) ){

	$user = $users_controller->get($_SESSION['us']);
	if( empty($user) ){
		$template = '
		     <div class= "container">
		     <label class= "p1"><b>
	            <p class= "item error">No existe el Usuario <mark><b>'.$_SESSION['us'].'</b></mar> o fue eliminado!</p>
	            </b><label class= "p1">
	         </div>
	         <script>
	             window.onload = function(){
		     		reloadPage("home2")
		     	}
	         </script>
	    ';
		
		printf($template, $_POST['us']);
		
	}else{
		$role_user = ($user[0]['role'] == 'User') ? 'checked' : '';
		$template_user = '
		    <label class= "p1"><b>Editar Usuario / Eliminar suscripción</b></label>
		    <form method= "POST" class= "itemusers">
		        <div class= "p_25">
		             <input type= "text" placeholder= "usuario" value= "%s" disabled required>
			       <input type= "hidden" name= "us" value= "%s">
		         </div>
		         <div class= "p_25">
		              <input type="hidden" name="email" value="%s">
		         </div>
		         <div class= "p_25">
		              <input type="text" name="name" value="%s">
		         </div>
		         <div class= "p_25">
		              <input type="text" name="tabla" value="%s">
		         </div>
		         <div class= "p_25">
			      <input type="hidden" name="role" id="noadmin" value="User" %s required><label for= "noadmin"></label>
		         </div>
			    <div class= "p_25">
			       <form method="POST">
				    <input type="hidden" name="us" value="' . $user[0]['us'] . '">
		            <input class="button edit"  type="submit" value="Editar">
		            <input type="hidden" name="crud" value="setu">
				    <input class="button cancel" type="button" value="Cancelar" onclick="history.back()">	
				    </form>
			      <form method= "POST"><br>
				     <input type="hidden" name="rot" value="user-delete">
				     <input type="hidden" name="us" value="' . $user[0]['us'] . '">
				     <input class="button delete" type="submit" value="Eliminar">
                  </form>				   
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
		    $role_user
	   );
	}
}else if($_SESSION['role'] == 'User' && $_POST['crud'] == 'setu' ){
	
	$role = @$user[0]['role'];
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
	
		$template = '
	   <div class= "container">';
	   if ($_SESSION['name'] != $_POST['name']) {
	   	$template .='<label class= "p1">
	   	               <b>
	   	                  <p class= "item edit">Sus datos fueron actualizados éxitosamente!!!</p>
	   	                </b>
	   	             <label class= "p1">';
	   }else{
	   	$template .='<label class= "p1">
	   	                <b>
	   	                    <p class= "item edit">Su tabla se modificó a la <mark><b>Nº %s</b></mark> éxitosamente!!!</p>
	   	                </b>
	   	             <label class= "p1">';
	   }
	       
	   $template .='<label class= "p1">
	   	               <b>
	   	                   <p>Deberá iniciar sesión nuevamente.</p>
	   	               </b>
	   	            <label class= "p1">
	   </div>
	   <script>
	        window.onload = function(){
				reloadPage("salir")
			}
	   </script>
	';
       
	 printf($template, $_POST['tabla']);
	}
   
}else{
	$controller = new ViewController();
	$controller-> load_view('error401');
}
}
?>
</aside>
</section>
</article>