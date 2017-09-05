<?php
/* Registration process, inserts user info into the database
   and sends account confirmation email message
 */
 $_SESSION['email'] = $_POST['email'];
 $_SESSION['first_name'] = $_POST['firstname'];
 $_SESSION['last_name'] = $_POST['lastname'];

 $email = $mysqli->escape_string($_POST['email']);
 $first_name = $mysqli->escape_string($_POST['firstname']);
 $last_name = $mysqli->escape_string($_POST['lastname']);
 $hash = $mysqli->escape_string( md5( rand(0,1000) ) );
 $password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
 $name = $_FILES["file"]["name"];
 $tmp_name  = $_FILES["file"]["tmp_name"];
 $location = "images/$name";

$_SESSION['imagelocation'] = $location;

$result = $mysqli->query("SELECT * FROM users WHERE email = '$email' ");

if($result->num_rows > 0)
{
  $_SESSION['message'] = 'This email is already registered';
  header("location: error.php");
}
else
{
  move_uploaded_file($tmp_name,$location);
  $sql = "INSERT INTO users (first_name, last_name, email, password, hash, imagelocation) "
          . "VALUES ('$first_name','$last_name','$email','$password', '$hash', '$location')";
  if ( $mysqli->query($sql) ){

      $_SESSION['active'] = 0; //0 until user activates their account with verify.php
      $_SESSION['logged_in'] = true; // So we know the user has logged in
      $_SESSION['message'] =

               "Confirmation link has been sent to $email, please verify
               your account by clicking on the link in the message!";

      // Send registration confirmation link (verify.php)
      $to      = $email;
      $subject = 'Account Verification ( mj.com )';
      $message_body = '
      Hello '.$first_name.',

      Thank you for signing up!

      Please click this link to activate your account:

      http://localhost/login-system/new/verify.php?email='.$email.'&hash='.$hash;

      mail( $to, $subject, $message_body );

      header("location: profile.php");
}
else
{
  $_SESSION['message'] = 'Registration failed!';
  header("location: error.php");
}
}
