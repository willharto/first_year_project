<!DOCTYPE html>
<html lang="en">
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
    h2 {
      font-size: 1.65vw;
    }
    h3 {
      font-size: 1.20vw;
    }
    .centered-categories {
      position: absolute;
      top: 50%;
      left: 50%;
      outline-style: solid;
      outline-color: #000;
      background-color:rgba(255, 255, 255, 0.9);
      padding: 15px 5% 15px 5%;
      transform: translate(-50%, -75%);
      text-align: center;
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
    .col-sm-3 {
      margin-bottom: 30px;
    }
    .col-sm-2 {
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
    .submit-font {
      color:#ffffff;
    }
    .submit-font:hover {
      color:#ecaa33;
    }
    .glyphicon {
      padding: 0px 10px;
    }
    @media screen and (max-width: 768px){
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
      <?php
        if(trim($_POST['searchWord']) == "")
        {?>
      <div class="row">
        <div class="col-sm-12">
          <h3 style="font-size: 30px; padding-bottom: 15px; color: black;"> Unit ID</h3>
        </div>
        <div class="col-sm-12">
          <h4 style="padding-bottom: 15px; color: black;"> Nothing found in Notes</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <h3 style="font-size: 30px; padding-top: 30px; padding-bottom: 15px; color: black;"> Notes</h3>
        </div>
        <div class="col-sm-12">
          <h4 style="padding-bottom: 15px; color: black;"> Nothing found in Notes</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <h3 style="font-size: 30px; padding-top: 30px; padding-bottom: 15px; color: black;"> Usernames</h3>
        </div>
        <div class="col-sm-12">
          <h4 style="padding-bottom: 15px; color: black;"> Nothing found in Notes</h4>
        </div>
      </div>
      <?php
        }
        else
        {
        ?>
      <div class="row">
        <div class="col-sm-12">
          <h3 style="font-size: 30px; padding-bottom: 15px; color: black;"> Unit ID</h3>
        </div>
        <?php
          require_once('config.inc.php');
          $conn = new PDO("mysql:host=$database_host;dbname=$database_name", $database_user, $database_pass);
          // $conn = new mysqli($database_host, $database_user, $database_pass, "2018_comp10120_z3");
          $searchWord = $_POST['searchWord'];
          $stat = $conn->prepare("SELECT * FROM Notes WHERE UnitID LIKE '%$searchWord%'");
          $stat->execute();
             $UnitIDInField = array();
          while($row = $stat->fetch())
          {
            if (!in_array($row['UnitID'], $UnitIDInField))
            {
          $img = "../User Home Page/Images/" . $row['UnitID'] . ".png";
          ?>
        <div class="col-sm-2 col-xs-6">
          <a <?php echo"<a href='../User Home Page/ShowNotes.php?id=".$row['UnitID']."&UnitYear=".$row['UnitYear']."'>"; ?>
          <img src="<?php echo $img ?>" style="width:100%;">
          <div class="centered-categories">
            <h2 style="color: #000;"><?php echo $row['UnitID'] ?></h2>
          </div>
          </a>
        </div>
        <?php
          array_push($UnitIDInField, $row['UnitID']);
          }
          }
          if ($stat->rowCount() == 0)
          {
          ?>
        <div class="col-sm-12">
          <h4 style="padding-bottom: 15px; color: black;"> Nothing found in Unit ID</h4>
        </div>
        <?php
          }
          ?>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <h3 style="font-size: 30px; padding-top: 30px; padding-bottom: 15px; color: black;"> Notes</h3>
        </div>
        <?php
          $stat = $conn->prepare("SELECT * FROM Notes WHERE TitleNote LIKE '%$searchWord%'");
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
              <?php echo $counterDislikes; ?><span class="glyphicon glyphicon-thumbs-down"></span>
            </h3>
          </div>
          <div class="bottom-left">
            <h3 style="color: #fff;">
              <span class="glyphicon glyphicon-thumbs-up"></span><?php echo $counterLikes; ?>
            </h3>
          </div>
          </a>
        </div>
        <?php
          }

          $stat2 = $conn->prepare("SELECT * FROM Notes WHERE SectionNumber LIKE '%$searchWord%'");
          $stat2->execute();
          while($row = $stat2->fetch())
          {




          $noteID = $row['NoteID'];
            		$stat3 = $conn->prepare("SELECT * FROM `Votes` WHERE NoteID = '$noteID'");
            		$stat3->execute();
            		$counterLikes = 0;
            		$counterDislikes = 0;
            		while($row2 = $stat3->fetch())
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
              <?php echo $counterDislikes; ?><span class="glyphicon glyphicon-thumbs-down"></span>
            </h3>
          </div>
          <div class="bottom-left">
            <h3 style="color: #fff;">
              <span class="glyphicon glyphicon-thumbs-up"></span><?php echo $counterLikes; ?>
            </h3>
          </div>
          </a>
        </div>
        <?php
          }
          if ($stat->rowCount() == 0 && $stat2->rowCount() == 0)
          {
          ?>
        <div class="col-sm-12">
          <h4 style="padding-bottom: 15px; color: black;"> Nothing found in Notes</h4>
        </div>
        <?php
          }
          ?>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <h3 style="font-size: 30px; padding-top: 30px; padding-bottom: 15px; color: black;"> Usernames</h3>
        </div>
        <?php
          $stat = $conn->prepare("SELECT * FROM Users WHERE Username LIKE '%$searchWord%' AND Username != 'ADMIN'");
          $stat->execute();
          while($row = $stat->fetch())
          {
          ?>
        <div class="col-sm-2 col-xs-6">
          <a <?php echo "href='../Profile Page/profile2.php?id=".$row['UserID']."'>"; ?>
          <img src="squareElementYellow.png" style="width:100%" class="img-circle">
          <div class="centered">
            <h3 style="color: #fff;">
              <?php echo $row['Username']?>
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
          <h4 style="padding-bottom: 15px; color: black;"> Nothing found in Usernames</h4>
        </div>
        <?php
          }
          }
          ?>
      </div>
    </div>
  </body>


  <?php
    require_once("../Header - Footer/footer.html");
    ?>
</html>
