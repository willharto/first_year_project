<!DOCTYPE html>
<html lang="en">
  <?php
    session_start();
    require_once("../Header - Footer/header.php");
    if($_SESSION["username"] == null)
    {
    	header('Location: ../index.html');
    }
    ?>
  <title>Page Title</title>
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
      font-size: 1.65vw;
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
      <div class="row">
        <h1 style="padding-bottom:30px; padding-left: 15px;"><?php echo $_GET['id']; ?></h1>
      </div>
      <div class="row">
        <?php
          require_once('config.inc.php');
          $conn = new PDO("mysql:host=$database_host;dbname=$database_name", $database_user, $database_pass);
          $id = isset($_GET['id'])? $_GET['id'] : "";
          $UnitYear = isset($_GET['UnitYear'])? $_GET['UnitYear'] : "";
          $stat = $conn->prepare("SELECT * FROM Notes WHERE UnitID = ? AND UnitYear = ?");
          $stat->bindParam(1, $id);
          $stat->bindParam(2, $UnitYear);
          $stat->execute();

              while($row = $stat->fetch()){
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
        <div class="col-sm-3 col-xs-6">
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
    </div>
  </body>
  <?php
    require_once("../Header - Footer/footer.html");
    ?>
</html>
