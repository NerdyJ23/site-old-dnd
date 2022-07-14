<?php

$sql = "INSERT INTO `Money_Real` VALUES(NULL,$newid,0,0,0,0,0)";
$err = $con->query($sql);
if($err != 1) echo 'Failed to make wallet';

?>
