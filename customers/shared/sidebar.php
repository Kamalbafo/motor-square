<?php 
require_once("../shared/connection.php");


$query = "SELECT image FROM user WHERE userId = '$userId'";
$resultImg = $connection->query($query);
$getResultImg = $resultImg->fetch_assoc();

?>
<input type="checkbox" name="" id="check" />
    <!-- header area start-->
    <header class="header flex-display">
      <div class="header__left">
        <label for="check">
          <i class="fas fa-bars" id="sideber_btn"></i>
        </label>
        <div class="left_area"></div>
      </div>
      <div class="header__right flex-display">
        <center>
          <img src="../upload/<?php echo $getResultImg['image']; ?>" class="profile_image" alt="" />
        </center>
      </div>
    </header>
    <!-- header area end-->
    <!-- side area start-->
    <div class="sidebar">
      <a href="dashboard.php"
        ><i class="fas fa-desktop"></i><span>Overview</span></a
      >
      <a href="jobs.php"><i class="fas fa-cogs"></i><span>Jobs</span></a>
      <a href="bikes.php"
        ><i class="fas fa-motorcycle"></i><span>My Bikes</span></a
      >
      <a href="../logout.php"
        ><i class="fas fa-sign-out-alt"></i><span>Log Out</span></a
      >
    </div>
