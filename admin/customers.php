<?php 
require_once('../shared/connection.php');
require_once("../shared/config.php");



session_start();
$errorMsg = "";

// if not admin
if(!isset($_SESSION['login']) && $_SESSION['level'] != 1)
{
 //redirect to home page for login
  header('location:../index.php');
	
}

//Get All customers

$query = "SELECT * FROM user WHERE level = 2";

$queryResult = $connection->query($query);


//Customer count

$countCustomer="SELECT count(*) as total from user where level = 2";
$dataCustomer= $connection->query($countCustomer);
$totalCustomerCount=$dataCustomer->fetch_assoc();

//Delete customer
$_SESSION["isDeleteModel"] = false;
if(isset($_POST["submitUserId"])) {
  $userId = $_POST["userId"];
  
  $deleteCustomer = "DELETE FROM user WHERE level = 2 AND userId = '$userId'";

  if($connection->query($deleteCustomer)){
    $_SESSION["isDeleteModel"] = true;
  }
   

}


if(isset($_POST["deleteConfirm"])) {
  $_SESSION["isDeleteModel"] = false;
}


require_once("../shared/header.php");
require_once('shared/sidebar.php');
?>

<div class="content">
      <div class="dashboard__overview">
        <p class="dashboard__title mt-sm">CUSTOMERS</p>

        <div class="card__box flex-display--column">
          <p class="card__box--title">CUSTOMERS</p>
          <p class="card__box--description"><?php echo $totalCustomerCount["total"]; ?></p>
        </div>

        <!-- customers section with table -->

        <div class="dashboard__table-header flex-display">
          <p class="dashboard__subtitle">All Customers</p>
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
              <th>Customer NAME</th>
              <th>Email</th>
              <th>DATE JOINED</th>
              <th class="action">Action</th>
            </tr>
          </thead>
          <tbody id="mainJobTable">
            <?php while($row=$queryResult->fetch_assoc()) {?>
            <tr>
              <td class="checkbox"><input type="checkbox" /></td>
              <td class="sn"><?php echo $row["userId"]; ?></td>
              <td><?php echo $row["fullName"]; ?></td>
              <td><?php echo $row["email"]; ?></td>
              <td><?php echo $row["dateJoined"]; ?></td>
              <td class="action">
                <div class="flex-display icon-size">
                <a href="customerJobHistory.php?userId=<?php echo $row["userId"]; ?>"><i class="fas fa-ellipsis-v three-dots edit-mechanic-data"></i></a>
                <form method="post">
                  <input type="hidden" name="userId" id="userId"  value="<?php echo $row["userId"]; ?>" />
                <button type="submit" name="submitUserId" id="submitUserId"><i class="fas fa-trash-alt delete-customer-data"></i></button>
                </form>
                </div>
              </td>
            </tr>
            <?php }?>
          </tbody>
        </table>
      </div>

      <!-- delete and confirm customer  modal -->

      <?php if($_SESSION["isDeleteModel"]) {?>
      <div class="modal-customer-delete-confirm">
        <div class="modal__content flex-display--column">
          <div class="circle">
            <div class="checkmark"></div>
          </div>
          <p>User deleted successfully!!!</p>
          <form type="method">
          <button type="submit" name="deleteConfirm" id="deleteConfirm" class="btn btn-primary btn-full finish-delete-customer">
            OK
          </button>
      </form>
        </div>
      </div>
      <div
        class="overlay-customer-delete-confirm">
    </div>
    <?php }?>
    </div>


<?php require_once("../shared/footer.php"); ?>