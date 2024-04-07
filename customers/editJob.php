<?php 
require_once("../shared/connection.php");
require_once("../shared/config.php");


session_start();

$errMsg = "";
$result="";

$jobId = $_GET['jobId'];



if(!isset($_SESSION['login']) && $_SESSION['level'] != 2)
{
 //redirect to home page for login
  header('location:../index.php');
	
}

//check if job id is exists in url
if($jobId == null){
  header('location:dashboard.php');
}

//fetch all the jobs that belongs to specific id
$fetchJob=  "SELECT * From job WHERE jobId = '$jobId '";
$getResult = $connection->query($fetchJob);
//fetch the selected article
$row=$getResult->fetch_assoc();


if(isset($_POST['submitNewJob'])) {
     
  //$jobDate = date("Y-m-d");
  $jobName = $_POST['jobname'];
  $jobBrand = $_POST['jobbrand'];
  $jobDesc  = $_POST['jobdesc'];
  $status = $_POST['calender'];
  $service = $_POST['service'];
  $image = $_FILES["image"]["name"]; 

  $target = "../upload/".basename($image); //specify upload images directory
  //save images into upload directory
  move_uploaded_file($_FILES["image"]["tmp_name"] ,$target);
  


    $query = "UPDATE job SET bikeName = '".$jobName."', bikeBrand = '".$jobBrand."',description = '".$jobDesc."', 
              status = '".$status."',serviceType = '".$service."', images = '".$image."' WHERE jobId = $jobId";
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
            <p class="dashboard__title mt-sm">Edit <?php echo $row["bikeName"];?> Job</p>
          </div>
        </div>
        <p><?php echo $errMsg; ?></p>
        <form id="addNewJobForm" method="post" enctype="multipart/form-data">
        <div
          class="full-with display-grid grid-two-column authenticate__details"
        >
          <div class="input-box flex-display--column">
            <label for="jobname">Bike Name:</label>
            <input type="text" name="jobname" id="jobname" placeholder="" value="<?php echo $row["bikeName"]?>"/>
          </div>

          <div class="input-box flex-display--column">
            <label for="jobbrand">Bike Brand:</label>
            <input type="text" name="jobbrand" id="jobbrand" placeholder="" value="<?php echo $row["bikeBrand"]?>"/>
          </div>

          <div class="input-box flex-display--column">
            <label for="jobdesc">Job Description:</label>
            <textarea
              class="text-area"
              name="jobdesc"
              rows="7"
              id="jobdesc"
             
            ><?php echo $row["description"]; ?></textarea>
          </div>

          <div class="full-with flex-display--column">
            <div class="input-box flex-display--column">
              <label for="service">Select Service:</label>
              <select class="select-service" name="service" id="service">
                <option value="<?php echo $row["serviceType"]; ?>" selected><?php echo $row["serviceType"]; ?></option>
                <option value="Repair">Repair</option>
                <option value="MOT">MOT</option>
              </select>
            </div>
            <div class="input-box flex-display--column">
              <label for="image">Upload a image again:</label>
              <input type="file" name="image" id="image" placeholder=""/>
            </div>
          </div>
        </div>
        <div class="authenticate__details full-with">
          <div class="full-with flex-display--column">
            <label for="calender">Book Your Appointment Date:</label>
            <input
              class="calender-date"
              type="datetime-local"
              name="calender"
              id="calender"
              placeholder=""
              value="<?php echo $row["status"]; ?>"
            />
          </div>
        </div>


        <button type="submit" id="submitNewJob" name="submitNewJob"
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
