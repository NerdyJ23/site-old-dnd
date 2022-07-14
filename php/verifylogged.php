<?php
session_start();

if(!isset($_SESSION['user']))
{
  $_SESSION['err'] = 'Login to continue';
  header('Location: login.php');
}

 ?>
