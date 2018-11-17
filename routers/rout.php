<?php ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

require_once(dirname(__FILE__) . "/../sec.php"); pathcheck(MYPATH);
require_once(dirname(__FILE__) . "/../classes/crud.php");

header("Cache-Control: no-cache, must-revalidate");


if (!defined('PDO::ATTR_DRIVER_NAME')) {
		echo "your PDO driver isn't defined or installed";
}else{

	if(__DIR__){

		# Page Load

		if(isset($_POST["load"]) && $_POST["load"] === "1"){

			$User::query("INSERT INTO admin_account(`name`,`password`)
			            SELECT * FROM (SELECT 'admin','root') AS tmp
			            WHERE NOT EXISTS (SELECT name FROM admin_account WHERE name = 'admin')
			            LIMIT 1");

			# Start read query
			$respon = $User::read(); //"SELECT * FROM `workers` ORDER BY id DESC"

			foreach($respon as $resp) {
			    echo "<div class='data--fields'>
						<p style='background:blueviolet; color:snow; padding:1%;' data-id='".$resp['id']."'><span>".$resp['name_surname']."</span> | <span>".$resp['address']."</span> | <span>".$resp['phone']."</span> | <span>".$resp['state']."</span> | <span>".$resp['email']."</span></p>
				      </div>";
			}
			// End read query
		}

		require_once("admin_rout.php");
		require_once("users_rout.php");


	}else{
		echo "something wrong";
		// die(-1);
    }

}