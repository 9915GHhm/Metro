<h2><center>Bienvenido a las Tablas de Rotación del<br> Metro de Caracas</center></h2><br><br>

<?php if( isset($_GET['error4']) ){
  $template = '<br>
     <div class="container">
         <h2 class="condition">Debe seleccionar tabla y fecha!!!</h2>
     </div><br/><br/><br/>
     <script>
          window.onload = function(){
        reloadPage("./")
      }
     </script>
  ';  
  printf($template, $_GET['error4']);
}else{
  ?>
  <h3 class="col"><center>Condición de la tabla: <m style="color:#42F784";><?php echo $this->table; ?></m></center></h3>   
  <h3 class="col"><center>Para el día <?php echo $see; ?>, de fecha: <m style="color:#42F784";><?php echo $fecha2; ?></m></center></h3><br>
  <h2 class="condi"><span class="parpadea text"><center><strong><?php echo $this->result; ?></strong></center>
  </h2><br><br>
<?php } ?>
<h3><center>Sí deseas conocer de otra tabla, selecciona una fecha y la tabla deseada,</center></h3>
<h3><center>luego haga click en el botón "Buscar" o presione "Enter".</center></h3>