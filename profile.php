<?php
include_once('template/header.html');
include_once('template/navbar.php');
require('php/verifylogged.php');
session_start();
echo "<title>".$_SESSION['user'] ."</title>";
?>
<h1> <?php echo $_SESSION['user']; ?> </h1>

<div id='profile'></div>
<div id='characters'><?php include('php/getcharacters.php'); showchars('Public',1,0); showchars('Private',0,0); ?></div>
