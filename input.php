<?php ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
require_once(__DIR__."/sec.php"); pathcheck(MYPATH);
require_once(__DIR__."/init.php");
require_once(__DIR__."/crud.php");
header("Cache-Control: no-cache, must-revalidate");?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin Panel</title>
</head>
<body>
	<div><h1>Admin Panel</h1></div>
	<form id="form">
		<textarea name="ms" id="ms" cols="30" rows="10" style="resize: none;overflow-x:scroll;"></textarea>
		<button type="button">Send</button>
	</form>
	<div class="res"></div>
	<script type="text/javascript" src="main.js"></script>
</body>
</html>