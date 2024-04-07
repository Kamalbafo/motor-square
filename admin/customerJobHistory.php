<?php 
require_once('../shared/connection.php');
require_once("../shared/config.php");



session_start();
$errorMsg = "";

$userId = $_GET['userId'] ?? null;
// if not admin
if(!isset($_SESSION['login']) && $_SESSION['level'] != 1)
{
 //redirect to home page for login
  header('location:../index.php');
	
}

if(!$userId)
{
  header('location:overview.php'); 
}

//Get specific customer by id

$customerInfo = "SELECT fullName, email, image, phone from user WHERE userId = '$userId'";
$fetchResult = $connection->query($customerInfo);  
$row=$fetchResult->fetch_assoc();


//customer jobs history 
$query = "SELECT user.email, user.fullName, user.image, user.phone, job.jobId, job.serviceType, job.jobStatus,
job.description, job.status FROM user INNER JOIN job ON user.userId = job.userId
WHERE user.userId = '$userId'";

$fetchJobs = $connection->query($query);


require_once("../shared/header.php");
require_once('shared/sidebar.php');
?>

<div class="content">
      <div class="dashboard__overview">
        <div class="full-with flex-display align-center">
          <div class="flex-nojustify">
            <span><a class="back-arrow" href="customers.php">&larr;</a></span>
            <p class="dashboard__title mt-sm"><?php echo $row['fullName']; ?></p>
          </div>
          <div class="flex-display align-center md-column-space">
            <div class="flex-display icon-size">
              <i class="fas fa-trash-alt delete-mechanic-data"></i>
            </div>
          </div>
        </div>

        <div class="full-with flex-display justify-center">
          <img
            class="image-profile-view"
            src="../upload/<?php echo $row['image']; ?>"
            alt="image-profile-view"
            srcset=""
          />
        </div>

        <div class="full-with flex-display authenticate__details mt-md">
          <div class="input-box flex-display--column full-with">
            <label for="jobname">Email:</label>
            <input
              type="text"
              value="<?php echo $row['email']; ?>"
              disabled
              name="jobname"
              id="jobname"
              placeholder=""
            />
          </div>

          <div class="input-box flex-display--column full-with">
            <label for="jobname">Full Name:</label>
            <input
              type="text"
              value="<?php echo $row['fullName']; ?>"
              disabled
              name="jobname"
              id="jobname"
              placeholder=""
            />
          </div>
        </div>

        <div class="full-with flex-display authenticate__details">
          <div class="input-box flex-display--column full-with">
            <label for="ph">Phone Number:</label>
            <input
              type="text"
              name="phone"
              value="<?php echo $row['phone']; ?>"
              disabled
              id="phone"
              placeholder=""
            />
          </div>
        </div>
        <div class="full-with top-modal"></div>
        <!-- customers section with table -->

        <!-- job section with table -->

        <div class="dashboard__table-header flex-display">
          <p class="dashboard__subtitle">Job History</p>
        </div>

        <div class="dashboard__search-header flex-display">
          <div class="dashboard__search-box flex-display">
            <input type="search" name="" id="" placeholder="Search by name" />
            <button id="mainSearchJob" class="btn btn-primary">Search</button>
          </div>
          <button class="btn btn-white btn-white-after">Filter</button>
        </div>

        <table>
          <thead>
            <tr>
              <th class="checkbox"></th>
              <th class="sn">NO</th>
              <th>CUSTOMER NAME</th>
              <th>JOB TYPE</th>
              <th>APPOINTMENT DATE</th>
              <th>JOB DESCRIPTION</th>
              <th>JOB STATUS</th>
            </tr>
          </thead>
          <tbody id="mainJobTable">
            <?php while($row = $fetchJobs->fetch_assoc()) {?>
            <tr class="select-admin-job--2">
              <td class="checkbox"><input type="checkbox" /></td>
              <td class="sn"><?php echo $row['jobId']; ?></td>
              <td><?php echo $row['fullName']; ?></td>
              <td><?php echo $row['serviceType']; ?></td>
              <td><?php echo $row['status']; ?></td>
              <td>
              <?php echo $row['description']; ?>
              </td>
              <td>
              <?php if($row["jobStatus"]== null) {?>
                <p class="">-</p>
              <?php } elseif($row["jobStatus"]== 0) {?>
              <p class="processing">Processing</p>
              <?php }else{?>
            <p class="completed">Job Done</p>
              <?php } ?>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>




<?php require_once("../shared/footer.php"); ?>