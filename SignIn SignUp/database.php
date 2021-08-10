<?php
// Load the configuration file containing your database credentials
require_once('config.inc.php');

// Connect to the database
$conn = new mysqli($database_host, $database_user, $database_pass, "2018_comp10120_z3");
// Check for errors before doing anything else
if($conn -> connect_error)
    die('Connect Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);


// $sql = "SELECT user_name FROM project demo";
// $result = $conn->query($sql);
function add_user($username, $password, $email) {

}


function validate_user($username, $password)
{
  global $conn;
  //return false;// uses for testing perposes
  //Encrypt password
  $password_hash = crypt($password, $username);

  $query = "SELECT * FROM Users WHERE Username = '$username' LIMIT 1";
  $result = $conn->query($query);

  if ($result && $user_row = $result->fetch_assoc())
  {
    return ($user_row["PasswordHash"] == $password_hash);
  } else {
    return false;
  }
}
//var_dump(validate_user("1234", "Helo"));// ? "Login\n" : "No\n";


function register($username, $password, $email, $year)
{
    global $message;
    global $conn;
    $query = "SELECT * FROM Users WHERE Username = '$username' LIMIT 1";
    $result = $conn->query($query);


    if ($result->num_rows > 0) {
      $message =" Username already exists";

      return false;
}
    $query = "SELECT * FROM Users WHERE Email = '$email' LIMIT 1";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
      $message =" Email already exists";

      return false;
}
    $password_hash = crypt($password, $username);
    $query = "INSERT INTO `Users`(`Email`, `Username`, `PasswordHash`, `YearOfStudent`) VALUES ('$email', '$username', '$password_hash', '$year')";
    $result = $conn->query($query);

    if ($result) {
      return true;
    } else {
      // SQL Error
        $message =" Please Fill in the details correctly";

        return false;
      }


}

//var_dump(register("tt7532436", "bgdht", "sda@236te23asd214231st.test"));
//var_dump(validate_user("sd121", "bgdht"));
//var_dump(validate_user("sd12", "bgdht"));
?>
