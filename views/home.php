<body>
<div class='container'><br>
<form method= "GET" class= "item">  
    <header>
        <hgroup id="grup">
        <a id="imagen" href="https://www.catmeca.org.ve/" target="_blank"><img class="cat" src="./public/img/catmeca.png"></a>
        <aside style = "background:blue" class = "item  i-b  v-middle  ph12  lg3  lg-left"><br>
        <center>
        <label for="day"><b>SELECCIONAR FECHA:</b></label><br>
        
        <input type="date" name="date" class="date"><br><br>
          
    <label><b>Seleccionar tabla:</b></label>
    <select name="table" class="select">
        <option>Selección</option>
        <?php
        $T = array('01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16');
        for ($i=0; $i<count($T); $i++) {

            print("<option value=".$T[$i].">tabla ".$T[$i]."</option>");
        }
        ?>
    </select><br><br>
    </center>
        <input type="submit" class="button add" value="Buscar"><br>
      </aside>
     </hgroup>
  </header>
</div>
<section id="condition"> 
<?php
date_default_timezone_set('America/Caracas');
$template = '
<section id="show">
<div id="better" class="jumbotron header"><br> 
     <h3 class="di">Bienvenid@ %s,</h3>
     <h3 class="di">Tu tabla es la Nº %s</h3><br>
</div> 
</section><br>
     ';
     
printf(
       $template, 
       $_SESSION['name'],
       $_SESSION['tabla']
       );

$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
$tab = isset($_GET['table']) ? $_GET['table'] : $_SESSION['tabla'];

$users_controller = new UsersController($date, $_SESSION['tabla'], $tab);
$users = $users_controller->saber_dia();

?> 
</section>
</form>
<br><br><br>
</div>



