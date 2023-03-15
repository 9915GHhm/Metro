<?php 
print('
   <section id="contenido">
      <section id="principal">
      <article id="galeria-inicio">
          <div class="flexslider">
            <ul class="slides">
              <li>
                <a href="http://bextlan.com"><img src="./public/img/slide-0.png" /></a>
                <p class="flex-caption">Jr`s Software  | lugar de... códigos backend y frontend.</p>
              </li>
              <li>
                <img src="./public/img/slide-1.png" />
                <p class="flex-caption">Curso de PHP(MVC) con MySql</p>
              </li>
              <li>
                <img src="./public/img/slide-2.png" />
                <p class="flex-caption">Curso de .NET con C# y VisualBasic</p>
              </li>
              <li>
                <a href="http://bextlan.com"><img src="./public/img/slide-3.png" /></a>
              </li>
            </ul>
          </div>
        </article>
        </section>
      <aside><br><br>
        <h3>Sí estás registrado aquí, puedes hacer<br>
            consultas de las tablas de servicio de<br>
            rotación del Metro de Caracas, y sí no<br>
            lo estás, registrate ya...<br><br></h3>
   <form method="POST" class="item">
       <div class = "p_25">
        <label class= "p1"><b>usuario:</b></label>
        <input type = "text" name = "us" placeholder = "usuario" required>
   </div>
     <div class = "p_25">
        <label class= "p1" for="password"><b>contraseña:</b></label>
        <input type = "password" name = "pass" placeholder = "password" required id="contrasena">
   </div>
   <div>
        <input type="checkbox" id="mostrar_contrasena" title="clic para mostrar contraseña"/><label class= "p1" for="password">&nbsp;Ver contraseña</label>
   </div><br>
   <div class = "p_25">
        <label id="p2"><b><a href = "registro">Registrarse</a></b></label>
   </div>
   <div class = "p_25">
        <input type = "submit" class = "button" value = "INGRESAR">
   </div><br>
   ');

       if( isset($_GET['error']) ){
  $template = '
     <div class= "container">
         <h4 class= "item edit">El Usuario <mar><b>%s</b></mark> y/o contraseña no coinciden</h4>
     </div>
     <script>
          window.onload = function(){
        reloadPage("./")
      }
     </script>
  ';  
  printf($template, $_GET['error']);
  
}
        print('
   </form>
      </aside>
    </section>  
');
?>

