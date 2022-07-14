<?php
require('../connect.php');
echo "Trying";
require('../verifyAuth.php');
if(!isset($_SESSION))
{
  session_start();
}

$sql = "DELETE FROM `Characters` WHERE ID = " . $char;
$result = $con->query($sql);
echo $sql;
if($result != 1)
{
  echo "Error occured while deleting";
}
  echo 'done lol';
 ?>
