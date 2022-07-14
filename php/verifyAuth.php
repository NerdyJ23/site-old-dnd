<?php
session_start();
$char = $_GET['q'];
require('connect.php');

$sql = "SELECT * FROM `Characters` WHERE ID = $char";
$sql = mysqli_real_escape_string($con,$sql);
$result = $con->query($sql);
$charInfo;
if($result->num_rows > 0)
{
  $charInfo = mysqli_fetch_array($result);
  if(!$charInfo['Visibility'] && $_SESSION['id'] != $charInfo['User_Access'])
  {
    header("Location: 404");
    die("oops");
  }
}
else
{
  header("Location: 404");
  die("oops");
} ?>
