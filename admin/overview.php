<?php 
require_once("../shared/config.php");
require_once('../shared/connection.php');



session_start();


if(!isset($_SESSION['login']) && $_SESSION['level'] != 1)
{
 //redirect to home page for login
  header('location:../index.php');
	
}

//Get last 4 jobs

$jobsResult='';
//query all the Job from newest to oldest
$jobs =  "SELECT user.fullName, job.jobId, job.bikeName, job.bikeBrand, job.status, 
          job.jobStatus FROM user INNER JOIN job on user.userId = job.userId
          WHERE job.jobStatus = '-' OR job.jobStatus IS NULL
          ORDER by job.jobId DESC LIMIT 4";


$jobsResult = $connection->query($jobs);


//get data into modal 


$appointmentRow = "";
$hiddenJobID="";
$_SESSION['isModel'] = false;
if(isset($_POST['appointmentSubmit'])) {

    $hiddenJobID = $_POST['hiddenJobId'];


    
//fetch all the jobs that belongs to specific id
$fetchAppointment =  "SELECT * From job INNER JOIN user ON job.userId = user.userId
                      WHERE job.JobId = '$hiddenJobID' order By jobId DESC LIMIT 4";
$getSingleJobAppointment = $connection->query($fetchAppointment);
//fetch the selected article
$appointmentRow=$getSingleJobAppointment->fetch_assoc();
$_SESSION['isModel'] = true;


}


//get available mechanics

$getMechanics = "SELECT user.userId, user.fullName, mechanicinfo.currentStatus FROM user
INNER JOIN mechanicinfo ON user.userId = mechanicinfo.userId
WHERE currentStatus = 1 AND user.level=3;";

$mechanicResult = $connection->query($getMechanics);


//assign job to mechanic based on availibilty


if(isset($_POST['submitJobAssign'])) {

   $mechanicId = $_POST['availableMechanic'];
   $assignJob = $_POST['assignJobId'];

   $query = "INSERT INTO jobassign(userId, jobId) VALUES('$mechanicId','$assignJob')";

   if($connection->query($query)) {
    header("Location:overview.php");
}
else {
    $errMsg = "Somthing goes wrong. Please try again later.";
}

}




//get jobs

$jobs2 =  "SELECT user.fullName, job.jobId, job.date,job.jobStatus, job.appointmentStatus,
job.bikeName, job.bikeBrand,job.serviceType, job.status,job.JobStatus FROM user
INNER JOIN job ON user.userId = job.userId WHERE job.jobStatus = 0
AND job.jobStatus != '-' ORDER BY user.userId DESC";

$jobsResult2 = $connection->query($jobs2);

$_SESSION['processing'] = false;
//get Processing job id

if(isset($_POST['processingSubmit'])) {

    
    
    $jobId = $_POST['jobSubmitId'];

    //fetch all the jobs that belongs to specific id
$fetchJob =  "SELECT * From Job INNER JOIN User ON Job.userId = User.userId
WHERE Job.JobId = '$jobId'";
$getSingleJob = $connection->query($fetchJob);
//fetch the selected article
$jobRow=$getSingleJob->fetch_assoc();
    $_SESSION['processing'] = true;
    


}


// Job count
$countBike="SELECT count(*) as total from vehicle";
$dataBike= $connection->query($countBike);
$totalBikeCount=$dataBike->fetch_assoc();


// Job count
$countJob="SELECT count(*) as total from job";
$dataJob= $connection->query($countJob);
$totalJobCount=$dataJob->fetch_assoc();

//mechanics count

$countMechanic="SELECT count(*) as total from user where level = 3";
$dataMechanic= $connection->query($countMechanic);
$totalJobCount=$dataMechanic->fetch_assoc();

//Customer count

$countCustomer="SELECT count(*) as total from user where level = 2";
$dataCustomer= $connection->query($countCustomer);
$totalCustomerCount=$dataCustomer->fetch_assoc();




require_once("../shared/header.php");
require_once('shared/sidebar.php');
?>
    <!-- side area end-->

    <div class="content">
      <div class="dashboard__overview">
        <p class="dashboard__title">Overview  </p>
        <div class="full-with flex-display">
          <div class="card__container flex-display special-card">
            <div class="card__box flex-display--column">
              <p class="card__box--title">Total Bikes</p>
              <p  class="card__box--description"><?php echo $totalBikeCount['total']; ?></p>
            </div>
            <div class="card__box flex-display--column">
              <p class="card__box--title">ALL JOBS</p>
              <p  class="card__box--description"><?php echo $totalJobCount['total']; ?></p>
            </div>

            <div class="card__box flex-display--column">
              <p class="card__box--title">MECHANICS</p>
              <p class="card__box--description"><?php echo $totalJobCount['total']; ?></p>
            </div>

            <div class="card__box flex-display--column">
              <p class="card__box--title">TOTAL CUSTOMERS</p>
              <p class="card__box--description"><?php echo $totalCustomerCount['total']; ?> </p>
            </div>
          </div>
        </div>
        
        <!-- appointment section with table -->

        <div class="dashboard__table-header flex-display">
          <p class="dashboard__subtitle">Next 4 Appointments</p>
        </div>

        <div class="dashboard__search-header flex-display">
          <div class="dashboard__search-box flex-display">
            <input type="search" name="mainSearchBike" id="mainSearchBike" placeholder="Search by name" />
            <button class="btn btn-primary">Search</button>
          </div>
          <button class="btn btn-white btn-view-all-apointment">
            View All
          </button>
        </div>

        <table>
          <thead>
            <tr>
              <th class="checkbox"></th>
              <th class="sn">NO</th>
              <th class="customername">Bike Name</th>
              <th class="emailuser">Bike Model</th>
              <th class="appointment-date">Appointment Date</th>
              <th class="assignto">Customer Name</th>
              <th class="status">Job Status</th>
              <th class="action">Assign Job</th>
            </tr>
          </thead>
          <tbody id="mainBikeTable">
          <?php while($row=$jobsResult->fetch_assoc()) { ?>
             <tr>
              <td class="checkbox"><input type="checkbox" /></td>
              <td class="sn"><?php echo $row["jobId"]; ?></td>
              <td class="customername"><?php echo $row["bikeName"]; ?></td>
              <td class="emailuser"><?php echo $row["bikeBrand"]; ?></td>
              <td class="appointment-date"><?php echo $row["status"]; ?></td>
              <td class="assignto"><?php echo $row["fullName"]; ?></td>
              <td class="status">
           <p class="">-</p>
              </td>
              <td class="action">
                <div class="flex-display icon-size">
                  <form method="post">
                    <input type="hidden" name="hiddenJobId" id="hiddenJobId" value="<?php echo $row["jobId"]; ?>" />
                 <button type="submit" name="appointmentSubmit"  class="three-dots-btn"><i class="fas fa-ellipsis-v three-dots"></i></button>
                 </form>
                </div>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
       
        <!-- job section with table -->

        <div class="dashboard__table-header flex-display">
          <p class="dashboard__subtitle">Ongoing Jobs</p>
        </div>

        <div class="dashboard__search-header flex-display">
          <div class="dashboard__search-box flex-display">
            <input type="search" name="mainSearchJob" id="mainSearchJob" placeholder="Search by name" />
            <button class="btn btn-primary">Search</button>
          </div>
          <button class="btn btn-white btn-view-all-admin-jobs">
            View All 
          </button>
        </div>

        <table>
          <thead>
            <tr>
              <th class="checkbox"></th>
              <th class="sn">NO</th>
              <th class="name">Bike Name</th>
              <th class="brand">Bike Brand</th>
              <th class="job-type">Job Type</th>
              <th class="appointment-date">Appointment Date</th>
              <th class="mechanic-incharge">MECHANIC INCHARGE</th>
              <th class="status">Job Status</th>
              <th class="action">View</th>
            </tr>
          </thead>
          <tbody id="mainJobTable">
            <?php while($row =$jobsResult2->fetch_assoc() ) { ?>
            <tr>
              <td class="checkbox"><input type="checkbox" /></td>
              <td class="sn"><?php echo $row["jobId"]; ?></td>
              <td class="name"><?php echo $row["bikeName"]; ?></td>
              <td class="brand"><?php echo $row["bikeBrand"]; ?></td>
              <td class="job-type"><?php echo $row["serviceType"]; ?></td>
              <td class="appointment-date"><?php echo $row["status"]; ?></td>
              <td class="mechanic-incharge"><?php echo $row["fullName"]; ?></td>
              <td class="status">
              <p class="processing">Processing</p>
            </td>
              
            <form method="post">
                <input type="hidden" name="jobSubmitId" id="jobSubmitId" value="<?php echo $row["jobId"]; ?>" />
              <td class="action">
              <button type="submit" name="processingSubmit" id="processingSubmit" class="three-dots-btn"><i class="fas fa-ellipsis-v three-dots"></i></button>

                </div>
              </td>
              
              </form>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <!-- Job processing Modal -->
      <?php if($_SESSION['isModel']) {?>
      <div class="modal-appointment-assign">
        <div class="modal__content flex-display--column">
          <div class="full-with flex-display top-modal align-center">
            <h3 class="top-modal--title">
              Appointment Date: <?php echo $appointmentRow["status"]; ?>
            </h3>
            <form method="post">
            <button type="submit" name="submitClose" id="submitClose" class="three-dots-btn"><i
              class="fas fa-times-circle close-modal-job-processing icon-size"
            ></i></button>
      </form>
          </div>
          <div
            class="full-with display-grid grid-two-column authenticate__details"
          >
            <div class="input-box flex-display--column">
              <label for="bikename">Customer Name:</label>
              <input
                type="text"
                value="<?php echo $appointmentRow["fullName"]; ?>"
                disabled
                name="bikename"
                id="bikename"
                placeholder=""
              />
            </div>

            <div class="input-box flex-display--column">
              <label for="bikebrand">Service:</label>
              <input
                type="text"
                name="bikebrand"
                disabled
                value="<?php echo $appointmentRow["serviceType"]; ?>"
                id="bikebrand"
                placeholder=""
              />
            </div>

            <div class="input-box flex-display--column">
              <div class="input-box flex-display--column mb-minus">
                <label for="bikebrand">Bike:</label>
                <input
                  type="text"
                  name="bikebrand"
                  disabled
                  value="<?php echo $appointmentRow["bikeName"]; ?>"
                  id="bikebrand"
                  placeholder=""
                />
              </div>
              <div class="input-box flex-display--column mb-minus">
                <label for="bikebrand">Bike Brand:</label>
                <input
                  type="text"
                  name="bikebrand"
                  disabled
                  value="<?php echo $appointmentRow["bikeBrand"]; ?>"
                  id="bikebrand"
                  placeholder=""
                />
              </div>
            </div>

            <div class="input-box flex-display--column">
              <label for="jobdesc">Job Description:</label>
              <textarea
                class="text-area"
                name="jobdesc"
                disabled
                rows="7"
                id="jobdesc"
                placeholder=""
              >
              <?php echo $appointmentRow["description"]; ?>
      </textarea>
            </div>

            <div class="input-box flex-display--column">
              <label for="datereg">Media:</label>
              <div class="flex-display media-container sm-column-space">
                <img src="../upload/<?php echo $appointmentRow['images']; ?>" alt="" srcset="" />
              </div>
            </div>
            <form method="post">
            <div class="input-box flex-display--column">
              <div class="flex-display--column media-container sm-column-space">
                <label for="lastmont">Assigned to:</label>
                <select class="select-service" name="availableMechanic" id="availableMechanic">
                <?php while($row=$mechanicResult->fetch_assoc()) { ?>
                  <option value="<?php echo $row["userId"]; ?>"><?php echo $row["fullName"]; ?></option>
                <?php }?>
                </select>
              </div>
            </div>
          </div>
          <div class="full-with flex-display center-flex">
          <input type="hidden" name="assignJobId" id="assignJobId" value="<?php echo $appointmentRow["jobId"]; ?>"/>

            <button type="submit" name="submitJobAssign" id="submitJobAssign"
              class="btn btn-primary full-with"
            >
              Save
            </button>
          </div>
      </form>
        </div>
      </div>
      <div class="overlay-appointment-assign hidden-appointment-assign"></div>
      <?php } ?>
         <!-- Job processing Modal -->
      <?php if($_SESSION['processing']) {?>
      <div class="modal-job-processing">
        <div class="modal__content flex-display--column">
          <div class="full-with flex-display top-modal align-center">
            <h3 class="top-modal--title">Appointment Date: 19/04/2023</h3>
            <div class="flex-display vertical-align sm-column-space">
              <h3 class="processing">My Status: Processing</h3> 
           </div>
            <i
              class="fas fa-times-circle close-modal-job-processing icon-size"
            ></i>
          </div>
          <div
            class="full-with display-grid grid-two-column authenticate__details"
          >
            <div class="input-box flex-display--column">
              <label for="bikename">Customer Name:</label>
              <input
                type="text"
                value="<?php echo $jobRow["fullName"];?>"
                disabled
                name="bikename"
                id="bikename"
                placeholder=""
              />
            </div>

            <div class="input-box flex-display--column">
              <label for="bikebrand">Service:</label>
              <input
                type="text"
                name="bikebrand"
                disabled
                value="<?php echo $jobRow["serviceType"];?>"
                id="bikebrand"
                placeholder=""
              />
            </div>

            <div class="input-box flex-display--column">
              <div class="input-box flex-display--column">
                <label for="bikebrand">Bike:</label>
                <input
                  type="text"
                  name="bikebrand"
                  disabled
                  value="<?php echo $jobRow["bikeName"];?>"
                  id="bikebrand"
                  placeholder=""
                />
              </div>
              <div class="input-box flex-display--column">
                <label for="bikebrand">Bike Brand:</label>
                <input
                  type="text"
                  name="bikebrand"
                  disabled
                  value="<?php echo $jobRow["bikeBrand"];?>"
                  id="bikebrand"
                  placeholder=""
                />
              </div>
            </div>

            <div class="input-box flex-display--column">
              <label for="jobdesc">Job Description:</label>
              <textarea
                class="text-area"
                name="jobdesc"
                disabled
                rows="7"
                id="jobdesc"
                placeholder=""
              >
              <?php echo $jobRow["description"];?>
              </textarea>
              >
            </div>

            <div class="input-box flex-display--column">
              <label for="datereg">Media:</label>
              <div class="flex-display media-container sm-column-space">
                <img src="../upload/<?php echo $jobRow['images']; ?>" alt="" srcset="" />
              </div>
            </div>

            <div class="input-box flex-display--column">
              <label for="lastmont">Assigned Date:</label>
              <input
                type="datetime-local"
                name="lastmont"
                value="<?php echo $jobRow["status"];?>"
                disabled
                id="lastmont"
                placeholder=""
              />
            </div>
          </div>
        </div>
      </div>
      <div class="overlay-job-processing"></div>

    <?php } ?>

    </div>

    <?php 
include_once("../shared/footer.php");

?>