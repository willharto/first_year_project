<?php
  require_once("../Header - Footer/header.php");
  session_start();
  if($_SESSION["username"] == null)
  {
  	header('Location: ../index.html');
  }
  ?>
<title>Profile</title>
<link rel="icon" href="Header - Footer/logo_purple.png">
<style>
  body {
    padding-top: 50px;
  }
  body > p {
    text-align: center;
  }
  h1 {
    font-size: 2.40vw;
  }
  h2 {
    font-size: 1.65vw;
  }
  h3 {
    font-size: 1.20vw;
  }
  .centered {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
  }
  .bottom-right {
    position: absolute;
    bottom: 8px;
    right: 16px;
  }
  .bottom-left {
    position: absolute;
    bottom: 8px;
    left: 16px;
  }
  .col-sm-2 {
    margin-bottom: 30px;
  }
  .col-xs-6 {
    margin-bottom: 30px;
  }
  .col-sm-12 h3 {
    font-size: 19px;
    text-transform: uppercase;
    color: white;
    font-weight: 400;
    padding: 0px;
    margin: 0px;
  }
  .col-sm-12 p {
    font-size: 19px;
    text-transform: uppercase;
    color: red;
    font-weight: 400;
    padding: 0px;
    margin: 0px;
  }
  .img-circle {
    border-radius: 50%;
  }
  .col-center {
    float: none;
    margin: 0 auto;
  }
  }
  .bottom-buffer {
    margin-bottom:20px;
  }
  .submit-btn {
    background-color: #660099;
    border-radius: 5px;
  }
  .submit-btn:hover {
    background-color: #660099;
    border-radius: 5px;
  }
  .delete-btn {
    background-color: #D90000!important;
    border-radius: 5px!important;
  }
  .delete-btn:hover {
    background-color: #D90000!important;
    border-radius: 5px!important;
  }
  .submit-font {
    color:#ffffff;
  }
  .submit-font:hover {
    color:#ecaa33;
  }
  @media screen and (max-width: 768px){
  h1 {
    font-size: 35px;
  }
  h2 {
    font-size: 25px;
  }
  h3 {
    font-size: 12px;
  }
  }
</style>


<body>
  <div id="top" class="container-fluid">
    <!-- Title and profile icon -->
    <?php
      require_once('config.inc.php');
      $conn = new PDO("mysql:host=$database_host;dbname=$database_name", $database_user, $database_pass);
      $conn2 = new mysqli($database_host, $database_user, $database_pass, "2018_comp10120_z3");
      $userID = $conn2->query("SELECT UserID FROM Users WHERE Username ='$_SESSION[username]'")->fetch_object()->UserID;//userID query
      $userYear = $conn2->query("SELECT YearOfStudent FROM Users WHERE UserID ='$userID'")->fetch_object()->YearOfStudent;// YearOfStudent query
       ?>
    <div class="row">
      <div class="col-sm-3 col-center" Style="max-width: 350px;">
        <img src="squareElementOrange.png" style="width:100%" class="img-circle">
        <div class="centered">
          <h1 style="color: #fff;">
            <?php echo $_SESSION['username']; ?>
          </h1>
          <h2 style="color: #fff;"><?php echo $userYear; ?></h2>
        </div>
      </div>
      <div class="col-sm-3 col-center" style="padding-top: 15px;">
        <a class="btn btn-default btn-block btn-sm submit-btn submit-font bottom-buffer" href="EditPage.php">Edit Profile</a>
      </div>
    </div>
    <!-- My notes Section -->
    <!-- Admin Start---->
    <?php
      $adminID = -1;
      if ($userID == $adminID)
      {
      ?>
    <div class="row">
      <div class="col-sm-12">
        <h3 style="font-size: 30px; padding-top: 30px; padding-bottom: 15px; color: black;"> All notes</h3>
      </div>
      <div class="col-sm-12" style="padding-top: 10px; padding-bottom: 30px; padding-right: 10px; color: black;">
        <div class="pull-right" style="width: 100%;">
          <h4 style="color: black;">Delete Note:</h4>
          <form method="post" class"form-inline">
            <select name="note">
              <option>---</option>
              <?php
                $stat = $conn->prepare("SELECT * FROM Notes");
                $stat->execute();
                while($row = $stat->fetch())
                {
                ?>
              <option><?php echo $row['TitleNote'];?></option>
              <?php
                }
                ?>
            </select>
            <input type="submit" class="btn btn-sm delete-btn submit-font bottom-buffer"  value="Delete" name="deleteBtn">
          </form>
        </div>
      </div>
      <?php
        $stat = $conn->prepare("SELECT * FROM Notes");
         	$stat->execute();

         	while($row = $stat->fetch())
        {
        	$noteID = $row['NoteID'];
        	$stat2 = $conn->prepare("SELECT * FROM `Votes` WHERE NoteID = '$noteID'");
        	$stat2->execute();
        	$counterLikes = 0;
        	$counterDislikes = 0;
        	while($row2 = $stat2->fetch())
        	{
        		if($row2['type'] == 1)
        					$counterLikes++;
        		else
        				$counterDislikes++;
        	}

        ?>
      <div class="col-sm-2 col-xs-6">
        <a <?php echo "href='../Notes Page/NotesPreview.php?id=".$row['NoteID']."'>"; ?>
        <img src="squareElement.png" style="width:100%">
        <div class="centered">
          <h3 style="color: #fff;">
            <?php echo $row['TitleNote'];?>
          </h3>
        </div>
        <div class="bottom-right">
          <h3 style="color: #fff;">
            <?php echo $counterDislikes; ?><span style="padding: 0px 10px;" class="glyphicon glyphicon-thumbs-down"></span>
          </h3>
        </div>
        <div class="bottom-left">
          <h3 style="color: #fff;">
            <span style="padding: 0px 10px;" class="glyphicon glyphicon-thumbs-up"></span><?php echo $counterLikes; ?>
          </h3>
        </div>
        </a>
      </div>
      <?php
        }
        ?>
    </div>
    <div class="row">
      <?php
        $stat = $conn->prepare("SELECT * FROM `Users`");
        $stat->execute();
        $numberOfUser = 0;
        $usernameArray = array();
        $links = array();
        while($row = $stat->fetch())
        {
          $username = $row['Username'];
          array_push($usernameArray, $username);
          $link = "profile2.php?id=" . $row['UserID'];
          array_push($links, $link);
          $numberOfUser++;
         }
        ?>
      <div class="col-sm-12">
        <h3 style="font-size: 30px; padding-top: 30px; padding-bottom: 15px; color: black;">All Users (<?php echo $numberOfUser;?>)</h3>
      </div>
      <?php
        for($counter = 0; $counter < $numberOfUser; $counter++)
        {
        ?>
      <div class="col-sm-2 col-xs-6">
        <a href= "<?php echo $links[$counter]; ?>">
          <img src="squareElementYellow.png" style="width:100%" class="img-circle">
          <div class="centered">
            <h3 style="color: #fff;">
              <?php echo $usernameArray[$counter]; ?>
            </h3>
          </div>
        </a>
      </div>
      <?php
        }
        ?>
    </div>
  </div>
  <?php
    }
    else
    {
    ?>
  <!-- Admin End---->
  <div class="row">
    <div class="col-sm-12">
      <h3 style="font-size: 30px; padding-top: 30px; color: black;">My notes</h3>
    </div>
    <div class="col-sm-12" style="padding-top: 10px; padding-bottom: 30px; color: black;">
      <div class="pull-right" style="width: 100%;">
        <h4 style="color: black;">Delete Note:</h4>
        <form method="post" class"form-inline">
          <select name="note">
            <option>---</option>
            <?php
              $stat = $conn->prepare("SELECT * FROM Notes WHERE UserID = ?");
              $stat->bindParam(1, $userID);
              $stat->execute();
              while($row = $stat->fetch())
              {
              ?>
            <option><?php echo $row['TitleNote'];?></option>
            <?php
              }

              ?>
          </select>
          <input type="submit" class="btn btn-sm delete-btn submit-font bottom-buffer" value="Delete" name="deleteBtn">
        </form>
      </div>
    </div>
    <?php
      $stat = $conn->prepare("SELECT * FROM Notes WHERE UserID = ?");
       	$stat->bindParam(1, $userID);
       	$stat->execute();

       	while($row = $stat->fetch())
      {
      	$noteID = $row['NoteID'];
      	$stat2 = $conn->prepare("SELECT * FROM `Votes` WHERE NoteID = '$noteID'");
      	$stat2->execute();
      	$counterLikes = 0;
      	$counterDislikes = 0;
      	while($row2 = $stat2->fetch())
      	{
      		if($row2['type'] == 1)
      					$counterLikes++;
      		else
      				$counterDislikes++;
      	}

      ?>
    <div class="col-sm-2 col-xs-6">
      <a <?php echo "href='../Notes Page/NotesPreview.php?id=".$row['NoteID']."'>"; ?>
      <img src="squareElement.png" style="width:100%">
      <div class="centered">
        <h3 style="color: #fff;">
        <?php echo $row['TitleNote'];?>
      </div>
      <div class="bottom-right">
        <h3 style="color: #fff;">
          <?php echo $counterDislikes; ?><span style="padding: 0px 10px;" class="glyphicon glyphicon-thumbs-down"></span>
        </h3>
      </div>
      <div class="bottom-left">
        <h3 style="color: #fff;">
          <span style="padding: 0px 10px;" class="glyphicon glyphicon-thumbs-up"></span><?php echo $counterLikes; ?>
        </h3>
      </div>
      </a>
    </div>
    <?php
      }
      if ($stat->rowCount() == 0)
      {
      ?>
    <div class="col-sm-12">
      <h4 style="padding-bottom: 15px; color: black;">No notes to dislay</h4>
    </div>
    <?php
      }
      ?>
  </div>
  <!-- My notes Section End -->
  <!-- Following Section -->
  <div class="row">
    <?php
      $userID = $conn2->query("SELECT UserID FROM Users WHERE Username ='$_SESSION[username]'")->fetch_object()->UserID;//userID query
          $stat = $conn->prepare("SELECT  * FROM `Followers` WHERE FollowerUserID = '$userID'");
          $stat->execute();
          $count = 0;
          $usernameArray = array();
          $links = array();
          while($row = $stat->fetch())
      {

            $FollowedUserID = $row['FollowedUserID'];
            $syn = "SELECT Username FROM Users WHERE UserID =" . $row['FollowedUserID'];
            $username = $conn2->query($syn)->fetch_object()->Username;
            array_push($usernameArray, $username);
            $link = "profile2.php?id=" . $FollowedUserID;
            array_push($links, $link);
            $count = $count + 1;
      }
      ?>
    <div class="col-sm-12">
      <h3 style="font-size: 30px; padding-top: 30px; padding-bottom: 15px; color: black;"> <?php echo $count;?> Following</h3>
    </div>
    <?php
      for($counter = 0; $counter < $count; $counter++)
      {
      ?>
    <div class="col-sm-2 col-xs-6">
      <a href= "<?php echo $links[$counter]; ?>">
        <img src="squareElementYellow.png" style="width:100%" class="img-circle">
        <div class="centered">
          <h3 style="color: #fff;">
            <?php echo $usernameArray[$counter]; ?>
          </h3>
        </div>
      </a>
    </div>
    <?php
      }
      if ($stat->rowCount() == 0)
      {
        ?>
      <div class="col-sm-12">
        <h4 style="padding-bottom: 15px; color: black;">No Followings</h4>
      </div>
      <?php
      }
      ?>
  </div>
  <!-- Following Section End -->
  <!-- Followers Section -->
  <div class="row">
    <?php
      $userID = $conn2->query("SELECT UserID FROM Users WHERE Username ='$_SESSION[username]'")->fetch_object()->UserID;//userID query
          $stat = $conn->prepare("SELECT  * FROM `Followers` WHERE FollowedUserID = '$userID'");
          $stat->execute();
          $count = 0;
          $usernameArray = array();
          $links = array();
          while($row = $stat->fetch())
      {
            $FollowerUserID = $row['FollowerUserID'];
            $syn = "SELECT Username FROM Users WHERE UserID =" . $row['FollowerUserID'];
            $username = $conn2->query($syn)->fetch_object()->Username;
            array_push($usernameArray, $username);
            $link = "profile2.php?id=" . $FollowerUserID;
            array_push($links, $link);
            $count = $count + 1;
          }
      ?>
    <div class="col-sm-12">
      <h3 style="font-size: 30px; padding-top: 30px; padding-bottom: 15px; color: black;"> <?php echo $count;?> Followers</h3>
    </div>
    <?php
      for($counter = 0; $counter < $count; $counter++)
      {
      ?>
    <div class="col-sm-2 col-xs-6">
      <a href= "<?php echo $links[$counter]; ?>">
        <img src="squareElementYellow.png" style="width:100%" class="img-circle">
        <div class="centered">
          <h3 style="color: #fff;">
            <?php echo $usernameArray[$counter]; ?>
          </h3>
        </div>
      </a>
    </div>
    <?php
      }
      if ($stat->rowCount() == 0)
      {
    ?>
      <div class="col-sm-12">
        <h4 style="padding-bottom: 15px; color: black;">No Followers</h4>
      </div>
      <?php
      }
    } //else

      if(isset($_POST['deleteBtn']))
      {
      $note = $_POST["note"];
      if ($note != "---")
      {
                                 $noteIDADM = $conn2->query("SELECT NoteID FROM Notes WHERE `TitleNote` = '$note'")->fetch_object()->NoteID;
      $deleteQuery = "DELETE FROM `Comments` WHERE NoteID = '$noteIDADM'";
                                 $conn->query($deleteQuery);
      $stat = $conn2->prepare("DELETE FROM `Notes` WHERE `TitleNote` = '$note'");
      $stat->execute();

      echo "DELETED";
      header('Location: '.$_SERVER['REQUEST_URI']);
      }
      }
    ?>
  </div>
  <!-- Followers Section End -->
  </div>
</body>
<?php
  require_once("../Header - Footer/footer.html");
  ?>
</html>
