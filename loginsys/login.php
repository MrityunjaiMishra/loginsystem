<?php
/* User login process, checks if user exists and password is correct */
//escape string is used so as to protect from sql injections
$email = $mysqli->escape_string($_POST['email']);
$result = $mysqli->query("SELECT * FROM users WHERE email = '$email' ");

if($result->num_rows == 0)
{
  //user doesnot exist
  $_SESSION['message'] = "User with that email dosent exists";
  header("location: error.php");;
}
else
{
  $user = $result->fetch_assoc(); //user Array

  if ( password_verify($_POST['password'], $user['password']) )
  {
    //setting the session variable
    $_SESSION['email'] = $user['email'];
    $_SESSION['first_name'] = $user['first_name'];
    $_SESSION['last_name'] = $user['last_name'];
    $_SESSION['active'] = $user['active'];
    $_SESSION['imagelocation'] = $user['imagelocation'];

    $_SESSION['logged_in'] = true;
    header('location:profile.php');
  }
  else {
      $_SESSION['message'] = "You have entered wrong password, try again!";
      header("location:error.php");
  }

}
