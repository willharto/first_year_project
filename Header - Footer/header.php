<!DOCTYPE html>
<html lang="en">
    <!-- Theme Made By www.w3schools.com -->
    <title>DeNOTE</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type"text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" type"text/css" href="../universalStyleSheet.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


  <head id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="../User Home Page/UserHomePage.php"><img src="../Header - Footer/logo_white.png"  height="23.5"> </a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-center" id="nav">
            <li><a href="../User Home Page/UserHomePage.php" id="homeNav"><span class="glyphicon glyphicon-home"></span> HOME</a></li>
            <li><a href="../Notes Upload Page/NoteUpload.php" id="noteNav"><span class="glyphicon glyphicon-upload"></span> UPLOAD</a></li>
          </ul>
          <form method="post" class="navbar-form navbar-left form-style" action="../Search/search.php">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Looking for Something?" name="searchWord">
            </div>
            <button type="submit" class="btn search-btn search-font"><a>
            <span class="search-font glyphicon glyphicon-search"></span>
            </a></button>
          </form>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../Profile Page/Profile.php" class="" id="profileNav"><span class="glyphicon glyphicon-user"></span>PROFILE</a></li>
            <li><a href="../Log Out/logout.php"><span class="glyphicon glyphicon-log-out"></span>LOGOUT</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <link rel="icon" href="logo_purple.ico">
  </head>
