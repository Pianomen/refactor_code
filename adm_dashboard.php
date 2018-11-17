<?php ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
require_once(realpath("sec.php")); pathcheck(MYPATH);
require_once(dirname(__FILE__) . "/config.php");



header("Cache-Control: no-cache, must-revalidate");


session_start();
try {

	if(isset($_POST["login"])){
		// require_once(__DIR__."/classes/admin_login.php");
		if( empty($_POST["admin_n"]) || empty($_POST["admin_p"])){

			echo "Name or Password is empty ";

		}else{

			//$log_in::session_admin($_POST["admin_n"], $_POST["admin_p"]);
			$sql = "SELECT * FROM admin_account WHERE name=:name AND password=:password";

			$query = $conn->prepare($sql);
			$query->execute(
				array(
					':name'=> $_POST["admin_n"],
					':password'=> $_POST["admin_p"]
			    )
		    );

			$count = $query->rowCount();

			if($count >= 1){

				$_SESSION["adm_name"] = $_POST["admin_n"];
				$_SESSION['time_start_login'] = time();

				header("Location: adm_dashboard.php");

			}else{
				header("Location:" . BASE_URL);
			}

			$conn = null;

		}

		// if(empty()){

		// }

    }
} catch (Exception $e) {
	print_r("<pre>");
	echo $sql . "<br>" . $e->getMessage();
}



if( isset($_SESSION["adm_name"]) ) :
	if((time() - $_SESSION["time_start_login"]) > 1800){
		// admin session time
		header("Location: logout.php");
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="main.css?v=1.0">
  <title>Main</title>
</head>
<body>
	<header>
		<section class="logo--way">
			<div class="logo--image"></div>
			<nav class="head--navigation">
				<ul class="head--menu">
					<li class="item">
						<a href="logout.php" class="admin_logout_clk">Log Out</a>
					</li>
				</ul>
			</nav>
		</section><!-- / logo--way -->

		<section class="wrapper wrap-admin">
			<h1>Welcome to admin (<?php echo $_SESSION['adm_name']; ?>) dashboard</h1>
			<p class="title--info">This project is a testing project like a task for show my some skills</p>

			<div id="dashboard" class="users_info">
				<h3>Insert users info</h3>

				<form action="" method="POST">

					<label for="#usr_names">User Names</label><br>
					<input type="text" id="#usr_names" name="user_names" class="usr_names" placeholder="Name and Surname">

					<label for="#user_address">Address</label><br>
					<input type="text" id="#user_address" name="user_addr" class="usr_addr" placeholder="Address">

					<label for="#user_tel">Phone Number</label><br>
					<input type="text" id="#user_tel" name="user_tel" class="usr_tel" placeholder="Phone">

					<label for="#user_state">State</label><br>
					<input type="text" id="#user_state" name="user_state" class="usr_state" placeholder="Menager or worker"><br>

					<label for="#user_pass">Password</label><br>
					<input type="text" id="#user_pass" name="user_password" class="usr_pass" placeholder="Password"><br>

					<label for="#user_email">Email</label><br>
					<input type="text" id="#user_email" name="user_email" class="usr_email" placeholder="Email"><br><br>

					<button name="insert_info" class="users_send">Insert</button>

				</form>

			</div>
		</section><!-- / wrapper -->

	</header>
	<main>
		<h2>
			Workers List
		</h2>
		<section class="data--space">
			<div class="data_categories_workers">
				<p><span>Name</span> | <span>Address</span> | <span>Phone</span> | <span>State</span> | <span>Email</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			 	<button class="update_user_pop">Edit</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="delete_user">Delete</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; View &nbsp;&nbsp;

			 	<label>Worker: <input type="checkbox" class="view_wrk"  name="chcheck"></label> &nbsp;&nbsp;&nbsp;
			 	<label>Manager: <input type="checkbox" class="view_mgr" name="chcheck"></label></p>

			 	<div class="data_pop_up_adm">
			 		<input type="hidden" class="cross_pop">
			 	</div>
			</div>
			<div class="data_response"></div>
				<!-- response heare -->
		</section><!-- / data--space -->



	</main>
	<footer>
			<div class="copyrighting">
					<p class="copy">&copy; Copyright 2018 | Author Eric</p>
			</div>
	</footer>
	<script type="text/javascript" src="main.js?v=1.0"></script>
</body>
</html>

<?php
else:
		header("Location: index.php?err=err");

endif;
?>


