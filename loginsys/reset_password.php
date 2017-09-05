<?php
/* Password reset process, updates database with new user password */
require 'db.php';
session_start();

if($_SERVER['REQUEST_METHOD']=='POST')
{
    if($_POST['newpassword'] == $_POST['confirmpassword'])
    {
    $new_password = password_hash($_POST['newpassword'], PASSWORD_BCRYPT);

    $email = $mysqli->escape_string($_POST['email']);

    $sql = "UPDATE users SET password = '$new_password' WHERE email = '$email'");

    if ( $mysqli->query($sql) ) {

      $_SESSION['message'] = "Your password has been reset successfully!";
      header("location: success.php");

      }
    }
    else {
      $_SESSION['message'] = 'Tow password you have entered is different';
      header('location : error.php');
    }
}
