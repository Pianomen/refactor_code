<?php ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
require_once(dirname(__FILE__) . "/sec.php"); pathcheck(MYPATH);

session_start();
require_once(dirname(__FILE__) . "/config.php");

try {

	$conn = new PDO("mysql:host=". DB_HOST .";dbname=". DB_NAME ."", DB_USER, DB_PASS, array(PDO::ATTR_PERSISTENT => true));
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND , "SET NAMES utf8mb4_unicode_ci");

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
				<div class="logo--image" id="user_way"></div>
				<nav class="head--navigation">
					<ul class="head--menu">
						<li class="item">
							<a href="javascript:;" class="admin_login_clk">Admin Login</a>
						</li>
						<li class="item">
							<a href="registration_user.php">Register</a>
						</li>
						<li class="item">
							<a href="user_login.php">User Login</a>
						</li>
					</ul>
					<div class="burger_lines">
						<p></p>
						<p></p>
						<p></p>
					</div>
					<div class="burger">
						<ul class="head--mobile-menu">
							<li class="item">
								<a href="javascript:;" class="admin_login_clk">Admin Login</a>
							</li>
							<li class="item">
								<a href="registration_user.php">Register</a>
							</li>
							<li class="item">
								<a href="user_login.php">User Login</a>
							</li>
						</ul>
					</div>
				</nav>
				</section><!-- / logo--way -->
				<section class="wrapper">
					<h1>Welcome to simple SRM system</h1>
					<p class="title--info">This project is a testing project like a task for show some my skills</p>
					</section><!-- / wrapper -->
					<section class="pop_ups--way">
						<!-- pop ups here -->
						<!-- Admin Login -->
						<div class="admin_login_pop_bg">
							<div class="admin_login_pop">
								<span class="cross">X</span>
								<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="adm_log">
									<!-- action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]) .'?action=lose'?>" -->
									<label for="a_name">Name (admin)</label> <br>
									<input type="text" id="a_name" class="admin_name" placeholder="Name" name="admin_n" autocomplete="off"><br> <br>
									<label for="a_pass">Password (root)</label> <br>
									<input type="password" id="a_pass" name="admin_p" class="admin_pass" placeholder="Password" autocomplete="off"> <br> <br>
									<button name="login" class="admin_log_btn">Log In</button>
								</form>
							</div>
						</div>
						<!-- Registration Login -->
						<!-- User Login -->
					</section>
				</header>
				<main>
					<h2>
					Workers List
					</h2>
					<section class="data--space">
						<div class="data_categories_workers">
							<p><span>Name</span> | <span>Address</span> | <span>Phone</span> | <span>State</span></p>
						</div>
						<div class="data_response"></div>
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