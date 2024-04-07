<?php 

require_once('shared/connection.php');
require_once("shared/config.php");


$errorMsg = "";

session_start();

$_SESSION['successMsg'] = false;


if(isset($_POST['updatePassword']))
{

   
   $email = trim(stripcslashes($_POST['email']));
   $salt = "m1o929whms92751qus0x";
   $password_hash = $_POST['password'].$salt;
   $password = sha1($password_hash);

       //query the username and password
       $query = "UPDATE user SET password = '".$password."'  WHERE email = '$email'";
       
       if (mysqli_query($connection, $query)) { 
        $_SESSION['successMsg'] = true;
      }  
      else {
      $errMsg = "Error: You email is not matched into our database";
    }
}

if(isset($_POST['success'])) {

    header("Location:index.php");
    $_SESSION['successMsg'] = false;
    
}

require_once("shared/header.php");
?>

<section class="container-wraper">
        <div class="container">
          <div class="authenticate flex-display m-left-md m-right-md">
            <div class="authenticate__details flex-display--column">
              <div class="authenticate__image">
              </div>
              <h1>Update Your Password</h1>
              <p class="error"><?php echo $errorMsg; ?></p>
              <form id="updatePassword" method="post">
              
  
                <div class="input-box flex-display--column">
                <label for="createpassword">Current Email: </label>
                    <div class="password">
                      <input type="email" name="email" id="email" placeholder=" " />

                    </div>
                    <br><br>
                    <label for="createpassword">Create Password</label>
                    <div class="password">
                      <input type="password" name="password" id="password" placeholder="********" />
                      <svg
                        width="20"
                        height="20"
                        viewBox="0 0 38 33"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        class="password-toggle"
                      >
                        <path
                          d="M37.0829 15.655C35.5779 12.4843 33.7869 9.89846 31.7099 7.89742L29.5316 10.0757C31.3079 11.7732 32.8552 13.9939 34.193 16.7595C30.6311 24.1318 25.5749 27.6339 18.665 27.6339C16.5909 27.6339 14.6805 27.3145 12.9338 26.6757L10.5735 29.036C12.9996 30.1562 15.6967 30.7163 18.665 30.7163C26.8936 30.7163 33.0328 26.4308 37.0829 17.8598C37.2457 17.5151 37.3301 17.1386 37.3301 16.7574C37.3301 16.3762 37.2457 15.9997 37.0829 15.655V15.655ZM34.3613 1.92768L32.5362 0.10045C32.5044 0.0686057 32.4666 0.0433436 32.4251 0.0261077C32.3835 0.00887169 32.3389 0 32.2939 0C32.2489 0 32.2043 0.00887169 32.1627 0.0261077C32.1212 0.0433436 32.0834 0.0686057 32.0516 0.10045L27.3692 4.78068C24.7876 3.46207 21.8862 2.80276 18.665 2.80276C10.4365 2.80276 4.29726 7.08826 0.24722 15.6593C0.0844285 16.004 0 16.3805 0 16.7617C0 17.1429 0.0844285 17.5194 0.24722 17.8641C1.86524 21.272 3.8132 24.0035 6.09109 26.0588L1.5607 30.5879C1.49652 30.6521 1.46046 30.7392 1.46046 30.83C1.46046 30.9208 1.49652 31.0079 1.5607 31.0721L3.38835 32.8998C3.45258 32.9639 3.53966 33 3.63046 33C3.72125 33 3.80834 32.9639 3.87256 32.8998L34.3613 2.41231C34.3931 2.3805 34.4184 2.34273 34.4356 2.30115C34.4529 2.25957 34.4617 2.215 34.4617 2.16999C34.4617 2.12498 34.4529 2.08042 34.4356 2.03884C34.4184 1.99726 34.3931 1.95949 34.3613 1.92768ZM3.13705 16.7595C6.70331 9.38728 11.7594 5.88524 18.665 5.88524C21 5.88524 23.1231 6.28596 25.0492 7.10068L22.0395 10.1104C20.6142 9.34988 18.9821 9.06763 17.3841 9.30528C15.7861 9.54292 14.3069 10.2879 13.1645 11.4302C12.0221 12.5726 11.2772 14.0519 11.0395 15.6499C10.8019 17.2479 11.0841 18.8799 11.8446 20.3053L8.27323 23.8767C6.29659 22.1321 4.59266 19.7684 3.13705 16.7595ZM13.6988 16.7595C13.6996 16.0046 13.8784 15.2605 14.2208 14.5877C14.5631 13.9148 15.0594 13.3322 15.6692 12.8872C16.279 12.4422 16.9852 12.1473 17.7304 12.0265C18.4756 11.9057 19.2388 11.9624 19.958 12.1919L13.9262 18.2237C13.775 17.7504 13.6983 17.2564 13.6988 16.7595V16.7595Z"
                          fill="black"
                        />
                      </svg>
                    </div>
                  </div>
      
                  <div class="input-box flex-display--column">
                    <label for="confirmpassword">Confirm Password</label>
                    <div class="password">
                      <input type="password" name="confirmpassword" id="confirmpassword" placeholder="********" />
                      <svg
                        width="20"
                        height="20"
                        viewBox="0 0 38 33"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        class="password-toggle"
                      >
                        <path
                          d="M37.0829 15.655C35.5779 12.4843 33.7869 9.89846 31.7099 7.89742L29.5316 10.0757C31.3079 11.7732 32.8552 13.9939 34.193 16.7595C30.6311 24.1318 25.5749 27.6339 18.665 27.6339C16.5909 27.6339 14.6805 27.3145 12.9338 26.6757L10.5735 29.036C12.9996 30.1562 15.6967 30.7163 18.665 30.7163C26.8936 30.7163 33.0328 26.4308 37.0829 17.8598C37.2457 17.5151 37.3301 17.1386 37.3301 16.7574C37.3301 16.3762 37.2457 15.9997 37.0829 15.655V15.655ZM34.3613 1.92768L32.5362 0.10045C32.5044 0.0686057 32.4666 0.0433436 32.4251 0.0261077C32.3835 0.00887169 32.3389 0 32.2939 0C32.2489 0 32.2043 0.00887169 32.1627 0.0261077C32.1212 0.0433436 32.0834 0.0686057 32.0516 0.10045L27.3692 4.78068C24.7876 3.46207 21.8862 2.80276 18.665 2.80276C10.4365 2.80276 4.29726 7.08826 0.24722 15.6593C0.0844285 16.004 0 16.3805 0 16.7617C0 17.1429 0.0844285 17.5194 0.24722 17.8641C1.86524 21.272 3.8132 24.0035 6.09109 26.0588L1.5607 30.5879C1.49652 30.6521 1.46046 30.7392 1.46046 30.83C1.46046 30.9208 1.49652 31.0079 1.5607 31.0721L3.38835 32.8998C3.45258 32.9639 3.53966 33 3.63046 33C3.72125 33 3.80834 32.9639 3.87256 32.8998L34.3613 2.41231C34.3931 2.3805 34.4184 2.34273 34.4356 2.30115C34.4529 2.25957 34.4617 2.215 34.4617 2.16999C34.4617 2.12498 34.4529 2.08042 34.4356 2.03884C34.4184 1.99726 34.3931 1.95949 34.3613 1.92768ZM3.13705 16.7595C6.70331 9.38728 11.7594 5.88524 18.665 5.88524C21 5.88524 23.1231 6.28596 25.0492 7.10068L22.0395 10.1104C20.6142 9.34988 18.9821 9.06763 17.3841 9.30528C15.7861 9.54292 14.3069 10.2879 13.1645 11.4302C12.0221 12.5726 11.2772 14.0519 11.0395 15.6499C10.8019 17.2479 11.0841 18.8799 11.8446 20.3053L8.27323 23.8767C6.29659 22.1321 4.59266 19.7684 3.13705 16.7595ZM13.6988 16.7595C13.6996 16.0046 13.8784 15.2605 14.2208 14.5877C14.5631 13.9148 15.0594 13.3322 15.6692 12.8872C16.279 12.4422 16.9852 12.1473 17.7304 12.0265C18.4756 11.9057 19.2388 11.9624 19.958 12.1919L13.9262 18.2237C13.775 17.7504 13.6983 17.2564 13.6988 16.7595V16.7595Z"
                          fill="black"
                        />
                      </svg>
                    </div>
                  </div>
  
              <button type="submit" name="updatePassword" id="updatePassword" class="btn btn-primary">Done</button>
            </form>
  
              <p class="authenticate__details--text">Don’t have an account? <span> <a href="signup.php"> Sign up </a><span><p>
  
            </div>
            <div class="authenticate__image--box flex-display--column">
              <img src="img/carousel/bro.png" alt="carousel image">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit ut aliquam, purus sit amet luctus venenatis Lorem ipsum dolor sit amet, consectetur adipiscing elit ut aliquam, purus sit amet luctus venenatis</p>
              <div class="dots">
                <button class="dot dot--fill">&nbsp;</button>
                <button class="dot">&nbsp;</button>
                <button class="dot">&nbsp;</button>
              </div>
            </div>
          </div>
        </div>
        <?php if($_SESSION['successMsg']) { ?>
        <div class="modal">
                <div class="modal__content flex-display--column">
                  <div class="circle">
                    <div class="checkmark"></div>
                  </div>
                    <p>
                    Password reset successful!!
                    </p>
                    <form method="post">
                    <button type="submit" name="success" id="success" class="btn btn-primary btn-full" >Login</button>
        </form>
                </div>
            </div>
        <div class="overlay hidden"></div>
        <?php } ?>
      </section>


<?php 
include_once("shared/footer.php");

?>