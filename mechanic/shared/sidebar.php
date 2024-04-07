<?php 
    
    $userId = $_SESSION['userId'];
    $query = "SELECT currentStatus FROM mechanicinfo WHERE userId = '$userId'";
    $fetchResult = $connection->query($query);  
    $statusRow=$fetchResult->fetch_assoc();

 
    
    ?>
    
    <!-- header area start-->
    <header class="header flex-display">
      <div class="header__left">
        <label for="check">
          <i class="fas fa-bars" id="sideber_btn"></i>
        </label>
        <div class="left_area"></div>
      </div>
      <div class="header__right flex-display">
        <?php if($statusRow["currentStatus"] == 0) {?>
        <div class="flex-display vertical-align sm-column-space">
            <p class="processing only-space">Busy</p>
        </div>
        <?php } else {?>
          <div class="flex-display vertical-align sm-column-space">
            <p class="completed only-space">Available</p>
        </div>
        <?php }?>
        <center>
          <img src="../upload/default-pic.png" class="profile_image" alt="" />
        </center>
      </div>
    </header>
    <!-- header area end-->
    <!-- side area start-->
    <div class="sidebar">
      <a href="index.php" id="active"
        ><i class="fas fa-desktop"></i><span>Overview</span></a
      >
      <a href="manageStatus.php" id="active"
        ><i class="fas fa-cogs"></i><span>Manage Status</span></a
      >

      <a href="../logout.php"
        ><i class="fas fa-sign-out-alt"></i><span>Log Out</span></a
      >
    </div>