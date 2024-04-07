<?php 
require_once("../shared/config.php");
require_once('../shared/connection.php');

session_start();


if(!isset($_SESSION['login']) && $_SESSION['level'] != 1)
{
 //redirect to home page for login
  header('location:../index.php');
	
}


//go to the create mechanic page

if(isset($_POST['submitNewMechanic'])) {

    header("Location: createMechanic.php");

}

//Get all the mechanics 


$queryResult = "";

$query = "SELECT  * FROM user INNER JOIN mechanicinfo ON user.userid = mechanicinfo.userId
WHERE user.level = 3";

$queryResult = $connection->query($query);

//mechanics count

$countMechanic="SELECT count(*) as total from user where level = 3";
$dataMechanic= $connection->query($countMechanic);
$totalJobCount=$dataMechanic->fetch_assoc();

require_once("../shared/header.php");
require_once('shared/sidebar.php');
?>


    <div class="content">
      <div class="dashboard__overview">
        <p class="dashboard__title mt-sm">Mechanics</p>

        <div class="card__box flex-display--column">
          <p class="card__box--title">Mechanics</p>
          <p class="card__box--description"><?php echo $totalJobCount["total"]; ?></p>
        </div>

        <!-- job section with table -->

        <div class="dashboard__table-header flex-display">
          <p class="dashboard__subtitle">All Mechanics</p>
          <form method="post">
          <button type="submit" name="submitNewMechanic" id="submitNewMechanic" class="btn btn-primary btn-full btn-primary-before-job--2">
            Add New Mechanic
          </button>
          </form>
        </div>

        <div class="dashboard__search-header flex-display">
          <div class="dashboard__search-box flex-display">
            <input type="search" name="mainSearchJob" id="mainSearchJob" placeholder="Search by name" />
            <button class="btn btn-primary">Search</button>
          </div>
          <button class="btn btn-white btn-white-after">Filter</button>
        </div>

        <table>
          <thead>
            <tr>
              <th class="checkbox"></th>
              <th class="sn">NO</th>
              <th>MECHANIC NAME</th>
              <th>Email</th>
              <th>DATE JOINED</th>
              <th>CURRENT STATUS</th>
              <th class="action">Action</th>
            </tr>
          </thead>
          <tbody id="mainJobTable">
          <?php while($row=$queryResult->fetch_assoc()) { ?>
            <tr>
              <td class="checkbox"><input type="checkbox" /></td>
              <td class="sn"><?php echo $row["userId"]; ?></td>
              <td><?php echo $row["fullName"]; ?></td>
              <td><?php echo $row["email"]; ?></td>
              <td><?php echo $row["dateJoined"]; ?></td>
              <td>
                 <?php if($row["currentStatus"] == 0){?>
                <p class="processing">Busy</p>
                <?php } else {?>
                  <p class="completed">Available</p>
                <?php }?>
              </td>
              <td class="action">
                <div class="flex-display icon-size">
                 <a href="editMechanic.php?userId=<?php echo $row["userId"]; ?>"><i class="fas fa-ellipsis-v three-dots edit-mechanic-data"></i></a>
                  <i class="fas fa-trash-alt delete-mechanic-data"></i>
                </div>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

    </div>

<?php require_once("../shared/footer.php"); ?>