<?php 
require_once('../shared/connection.php');
require_once("../shared/config.php");



session_start();
$errMsg = "";
$userId = $_GET['userId'] ?? null; 

if(!isset($_SESSION['login']) && $_SESSION['level'] != 1)
{
 //redirect to home page for login
  header('location:../index.php');
	
}


//if there is no user id passed in router then redirect to mechanic page

if($userId == null) {
    header('location:mechanics.php');
}

//get record related to the specific user


$query = "Select user.email, user.fullName, user.phone, mechanicinfo.address,mechanicinfo.phone2
          FROM user inner join mechanicinfo ON user.userId = mechanicinfo.userId WHERE user.userId = '$userId'";

$fetchResult = $connection->query($query);  
$row=$fetchResult->fetch_assoc();


if(isset($_POST['editMechanic'])){
    $email = trim(stripcslashes($_POST['email']));
    $fullName = trim(stripcslashes($_POST['fullName']));
    $phone1 = trim(stripcslashes($_POST['phone1']));
    $phone2 = trim(stripcslashes($_POST['phone2']));
    $address = trim(stripcslashes($_POST['address']));

    $query = "UPDATE user SET email ='$email', fullname ='$fullName', phone ='$phone1' WHERE userId = '$userId';";
    $query .= "UPDATE mechanicinfo SET address='$address', phone2='$phone2' WHERE userId = '$userId'";

    if(mysqli_multi_query($connection,$query)) {
        header("Location:mechanics.php");
      }
    else {
      $errMsg = "Error: Please check your details and submit again!";
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
            <p class="dashboard__title mt-sm"><?php echo $row["fullName"]; ?></p>
          </div>
        </div>
        <p><?php echo $errMsg; ?></p>
       <form id="editMechanicForm" method="post">
        <div class="full-with flex-display authenticate__details mt-md">
          <div class="input-box flex-display--column full-with">
            <label for="email">Email:</label>
            <input
              type="text"
              value="<?php echo $row["email"]; ?>"
              name="email"
              id="email"
              placeholder=""
            />
          </div>

          <div class="input-box flex-display--column full-with">
            <label for="fullName">Full Name:</label>
            <input
              type="text"
              value="<?php echo $row["fullName"]; ?>"
              name="fullName"
              id="fullName"
              placeholder=""
            />
          </div>
        </div>

        <div class="full-with flex-display authenticate__details">
          <div class="input-box flex-display--column full-with">
            <label for="phone1">Phone Number 1:</label>
            <input
              type="text"
              name="phone1"
              value="<?php echo $row["phone"]; ?>"
              id="phone1"
              placeholder=""
            />
          </div>
          <div class="input-box flex-display--column full-with">
            <label for="phone2">Phone Number 2:</label>
            <input
              type="text"
              name="phone2"
              value="<?php echo $row["phone2"]; ?>"
              id="phone2"
              placeholder=""
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
            placeholder=""
          >
          <?php echo $row["address"]; ?>
        </textarea>
        </div>

        <div class="full-with flex-display justify-center">
          <button type="submit" name="editMechanic" id="editMechanic" class="btn btn-primary btn-full">Save</button>
        </div>
      </div>
    </div>


<?php require_once("../shared/footer.php");?>