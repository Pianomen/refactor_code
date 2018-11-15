<?php require_once("sec.php"); pathcheck(MYPATH);

define("DB_HOST", "local.projects");
define("DB_NAME", "my_task");
define("DB_USER", "root");
define("DB_PASS", "root");
define("BASE_URL", "http://local.projects/astudio_task/php/");



try {
	$conn = new PDO("mysql:host=". DB_HOST .";dbname=". DB_NAME ."", DB_USER, DB_PASS, array(PDO::ATTR_PERSISTENT => true,PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true)); //dbname={DB_NAME} // charset=utf8mb4_unicode_ci
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND , "SET NAMES 'utf8mb4_unicode_ci'");
}catch(PDOException $e){
	print_r("<pre>");
    echo $e->getMessage();
    #$res = "Data undefined";
}