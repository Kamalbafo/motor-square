<?php 
session_start();
require_once("../shared/config.php");
require_once('../shared/connection.php');





if(!isset($_SESSION['login']) && $_SESSION['level'] != 3)
{
 //redirect to home page for login
  header('location:../index.php');
	
}

$userId = $_SESSION['userId'];
echo $userId;
//Get all Jobs related to specific mechanic

//fetch all the jobs that belongs to specific id
$jobsResult='';
//query all the Job from newest to oldest
$jobs =  "SELECT job.jobId, job.date,job.jobStatus, job.appointmentStatus, job.bikeName, job.bikeBrand, job.serviceType, job.status,job.jobStatus
          FROM user INNER JOIN jobassign ON user.userId = jobassign.userId INNER JOIN job
          ON jobassign.jobId = job.jobId WHERE user.userId = '$userId' order By job.jobId DESC";


$jobsResult = $connection->query($jobs);



require_once("../shared/header.php");
require_once("shared/sidebar.php");
?>

<div class="content">
      <div class="dashboard__overview">
        <p class="dashboard__title">Overview</p>
        <div class="full-with flex-display">
          <div class="card__container flex-display">
            <div class="card__box flex-display--column">
              <p class="card__box--title">TOTAL JOBS</p>
              <p class="card__box--description">7</p>
            </div>
          </div>
        </div>

        <!-- Job section with table -->

        <div class="dashboard__table-header flex-display">
          <p class="dashboard__subtitle">My Jobs</p>
        </div>

        <div class="dashboard__search-header flex-display">
          <div class="dashboard__search-box flex-display">
            <input type="search" name="" id="" />
            <button class="btn btn-primary">Search</button>
          </div>
        </div>

        <table>
          <thead>
            <tr>
              <th class="checkbox"></th>
              <th class="sn">NO</th>
              <th class="date">Date</th>
              <th class="name">Bike Name</th>
              <th class="brand">Bike Brand</th>
              <th class="job-type">Job Type</th>
              <th class="appointment-date">Appointment Date</th>
              <th class="status">Job Status</th>
              <th class="action">Action</th>
            </tr>
          </thead>
          <tbody>
          <?php while($row=$jobsResult->fetch_assoc()) { ?>
            <tr>
              <td class="checkbox"><input type="checkbox" /></td>
              <td class="sn"><?php echo $row["jobId"]; ?></td>
              <td class="date"><?php echo $row["date"]; ?></td>
              <td class="name"><?php echo $row["bikeName"]; ?></td>
              <td class="brand"><?php echo $row["bikeBrand"]; ?></td>
              <td class="job-type"><?php echo $row["serviceType"]; ?></td>
              <td class="appointment-date">
              <?php echo $row["status"]; ?> 
              <?php if($row["appointmentStatus"] == 0) { ?>
                <span class="processing">Absent</span>
              <?php } elseif ($row["appointmentStatus"] == 1) {?>
                <span class="completed">Present</span>
              <?php } else {?>
                <span class=""></span>
              <?php }?>
              
              

              </td>
              <?php if($row["jobStatus"] == 0){ ?>
              <td class="status"><p class="processing">Processing</p></td>
              <?php } elseif ($row["jobStatus"] == 1) {?>
                <td class="status"><p class="completed">Job Done</p></td>
              <?php } else {?>
                <td class="status"><p class="">-</p></td>
              <?php } ?>
              <td class="action">
                <div class="flex-display icon-size">
                 <a href="manageJob.php?jobId=<?php echo $row["jobId"]; ?>"><i class="fas fa-ellipsis-v three-dots"></i></a>
                </div>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <?php require_once('../shared/footer.php'); ?>