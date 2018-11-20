<?php ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

require_once(dirname(__FILE__) . "/../sec.php"); pathcheck(MYPATH);
require_once(dirname(__FILE__) . "/../classes/crud.php");

header("Cache-Control: no-cache, must-revalidate");

if (!defined('PDO::ATTR_DRIVER_NAME')) {
		echo "your PDO driver isn't defined or installed";
}else{

	if(__DIR__){

		#Get user id and set to hidden input

		if(isset($_POST["usr_id"]) && $_POST["usr_id"]){

			$user = $User::read( $_POST["usr_id"] );
			// foreach($user as $q){
					echo "
			            <span class='cross_pop'>X</span>
						<input type='hidden' name='' value='".$user[0]['id']."' class='hide_usr_id'>
				        <label>Name <br>
						   <input type='text' value='".$user[0]['name_surname']."' class='edit_name'>
						</label><br>
						<label>Address <br>
						   <input type='text' value='".$user[0]['address']."' class='edit_addr'>
						</label> <br>
						<label>Tel <br>
						   <input type='text' value='".$user[0]['phone']."' class='edit_tel'>
						</label><br>
						<label>State <br>
						   <input type='text' value='".$user[0]['state']."' class='edit_state'>
						</label><br>
						<label>Password <br>
						   <input type='text' value='".$user[0]['password']."' class='edit_pass'>
						</label><br>
						<label>Email <br>
						   <input type='text' value='".$user[0]['email']."' class='edit_email'>
						</label><br> <br>
						<button class='update_user_btn'>Edit</button>";

			// }

		}

		# Update Users

		if( isset($_POST["new_n"]) && $_POST["new_n"] && isset($_POST["new_a"]) && $_POST["new_a"] && isset($_POST["new_t"]) && $_POST["new_t"] && isset($_POST["new_s"]) && $_POST["new_s"] && isset($_POST["new_p"]) && $_POST["new_p"] && isset($_POST["new_e"]) && $_POST["new_e"] && isset($_POST["user_id"]) && $_POST["user_id"] ){

			$User::update([
					'name'     => $_POST["new_n"],
					'address'  => $_POST["new_a"],
					'phone'    => $_POST["new_t"],
					'state'    => $_POST["new_s"],
					'password' => $_POST["new_p"],
					'email'    => $_POST["new_e"],
					'id'       => $_POST["user_id"]
				]);

		}

		# Create User Data

		if(isset($_POST["usr_name"]) && $_POST["usr_name"] && isset($_POST["usr_addr"]) && $_POST["usr_addr"] && isset($_POST["usr_tel"]) && $_POST["usr_tel"] && isset($_POST["usr_state"]) && $_POST["usr_state"] && isset($_POST["usr_pass"]) && $_POST["usr_pass"] && isset($_POST["usr_email"]) && $_POST["usr_email"]){

			// session_start();
			$usr_id = $User::create([ $_POST['usr_name'],$_POST['usr_addr'],$_POST['usr_tel'],$_POST['usr_state'],$_POST["usr_pass"],$_POST["usr_email"] ]);

		}

		# if users exists create users session

		if(isset($_POST["log_u_e"]) && $_POST["log_u_e"] && isset($_POST["log_u_p"]) && $_POST["log_u_p"]){

			$usr = $User::usr_exists($_POST['log_u_e']);

			if( $usr ){
				session_start();
				$_SESSION["u_id"] = $usr["id"];
				$_SESSION["state"] = $usr["state"];
				$_SESSION["time_start_login_usr"] = time();
				echo "ok";
                //header("Location: ../users.php", TRUE, 301);
        	}else{
        		echo "lose";
        		//header("Location:". BASE_URL);
        	}

		}

		# User registration

		if(isset($_POST["na_user"]) && $_POST["na_user"] && isset($_POST["ad_user"]) && $_POST["ad_user"] && isset($_POST["ph_user"]) && $_POST["ph_user"] && isset($_POST["st_user"]) && $_POST["st_user"] && isset($_POST["pa_user"]) && $_POST["pa_user"] && isset($_POST["em_user"]) && $_POST["em_user"]){

			$exists = $User::email_exists( $_POST["em_user"] );

			if( $exists ){

				echo "email_exists";

			}else{

				// $usr_id = $User::create([ $_POST["na_user"],$_POST["ad_user"],$_POST["ph_user"],$_POST["st_user"],$_POST["pa_user"],$_POST["em_user"] ]);
				$User::create([ $_POST["na_user"],$_POST["ad_user"],$_POST["ph_user"],$_POST["st_user"],$_POST["pa_user"],$_POST["em_user"] ]);
			}

		}

		# Show only managers
		if(isset($_POST["managers_show"]) && $_POST["managers_show"] === "show"){

			$response = $User::mgr_show();
			foreach ($response as $resp_data) {

				echo "<div class='data--fields_admin'>
						<p style='background:blueviolet; color:snow; padding:1%;'><span class='mgmr_workers'><a href='javascript:;'>".$resp_data['name_surname']."</a></span> | <span>".$resp_data['address']."</span> | <span>".$resp_data['phone']."</span> | <span>".$resp_data['state']."</span> | <span>".$resp_data['email']."</span>&nbsp;&nbsp;&nbsp;&nbsp; <input type='radio' name='radio' style='float:right; margin-right:10%;' value='".$resp_data['id']."' > </p>
				   </div>";
			}

			// if(!$response){
			// 	echo "managers cant view";
			// 	$asoc_data = $User::read();
			// 	foreach ($asoc_data as $data ) {
	  //       		echo "<div class='data--fields_admin'>
			// 			<p style='background:blueviolet; color:snow; padding:1%;'><span class='mgmr_workers'><a href='javascript:;'>".$data['name_surname']."</a></span> | <span>".$data['address']."</span> | <span>".$data['phone']."</span> | <span>".$data['state']."</span> | <span>".$data['email']."</span>&nbsp;&nbsp;&nbsp;&nbsp; <input type='radio' name='radio' style='float:right; margin-right:10%;' value='".$data['id']."' > </p>
		 //                </div>";
			// 	}
			// }

		}

		# unchack manager
		if( isset($_POST["managers_hide"]) && $_POST["managers_hide"] === "hide" ){

			$asoc_data = $User::read();
				foreach ($asoc_data as $data ) {
	        		echo "<div class='data--fields_admin'>
						<p style='background:blueviolet; color:snow; padding:1%;'><span class='mgmr_workers'><a href='javascript:;'>".$data['name_surname']."</a></span> | <span>".$data['address']."</span> | <span>".$data['phone']."</span> | <span>".$data['state']."</span> | <span>".$data['email']."</span>&nbsp;&nbsp;&nbsp;&nbsp; <input type='radio' name='radio' style='float:right; margin-right:10%;' value='".$data['id']."' > </p>
		                </div>";
				}
		}


		#Show only workers
		if(isset($_POST["workers_show"]) && $_POST["workers_show"] === "show"){
			$res = $User::wrk_show();
			foreach ($res as $r ) {
	        		echo "<div class='data--fields_admin'>
						<p style='background:blueviolet; color:snow; padding:1%;'><span class='mgmr_workers'><a href='javascript:;'>".$r['name_surname']."</a></span> | <span>".$r['address']."</span> | <span>".$r['phone']."</span> | <span>".$r['state']."</span> | <span>".$r['email']."</span>&nbsp;&nbsp;&nbsp;&nbsp; <input type='radio' name='radio' style='float:right; margin-right:10%;' value='".$r['id']."' > </p>
		                </div>";
				}
		}

		# uncheck workers
		if(isset($_POST["workers_hide"]) && $_POST["workers_hide"] === "hide"){

			$resp = $User::read();
			foreach ($resp as $re ) {
	        		echo "<div class='data--fields_admin'>
						<p style='background:blueviolet; color:snow; padding:1%;'><span class='mgmr_workers'><a href='javascript:;'>".$re['name_surname']."</a></span> | <span>".$re['address']."</span> | <span>".$re['phone']."</span> | <span>".$re['state']."</span> | <span>".$re['email']."</span>&nbsp;&nbsp;&nbsp;&nbsp; <input type='radio' name='radio' style='float:right; margin-right:10%;' value='".$re['id']."' > </p>
		                </div>";
			}

		}

		# Delete user
		if( isset($_POST["radio_value"]) && $_POST["radio_value"] ){

	        $User::delete($_POST["radio_value"]);

		}


	}else{
		echo "something wrong";
		// die(-1);
    }

}