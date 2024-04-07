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



$userId = $_GET['userId'];


//check if job id is exists in url
if($userId == null){
  header('location:profile.php');
}

//Get user details

//fetch all the jobs that belongs to specific id
$fetchUser=  "SELECT * From user WHERE userId = '$userId '";
$getResult = $connection->query($fetchUser);
//fetch the selected article
$row=$getResult->fetch_assoc();

if(isset($_POST['editProfile'])) {
    
    $email = trim(stripcslashes($_POST['email']));
    $fullName = trim(stripcslashes($_POST['fullname']));
    $image = $_FILES['image']['name']; 
    
    
	$target = "../upload/".basename($image); //specify upload images directory
	//save images into upload directory
	move_uploaded_file($_FILES['image']['tmp_name'] ,$target);

    $phone = trim(stripcslashes($_POST['phone']));

    $query = "UPDATE user SET email = '".$email."', fullName = '".$fullName."',image = '".$image."', 
              phone = '".$phone."' WHERE userId = $userId"; 

                
  if($connection->query($query)) {
    header("Location:profile.php");
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
        <p class="dashboard__title">Edit Profile</p>
        <div class="full-with flex-display justify-center">
          <img
            class="image-profile-view"
            src="../upload/<?php echo $row["image"]; ?>"
            alt="image-profile-view"
            srcset=""
          />
        </div>
        <form method="post" enctype="multipart/form-data">
        <div class="full-with flex-display authenticate__details mt-md">
          <div class="input-box flex-display--column full-with">
            <label for="email">Email:</label>
            <input
              type="text"
              value="<?php echo $row["email"]; ?>"
              name="email"
              id="email"
              placeholder=""
              readonly="true"
            />
          </div>
          <div class="input-box flex-display--column full-with">
            <label for="fullname">Full Name:</label>
            <input
              type="text"
              value="<?php echo $row["fullName"]; ?>"
              name="fullname"
              id="fullname"
              placeholder=""
            />
          </div>
        </div>
        <div class="full-with flex-display authenticate__details">
          <div class="input-box flex-display--column full-with">
            <label for="image">Upload Profile Image:</label>
            <input type="file" name="image" id="image" placeholder="" required/>          
        </div>
        <div class="input-box flex-display--column full-with">
            <label for="phone">Phone Number:</label>
            <input type="text" name="phone" id="phone" placeholder="" value="<?php echo $row["phone"]; ?>"/>
          </div>
        </div>

        <div class="full-with flex-display justify-center">
          <button type="submit" name="editProfile" id="editProfile" class="btn btn-primary btn-full">Save</button>
        </div>
</form>
      </div>
    </div>

<?php require_once("../shared/footer.php"); ?>