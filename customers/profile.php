<?php 
require_once("../shared/connection.php");
require_once("../shared/config.php");


session_start();
if(!isset($_SESSION['login']) && $_SESSION['level'] != 2)
{
 //if not admin then redirect to index page
  header('location:../index.php');
	
}

//Get Current User ID

$userId = $_SESSION["userId"];

//fetch all the jobs that belongs to specific id
$fetchUser=  "SELECT * From user WHERE userId = '$userId '";
$getResult = $connection->query($fetchUser);
//fetch the selected article
$row=$getResult->fetch_assoc();

require_once("../shared/header.php");
require_once("shared/sidebar.php");
?>

    <!-- side area end-->
    <div class="content">
      <div class="dashboard__overview">
        <p class="dashboard__title">Profile</p>

        <div class="full-with flex-display align-center">
          <div class="flex-display align-center md-column-space">
            <img
              class="image-profile-view"
              src="../upload/<?php echo $row["image"]; ?>"
              alt="image-profile-view"
              srcset=""
            />
            <div class="flex-display--column">
              <h3 class="image-profile-name"><?php echo $row["fullName"]; ?></h3>
              <h3 class="image-profile-email"><?php echo $row["email"]; ?></h3>
            </div>
          </div>
          <div class="flex-display icon-size">
            <a href="profileEdit.php?userId=<?php echo $row["userId"]; ?>"><i class="fas fa-edit profile-icon-edit"></i></a>
          </div>
        </div>

        <div class="full-with flex-display authenticate__details mt-md">
          <div class="input-box flex-display--column full-with">
            <label for="jobname">Email:</label>
            <input
              type="text"
              value="<?php echo $row["email"]; ?>"
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
              value="<?php echo $row["fullName"]; ?>"
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
              value="<?php echo $row["phone"]; ?>"
              disabled
              id="phone"
              placeholder=""
            />
          </div>
        </div>
      </div>
    </div>

<?php require_once("../shared/footer.php"); ?>