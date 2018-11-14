<?php ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);


require_once(dirname(__FILE__) . "/sec.php"); pathcheck(MYPATH);
require_once(dirname(__FILE__) . "/config.php");

?>

<!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>User Login</title>
 </head>
 <body>
	<form id="state_user_log" action="" method="POST" id="usr_login_form" style="margin:3% auto; width:20%;">
		<label for="email">Email</label><br>
		<input type="text" id="email" style="width:100%" name="em_usr" class="email_user_log"><br><br>
		<label for="password_user">Password</label>
		<input type="text" id="password" style="width:100%" name="ps_usr" class="pass_user_log"><br><br>
		<button class="user_login">Log in</button>
	</form>
	<code>
		<h3>Test</h3>
		<p><b>Email: </b>kolorit66@yahoo.com  &nbsp;&nbsp;&nbsp; <b>Password: </b>davidov</p>
	</code>

<script type="text/javascript" src="main.js?v=1.0"></script>
 </body>
 </html>
<?php #echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>