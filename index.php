<?php ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
require_once(dirname(__FILE__) . "/sec.php"); pathcheck(MYPATH);
require_once(dirname(__FILE__) . "/config.php");


if(isset($_GET["err"]) && $_GET["err"] === "err"){
	echo "Admin name or password is not valid";
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
								<form action="adm_dashboard.php" method="POST" class="adm_log">
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