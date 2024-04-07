<?php 
 require_once("../shared/connection.php");
 require_once("../shared/config.php");

 
 $errMsg = "";
 
 $_SESSION['addBikeSuccess'] = false;
 
 
 session_start();
 if(!isset($_SESSION['login']) && $_SESSION['level'] != 2)
 {
  //if not admin then redirect to index page
   header('location:../index.php');
     
 }
 
 $userId = $_SESSION["userId"];

 //Get All the Bikes

$bikesResult='';
//query all the articles from newest to oldest
$bikes =  "SELECT * From vehicle WHERE userId = '$userId' ORDER BY vehicleId";


$bikesResult = $connection->query($bikes);

//Add new Bike
if(isset($_POST['addBikeSubmit']))
{


  $registrationNo = trim(stripcslashes($_POST['registrationNo']));
  $bikename = trim(stripcslashes($_POST['bikename']));
  $bikebrand = trim(stripcslashes($_POST['bikebrand']));
  $datereg = trim(stripcslashes($_POST['datereg']));
  $lastmont = trim(stripcslashes($_POST['lastmont']));


  if($registrationNo != null && $bikename != null && $bikebrand != null && $datereg != null && $lastmont != null)
    {
      $query = "INSERT INTO vehicle(regoNumber,name,brand,regDate, mot,userId) VALUES('$registrationNo','$bikename','$bikebrand','$datereg','$lastmont', '$userId')";
      
      if($connection->query($query)) {
        $_SESSION['addBikeSuccess'] = true;
      }
    
    }
    else {
      $errMsg = "Error: Check Your details and submit again.";
    }
}

//unset model session

if(isset($_POST['bikeSuccessModel'])) {
    $_SESSION['addBikeSuccess'] = false;
  
  }

  // delete bike
$_SESSION['deleteBikeModal'] = false;
if(isset($_POST['deleteBike'])) {
   
  $bikeId = $_POST['vehicleId'];

  $query = "DELETE FROM vehicle WHERE vehicleId = '$bikeId'";
  if($connection->query($query)){

    $_SESSION['deleteBikeModal'] = true;
  } else {
    $errMsg = "Error: Check Your details and submit again.";
  }
}


if(isset($_POST['bikeDeleteModel'])) {
  
  header("Refresh:0");
  $_SESSION['deleteBikeModal'] = false;

}

require_once("../shared/header.php");
require_once("shared/sidebar.php");
 ?>
 
 <div class="content">
      <div class="dashboard__overview">
        <p class="dashboard__title">My Bikes</p>
 <!-- Bike section with table  -->
 <div class="dashboard__table-header flex-display">
          <p class="dashboard__subtitle">All Bikes</p>
          <button
            class="btn btn-primary btn-primary-before-job--2 add-new-bike"
          >
            Add a New Bike
          </button>
        </div>

        <div class="dashboard__search-header flex-display">
          <div class="dashboard__search-box flex-display">
            <input type="search" name="mainSearchBike" id="mainSearchBike" />
            <button class="btn btn-primary">Search</button>
          </div>
          <button class="btn btn-white customers-view-all-bikes-btn">
            View All
          </button>
        </div>

        <table id="jobTable2">
          <thead>
            <tr>
              <th class="checkbox"></th>
              <th class="sn">NO</th>
              <th class="name">Bike Name</th>
              <th class="brand">Bike Brand</th>
              <th class="reg-date">REGISTRATION DATE</th>
              <th class="last-amount">LAST MOT</th>
              <th class="action">Action</th>
            </tr>
          </thead>
          <tbody id="mainBikeTable">
          <?php while($row=$bikesResult->fetch_assoc()) { ?>
            <tr>
              <td class="checkbox"><input type="checkbox" /></td>
              <td class="sn"><?php echo $row["regoNumber"]; ?></td>
              <td class="name"><?php echo $row["name"]; ?></td>
              <td class="brand"><?php echo $row["brand"]; ?></td>
              <td class="reg-date"><?php echo $row["regDate"]; ?></td>
              <td class="last-amount">
                <p><?php echo $row["mot"]; ?></p>
              </td>
              <td class="action">
                <div class="flex-display icon-size">
                  <a href="editBike.php?vehicleId=<?php echo $row["vehicleId"]; ?>"><i class="fas fa-edit"></i></a>
                  <form method="post">
                  <input type="hidden" name="vehicleId" id="vehicleId" value="<?php echo $row["vehicleId"]?>" />
                  <button class="three-dots-btn" type="submit" name="deleteBike" id="deleteBike">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                  </form>
                </div>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- delete and edit bike and job  modal -->

    <div class="modal-delete hidden-delete">
      <div class="modal__content flex-display--column">
        <img
          id="waning-image"
          src="/img/warning.png"
          alt="warning image"
          srcset=""
        />
        <p>
          Are you sure you want to delete this bike? <br />
          This action cannot be undone!!
        </p>
        <div class="full-with flex-display close-delete md-column-space">
          <button class="btn btn-primary-outline cancel-delete-modal btn-full">
            Cancel
          </button>
          <button class="btn btn-primary btn-full confirm-delete">
            Delete
          </button>
        </div>
      </div>
    </div>
    <div class="overlay-delete hidden-delete"></div>

    <?php if($_SESSION['deleteBikeModal']){ ?>
    <div class="modal-book-new-job">
      <div class="modal__content flex-display--column">
        <div class="circle">
          <div class="checkmark"></div>
        </div>
        <p>Bike deleted successfully!!!</p>
        <form method="post">
        <button type="submit" name="bikeDeleteModel" id="bikeDeleteModel" class="btn btn-primary btn-full finish-bike-added">OK</button>
    </form>
      </div>
    </div>
    <div class="overlay-book-new-job hidden-book-new-job"></div>
    <?php } ?>

    <!-- add new bike modal -->
    <div id="pageAddBike" class="modal-add-new-bike hidden-add-new-bike">
      <div class="modal__content flex-display--column">
        <div class="full-with flex-display top-modal align-center">
          <h3 class="top-modal--title">Add New Bike</h3>
          <i class="fas fa-times-circle close-modal-add-new-bike"></i>
        </div>
        <form id="addBikeForm" method="post">
        <div
          class="full-with display-grid grid-two-column authenticate__details"
        >
        
        <div class="input-box flex-display--column">
            <label for="bikename">Registration No:</label>
            <input type="text" name="registrationNo" id="registrationNo" placeholder=""/>
          </div>
          <div class="input-box flex-display--column">
            <label for="bikename">Bike Name:</label>
            <input type="text" name="bikename" id="bikename" placeholder="" />
          </div>

          <div class="input-box flex-display--column">
            <label for="bikebrand">Bike Brand:</label>
            <input type="text" name="bikebrand" id="bikebrand" placeholder="" />
          </div>

          <div class="input-box flex-display--column">
            <label for="datereg">Date of Registration:</label>
            <input type="date" name="datereg" id="datereg" placeholder="" />
          </div>

          <div class="input-box flex-display--column">
            <label for="lastmont">Last MOT:</label>
            <input
              type="datetime-local"
              name="lastmont"
              id="lastmont"
              placeholder=""
            />
          </div>
        </div>
        <button type="submit" id="addBikeSubmit" name="addBikeSubmit"
          class="btn btn-primary btn-full"
        >
          Add
        </button>
        
      </div>
    </div>
    </form>    
    <div class="overlay-add-new-bike hidden-add-new-bike"></div>
    <?php if($_SESSION['addBikeSuccess']){ ?>

    <div class="modal-bike-added-confirm ">
      <div class="modal__content flex-display--column">
        <div class="circle">
          <div class="checkmark"></div>
        </div>
        <p>Bike added successfully!!!</p>
        <form method="post">
        <button type="submit" name="bikeSuccessModel" id="bikeSuccessModel" class="btn btn-primary btn-full finish-bike-added">OK</button>
        </form>
      </div>
    </div> 
    <?php }?>
    <div class="overlay-bike-added-confirm hidden-bike-added-confirm"></div>


    <div class="overlay-book-new-job-page hidden-book-new-job"></div>
 
        <!-- add new bike modal -->
     <!-- add new job modal -->
     <div class="modal-new-job hidden-new-job">
      <div class="modal__content flex-display--column">
        <div class="full-with flex-display top-modal align-center">
          <h3 class="top-modal--title">Add New Job</h3>
          <i class="fas fa-times-circle close-modal-add-new-job"></i>
        </div>
        <form id="addNewJobForm" method="post">
        <div
          class="full-with display-grid grid-two-column authenticate__details"
        >
          <div class="input-box flex-display--column">
            <label for="jobname">Bike Name:</label>
            <input type="text" name="jobname" id="jobname" placeholder="" />
          </div>

          <div class="input-box flex-display--column">
            <label for="jobbrand">Bike Brand:</label>
            <input type="text" name="jobbrand" id="jobbrand" placeholder="" />
          </div>

          <div class="input-box flex-display--column">
            <label for="jobdesc">Job Description:</label>
            <textarea
              class="text-area"
              name="jobdesc"
              rows="7"
              id="jobdesc"
              placeholder=""
            ></textarea>
          </div>

          <div class="full-with flex-display--column">
            <div class="input-box flex-display--column">
              <label for="service">Select Service:</label>
              <select class="select-service" name="service" id="service">
                <option value="Repair">Repair</option>
                <option value="MOT">MOT</option>
              </select>
            </div>
            <div class="input-box flex-display--column">
              <label for="upload">Upload a image:</label>
              <input type="file" name="upload" id="upload" placeholder="" />
            </div>
          </div>
        </div>
        <div class="authenticate__details full-with">
          <div class="full-with flex-display--column">
            <label for="calender">Book Your Appointment Date:</label>
            <input
              class="calender-date"
              type="datetime-local"
              name="calender"
              id="calender"
              placeholder=""
            />
          </div>
        </div>


        <button type="submit" id="submitNewJob" name="submitNewJob"
          class="btn btn-primary btn-full mt-md"
        >
          Confirm
        </button>
      </div>
    </div>
    </form>

    <div class="overlay-new-job hidden-new-job"></div>
    </div>
    </div>
   