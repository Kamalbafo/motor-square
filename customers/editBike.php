<?php 
require_once("../shared/connection.php");
require_once("../shared/config.php");


session_start();

$errMsg = "";
$bikeId = $_GET['vehicleId'];



if(!isset($_SESSION['login']) && $_SESSION['level'] != 2)
{
 //redirect to home page for login
  header('location:../index.php');
	
}

//check if job id is exists in url
if($bikeId == null){
  header('location:dashboard.php');
}

//fetch all the jobs that belongs to specific id
$fetchBike=  "SELECT * From vehicle WHERE vehicleId = '$bikeId '";
$getResult = $connection->query($fetchBike);
//fetch the selected article
$row=$getResult->fetch_assoc();

if(isset($_POST['editBike']))
{


  $registrationNo = trim(stripcslashes($_POST['registrationNo']));
  $bikename = trim(stripcslashes($_POST['bikename']));
  $bikebrand = trim(stripcslashes($_POST['bikebrand']));
  $datereg = trim(stripcslashes($_POST['datereg']));
  $lastmont = trim(stripcslashes($_POST['lastmont']));



  $query = "UPDATE vehicle SET regoNumber = '".$registrationNo."', name = '".$bikename."',brand = '".$bikebrand."', 
  regDate = '".$datereg."', mot = '".$lastmont."' WHERE vehicleId = $bikeId";      
     
  
  if($connection->query($query)) {
        header("Location:dashboard.php");
      }
    else {
      $errMsg = "Error: Check Your details and submit again.";
    }
}

require_once("../shared/header.php");
require_once("shared/sidebar.php");
?>
    <!-- side area end-->
    <div class="content">
      <div class="dashboard__overview">
        <div class="full-with flex-display align-center">
          <div class="flex-nojustify">
            <span><a class="back-arrow" href="dashboard.php">&larr;</a></span>
            <p class="dashboard__title mt-sm">Edit <?php echo $row["name"];?> Bike</p>
          </div>
        </div>
        <p><?php echo $errMsg; ?></p>
        <form id="addNewJobForm" method="post">
        <div
          class="full-with display-grid grid-two-column authenticate__details"
        >
          <div class="input-box flex-display--column">
            <label for="jobname">Registration No:</label>
            <input type="text" name="registrationNo" id="registrationNo" placeholder="" value="<?php echo $row["regoNumber"];?>"/>
          </div>

          <div class="input-box flex-display--column">
            <label for="jobbrand">Bike Name:</label>
            <input type="text" name="bikename" id="bikename" placeholder="" value="<?php echo $row["name"];?>"/>
          </div>
          <div class="input-box flex-display--column">
            <label for="jobname">Bike brand:</label>
            <input type="text" name="bikebrand" id="bikebrand" placeholder="" value="<?php echo $row["brand"];?>"/>
          </div>

          <div class="input-box flex-display--column">
            <label for="datereg">Date of Registration:</label>
            <input type="date" name="datereg" id="datereg" placeholder="" value="<?php echo $row["regDate"];?>" />
          </div>

          <div class="input-box flex-display--column">
            <label for="lastmont">Last MOT:</label>
            <input
              type="date"
              name="lastmont"
              id="lastmont"
              placeholder=""
              value="<?php echo $row["mot"];?>" 
            />
          </div>
          <br>


        <button type="submit" id="editBike" name="editBike"
          class="btn btn-primary btn-full mt-md"
        >
          Update
        </button>
      </div>
    </div>
    </form>
      </div>
    </div>

  <?php 
  require_once("../shared/footer.php");

  ?>
