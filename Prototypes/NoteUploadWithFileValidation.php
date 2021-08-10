<!DOCTYPE html>
<html lang="en">
  <?php
    session_start();
    if($_SESSION["username"] == null)
    {
    	header('Location: ../index.html');
    }
    ?>
  <?php
    include "../Header - Footer/header.php";
    ?>
  <title>Upload Page</title>
  <script type="text/javascript">
    $(function(){
      var current = window.location.pathname;
      if(current.includes('NoteUpload.php')) {
        var element = document.getElementById('noteNav');
        element.classList.add("active");
      }
      else if (current.includes('Feed.php')){
        var element = document.getElementById('feedNav');
        element.classList.add("active");
      }
      else if (current.includes('Profile.php')){
        var element = document.getElementById('profileNav');
        element.classList.add("active");
      }
    });

    $(function(){

    });
  </script>
  <style>
    .bottom-buffer {
    margin-bottom:20px !important;
    }
    .submit-btn {
    background-color: #660099 !important;
    }
    .submit-font {
    color:#ffffff !important;
    }
    .submit-font:hover {
    color:#ecaa33 !important;
    }
    .form-top-left{
    width : 75% !important;
    }
    .formcenter {
    min-height: 100% !important;  /* Fallback for browsers do NOT support vh unit */
    min-height: 100vh; /* These two lines are counted as one :-)       */
    align-items: center !important;
    }
    body {
    padding-top: 50px;
    }
    label {
    color: #212529;
    font: 400 15px Lato, sans-serif;
    }
  </style>

  <body>
    <div id="top">
      <?php
        require_once('config.inc.php');
        // Connect to the database
         $conn = new PDO("mysql:host=$database_host;dbname=$database_name", $database_user, $database_pass);
         $conn2 = new mysqli($database_host, $database_user, $database_pass, "2018_comp10120_z3");

         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(isset($_POST['btn']))
        {

          $userID = $conn2->query("SELECT UserID FROM Users WHERE Username ='$_SESSION[username]'")->fetch_object()->UserID;
          $unitYear = $conn2->query("SELECT YearOfStudent FROM Users WHERE Username ='$_SESSION[username]'")->fetch_object()->YearOfStudent;
          $name = $_FILES['requiredFile']['name'];
          $type = $_FILES['requiredFile']['type'];
          $titleNote = $_POST["title"];
          $unitID = $_POST["UnitID"];
          $sectionNumber = $_POST["sectionNumber"];

          if(validateUpload($unitID, $sectionNumber) && isset($_POST['box']))
          {
          $data = file_get_contents($_FILES['requiredFile']['tmp_name']);
          $stmt = $conn->prepare("INSERT INTO Notes (`FileName`,`dataType`,`Data`, `SectionNumber`, `UserID`, `UnitID`, `TitleNote`, `UnitYear`) VALUES (?,?,?,?,?,?,?,?)");
          $stmt->bindParam(1, $name);
          $stmt->bindParam(2, $type);
          $stmt->bindParam(3, $data);
          $stmt->bindParam(4, $sectionNumber);
          $stmt->bindParam(5, $userID);
          $stmt->bindParam(6, $unitID);
          $stmt->bindParam(7, $titleNote);
          $stmt->bindParam(8, $unitYear);
          $stmt->execute();
          }
          else
        {
        ?>
        <div class="fixed-top" style="padding-top: 53px">
          <div class="alert alert-danger alert-dismissible" role="alert">
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

      <div class="container">
        <div class="form-content">
          <h2 style="padding-top:30px;">Upload</h2>
          <div class="form-body">
            <form method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="title"> Note Name</label>
                <input type="textbox" class="form-control" name="title" placeholder="Title">
              </div>
              <div class="form-group">
                <label for="unit"> Unit</label>
                <select class="form-control" name="UnitID" placeholder="Unit">
                  <option>----</option>
                  <option>AHCP</option>
                  <option>AMER</option>
                  <option>ARGY</option>
                  <option>BIOL</option>
                  <option>BMAN</option>
                  <option>CHEM</option>
                  <option>CHEN</option>
                  <option>CHIN</option>
                  <option>CLAH</option>
                  <option>COMP</option>
                  <option>DENT</option>
                  <option>DRAM</option>
                  <option>EART</option>
                  <option>ECON</option>
                  <option>EDUC</option>
                  <option>EEEN</option>
                  <option>ENGL</option>
                  <option>FOUN</option>
                  <option>FREN</option>
                  <option>GEOG</option>
                  <option>GERM</option>
                  <option>HCDI</option>
                  <option>HIST</option>
                  <option>HSTM</option>
                  <option>IIDS</option>
                  <option>ITAL</option>
                  <option>JAPA</option>
                  <option>LAWS</option>
                  <option>LELA</option>
                  <option>MACE</option>
                  <option>MATH</option>
                  <option>MATS</option>
                  <option>MCEL</option>
                  <option>MEDN</option>
                  <option>MEST</option>
                  <option>MGDI</option>
                  <option>MUSC</option>
                  <option>NURS</option>
                  <option>OPTO</option>
                  <option>PHAR</option>
                  <option>PHIL</option>
                  <option>PHYS</option>
                  <option>PLAN</option>
                  <option>POLI</option>
                  <option>PSYC</option>
                  <option>RELT</option>
                  <option>RUSS</option>
                  <option>SALC</option>
                  <option>SOAN</option>
                  <option>SOCY</option>
                  <option>SOST</option>
                  <option>SPLA</option>
                  <option>UCIL</option>
                  <option>Other</option>
                </select>
              </div>
              <div class="form-group">
                <label for="sectionID"> Section ID</label>
                <input type="textbox" class="form-control form-element" name="sectionNumber" placeholder="Section ID">
              </div>
              <div class="form-group">
                <input type="file" id="requiredFile" name="requiredFile" accept=".pdf,.png,.jpg">
              </div>
              <div class="form-group">
                <input type="checkbox" name="box" value="tik the Box"> I confirm that the file complies with the <a href="./TermsAndConditions.html">Terms and Conditions</a><br>
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-default btn-lg submit-btn btn-block submit-font bottom-buffer" value="Submit" name="btn">
              </div>
            </form>
          </div>
        </div>
      </div>

      <script type="text/javascript">
      $(function(){
        $("#requiredFile").on('change', function(event) {
            var file = event.target.files[0];

            if(!(file.type.match('image/jp.*') || file.type.match('application/pdf'))) {
                alert("only JPG and PDF files");
                $("#requiredFile").get(0).reset(); //the tricky part is to "empty" the input file here I reset the form.
                return;
            }

            var fileReader = new FileReader();
            fileReader.onload = function(e) {
                var int32View = new Uint8Array(e.target.result);

                // for JPG is 0xFF 0xD8 0xFF 0xE0 (see https://en.wikipedia.org/wiki/List_of_file_signatures)
                if(int32View.length>4 && int32View[0]==0xFF && int32View[1]==0xD8 && int32View[2]==0xFF && int32View[3]==0xE0
                   || int32View[0]==0x25 && int32View[1]==0x50 && int32View[2]==0x44 && int32View[3]==0x46
                   && int32View[4]==0x2d) {
                    alert("ok!");
                } else {
                    alert("only valid JPG and PDF files");
                    $("#requiredFile").get(0).reset(); //the tricky part is to "empty" the input file here I reset the form.
                    return;
                }
            };
            fileReader.readAsArrayBuffer(file);
        });
      });
      </script>

      <?php
        function validateUpload($Unit, $Number)
        {
          if ($Unit == "----")
            return false;
          else if ($Number == "")
            return false;
          else
            return true;
        }

         ?>
    </div>
  </body>
</html>
