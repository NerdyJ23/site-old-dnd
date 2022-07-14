<?php
//require('../connect.php');

$char = $newid;
for($i = 1; $i <= 24; $i++)
{
  $sql="INSERT INTO `Abilities` VALUES(NULL,$char,$i,0)";
  $err = $con->query($sql);
  if($err != 1)
  {
    //echo $sql;
    error_log("Error inserting #$i on char $char\n$sql");
  }
}
 ?>
