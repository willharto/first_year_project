<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="mystylephp.css">
        <title> Sign in page </title>
</head>
</head>
<body>
<h1 class ="intro"> sign in page </h1> <br>

	<ul id="nava">
  		<li class="bar-li"><a   class="bar-lisa"  href="index.php">Sign In </a></li>
		<li class="bar-li"><a   class="bar-lisa"  href="signUp.php">Sign Up </a></li>

	</ul>
	<br>

	<p>please enter user name and password: </p> <br>




<?php
require_once("database.php");
?>





<form method="post" action='validateFunction()'>
	<fieldset>
		<legend>Sign In</legend>
		Username:<br>
		<input type="text" name =Username><br>
		Password:<br>
		<input type="text" name =password><br><br>
		<input type="submit" value="Submit">
	</fieldset>
</form>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
 {
	 $username = $_POST["Username"];
	 $password = $_POST["password"];

	 if(validate_user($username, $password)) {
		 // Login Session
		 echo 'hello';
	 } else {
		 // Incorrect Login
	 }
	}
?>


</body>
</html>
