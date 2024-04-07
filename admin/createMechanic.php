<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require '../vendor/autoload.php';
require_once("../shared/connection.php");
require_once("../shared/config.php");


session_start();


//If not admin
if(!isset($_SESSION['login']) && $_SESSION['level'] != 1)
{
 //redirect to home page for login
  header('location:../index.php');
	
}

$msg = "";

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //capture user inputs
    $fullName = trim(stripcslashes($_POST['fullName']));
    $email = trim(stripcslashes(($_POST['email'])));
    $default_password = "mechanic123";
    $salt = "m1o929whms92751qus0x";
    $password_hash = $default_password.$salt;
    $password = sha1($password_hash);
    
	//all the mechanic are assigned with 3 level 
	$level = 3; 

  if($fullName != null && $email != null && $password != null){
     
    $query = "INSERT INTO user(fullName,email,password,level)
    VALUES ('$fullName','$email','$password','$level')";
  
   
    if(mysqli_query($connection,$query))
	{
    
		//if signup successfull then redirect user to login page
    $last_id = mysqli_insert_id($connection);
    
    $_SESSION["mechanicUserId"] =  $last_id;

    //send username and password mechanic on email address

$mail = new PHPMailer(true);

$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "kamaldiriyeprojects@gmail.com";
$mail->Password = "agwpwqehpotjuwdv";
$mail->SetFrom("kamaldiriyeprojects@gmail.com");
$mail->Subject = "Account Creating Notification || Motor Square";
$mail->Body = "Your account is created successfully. 
               Login using your email address and password is:" .$default_password;
$mail->AddAddress($email );

 if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
    echo "Message has been sent";
 }


		header("Location:mechanicProfileCreation.php");
	}
	else
	{
		//if something went wrong then display error
		$msg  = "signup faild. Check your details and try again.";
	}
} else {
  $msg  = "signup faild. Check your details and try again.";
}
}



require_once("../shared/header.php");
?>

    <section class="container-wraper">
        <div class="container">
          <div class="authenticate flex-display m-left-md m-right-md">
            <div class="authenticate__details flex-display--column">
              <div class="authenticate__image">
              </div>
              <h1>Create Mechanic Account</h1>
              <form id="signUpForm" method="post">
              <div class="input-box flex-display--column">
                <label for="fullname">Full Name</label>
                <input type="text" name="fullName" id="fullname" placeholder="John Doe"/>
              </div>
              
              <div class="input-box flex-display--column">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="john@gmail.com"/>
              </div>
              <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
            </form> 
            <?php if($msg != "") { ?>
            <div class="p">
                <p style="color:red;">*<?php echo $msg; ?></p>
              </div>
              <?php } ?>
              <p class="authenticate__details--text">Already have an account?  <span> <a href="login.php"> Sign in </a><span><p>
  
            </div>
            <div class="authenticate__image--box flex-display--column">
              <img src="../img/carousel/bro.png" alt="carousel image">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit ut aliquam, purus sit amet luctus venenatis Lorem ipsum dolor sit amet, consectetur adipiscing elit ut aliquam, purus sit amet luctus venenatis</p>
              <div class="dots">
                <button class="dot dot--fill">&nbsp;</button>
                <button class="dot">&nbsp;</button>
                <button class="dot">&nbsp;</button>
              </div>
            </div>
          </div>
        </div>
      </section>
<?php 
include_once("../shared/footer.php");

?>
