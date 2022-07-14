<?php
require('../connect.php');
session_start();

//first check if the user is authorized

$hp = $_POST['val'];
$stat = $_POST['stat'];
$char = $_POST['char'];
//echo "CharID: $char\n";
//echo "HP: $hp\n";
//echo "Stat: $stat\n";

$sql = "SELECT * FROM `Characters` WHERE ID = $char";
$sql = mysqli_real_escape_string($con,$sql);
$result = $con->query($sql);
//echo $sql . "\n";
if($result->num_rows > 0)
{
  $row = mysqli_fetch_array($result);
  if($_SESSION['id'] != $row['User_Access'])
  {
    //echo "S_ID:".$_SESSION['id']."\n";
    //echo "UserAccess".$row['User_Access']."\n";
    echo 'Err: Not authorized';
    exit();
  }
  else
  {
      $sql = "UPDATE `Stats` SET `$stat` = $hp WHERE `Stats`.`Char_ID` = $char; ";
      //echo $sql;
      $sql = mysqli_real_escape_string($con,$sql);
      $result = $con->query($sql);
      if($result != 1)
      {
        echo "Err: Failed to update value";
      }
      //echo $result."TEST";
  }
}
 ?>
