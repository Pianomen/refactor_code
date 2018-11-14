<?php  ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
	   require_once(dirname(__FILE__) . "/sec.php"); pathcheck(MYPATH);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="main.css?v=1.0">
  <title>Registration</title>
</head>
<body>
  <form action="" method="POST" accept-charset="utf-8" id="reg_user_page" class="reg_form">

	<label for="#name_user">User Names</label><br>
	<input type="text" id="#name_user" name="name_user" class="name_user" placeholder="Name and Surname"><br>

	<label for="#address_user">Address</label><br>
	<input type="text" id="#address_user" name="add_usr" class="addr_user" placeholder="Address"><br>

	<label for="#tel_usr">Phone Number</label><br>
	<input type="text" id="#tel_usr" name="tel_usr" class="phone_user" placeholder="Phone"><br>

	<label for="#state_usr">State</label><br>
	<input type="text" id="#state_usr" name="state_usr" class="state_user" placeholder="Menager or worker"><br>

	<label for="#pass_user">Password</label><br>
	<input type="text" id="#pass_user" name="user_password" class="pass_user" placeholder="Password"><br>

	<label for="#email_user">Email</label><br>
	<input type="text" id="#email_user" name="email_user" class="email_user" placeholder="Email"><br><br>

	<button name="register" class="register_user">Register</button>

  </form>

<script type="text/javascript" src="main.js?v=1.0"></script>
</body>
</html>