<?php 
require_once('../shared/connection.php');
require_once("../shared/config.php");



session_start();


// if not admin
if(!isset($_SESSION['login']) && $_SESSION['level'] != 1)
{
 //redirect to home page for login
  header('location:../index.php');
	
}

//get jobs

$jobs =  "SELECT user.fullName, job.jobId, job.date,job.jobStatus, job.appointmentStatus, job.bikeName,
          job.bikeBrand,job.serviceType, job.status,job.JobStatus FROM user INNER JOIN jobassign
          ON user.userId = jobassign.userId INNER JOIN job ON jobassign.jobId = job.jobId 
          order By job.jobId DESC";

$jobsResult = $connection->query($jobs);

$_SESSION['processing'] = false;
//get Processing job id

if(isset($_POST['processingSubmit'])) {

    
    
    $jobId = $_POST['jobSubmitId'];

    //fetch all the jobs that belongs to specific id
$fetchJob =  "SELECT * From job INNER JOIN user ON job.userId = user.userId
WHERE job.jobId = '$jobId'";
$getSingleJob = $connection->query($fetchJob);
//fetch the selected article
$jobRow=$getSingleJob->fetch_assoc();
    $_SESSION['processing'] = true;
    


}

$count = "SELECT count(*) as total from job";
$countResult = $connection->query($count);
$totalJob = $countResult->fetch_assoc();

require_once("../shared/header.php");
require_once('shared/sidebar.php');
?>


<div class="content">
      <div class="dashboard__overview">
        <div class="flex-nojustify">
          <span><a class="back-arrow" href="overview.php">&larr;</a></span>
          <p class="dashboard__title mt-sm">Job</p>
        </div>

        <div class="card__box flex-display--column">
          <p class="card__box--title">ALL JOBS</p>
          <p class="card__box--description"><?php echo $totalJob["total"]; ?></p>
        </div>

        <!-- job section with table -->

        <div class="dashboard__table-header flex-display">
          <p class="dashboard__subtitle">All Jobs</p>
        </div>

        <div class="dashboard__search-header flex-display">
          <div class="dashboard__search-box flex-display">
            <input type="search" name="mainSearchJob" id="mainSearchJob" placeholder="Search by name" />
            <button class="btn btn-primary">Search</button>
          </div>
          <button class="btn btn-white btn-white-after">Filter</button>
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
            <?php while($row =$jobsResult->fetch_assoc() ) { ?>
            <tr>
              <td class="checkbox"><input type="checkbox" /></td>
              <td class="sn"><?php echo $row["jobId"]; ?></td>
              <td class="name"><?php echo $row["bikeName"]; ?></td>
              <td class="brand"><?php echo $row["bikeBrand"]; ?></td>
              <td class="job-type"><?php echo $row["serviceType"]; ?></td>
              <td class="appointment-date"><?php echo $row["status"]; ?></td>
              <td class="mechanic-incharge"><?php echo $row["fullName"]; ?></td>
              <td class="status">
              <?php if($row["jobStatus"] == 0){ ?>
              <p class="processing">Processing</p>
              <?php } elseif($row["jobStatus"]==1){?>
                <p class="compelted">Job Done</p>
              <?php } else {?>
                <p class="">-</p>
             <?php }?>
            </td>
              
            <form method="post">
                <input type="hidden" name="jobSubmitId" id="jobSubmitId" value="<?php echo $row["jobId"]; ?>" />
              <td class="action">
                <div class="flex-display icon-size">
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
      <?php if($_SESSION['processing']) {?>
        <div class="modal-job-processing">
        <div class="modal__content flex-display--column">
          <div class="full-with flex-display top-modal align-center">
            <h3 class="top-modal--title">Appointment Date: 19/04/2023</h3>
            <div class="flex-display vertical-align sm-column-space">
              <h3>My Status:</h3>
              <?php if($jobRow["jobStatus"]==0) {?>
              <h3 class="processing">Processing</h3>
              <?php }?>
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
                <img src="../upload/<?php echo $jobRow['images']; ?>" alt="" />
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

      <!-- Job Done Modal -->
      <div class="modal-job-done hidden-job-done">
        <div class="modal__content flex-display--column">
          <div class="full-with flex-display mt-md md-column-space">
            <div class="flex-5">
              <h3 class="dashboard__title title-head">Invoice Generated</h3>
              <h2 class="invoice-gen-title">SERVICES PROVIDED</h2>
              <table class="mb-minus">
                <thead>
                  <tr>
                    <th class="sn">NO</th>
                    <th class="service">Service</th>
                    <th class="price">PRICE</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="sn">1</td>
                    <td class="service">Oil Change</td>
                    <td class="price">N5000:00</td>
                  </tr>
                  <tr>
                    <td class="sn">2</td>
                    <td class="service">Brake Reset</td>
                    <td class="price">N5000:00</td>
                  </tr>
                  <tr class="sub-total">
                    <td class="sn"></td>
                    <td class="service sub-total">Sub Total</td>
                    <td class="price sub-total">N10000:00</td>
                  </tr>
                </tbody>
              </table>
              <h2 class="invoice-gen-title">PARTS PURCHASED</h2>
              <table class="mb-minus">
                <thead>
                  <tr>
                    <th class="sn">NO</th>
                    <th class="part">Service</th>
                    <th class="price">PRICE</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="sn">1</td>
                    <td class="part">Engine Shaft</td>
                    <td class="price">N6000:00</td>
                  </tr>
                  <tr>
                    <td class="sn">2</td>
                    <td class="part">Brake Pedal</td>
                    <td class="price">N2000:00</td>
                  </tr>
                  <tr class="sub-total">
                    <td class="sn"></td>
                    <td class="part sub-total">Sub Total</td>
                    <td class="price sub-total">N10000:00</td>
                  </tr>
                </tbody>
                <tr class="total">
                  <td class="sn"></td>
                  <td class="part sub-total-total">Total</td>
                  <td class="price">N10000:00</td>
                </tr>
              </table>
            </div>
            <div class="flex-3 full-with flex-align-left">
              <h3 class="dashboard__title title-head mb-minus">
                Invoice Generated
              </h3>
              <h3 class="title-head">Bike Name: Jincheng</h3>
              <h3 class="title-head">Bike Brand: JC-18827</h3>
              <h4>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit ut
                aliquam, purus sit amet luctus venenatis Lorem ipsum dolor sit
                amet, consectetur adipiscing elit
              </h4>

              <h3 class="dashboard__title mt-sm title-head">Media Uploaded</h3>
              <img
                class="media-picture"
                src="../img/job-image.png"
                alt="media image"
                srcset=""
              />
              <h3 class="title-head">Date Completed: 22/12/2022</h3>
              <h3 class="dashboard__title title-head mb-minus">
                Mechanic’s Note:
              </h3>
              <h4>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit ut
                aliquam, purus sit amet luctus venenatis Lorem ipsum dolor sit
                amet, consectetur adipiscing elit ut aliquam, purus sit amet
                luctus venenatis Lorem ipsum dolor sit amet, consectetur
                adipiscing elit ut aliquam, purus sit amet luctus venenatis
                Lorem ipsum dolor sit amet,
              </h4>
            </div>
          </div>
        </div>
      </div>
      <div class="overlay-job-done hidden-job-done"></div>
    </div>

<?php require_once("../shared/footer.php"); ?>
