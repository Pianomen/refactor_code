<?php ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

require_once("../sec.php"); pathcheck(MYPATH);
require_once("../classes/crud.php");
require_once("../classes/admin_login.php");

header("Cache-Control: no-cache, must-revalidate");

if (!defined('PDO::ATTR_DRIVER_NAME')) {
		echo "your PDO driver isn't defined or installed";
}else{

	if(__DIR__){

		#Admin page load

		if(isset($_POST["load_adm"]) && $_POST["load_adm"] === "1"){

			// Start read query
			$response = $User::read(); //"SELECT * FROM `workers` ORDER BY id DESC"

			foreach($response as $resp) {

			   //  echo "<div class='data--fields'>
						// <p style='background:blueviolet; color:snow; padding:1%;' data-id='".$resp['id']."'><span>".$resp['name_surname']."</span> | <span>".$resp['address']."</span> | <span>".$resp['phone']."</span> | <span>".$resp['state']."</span>&nbsp;&nbsp;&nbsp;&nbsp;<a href='javascript:;' class='update_usr'>Update</a> &nbsp;&nbsp;&nbsp;&nbsp; <a href='javascript:; class='delete_usr'>Delete</a>
						// </p>
				  //     </div>";
				 echo "<div class='data--fields_admin'>
						<p style='background:blueviolet; color:snow; padding:1%;' data-id='".$resp['id']."'><span class='mgmr_workers'><a href='javascript:;'>".$resp['name_surname']."</a></span> | <span>".$resp['address']."</span> | <span>".$resp['phone']."</span> | <span>".$resp['state']."</span>&nbsp;&nbsp;&nbsp;&nbsp; <input type='radio' name='radio' style='float:right; margin-right:10%;' value='".$resp['id']."' > </p>
				      </div>";
			}
			// End read query

		}

		#Get user id and set to hidden input

		if(isset($_POST["usr_id"]) && $_POST["usr_id"]){
			#UPDATE users SET name=:name, surname=:surname, sex=:sex WHERE id=:id chi uxarkum ajax ov uxaki haytararca

			#Update
			$user_id = $_POST["usr_id"];

			$query = $User::read("SELECT * FROM `workers` WHERE id=$user_id");
			// var_dump($query);exit;
			// foreach($query as $q){

					echo "
			            <span class='cross_pop'>X</span>
						<input type='hidden' name='' value='".$query[0]['id']."' class='hide_usr_id'>
				        <label>Name <br>
						   <input type='text' value='".$query[0]['name_surname']."' class='edit_name'>
						</label><br>
						<label>Address <br>
						   <input type='text' value='".$query[0]['address']."' class='edit_addr'>
						</label> <br>
						<label>Tel <br>
						   <input type='text' value='".$query[0]['phone']."' class='edit_tel'>
						</label><br>
						<label>State <br>
						   <input type='text' value='".$query[0]['state']."' class='edit_state'>
						</label><br> <br>
						<button class='update_user_btn'>Edit</button>";

			// }

		}

		# Update Users

		if(isset($_POST["new_n"]) && $_POST["new_n"] && isset($_POST["new_a"]) && $_POST["new_a"] && isset($_POST["new_t"]) && $_POST["new_t"] && isset($_POST["new_s"]) && $_POST["new_s"] && isset($_POST["user_id"]) && $_POST["user_id"]){

			$User::update("UPDATE `workers` SET name_surname=:name, address=:address, phone=:phone, state=:state WHERE id=:id",
					[
					'name'    => $_POST["new_n"],
					'address' => $_POST["new_a"],
					'phone'   => $_POST["new_t"],
					'state'   => $_POST["new_s"],
					'id'      => $_POST["user_id"]
				]);

		}


		# Create User Data

		if(isset($_POST["usr_name"]) && $_POST["usr_name"] && isset($_POST["usr_addr"]) && $_POST["usr_addr"] && isset($_POST["usr_tel"]) && $_POST["usr_tel"] && isset($_POST["usr_state"]) && $_POST["usr_state"]){


			$User::create([$_POST['usr_name'],$_POST['usr_addr'],$_POST['usr_tel'],$_POST['usr_state']]);


		}


		// if( isset($_POST["admin_name"]) && $_POST["admin_name"] && isset($_POST["admin_pass"]) && $_POST["admin_pass"]  ){

		// 	echo "Data is defined ";
		//     $log_in::session_admin($_POST["admin_name"], $_POST["admin_pass"])

  //       }

	}else{
		echo "something wrong";
		// die(-1);
    }

}

/*

$User::create("INSERT INTO workers(`name_surname`, `address`, `phone`, `state`)
				         VALUES ( '" . $_POST['usr_name'] ."','".$_POST['usr_addr']."','".$_POST['usr_tel']."','".$_POST['usr_state'] ."' ) ");
*/




