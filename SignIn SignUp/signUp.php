<?php
// Start the session
session_start();
$message = "";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Sign up to DeNOTE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="icon" href="Header - Footer/logo_purple.png">
    <style>
          body {
              background-color: white;
          }
          .top-buffer {
              margin-top:20px;
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
          .form-top-right{
	            width : 25%;
              font-size: 66px;
          }
          .form-top-left{
              width : 75%;
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
      <a class="navbar-brand" href="../index.html"><img src="../Welcome Page/logo_white.png"  height="23.5" alt="DeNOTE logo"> </a>
    </div>
  </nav>
  <?php
	  require_once("database.php");
  ?>

  <!-- Signup -->
	<div class="container formcenter">
    <div class="col-sm">
      <div class="form-content">
        <div class="form-top-left">
    		    <h2>Sign Up</h2>
    	  </div>

        <div class="form-body">
    		  <form class="form-horizontal" role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >

    		  <div class="form-group">
            <label for="username">Username (cannot contain < ; >)</label>
            <input type="textbox" class="form-control form-element" name="username" placeholder="Username" pattern="[^<>;]+" required>
          </div>

          <div class="form-group">
            <label for="email">University Email</label>
            <input type="email" class="form-control form-element" name="email" placeholder="University Email" required>
          </div>

          <div class="form-group">
            <label for="year">Year of Study</label>
            <select class="form-control form-element" name="year">
              <option>Year 0</option>
              <option>Year 1</option>
              <option>Year 2</option>
              <option>Year 3</option>
              <option>Other</option>
            </select>
          </div>

          <!-- Password validation based on www.w3schools.com/howto/howto_js_password_validation.asp -->
          <div class="form-group">
            <label for="password">Password (8+ characters, cannot contain < ; >)</label>
    			  <input type="password" class="form-control form-element" name="password" placeholder="Password" pattern="[a-zA-Z0-9!?@#$%*-/+_]{8,}" required>
          </div>

          <br>
          <input type="submit" class="btn btn-default btn-lg submit-btn btn-block submit-font bottom-buffer" value="Sign Up">
          <p style="text-align: center">Already a member? <a href="./signIn.php" style="color:#660098;">Sign in here</a></p>
          <p style="text-align: center">By signing up, you accept the following <a href="./TermsAndConditions.html" style="color:#660098;">Terms and Conditions</a></p>
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
  	  $year = $_POST["year"];
  	  $email = $_POST["email"];


  	  if(register($username, $password, $email, $year)) {
       $_SESSION["username"] = $username;
       header('Location: ../User Home Page/UserHomePage.php');
  	  } else {
  echo '
    <div class="fixed-top" style="margin-top: 53px">
    	<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error:</strong>';
        echo $message;
    echo '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>';


  }

}
?>


</body>
</html>
