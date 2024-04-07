<?php 
require_once("../shared/connection.php");
require_once("../shared/config.php");



$errMsg = "";




session_start();
if(!isset($_SESSION['login']) && $_SESSION['level'] != 2)
{
 //if not admin then redirect to index page
  header('location:../index.php');
	
}

$_SESSION['addJobSuccess'] = false;

//Get Current User ID

$userId = $_SESSION["userId"];

//Job Section

//Get All the Bikes

$jobsResult='';
//query all the articles from newest to oldest
$jobs =  "SELECT * From job WHERE userId= '$userId' ORDER BY jobId";


$jobsResult = $connection->query($jobs);

if(isset($_POST['submitNewJob'])) {
     
    $jobDate = date("Y-m-d");
    $jobName = $_POST['jobname'];
    $jobBrand = $_POST['jobbrand'];
    $jobDesc  = $_POST['jobdesc'];
    $image = $_FILES["image"]["name"]; 
    $status = $_POST['calender'];
    $service = $_POST['service'];
    

    $target = "../upload/".basename($image); //specify upload images directory
    //save images into upload directory
    move_uploaded_file($_FILES["image"]["tmp_name"] ,$target);

    
    if($jobDate !=null && $jobName != null && $jobBrand != null && $jobDesc != null 
       && $service != null && $image != null && $status != null
    )
    {
  
      $query = "INSERT INTO job(date,bikeName,bikeBrand,description, status,serviceType,images,userId)
                         VALUES('$jobDate','$jobName','$jobBrand','$jobDesc','$status','$service','".$image."',
                                '$userId')";
      if($connection->query($query)) {
        $_SESSION['addJobSuccess'] = true;
      }
      else {
        $errMsg = "Error: Check Your details and submit again.";
      }
    }
   
  //count bikes and jobs
  
  if(isset($_POST['JobSuccessModel'])) {
    $_SESSION['addJobSuccess'] = false;
  
  }

}

$_SESSION['deleteJobModal'] = false;
//delete job Modal

if(isset($_POST['deleteJob'])) {
   
  $jobId = $_POST['jobId'];

  echo  $jobId;

  $query = "DELETE FROM job WHERE jobId = '$jobId'";
  if($connection->query($query)){

    $_SESSION['deleteJobModal'] = true;
  } else {
    $errMsg = "Error: Check Your details and submit again.";
  }
 }

 if(isset($_POST['jobDeleteModel'])) {
  
  header("Refresh:0");
  $_SESSION['deleteJobModal'] = false;

}
require_once("../shared/header.php");
require_once("shared/sidebar.php");
?>

<div class="content">
      <div class="dashboard__overview">
        <p class="dashboard__title">Jobs</p>

        <div class="card__container flex-display">
          <div class="card__box flex-display--column">
            <p class="card__box--title">TOTAL JOBS</p>
            <p id="totalJobs" class="card__box--description">0</p>
          </div>
        </div>

        <div class="dashboard__table-header flex-display">
          <p class="dashboard__subtitle">Recent Jobs</p>
          <button class="btn btn-primary btn-primary-before-job book-new-job">
            Book a New Job
          </button>
        </div>

        <div class="dashboard__search-header flex-display">
          <div class="dashboard__search-box flex-display">
            <input type="search" name="" id="mainSearchJob" />
            <button class="btn btn-primary">Search</button>
          </div>
        </div>
        <table id="jobTable">
          <thead>
            <tr>
              <th class="checkbox"></th>
              <th class="sn">NO</th>
              <th class="date">Date</th>
              <th class="name">Bike Name</th>
              <th class="brand">Bike Brand</th>
              <th class="job">Job Description</th>
              <th class="status">Status</th>
              <th class="action">Action</th>
            </tr>
          </thead>
          <tbody id="mainJobTable">
          <?php while($row=$jobsResult->fetch_assoc()) { ?>
            <tr>
              <td class="checkbox"><input type="checkbox" /></td>
              <td class="sn"><?php echo $row["jobId"]?></td>
              <td class="date"><?php echo $row["date"]?></td>
              <td class="name"><?php echo $row["bikeName"]?></td>
              <td class="brand"><?php echo $row["bikeBrand"]?></td>
              <td class="job">
              <?php echo $row["description"]?>
                ...
              </td>
              <td class="status">
                Appointment Scheduled on:
                <p class="text-red"><?php echo $row["status"]?></p>
              </td>
              <td class="action">
                <div class="flex-display icon-size">
                  <a href="editJob.php?jobId=<?php echo $row["jobId"]?>"><i class="fas fa-edit"></i></a>
                  <form method="post">
                  <input type="hidden" name="jobId" id="jobId" value="<?php echo $row["jobId"]?>" />
                  <button class="three-dots-btn" type="submit" name="deleteJob" id="deleteJob">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                  </form>
                </div>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>


    <!-- add new bike modal -->
 
    <div class="modal-new-job hidden-new-job">
      <div class="modal__content flex-display--column">
        <div class="full-with flex-display top-modal align-center">
          <h3 class="top-modal--title">Add New Job</h3>
          <i class="fas fa-times-circle close-modal-add-new-job"></i>
        </div>
        <form id="addNewJobForm" method="post" enctype="multipart/form-data">
        <div
          class="full-with display-grid grid-two-column authenticate__details"
        >
          <div class="input-box flex-display--column">
            <label for="jobname">Bike Name:</label>
            <input type="text" name="jobname" id="jobname" placeholder="" />
          </div>

          <div class="input-box flex-display--column">
            <label for="jobbrand">Bike Brand:</label>
            <input type="text" name="jobbrand" id="jobbrand" placeholder="" />
          </div>

          <div class="input-box flex-display--column">
            <label for="jobdesc">Job Description:</label>
            <textarea
              class="text-area"
              name="jobdesc"
              rows="7"
              id="jobdesc"
              placeholder=""
            ></textarea>
          </div>

          <div class="full-with flex-display--column">
            <div class="input-box flex-display--column">
              <label for="service">Select Service:</label>
              <select class="select-service" name="service" id="service">
                <option value="Repair">Repair</option>
                <option value="MOT">MOT</option>
              </select>
            </div>
            <div class="input-box flex-display--column">
              <label for="image">Upload a image:</label>
              <input type="file" name="image" id="image" placeholder="" />
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
            />
          </div>
        </div>


        <button type="submit" id="submitNewJob" name="submitNewJob"
          class="btn btn-primary btn-full mt-md"
        >
          Confirm
        </button>
        </form>
      </div>
    </div>
    <?php if($_SESSION['addJobSuccess']) { ?>
    <div class="overlay-new-job"></div>

    <div class="modal-finish-new-job">
      <div class="modal__content flex-display--column">
        <div class="circle">
          <div class="checkmark"></div>
        </div>
        <p>Appointment Scheduled Successfully.</p>
        <form method="post">
          <!-- working -->
        <button type="submit" name="JobSuccessModel" id="JobSuccessModel" class="btn btn-primary btn-full finish-new-job">OK</button>
    </form>
      </div>
    </div>
    <div class="overlay-finish-new-job hidden-finish-new-job"></div>
    <?php } ?>

    <?php if($_SESSION['deleteJobModal']) {?>
    <div class="modal-delete-confirm">
          <div class="modal__content flex-display--column">
            <div class="circle">
              <div class="checkmark"></div>
            </div>
            <p>Job deleted successfully!!!</p>
            <form method="post">
        <button type="submit" name="jobDeleteModel" id="jobDeleteModel" class="btn btn-primary btn-full finish-bike-added">OK</button>
    </form>          </div>
        </div>
        <div class="overlay-delete-confirm hidden-delete-confirm"></div>
      </div>
    </div>
    <?php }?>

    <?php require_once("../shared/footer.php"); ?>