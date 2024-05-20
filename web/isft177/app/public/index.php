<?php
# AUTOCARGADOR DE CONTROLADORES Y MODELOS
spl_autoload_register(function ($class) {
	if (strpos($class, "Controller")) {
		require_once '../controllers/' . $class . '.php';
	}
	if (strpos($class, "Model")) {
		require_once '../models/' . $class . '.php';
	};
});

// require_once '../config/MysqlDb.php';

# CARGO LA PLANTILLA PRINCIPAL
$index = new IndexController;
$index->run();

/*$model_sql = new model_sql();
$model_sql->testConnection(); // Prueba la conexión a la base de datos*/
