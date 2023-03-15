<section id="contenido">
      <article class="b">
		<aside class="a">
<?php
if(!isset($_POST['crud']) ){
	print('
		
	    <label class= "p1"><b>Ingresa tus Datos:</b></label>
		<form method= "POST" class= "item">
		   <div class= "p_25">
		      <input type= "text" name= "us" placeholder= "usuario" required>
		   </div>
		   <div class= "p_25">
		      <input type= "email" name= "email" placeholder= "email" required>
		   </div>
		   <div class= "p_25">
		      <input type= "text" name= "name" placeholder= "nombre" required>
		   </div>
		   <div class= "p_25">
		      <input type="password" style="width : 214px; heigth : 1px" name="pass" placeholder="contraseña" required>
		      <select id="tab" style="width : 90px; heigth : 1px" name="tabla" class="select" placeholder= "tabla" required>
        <option>tabla</option>');
        $T = array('01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16');
        for ($i=0; $i<count($T); $i++) {
                   print("<option value=".$T[$i].">tabla ".$T[$i]."</option>");   
        }
          print('</select>
		   </div>
		   <div class= "p_25">
			       <input type= "hidden" name= "role" value= "User">
		         </div>
           <div class= "p_25">
           <form method= "POST">
              <input class= "button add" type= "submit" value= "Registrar"> 
			  <input class= "button cancel" type= "button" value= "Cancelar" onclick= "history.back()">
			  <input type= "hidden" name= "rot" value= "registro">
              <input type= "hidden" name= "crud" value= "set">
              </form>
           </div>
        </form>
        		   
	');

}else if( $_POST['rot'] == 'registro' && $_POST['crud'] == 'set' ){

	$users_controller = new UsersController(@$date, @$num, @$table);
	$user = $users_controller->get($_POST['us']);
	$email = $users_controller->get();
	
	$new_user = array(
	   'us' => $_POST['us'],
	   'email' => $_POST['email'],
	   'name' => $_POST['name'],
	   'tabla' => $_POST['tabla'],
	   'pass' => $_POST['pass'],
	   'role' => $_POST['role']
	);

	foreach ($_POST as $key => $value) {
    switch ($key) {
   	case 'us':
   	   if (empty($_POST['us'])) {
   	   	$template2 = '
	   <div class= "container">
	        <label class= "p1">
	   	        <b>
	                <p class= "item delete">El campo Usuario no debe estar vacio!</p>
	            </b>
	        </label>
	   </div>
	   <script>
	        window.onload = function(){
				reloadPage("registro")
			}
	   </script>
	';
	$errors = false;
	printf($template2);
    }
    
    $us = array_column($user, 'us');
   	if (in_array($value, $us) == true){
		$template2 = '
	   <div class= "container">
	        <label class= "p1">
	   	        <b>
	                <p class= "item delete">El Usuario <mark><b>%s</b></mark> ya está registrado!</p>
	            </b>
	        </label>
	   </div>
	   <script>
	        window.onload = function(){
				reloadPage("registro")
			}
	   </script>
	';
	$errors = false;
	printf($template2, $_POST['us']);

	}

	break;

    case 'email':
      $emails = array_column($email, 'email');
      if(in_array($value, $emails) == true){
      
      $template2 = '
	   <div class= "container">
	        <label class= "p1">
	   	        <b>
	                <p class= "item delete">Esta dirección de correo <mark><b>%s</b></mark> ya está registrada!</p>
	            </b>
	        </label>
	   </div>
	   <script>
	        window.onload = function(){
				reloadPage("registro")
			}
	   </script>
	';
     $errors = false;
     printf($template2, $_POST['email']);
        }

      if($users_controller->noEmail($value) === false){
      
      $template2 = '
	   <div class= "container">
	        <label class= "p1">
	   	        <b>
	                <p class= "item delete">La dirección de correo <mark><b>%s</b></mark> es incorrecta!</p>
	            </b>
	        </label>
	   </div>
	   <script>
	        window.onload = function(){
				reloadPage("registro")
			}
	   </script>
	';
     $errors = false;
	 printf($template2, $_POST['email']);
	 }

	 break;

	 case 'name':
	   if(empty($_POST['name'])){
	   	$template2 = '
	   <div class= "container">
	        <label class= "p1">
	   	        <b>
	                <p class= "item delete">El campo Nombre no debe estar vacio!</p>
	            </b>
	        </label>
	   </div>
	   <script>
	        window.onload = function(){
				reloadPage("registro")
			}
	   </script>
	';
     $errors = false;
	 printf($template2);
	   } 
    break;

    case 'tabla':
	   if($_POST['tabla'] == 'tabla' || empty($_POST['tabla'])){
	   	$template2 = '
	   <div class= "container">
	        <label class= "p1">
	   	        <b>
	                <p class= "item delete">Debe seleccionar una tabla!</p>
	            </b>
	        </label>
	   </div>
	   <script>
	        window.onload = function(){
				reloadPage("registro")
			}
	   </script>
	';
	
     $errors = false;
	 printf($template2);
	   } 
    break;

    case 'pass':
	   if(empty($_POST['pass'])){
	   	$template2 = '
	   <div class= "container">
	       <label class= "p1">
	   	        <b>
	               <p class= "item delete">El campo Contraseña no debe estar vacio!</p>
	            </b>
	        </label>
	   </div>
	   <script>
	        window.onload = function(){
				reloadPage("registro")
			}
	   </script>
	';

     $errors = false;
	 printf($template2);
	   } 
    break;

	 default:
     
      break;
  }
}

if(@$errors !== false){
    $user = $users_controller->set($new_user);
    $template = '
	   <div class= "container">
	        <label class= "p1">
	   	        <b>
	                <p class= "item delete">El Usuario <mark><b>%s</b></mark> salvado!</p>
	            </b>
	        </label>
	   </div>
	   <script>
	        window.onload = function(){
				reloadPage("./")
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
<footer>
	
</footer>
