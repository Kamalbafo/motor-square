<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
require_once('../shared/connection.php');
require_once("../shared/config.php");





session_start();
$errMsg  = "";

if(!isset($_SESSION['login']) && $_SESSION['level'] != 3)
{
 //redirect to home page for login
  header('location:../index.php');
	
}


// get job related to the job Id
$jobId = $_GET["jobId"];

$fetchJob=  "SELECT * From user INNER JOIN job on user.userId = job.userId WHERE job.jobId = '$jobId'";
$getResult = $connection->query($fetchJob);
$row=$getResult->fetch_assoc();


if(isset($_POST['submitJob'])) {

  $apoint = $_POST['apoint'];
  $jobStatus = $_POST['jobStatus'];

  $query =   "UPDATE job SET  jobStatus ='".$jobStatus."', appointmentStatus = '".$apoint."' WHERE
              jobId = '".$jobId."'";

      if($connection->query($query)) {
        header("Location:index.php");
      }
    else {
      $errMsg = "Error: Check Your details and submit again.";
    }


}


//Genrate Invoice 
$_SESSION['invoiceSuccess'] = false;
if(isset($_POST['invoiceSubmit'])) {

$customerId = $_POST['customerId'];
$jobId = $_POST['jobId'];
$jobCost = $_POST['jobCost'];
$jobDesc = $_POST['jobDesc'];




$query = "INSERT INTO invoice(jobCost,notes,userId,jobId) VALUES('".$jobCost."','".$jobDesc."',
         '".$customerId."','".$jobId."')";

if($connection->query($query)){
  
  $_SESSION['invoiceSuccess'] = true;

  $mail = new PHPMailer(true);

$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "kamaldiriyeprojects@gmail.com";
$mail->Password = "agwpwqehpotjuwdv";
$mail->SetFrom("kamaldiriyeprojects@gmail.com");
$mail->Subject = "Invoice|| Motor Square";
$mail->Body = "Your total cost: ".$jobCost. " for " .$jobDesc. " Job" ;
$mail->AddAddress($row['email']);

 if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
    echo "Message has been sent";
 }


   

} else {

  $errMsg = "Something went wrong. Please try again later.";
}
}


if(isset($_POST['close'])){
  $_SESSION['invoiceSuccess'] = false;
}


require_once("../shared/header.php");
require_once("shared/sidebar.php");
?>

    <!-- side area end-->
    <div class="content">
      <div class="dashboard__overview">
        <div class="flex-nojustify">
          <span><a class="back-arrow" href="index.php">&larr;</a></span>
          <p class="dashboard__title mt-sm">Job</p>
        </div>
         <p><?php echo $errMsg; ?></p>
        <div class="full-with flex-display mt-md md-column-space">
          <div class="flex-3">
            <h3 class="title-head">Bike Name: <?php echo $row["bikeName"]; ?></h3>
            <h3 class="title-head">Bike Brand: <?php echo $row["bikeBrand"]; ?></h3>
            <h3 class="title-head">Job Tpye: <?php echo $row["serviceType"]; ?></h3>
            <h3 class="title-head">Appointment Date: <?php echo $row["status"]; ?></h3>

            <p class="dashboard__title mt-sm mb-minus">Job Description</p>
            <p>
            <?php echo $row["description"]; ?>
            </p>
            <p class="dashboard__title mt-sm">Media Uploaded</p>
            <img
              class="media-picture"
              src="../upload/<?php echo $row["images"]; ?>"
              alt="media image"
              srcset=""
            />
            <form method="post">
            <div class="full-with flex-display--column mb-sm">
              <div class="input-box flex-display--column">
                <label for="jobCost">Note:</label>
                <input class="select-service" type="number" name="jobCost" id="jobCost" placeholder="0.00" required />
              </div>
            </div>
            <div class="full-with flex-display--column mb-sm">
              <div class="input-box flex-display--column">
                <label for="jobDesc">Note:</label>
                <textarea
                  class="text-area"
                  name="jobDesc"
                  rows="7"
                  id="jobDesc"
                  placeholder=""
                  required
                ></textarea>
              </div>
            </div>
            <input type="hidden" id="customerId" name="customerId" value="<?php echo $row["userId"]; ?>">
            <input type="hidden" id="jobId" name="jobId" value="<?php echo $row["jobId"]; ?>">
            <div class="full-with flex-display">
              <button type="submit" name="invoiceSubmit" id="invoiceSubmit" class="btn btn-primary-outline btn-full generate-invoice">
                Generate Invoice
              </button>
            </div>
            </form>
          </div>
         
          <div class="flex-5">
          <form method="post">
            <div class="full-with flex-display--column mb-sm">
              <div class="input-box flex-display--column">
                <label for="apoint" class="title-head">Appointment:</label>
                <select class="select-service" name="apoint" id="apoint">
                  <option value="">Select</option>
                  <option value="0">Absent</option>
                  <option value="1">Present</option>
                </select>
              </div>
            </div>
            <div class="full-with flex-display--column mb-sm">
              <div class="input-box flex-display--column">
                <label for="job-status" class="title-head">Job Status:</label>
                <select
                  class="select-service"
                  name="jobStatus"
                  id="jobStatus"
                >
                  <option value="">Select</option>
                  <option value="0">Processing</option>
                  <option value="1">Job Done</option>
                </select>
              </div>
            </div>

            <div class="full-with flex-display--column mb-sm">
              <div class="input-box flex-display--column">
                <label for="jobdesc">Note:</label>
                <textarea
                  class="text-area"
                  name="jobdesc"
                  rows="7"
                  id="jobdesc"
                  placeholder=""
                ></textarea>
              </div>
            </div>

            <div class="full-with flex-display center-flex">
              <button type="submit" name="submitJob" id="submitJob" class="btn btn-primary full-with mt-big">Save</button>
            </div>
          </form>
        
          </div>
        </div>
      </div>

    <!-- Invoice Modal Confirm -->
    <?php if($_SESSION['invoiceSuccess']) {?>
    <div class="modal-invoice-confirm">
      <div class="modal__content flex-display--column">
        <div class="circle">
          <div class="checkmark"></div>
        </div>
        <p>Invoice Successfully Generatated and Customer is notified!!!</p>
        <form method="post">
        <button type="submit" name="close" id="close" class="btn btn-primary btn-full">OK</button>
    </form>
      </div>
    </div>
    <div class="overlay-invoice-confirm hidden-invoice-confirm"></div>
    </div>
    <?php } ?>

<?php require_once('../shared/footer.php'); ?>