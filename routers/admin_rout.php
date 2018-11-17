<?php ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

require_once("../sec.php"); pathcheck(MYPATH);
require_once("../classes/crud.php");

header("Cache-Control: no-cache, must-revalidate");

if (!defined('PDO::ATTR_DRIVER_NAME')) {
		echo "your PDO driver isn't defined or installed";
}else{

	if(__DIR__){

		# Admin page load

		if(isset($_POST["load_adm"]) && $_POST["load_adm"] === "1"){

			# Start read query

			$response = $User::read();

			foreach($response as $resp) {

				 echo "<div class='data--fields_admin'>
						<p style='background:blueviolet; color:snow; padding:1%;' data-id='".$resp['id']."'><span class='mgmr_workers'>".$resp['name_surname']."</span> | <span>".$resp['address']."</span> | <span>".$resp['phone']."</span> | <span>".$resp['state']."</span> | <span>".$resp['email']."</span>&nbsp;&nbsp;&nbsp;&nbsp; <input type='radio' name='radio' style='float:right; margin-right:10%;' value='".$resp['id']."' > </p>
				       </div>";
			}
			// End read query

		}

		# admin login


	}else{
		echo "something wrong";
		// die(-1);
    }

}





