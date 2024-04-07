<?php

session_start();
session_destroy(); //logout when this request this page
header('location: index.php'); //after log out redirect to home page
exit();
?>
