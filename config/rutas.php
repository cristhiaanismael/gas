<?php
if (!defined('ruta')) {
$ruta=dirname(dirname(__FILE__));//nombre del host url
$ruta=str_replace("\\", "/", $ruta);
define('ruta', $ruta);
define('ruta_controllers', $ruta."/controller");
define('view', $ruta."/view");
define('view_controllers', $ruta."/view_controllers");

define('pdfs', $ruta."/pdfs");
define('templates', $ruta."/templates");

//si se modifica ruta de las imagenes se debe modificar estas 2
define('user_foto', $ruta."/request/upload/");
define('img', $ruta."/view/img/");

define('ruta_foto_servidor', "http://104.128.230.87/apparking/calidad/request/upload/");




define('ruta_models', $ruta."/models");
define ('ruta_conexion', $ruta."/core/conexion.php");
define ('ruta_config', $ruta."/config");
define ('ruta_request', $ruta."/request");

define('pref', 'app_');
define('psw_dev', 'devciru');//key para poder debuguear
//echo PRUEBA;
}
?>