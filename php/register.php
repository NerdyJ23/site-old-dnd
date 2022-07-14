<?php
require('connect.php');
$pass = mysqli_real_escape_string($con,password_hash($_POST['password'],PASSWORD_DEFAULT));
$user = mysqli_real_escape_string($con,$_POST['username']);
//INSERT INTO `Class` (`ID`, `Char_ID`, `Class`, `Level`) VALUES (NULL, '2', 'test', '1');
$sql = "INSERT INTO `Users`(Username,Password,Created_At) VALUES ('$user','$pass',NOW())";
//$sql = mysqli_real_escape_string($con,$sql);

$result = $con->query($sql);

session_start();
if($result != 1)
{
  $_SESSION['err'] = "Err: Failed to create user.";

  header("Location: /register.php");
}
else
{
  header("Location: /login.php");
}
 ?>
