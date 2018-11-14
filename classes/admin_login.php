<?php require_once(__DIR__."/../sec.php"); pathcheck(MYPATH);//$_SERVER["DOCUMENT_ROOT"]
 //require_once(__DIR__."/../config.php");

class Log_in {


	public static function session_admin($ad_name,$ad_password){
		try {
			$conn = new PDO("mysql:host=". DB_HOST .";dbname=". DB_NAME ."", DB_USER, DB_PASS, array(PDO::ATTR_PERSISTENT => true)); //dbname={DB_NAME} // charset=utf8mb4_unicode_ci
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    $conn->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND , "SET NAMES 'utf8mb4_unicode_ci'");


		    // $pass = password_hash("$password", PASSWORD_DEFAULT);

		    $sql = "SELECT * FROM admin_account WHERE name=:name AND password=:password";

			$statement = $conn->prepare($sql);
			$statement->execute(
				array(
					':name'=> $ad_name,
					':password'=> $ad_password
			    )
		    );

			$count = $statement->rowCount();

			if($count > 0){

				$_SESSION["adm_name"] = $ad_name;

				header("Location: adm_dashboard.php");

			}else{
				header("Location: index.php");
			}

		    $conn = null;
		} catch(PDOException $e){
			print_r("<pre>");
			echo $sql . "<br>" . $e->getMessage();
			$message = "Data undefined";
   		}
	}

}


$log_in = new Log_in();

