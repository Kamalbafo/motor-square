<?php 
require_once("../shared/config.php");
require_once('../shared/connection.php');

session_start();
$errorMsg = "";

$mechanicUserId = $_SESSION['mechanicUserId'];

// if not admin
if(!isset($_SESSION['login']) && $_SESSION['level'] != 1 && $mechanicUserId)
{
 //redirect to home page for login
  header('location:../index.php');
	
}

if(isset($_POST['submitMechanic']))
{

     $phone1 = $_POST['phone1'];
     $phone2 = $_POST['phone2'];
     $address = $_POST['address'];


     if($phone1 != null && $phone2 != null && $address != null){
      
      $query = "UPDATE user SET phone = '".$phone1."' WHERE userId = '$mechanicUserId';";

      $query .= "INSERT INTO mechanicinfo(address,phone2,currentStatus,userId)
                VALUES ('$address','$phone2','','$mechanicUserId')";
     
      if(mysqli_multi_query($connection,$query)) {

        header('Location:mechanics.php');
        unset($_SESSION['mechanicUserId']);
      } else {
        $errorMsg ="Something went wrong. Please try again!".mysqli_error($connection);
      }

     }
     
}

require_once("../shared/header.php");
require_once('shared/sidebar.php');

?>
    <div class="content">
      <div class="dashboard__overview">
        <div class="full-with flex-display align-center">
          <div class="flex-nojustify">
            <span><a class="back-arrow" href="mechanics.php">&larr;</a></span>
            <p class="dashboard__title mt-sm">Finish Mechanic Profile</p>
          </div>
        </div>
        <p><?php echo $errorMsg;?></p>
        <form id="mechanicForm" method="post">

        <div class="full-with flex-display authenticate__details">
          <div class="input-box flex-display--column full-with">
            <label for="phone1">Phone Number 1:</label>
            <input
              type="text"
              name="phone1"
              value=""
              id="phone1"
              placeholder="+234 8168898055"
            />
          </div>
          <div class="input-box flex-display--column full-with">
            <label for="phone2">Phone Number 2:</label>
            <input
              type="text"
              name="phone2"
              value=""
              id="phone2"
              placeholder="+234 8168898055"
            />
          </div>
        </div>

        <div class="input-box flex-display--column">
          <label for="address">Address:</label>
          <textarea
            class="text-area"
            name="address"
            rows="7"
            id="address"
            placeholder="Address here..."
          ></textarea>
        </div>

        <div class="full-with flex-display justify-center">
          <button type="submit" name="submitMechanic" id="submitMechanic" class="btn btn-primary btn-full">Save</button>
        </div>
</form>
      </div>
    </div>
<?php require_once("../shared/footer.php"); ?>