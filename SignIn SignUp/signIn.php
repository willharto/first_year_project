<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Sign in to DeNOTE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="icon" href="Header - Footer/logo_purple.png">
    <style>
          body {
              background-color: white;
          }
          .top-buffer {
              margin-top:100px;
          }
          .bottom-buffer {
              margin-bottom:20px;
          }
          .submit-btn {
              background-color: #660099;
          }
          .submit-font {
              color:#ffffff;
          }
          .submit-font:hover {
              color:#ecaa33;
          }
          .multi-form-wrapper{
	            margin-bottom: 20px;
          }
          .form-element{
              display: inline;
        	    width:100%;
          }
          .navbar {
              background-color: #660099;
          }
 	        .formcenter {
              min-height: 90%;  /* Fallback for browsers do NOT support vh unit */
   	          min-height: 90vh; /* These two lines are counted as one :-)       */
              width: auto;
  	          display: flex;
  	          align-items: center;
	        }
    </style>
  </head>

<body>
  <nav class="navbar">
    <div class="container-fluid">
      <a class="navbar-brand" href="../index.html"><img src="../Welcome Page/logo_white.png"  height="23.5"> </a>
    </div>
  </nav>
  <?php
  	require_once("database.php");
  ?>

  <!-- Signin -->
  <div class="container formcenter">
    <div class="col-sm">
      <div class="form-content">
        <div class="form-top-left">
          <h2>Sign in</h2>
        </div>

        <div class="form-body">
          <form class="form-horizontal" role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">

    		  <div class="form-group">
            <label for="username"> Username</label>
            <input type="textbox" class="form-control form-element" name="username" placeholder="Username" pattern="[^<>]+" required>
          </div>

          <div class="form-group">
            <label for="password"> Password</label>
    		    <input type="password" class="form-control form-element" name="password" placeholder="Password" pattern="[^<>]+" required>
          </div>

          <br>
	        <input type="submit" class="btn btn-default btn-lg submit-btn btn-block submit-font bottom-buffer" value="Sign In">
          <p style="text-align: center">Not a member? <a href="./signUp.php" style="color:#660098;">Sign up here</a></p>

          </form>
        </div>
      </div>
    </div>
  </div>
  <?php

  	if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
	    $username = $_POST["username"];
	    $password = $_POST["password"];

	    if(validate_user($username, $password)) {
		  // Login Session
		  $_SESSION["username"] = $username;
		  header('Location: ../User Home Page/UserHomePage.php');
	  } else {
  ?>
	    <div class="fixed-top" style="margin-top: 53px">
	      <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error:</strong> Check that you entered the correct username and password.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
  <?php
	    }
	  }
  ?>

</body>
</html>
