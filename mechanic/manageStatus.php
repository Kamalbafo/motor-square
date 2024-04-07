<?php 
require_once('../shared/connection.php');
require_once("../shared/config.php");


session_start();
$userId = $_SESSION['userId'];
if(!isset($_SESSION['login']) && $_SESSION['level'] != 3)
{
 //redirect to home page for login
  header('location:../index.php');
	
}


$errMsg = "";


if(isset($_POST['statusSubmit'])){

    $status = $_POST["status"];
    
    $query = "UPDATE mechanicinfo SET currentStatus = '".$status."' WHERE userId = '".$userId."'";

    if($connection->query($query)) {
        header("Location:index.php");
    }
    else {
        $errMsg = "Somthing goes wrong. Please try again later.";
    }

   
}

require_once("../shared/header.php");
require_once("shared/sidebar.php");
?>

<div class="content">
      <div class="dashboard__overview">
        <div class="full-with flex-display align-center">
          <div class="flex-nojustify">
            <span><a class="back-arrow" href="index.php">&larr;</a></span>
            <p class="dashboard__title mt-sm">Update Your Status</p>
          </div>
          <div class="flex-display align-center md-column-space">
            <div class="flex-display icon-size">
              <i class="fas fa-trash-alt delete-mechanic-data"></i>
            </div>
          </div>
        </div>
        <form method="post">
        <div class="input-box flex-display--column">
              <div class="flex-display--column media-container sm-column-space">
                <label for="lastmont">Select:</label>
                <select class="select-service" name="status" id="status">
                <option value="1">Available</option> 
                <option value="0">Busy</option>
                </select>
              </div>
            </div>


            <button type="submit" name="statusSubmit" id="statusSubmit"
              class="btn btn-primary full-with confirm-appointment-assign"
            >
              Update
            </button>
</form>    
        
</div>
</div>