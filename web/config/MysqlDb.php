<?php

class model_sql
{
   
//funcion que conecta la base de dato
   static  public function connectToDatabase()
    {
        $hostname = getenv("MYSQLSERVER");
        $database = getenv("DB_NAME_isft177");
        $username = getenv("MYSQL_USER");
        $password = getenv("MYSQL_PASSWORD");
        //$PORT="3307";
        $charset = "utf8";
      
        try {
            $connection = "mysql:host=" . $hostname . ";dbname=" . $database . ";charset=" . $charset;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            $pdo = new PDO($connection, $username, $password, $options);
            return $pdo;
        } catch (PDOException $e) {
            echo 'Error de conexión: ' . $e->getMessage();
            exit;
        }
    }


     static public function testConnection()
    {
        $pdo = self::connectToDatabase(); // Llama al método estático de conexión

        if ($pdo) {
           echo "conexion exitosa";
        } else {
            echo 'Error al conectar a la base de datos.';
        }
    }
}


