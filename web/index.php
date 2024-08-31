<?php
 error_reporting(E_ALL);

 ini_set('ignore_repead_errors', TRUE);

 ini_set('display_errors',FALSE);

 ini_set('log_errors', TRUE);

 ini_set('error_log', "/var/www/html/php-error.log");

 error_log("Inicio de aplicacion");

# AUTOCARGADOR DE CONTROLADORES Y MODELOS
spl_autoload_register(function ($class) {
	if (strpos($class, "Controller")) {
		require_once 'controllers/' . $class . '.php';
	}
	if (strpos($class, "Model")) {
		require_once 'models/' . $class . '.php';
	};
});

require 'vendor/autoload.php';

require_once 'config/MysqlDb.php';

# CARGO LA PLANTILLA PRINCIPAL
$index = new IndexController;
$index->run();

/*$model_sql = new model_sql();
$model_sql->testConnection(); // Prueba la conexión a la base de datos*/
