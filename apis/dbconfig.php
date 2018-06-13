<?php 
/* 
 * Database connection string
 * */

    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASSWORD', '');
    define('DATABASE', 'test');
    define('DB_ENCODING', 'utf8');

    function DB() {
        static $instance;

        if ($instance === NULL) {
            $opt = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => FALSE,
            );
            $dsn = 'mysql:host='.HOST.';dbname='.DATABASE.';charset='.DB_ENCODING;
            $instance = new PDO($dsn, USER, PASSWORD, $opt);
        }

        return $instance;
    }
?>