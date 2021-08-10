<?php
// Load the configuration file containing your database credentials
require_once('config.inc.php');

// Connect to the database
$conn = new mysqli($database_host, $database_user, $database_pass, "2018_comp10120_z3");
// Check for errors before doing anything else
if($conn -> connect_error)
    die('Connect Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);

function edit($newUsername, $newPassword, $newYear, $oldUsername)
{
    global $conn;

    $userID = $conn->query("SELECT UserID FROM Users WHERE Username ='$oldUsername'")->fetch_object()->UserID;//userID query

    $NewPassword_hash = crypt($newPassword, $newUsername);

    $query = "UPDATE Users SET Username='$newUsername',PasswordHash='$NewPassword_hash',YearOfStudent='$newYear' WHERE UserID = '$userID'";
    $result = $conn->query($query);

    if ($result) {
      return true;
    } else {
      // SQL Error
      return false;
    }

}

function exist($newUsername)
{
  global $conn;

  $query = "SELECT * FROM Users WHERE Username = '$newUsername' LIMIT 1";
  $result = $conn->query($query);
  if ($result->num_rows > 0) return false;
  else return true;
}

?>
