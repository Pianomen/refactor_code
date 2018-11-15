<?php ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
require_once(dirname(__FILE__) . "/sec.php"); pathcheck(MYPATH);

header("Cache-Control: no-cache, must-revalidate");

session_start();
require_once(dirname(__FILE__) . "/routers/rout.php");

if( isset($_SESSION["u_id"]) ) :

	if((time() - $_SESSION["time_start_login_usr"]) > 1800){
		// admin session time
		header("Location: logout.php");
	}

	if( isset($_SESSION["state"]) && $_SESSION["state"] === "worker" ): ?>

		<!-- IF USER IS WORKER -->

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Worker</title>
</head>
<body style="background:blueviolet;color:snow;">
	<a href="logout.php">log out</a>
	<div><h1>Welcome Worker</h1></div>
</body>
</html>

<?php endif; if( isset($_SESSION["state"]) && $_SESSION["state"] === "manager" ): ?>

	<!-- IF USER IS MANAGER -->

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Manager</title>
</head>
<body style="background:coral;">
	<a href="logout.php">log out</a>
	<div><h1>Welcome Manager</h1></div>
</body>
</html>

  <?php endif; ?>  <!-- / End SESSION STATE IF -->

<?php endif; ?> <!-- / END SESSION ID IF -->
