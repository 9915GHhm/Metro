<?php
require_once('./controllers/Autoload.php');
$autoload = new Autoload();

$route = isset($_GET['rot']) ? $_GET['rot'] : 'home'; /*(isset) se usa para saber sí una variable está 
definida o no, y esta, la cual es ('rot'), está definida en el archivo(.htaccess) la cual está formada 
de esta manera(rot=$1 [L]). Y sí no está definida, en esta ocación se seleccinó el valor('home').*/
$metro = new Router($route);

?>